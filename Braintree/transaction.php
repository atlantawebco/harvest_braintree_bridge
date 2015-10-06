<?php

require_once 'lib/Braintree.php';

require_once( dirname(dirname(__FILE__)) . '/HarvestAPI.php' );

spl_autoload_register(array('HarvestAPI', 'autoload') );

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('dpj4pxjbj3cnx8xg');
Braintree_Configuration::publicKey('4x6tx5z3bnryd28f');
Braintree_Configuration::privateKey('56e2c31914c5326fa84f65937b307235');

//Braintree_Configuration::environment('production');
//Braintree_Configuration::merchantId('7v6gffktf6qxg98h');
//Braintree_Configuration::publicKey('vq8xkx9t3wz996f3');
//Braintree_Configuration::privateKey('48ab9e13970abdffaa17f6fef835511a');


$result_bt = Braintree_Transaction::sale(array(

    "amount" => $_POST["payment_amount"],
	'orderId' => $_POST["invoice_number"],
    "creditCard" => array(
	   'cardholderName' => $_POST["cardholder_name"],
        "number" => $_POST["number"],
        "cvv" => $_POST["cvv"],
        "expirationMonth" => $_POST["month"],
        "expirationYear" => $_POST["year"]
    ),
	'customer' => array(
    'email' => $_POST['payment_email']
  ),
    'billing' => array(
    'postalCode' => $_POST["payment_zipcode"],
  ),
    "options" => array(
        "submitForSettlement" => true
    )
));

if ($result_bt->success) {

    echo("<Br><br><p style=\"font-size:13px\">Thank you for your payment! <br><Br> Your payment reference number is  #" . $result->transaction->id . " <br><Br>Please keep a note of this reference number for your payment records.<br><br>If you do not receive your payment receipt by email automatically please contact us and we will provide you with a receipt manually. <Br><BR> Note: All invoices are updated to paid status manually next business day.</p> ");

    require_once( dirname(dirname(__FILE__)) . '/config.php' );

    $hashAuth = base64_encode($user.":".$password);

    $today_date = date("Y-m-d");
    $today_time = date("H:i:s");

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://".$account.".harvestapp.com/invoices/".$_POST["invoice_number"]."/payments",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "<payment>\r\n  <paid-at>".$today_date."T".$today_time."Z</paid-at>\r\n  <amount>".$_POST["payment_amount"]."</amount>\r\n  <notes></notes>\r\n</payment>",
        CURLOPT_HTTPHEADER => array(
            "accept: application/xml",
            "authorization: Basic ".$hashAuth,
            "cache-control: no-cache",
            "content-type: application/xml"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

} else if ($result_bt->transaction) {
    echo("<Br><br><p style=\"font-size:13px\">Error: " . $result->message."</p>");
    echo("<br/>");
    echo("<p style=\"font-size:13px\">Code: " . $result->transaction->processorResponseCode."</p>");
	echo ("<br><br><a href=\"http://atlcode.com/bill-pay/\">Please try your payment again</a>");
} else {
    echo("<br><br><p style=\"font-size:12px\">Validation errors:</p><br/>");
    foreach (($result_bt->errors->deepAll()) as $error) {
        echo("<p style=\"font-size:13px; color:red;\">- " . $error->message . "</p><br/>");
    }
		echo ("Please try your payment again.");

}




?>