<?php
/**
 * Created using PhpStorm
 * Project Name: Harvest_Braintree_Bridge
 * File Name: index.php
 * Author: Amy Bridges
 * Created on 10/1/2015 at 5:18 PM
 * Company: Atlanta Web Certified Officials
 * W: http://www.atlcode.com
 */

/** @var  $harvestURI */
$harvestURI = ".harvestapp.com";

/** @var  $ssl */
$ssl = false; // https mode on or off

/** @var  $retry */
$retry = false; // retry the connection if 503 on or off

$company_name = "Company Name";
$company_address = "00 Test Lane <br> Atlanta, Georgia 30305";
$company_phone = "000-000-0000";
$company_email = "test@mymail.com";

/** @var  $user */
$user = ""; // account username

/** @var  $password */
$password = ""; // account password

/** @var  $account */
$account = ""; // account name goes here ex: http://company123.harvestapp.com/ account would be company123

/** @var  $invoice_id */
$invoice_id = (int)$_REQUEST['inv']; //Invoice ID form the URL

// Require Harvest Main App API Wrapper
require_once( dirname(__FILE__) . '/HarvestAPI.php' );

// Initiate the loader DOM
spl_autoload_register(array('HarvestAPI', 'autoload') );

if($invoice_id != false) {

    $api = new HarvestAPI();
    $api->setUser($user);
    $api->setPassword($password);
    $api->setAccount($account);
    $api->setSSL($ssl);

    if ($retry) {
        $api->setRetryMode(HarvestAPI::RETRY);
    }

    $inv_result = $api->getInvoice($invoice_id);

    if ($inv_result->isSuccess()) {

        $invoice = $inv_result->data;

        $invoice_id = $invoice->id;

        $invoice_subject = $invoice->subject;

        $invoice_po_number = $invoice->get('purchase-order');

        $invoice_issued_on = date("m/d/Y", strtotime($invoice->get('issued-at')));
        $invoice_due_on = date("m/d/Y", strtotime($invoice->get('due-at')));
        $invoice_due_on_human = $invoice->get('due-at-human-format');

        $invoice_notes = $invoice->notes;

        $client_id = $invoice->get('client-id');

        $client_result = $api->getClient(  $client_id  );

        if($client_result->isSuccess() ) {

            $client = $client_result->data;

            $client_name = $client->get('name');
            $client_details = $client->get('details');

            $client_contact_result = $api->getClientContacts(  $client_id  );

            if($client_contact_result->isSuccess() ) {

                $client_contact = $client_contact_result->data;

                $client_contact_i = 0;
                $client_contact_items = count($client_contact);
                foreach($client_contact as $client_contact_key => $client_contact_value) {

                    if(++$client_contact_i === $client_contact_items) {
                        $client_contact_name = $client_contact_value->get('first-name') . " " . $client_contact_value->get('last-name');

                        if ($client_contact_value->get('phone-mobile') != "") {
                            $client_contact_phone = $client_contact_value->get('phone-mobile');
                        } else {
                            $client_contact_phone = $client_contact_value->get('phone-office');
                        }

                        $client_contact_email  =  $client_contact_value->get('email');
                    }

                }

                //$client_contact_name = $client_contact->get('first-name');

                require_once("template.php");

            } else {

                die("Opps!! Well this is not good, An error has occurred for pulling the client contact data.");

            }

        } else {

            die("Opps!! Well this is not good, An error has occurred for pulling the client data.");

        }


    } else {
        die("Opps!! Well this is not good, An error has occurred for pulling the invoice data.");
    }

} else {

    die('Sorry! You must enter a invoice id before we can initiate the invoice app');

}