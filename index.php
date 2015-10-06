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



// Require Harvest Main App API Wrapper
require_once( dirname(__FILE__) . '/HarvestAPI.php' );

require_once( dirname(__FILE__)  . '/config.php' );

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

            //print_r($invoices_val);

            if($cKey == $invoices_val->number) {

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

        if($invoice_state == "open") {

            if (strtotime($invoice->get('due-at')) < time()) {
                $invoice_state_img = "late.gif";
            }

        } elseif($invoice_state == "partial") {

            if (strtotime($invoice->get('due-at')) < time()) {
                $invoice_state_img = "late.gif";
            }

        } elseif($invoice_state == "draft") {

            $invoice_state_img = "draft.gif";

        } elseif($invoice_state == "paid") {

            $invoice_state_img = "paid.gif";

        }

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