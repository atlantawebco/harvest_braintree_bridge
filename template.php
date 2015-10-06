<?php
/**
 * Created using PhpStorm
 * Project Name: Harvest_Braintree_Bridge
 * File Name: template.php
 * Author: Amy Bridges
 * Created on 10/1/2015 at 5:45 PM
 * Company: Atlanta Web Certified Officials
 * W: http://www.atlcode.com
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #<?php echo $invoice_id; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <style>
        @import url(http://fonts.googleapis.com/css?family=Bree+Serif);
        body, h1, h2, h3, h4, h5, h6{
            font-family: 'Bree Serif', serif;
        }
        .hidden {
            visibility: hidden;
        }
        .margin-padding-extra-info {
            margin-bottom: 2px;
            padding-bottom: 2px;
            margin-top: 2px;
        }        
        .top {
            background-image: url("assets/images/<?php echo $invoice_state_img; ?>");
            background-repeat: no-repeat;
            background-position: center;
        }
        
    </style>
</head>

<body>
<div class="container">
    <div class="row top">
        <div class="col-xs-6">
            <h1>
                <a href="https://twitter.com/tahirtaous">
                    <img class="img-responsive" width="300" src="assets/images/logo.png">
                </a>
            </h1>
        </div>
        <div class="col-xs-6 text-right">
            <h1>INVOICE</h1>
            <h1><small>Invoice #<?php echo $invoice_id; ?></small></h1>
            <?php if($invoice_po_number != "") { ?>
            <h3 class="margin-padding-extra-info"><small>PO Number: <?php echo $invoice_po_number; ?></small></h3>
            <?php } ?>
            <h3 class="margin-padding-extra-info"><small>Issue Date: <?php echo $invoice_issued_on; ?></small></h3>
            <h3 class="margin-padding-extra-info"><small class="text-danger">Due Date: <?php echo $invoice_due_on; ?> (<?php echo $invoice_due_on_human; ?>)</small></h3>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="text-primary">From: <?php echo $company_name; ?></h4>
                </div>
                <div class="panel-body">
                    <p><?php echo $company_address; ?></p>
                    <p><i class="fa fa-fw fa-phone-square"></i> <a href="tel:<?php echo $company_phone; ?>"><?php echo $company_phone; ?></a> <i class="fa fa-fw fa-envelope-square"></i> <a href="mailto:<?php echo $company_email; ?>"><?php echo $company_email; ?></a></p>
                </div>
            </div>

            <?php if($invoice_subject != "") { ?>
            <div class="text-warning"><b>Subject: <?php echo $invoice_subject; ?></b></div>
            <?php } ?>

        </div>
        <div class="col-xs-5 col-xs-offset-2 text-right">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="text-success">To: <?php echo $client_name; ?></h4>
                </div>
                <div class="panel-body">
                    <p>Attn: <?php echo $client_contact_name; ?></p>
                    <p>
                        <?php echo nl2br($client_details); ?>
                    </p>
                    <p><?php if($client_contact_phone != "") { ?><i class="fa fa-fw fa-phone-square"></i> <a href="tel:<?php echo $client_contact_phone; ?>"><?php echo $client_contact_phone; ?></a> <?php } ?> <i class="fa fa-fw fa-envelope-square"></i> <a href="mailto:<?php echo $client_contact_email; ?>"><?php echo $client_contact_email; ?></a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- / end client details section -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>
                <h4>Item Type</h4>
            </th>
            <th>
                <h4>Description</h4>
            </th>
            <th>
                <h4 align="right">Hrs/Qty</h4>
            </th>
            <th>
                <h4 align="right">Rate/Price</h4>
            </th>
            <th>
                <h4 align="right">Amount</h4>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
        $invLineCount = 0;
        $em = array_filter($data);
        foreach($em as $key => $value) {
        ?>
        <tr>
            <td><?php echo $value['kind']; ?></td>
            <td><?php echo $value['description']; ?></td>
            <td class="text-right"><?php echo $value['quantity']; ?></td>
            <td class="text-right"><?php  echo money_format('%.2n', $value['unit_price']); ?></td>
            <td class="text-right"><?php  echo money_format('%.2n', $value['amount']); ?></td>
        </tr>
     <?php
            $subTotal += $value['amount'];

            $invLineCount++;
        }

        ?>
        </tbody>
    </table>
    <div class="row text-right">
        <div class="col-xs-2 col-xs-offset-8">
            <p>
                <strong>
                    Sub Total : <br>
                    Discount : <br>
                    TAX : <br>
                    Total : <br>
                </strong>
            </p>
        </div>
        <div class="col-xs-2">
            <strong>
                <?php  echo money_format('%.2n', $subTotal); ?> <br>
                <?php  echo money_format('%.2n', $discount_amount); ?> <br>
                <?php  echo money_format('%.2n', $tax_amount); ?> <br>
                <?php  echo money_format('%.2n', $due_amount); ?> <br>
            </strong>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-5">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Payment Method</h4>
                </div>
                <div class="panel-body">
                    <div class="radio">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                            Braintree (Credit Card)
                        </label>
                    </div>
                    <div><i class="fa fa-fw fa-cc-visa fa-2x"></i> <i class="fa fa-fw fa-cc-mastercard fa-2x"></i> <i class="fa fa-fw fa-cc-amex fa-2x"></i> <i class="fa fa-fw fa-cc-discover fa-2x"></i> <i class="fa fa-fw fa-cc-paypal fa-2x"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xs-7">
            <div class="span7">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4>Payment Form</h4>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo $current_uri_parse['path']; ?>Braintree/transaction.php" method="post" id="braintree-payment-form">
                            <div class="form-group">
                                <label for="cardholder_name">Card Holder Name</label><br>
                                <input type="text" id="cardholder_name" class="form-control" size="40" autocomplete="off" name="cardholder_name" required=""><br>
                                <small class="small">(name as shown on card)</small>
                            </div>
                            <div class="form-group">
                                <label for="cc_number">Card Number</label><br>
                                <input type="text" id="cc_number" class="form-control" size="40" autocomplete="off" data-encrypted-name="number" maxlength="19" required=""><br>
                                <small class="small">(16/19 digit card number)</small>
                            </div>
                            <p><label for="month">Expiration Date</label></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="month" class="form-control"><option value="">Select Month</option><option value="1">January (1)</option><option value="2">February (2)</option><option value="3">March (3)</option><option value="4">April (4)</option><option value="5">May (5)</option><option value="6">June (6)</option><option value="7">July (7)</option><option value="8">August (8)</option><option value="9">September (9)</option><option value="10">October (10)</option><option value="11">November (11)</option><option value="12">December (12)</option></select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="year" class="form-control"><option value="">Select Year</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option><option value="2019">2019</option><option value="2020">2020</option><option value="2021">2021</option><option value="2022">2022</option><option value="2023">2023</option><option value="2024">2024</option></select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cvv">CVV</label><br>
                                <input type="text" class="form-control" size="4" autocomplete="off" data-encrypted-name="cvv" maxlength="4" required=""><br>
                                <small class="small">(3/4 digits on back of card)</small>
                            </div>
                            <div class="form-group">
                                <label for="payment_zipcode">Billing Zip Code</label><br>
                                <input type="text" class="form-control" size="6" autocomplete="off" name="payment_zipcode" required=""><br>
                                <small class="small">(billing zip code linked to card)</small>
                            </div>
                            <div class="form-group">
                                <label for="payment_email">Email Address</label><br>
                                <input type="email" class="form-control" id="payment_email" name="payment_email" size="40" autocomplete="off" required=""><br>
                                <small class="small">(please enter your email for a receipt)</small>
                            </div>
                            <input type="hidden" id="payment_amount" name="payment_amount" value="<?php echo $due_amount; ?>">
                            <input type="hidden" id="invoice_number" value="<?php echo $invoice_id; ?>" name="invoice_number">
                            <input type="submit" id="submit" class="btn btn-danger btn-lg" value="Pay <?php  echo money_format('%.2n', $due_amount); ?>"><p></p>
                        </form>

                        <script type='text/javascript' src='//code.jquery.com/jquery-1.11.3.min.js'></script>
                        <script type='text/javascript' src='//js.braintreegateway.com/v1/braintree.js'></script>
                        <script>
                            $( document ).ready(function() {
                            var ajax_submit = function (e) {
                                form = $('#braintree-payment-form');
                                e.preventDefault();
                                $("#submit").attr("disabled", "disabled");
                                $.post(form.attr('action'), form.serialize(), function (data) {
                                    form.parent().replaceWith(data);
                                });
                            }
                            var braintree = Braintree.create('MIIBCgKCAQEAmu7fa8cMX+cmxW2EaD1aYFqI3Ktz2wjRyvRZ2VtOV98B1ok7rUPSB1HnYYBaQLW2XFvGJ6MB0kXu1khcoyRica2g+Kf/1NwNLgqoyPkyZ3amDUKfVKpunQpRaO8ZsAOg0gMQYqjjngBN6I9Kx5pXixZkbhfC/SaoLm5nH1UXKMotqlDQi8H8S8XvAbZFebSi3Z4gL2hjFIjmKwdDVnMdwLgxCwk61kVFhF+wENXB9tloTL50GPSS+Ct+w4SRODsQokZTqaacVwTWoz6yzQXu/zr+17fHEX1Khr3qr1luwxWnXJUdrI25Kr5yfseoZc/NsKF2j82QgcuUL63tQDzPvwIDAQAB');
                            braintree.onSubmitEncryptForm('braintree-payment-form', ajax_submit);

                            });
                        </script>

                        <hr>
                        <h5> <h6 class="text-danger">Notes</h6> <?php echo $invoice_notes; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
