<?php
/**
 * Created using PhpStorm
 * Project Name: Harvest_Braintree_Bridge
 * File Name: config.php
 * Author: Amy Bridges
 * Created on 10/5/2015 at 4:26 PM
 * Company: Atlanta Web Certified Officials
 * W: http://www.atlcode.com
 */

setlocale(LC_MONETARY, 'en_US.UTF-8');

/** @var  $harvestURI */
$harvestURI = ".harvestapp.com";

/** @var  $braintreeClientToken */
$braintreeClientToken = "";

/** @var  $braintreeMode */
$braintreeMode = "sandbox"; // sandbox ?: production

/** @var  $braintreeMerchantId */
$braintreeMerchantId = "";

/** @var  $braintreePublicKey */
$braintreePublicKey = "";

/** @var  $braintreePrivateKey */
$braintreePrivateKey = "";

/** @var  $ssl */
$ssl = false; // https mode on or off

/** @var  $retry */
$retry = false; // retry the connection if 503 on or off

$company_name = "";
$company_address = "";
$company_phone = "";
$company_email = "";

/** @var  $user */
$user = ""; // account username

/** @var  $password */
$password = ""; // account password

/** @var  $account */
$account = ""; // account name goes here ex: http://company123.harvestapp.com/ account would be company123

/** @var  $invoice_id */
$cKey = $_REQUEST['key']; //Invoice ID form the URL

$dir = dirname(__FILE__) ;

$current_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$current_uri_parse = parse_url($current_uri);