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
      } else if (PAYPALAPI["env"] == "production") {
        $environment = new ProductionEnvironment(PAYPALAPI["clientID"], PAYPALAPI["secret"]);
      } else {
        throw new HttpException("PayPal Environment not specified.", 404, null);
      }
      $this->client = new PayPalHttpClient($environment);
    } catch (HttpException $err) {
      $_SESSION["message"] = "Error - PayPal/construct Failed: " . $err->getMessage() . "<br />";
      return false;
    }

    // Initialise DB Connection
    try {
      $connString = "mysql:host=" . DBSERVER["servername"] . ";dbname=" . DBSERVER["database"];
      $this->conn = new PDO($connString, DBSERVER["username"], DBSERVER["password"]);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $err) {
      echo "Error - PayPal/DB Connection Failed: " . $err->getMessage() . "<br />";
      return false;
    }
    return true;
  }

  /**
   * createOrder function - Create an Order on PayPal
   * @param string $invoiceID    ID of Invoice to allow Merchant/Payer ID Reconciliation
   * @param 
   */
  public function createOrder($invoiceID, $currencyCode, $value) {
    try {
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
      $_SESSION["message"] = "Error - PayPal/createOrder Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }

  /**
   * addOrder function - Add the PayPal order to the database
   * @param object $response  Response Object from PayPal API
   * @return bool $result     True if loaded or False
   */
  public function addOrder($response) {
    try {
      $createTime = date("Y-m-d H:i-s", strtotime($response->result->create_time));
      $sql = "INSERT INTO paypal_orders (`OrderID`, `Status`, `CurrencyCode`, `Value`, `InvoiceID`, `CreateTime`, `PayPalDebugID`) VALUES ('{$response->result->id}', '{$response->result->status}', '{$response->result->purchase_units[0]->amount->currency_code}', '{$response->result->purchase_units[0]->amount->value}', '{$response->result->purchase_units[0]->invoice_id}', '{$createTime}', '{$response->headers["Paypal-Debug-Id"]}')";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - PayPal/addOrder Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }
}
?>