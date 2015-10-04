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

setlocale(LC_MONETARY, 'en_US.UTF-8');

/** @var  $harvestURI */
$harvestURI = ".harvestapp.com";

/** @var  $braintreeClientToken */
$braintreeClientToken = "eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiI5N2E3MTNlZTdjMDZkM2JkNzM1YjdlYzI0OTg0OGIyY2UyNjE0M2M5MDBhYjdlNjU1MmM0OWYwZjUyMjEwYmE2fGNyZWF0ZWRfYXQ9MjAxNS0xMC0wMlQwNjo0OTo0Mi4zMTk2NzUxNjcrMDAwMFx1MDAyNm1lcmNoYW50X2lkPTM0OHBrOWNnZjNiZ3l3MmJcdTAwMjZwdWJsaWNfa2V5PTJuMjQ3ZHY4OWJxOXZtcHIiLCJjb25maWdVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvMzQ4cGs5Y2dmM2JneXcyYi9jbGllbnRfYXBpL3YxL2NvbmZpZ3VyYXRpb24iLCJjaGFsbGVuZ2VzIjpbXSwiZW52aXJvbm1lbnQiOiJzYW5kYm94IiwiY2xpZW50QXBpVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzLzM0OHBrOWNnZjNiZ3l3MmIvY2xpZW50X2FwaSIsImFzc2V0c1VybCI6Imh0dHBzOi8vYXNzZXRzLmJyYWludHJlZWdhdGV3YXkuY29tIiwiYXV0aFVybCI6Imh0dHBzOi8vYXV0aC52ZW5tby5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tIiwiYW5hbHl0aWNzIjp7InVybCI6Imh0dHBzOi8vY2xpZW50LWFuYWx5dGljcy5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tIn0sInRocmVlRFNlY3VyZUVuYWJsZWQiOnRydWUsInRocmVlRFNlY3VyZSI6eyJsb29rdXBVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvMzQ4cGs5Y2dmM2JneXcyYi90aHJlZV9kX3NlY3VyZS9sb29rdXAifSwicGF5cGFsRW5hYmxlZCI6dHJ1ZSwicGF5cGFsIjp7ImRpc3BsYXlOYW1lIjoiQWNtZSBXaWRnZXRzLCBMdGQuIChTYW5kYm94KSIsImNsaWVudElkIjpudWxsLCJwcml2YWN5VXJsIjoiaHR0cDovL2V4YW1wbGUuY29tL3BwIiwidXNlckFncmVlbWVudFVybCI6Imh0dHA6Ly9leGFtcGxlLmNvbS90b3MiLCJiYXNlVXJsIjoiaHR0cHM6Ly9hc3NldHMuYnJhaW50cmVlZ2F0ZXdheS5jb20iLCJhc3NldHNVcmwiOiJodHRwczovL2NoZWNrb3V0LnBheXBhbC5jb20iLCJkaXJlY3RCYXNlVXJsIjpudWxsLCJhbGxvd0h0dHAiOnRydWUsImVudmlyb25tZW50Tm9OZXR3b3JrIjp0cnVlLCJlbnZpcm9ubWVudCI6Im9mZmxpbmUiLCJ1bnZldHRlZE1lcmNoYW50IjpmYWxzZSwiYnJhaW50cmVlQ2xpZW50SWQiOiJtYXN0ZXJjbGllbnQzIiwiYmlsbGluZ0FncmVlbWVudHNFbmFibGVkIjp0cnVlLCJtZXJjaGFudEFjY291bnRJZCI6ImFjbWV3aWRnZXRzbHRkc2FuZGJveCIsImN1cnJlbmN5SXNvQ29kZSI6IlVTRCJ9LCJjb2luYmFzZUVuYWJsZWQiOmZhbHNlLCJtZXJjaGFudElkIjoiMzQ4cGs5Y2dmM2JneXcyYiIsInZlbm1vIjoib2ZmIn0=";

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
$cKey = $_REQUEST['key']; //Invoice ID form the URL

// Require Harvest Main App API Wrapper
require_once( dirname(__FILE__) . '/HarvestAPI.php' );

// Initiate the loader DOM
spl_autoload_register(array('HarvestAPI', 'autoload') );

if($cKey != false) {

    $api = new HarvestAPI();
    $api->setUser($user);
    $api->setPassword($password);
    $api->setAccount($account);
    $api->setSSL($ssl);

    if ($retry) {
        $api->setRetryMode(HarvestAPI::RETRY);
    }

    //$filter = new Harvest_Invoice_Filter();
    //$filter->set( "status", Harvest_Invoice_Filter::UNPAID );

    $result = $api->getInvoices(  );
    if( $result->isSuccess() ) {
        $invoices = $result->data;
        foreach ($invoices as $invoices_key => $invoices_val) {

            if($cKey == $invoices_val->client_key) {

                $invoice_id = $invoices_val->id;

            } else {
                die("Sorry! That key does not match an unpaid invoice.");
            }

        }
    }

    $inv_result = $api->getInvoice($invoice_id);

    if ($inv_result->isSuccess()) {

        $invoice = $inv_result->data;

        //print_r($invoice);

        $client_key = $invoice->get('client-key');

        $invoice_id = $invoice->id;

        $invoice_subject = $invoice->subject;

        $invoice_po_number = $invoice->get('purchase-order');

        $invoice_issued_on = date("m/d/Y", strtotime($invoice->get('issued-at')));
        $invoice_due_on = date("m/d/Y", strtotime($invoice->get('due-at')));
        $invoice_due_on_human = $invoice->get('due-at-human-format');

        $invoice_notes = $invoice->notes;

        $discount_amount = $invoice->get('discount-amount');
        $due_amount = $invoice->get('due-amount');
        $tax_amount = $invoice->get('tax-amount');

        $invoice_state = $invoice->get('state');

        $lines = explode( "\n", $invoice->get('csv-line-items') );
        $headers = str_getcsv( array_shift( $lines ) );
        $data = array();
        foreach ( $lines as $line ) {
            $row = array();
            foreach ( str_getcsv( $line ) as $key => $field )
                $row[ $headers[ $key ] ] = $field;
            $row = array_filter( $row );
            $data[] = $row;
        }

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