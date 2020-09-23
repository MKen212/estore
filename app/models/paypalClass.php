<?php  // PayPal Class

// Load PayPal SDK Classes
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalHttp\HttpException;

use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;

use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class PayPal {
  private $client;  // PayPal HTTP Client Object
  private $conn;  // PDO database connection object

  /**
   * __construct function - Initialise the PayPal object
   */
  public function __construct() {
    // Initialise PayPal Client API Connection
    try {
      // Load relevant Sandbox/Production Environment
      if (PAYPALAPI["env"] == "sandbox") {
        $environment = new SandboxEnvironment(PAYPALAPI["clientID"], PAYPALAPI["secret"]);
      } elseif (PAYPALAPI["env"] == "production") {
        $environment = new ProductionEnvironment(PAYPALAPI["clientID"], PAYPALAPI["secret"]);
      } else {
        throw new HttpException("PayPal Environment not specified.", 400, null);
      }
      $this->client = new PayPalHttpClient($environment);
    } catch (HttpException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - PayPal/construct Failed: " . $err->getMessage() . "<br />");
      return false;
    }

    // Initialise DB Connection
    try {
      $connString = "mysql:host=" . DBSERVER["servername"] . ";dbname=" . DBSERVER["database"];
      $this->conn = new PDO($connString, DBSERVER["username"], DBSERVER["password"]);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - PayPal/DB Connection Failed: " . $err->getMessage() . "<br />");
      return false;
    }
    return true;
  }

  /**
   * createOrder function - Create an Order on PayPal
   * @param string $invoiceID     ID of Invoice to allow Merchant/Payer ID Reconciliation
   * @param string $currencyCode  Currency Code of transaction
   * @param float $value          Value of transaction
   * @return object $response     Returns object of the Created Order or False
   */
  public function createOrder($invoiceID, $currencyCode, $value) {
    try {
      if (empty($invoiceID) || empty($currencyCode) || empty($value)) throw new HttpException("Required parameters not provided.", 400, null);
      // Build the Order Body
      $body = [
        "intent" => "CAPTURE",
        "purchase_units" => [
          0 => [
            "invoice_id" => $invoiceID,
            "description" => PAYPALAPI["purchaseDesc"],
            "amount" => [
              "currency_code" => $currencyCode,
              "value" => $value,
            ]
          ]
        ]
      ];

      // Build the Order request
      $request = new OrdersCreateRequest();
      $request->prefer("return=representation");
      $request->body = $body;

      // Execute the Order request
      $response = (object) $this->client->execute($request);

      // If response returned then update Session and load order into database
      if ($response) {
        // Update Session variables
        $_SESSION["cart"][0]["ppOrderID"] = $response->result->id;
        $_SESSION["cart"][0]["ppOrderStatus"] = $response->result->status;
        // Load into Database & Return
        $this->addOrder($response);
        return $response;
      } else {
        throw new HttpException("No PayPal API response.", 204, null);
      }
    } catch (HttpException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - PayPal/createOrder Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * addOrder function - Add the PayPal order to the database
   * @param object $response  Response Object from PayPal API
   * @return int $result      Number of records added or False
   */
  public function addOrder($response) {
    try {
      // Update variables
      $createTime = date("Y-m-d H:i-s", strtotime($response->result->create_time));

      // Build SQL & Execute
      $sql = "INSERT INTO paypal_orders (`PpInvoiceID`, `PpOrderID`, `PpOrderStatus`, `CurrencyCode`, `Value`, `CreateTimestamp`, `CreateDebugID`) VALUES ('{$response->result->purchase_units[0]->invoice_id}', '{$response->result->id}', '{$response->result->status}', '{$response->result->purchase_units[0]->amount->currency_code}', '{$response->result->purchase_units[0]->amount->value}', '{$createTime}', '{$response->headers["Paypal-Debug-Id"]}')";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - PayPal/addOrder Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * captureOrder function - Capture an authorised PayPal Order
   * @param string $ppOrderID    PayPal Order ID
   * @return object $response  Returns object of the Captured Order or False
   */
  public function captureOrder($ppOrderID) {
    try {
      if (empty($ppOrderID)) throw new HttpException("PayPal Order ID not provided.", 400, null);

      // Build the Capture Request
      $request = new OrdersCaptureRequest($ppOrderID);
      $request->prefer("return=representation");

      // Execute the Capture request
      $response = (object) $this->client->execute($request);

      // If response returned then update Session and update order in database
      if ($response) {
        // Update Session variables
        $_SESSION["cart"][0]["ppOrderStatus"] = $response->result->status;
        // Update Database & Return
        $this->updateCapturedOrder($response);
        return $response;
      } else {
        throw new HttpException("No PayPal API response.", 204, null);
      }
    } catch (ErrorException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - PayPal/captureOrder Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateCapturedOrder function - Update the Captured PayPal order in the database
   * @param object $response  Response Object from PayPal API
   * @return int $result      Number of records updated or False
   */
  public function updateCapturedOrder($response) {
    try{
      // Update variables
      $shipping = $response->result->purchase_units[0]->shipping->name->full_name . ", " . implode(", ", (array) $response->result->purchase_units[0]->shipping->address);
      $payerName = implode(" ", (array) $response->result->payer->name);
      $captureTime = date("Y-m-d H:i-s", strtotime($response->result->update_time));

      // Build SQL & Execute
      $sql = "UPDATE paypal_orders SET `PpOrderStatus` = '{$response->result->status}', `Shipping` = '$shipping', `PaymentID` ='{$response->result->purchase_units[0]->payments->captures[0]->id}', `PaymentStatus` ='{$response->result->purchase_units[0]->payments->captures[0]->status}', `PaymentCurrency` ='{$response->result->purchase_units[0]->payments->captures[0]->amount->currency_code}', `PaymentValue` ='{$response->result->purchase_units[0]->payments->captures[0]->amount->value}', `PayerID` = '{$response->result->payer->payer_id}', `PayerName` ='$payerName', `PayerEmail` ='{$response->result->payer->email_address}', `CaptureTimestamp` ='$captureTime', `CaptureDebugID` = '{$response->headers["Paypal-Debug-Id"]}' WHERE `PpOrderID` = '{$response->result->id}'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - PayPal/updateCapturedOrder Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }
}
?>