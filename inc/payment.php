<?php
class Boom_Payment_Gateway { 
  
  function __construct() { 
    // TODO: add correct payment ID for PAYPAL submission
    $this->paymentMethod = "paypal";
    $this->form = '<form id="boomshaka-payment-form" method=\"POST\" type=\"application/x-www-form-urlencoded\" action=\"https://paypal.com/paypal">'
      ."<label for=\"boom-payment-firstname\">First Name</label>"
      ."<input id=\"boom-payment-firstname\" name=\"boom-payment-firstname\" type=\"text\" />" 
      ."<label for=\"boom-payment-lastname\">Last Name</label>"
      ."<input id=\"boom-payment-lastname\" name=\"boom-payment-lastname\" type=\"text\" />" 
      ."<label for=\"boom-payment-cc\">Credit Card (in the form XXXXXXXXXXXXXXXX)<label>" 
      ."<input id=\"boom-payment-cc\" name=\"boom-payment-cc\" type=\"text\" />" 
      ."<label for=\"boom-payment-security-code\">Security Code (3 or 4 digits)</label>" 
      ."<input id=\"boom-payment-security-code\" name=\"boom-payment-security-code\" type=\"text\" />" 
      ."<input value=\"pay\" type=\"submit\" />" 
      ."</form>";
  }
  
}
global $boomshaka_payment;
$boomshaka_payment = new Boom_Payment_Gateway();
?>