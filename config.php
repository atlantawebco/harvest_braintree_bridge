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
$braintreeClientToken = "MIIBCgKCAQEAmu7fa8cMX+cmxW2EaD1aYFqI3Ktz2wjRyvRZ2VtOV98B1ok7rUPSB1HnYYBaQLW2XFvGJ6MB0kXu1khcoyRica2g+Kf/1NwNLgqoyPkyZ3amDUKfVKpunQpRaO8ZsAOg0gMQYqjjngBN6I9Kx5pXixZkbhfC/SaoLm5nH1UXKMotqlDQi8H8S8XvAbZFebSi3Z4gL2hjFIjmKwdDVnMdwLgxCwk61kVFhF+wENXB9tloTL50GPSS+Ct+w4SRODsQokZTqaacVwTWoz6yzQXu/zr+17fHEX1Khr3qr1luwxWnXJUdrI25Kr5yfseoZc/NsKF2j82QgcuUL63tQDzPvwIDAQAB";

/** @var  $braintreeMode */
$braintreeMode = "sandbox"; // sandbox ?: production

/** @var  $braintreeMerchantId */
$braintreeMerchantId = "dpj4pxjbj3cnx8xg";

/** @var  $braintreePublicKey */
$braintreePublicKey = "4x6tx5z3bnryd28f";

/** @var  $braintreePrivateKey */
$braintreePrivateKey = "56e2c31914c5326fa84f65937b307235";

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

$dir = dirname(__FILE__) ;

$current_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$current_uri_parse = parse_url($current_uri);