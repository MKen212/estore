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

  /**
   * __construct function - Initialise the PayPal object & set-up the client API connection
   */
  public function __construct() {
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
      return true;
    } catch (HttpException $err) {
      $_SESSION["message"] = "Error - PayPal/construct Failed: " . $err->getMessage() . "<br />";
      return false;
    }
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
      $response = $this->client->execute($request);
      return $response;
    } catch (HttpException $err) {
      $_SESSION["message"] = "Error - PayPal/createOrder Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }
}
?>