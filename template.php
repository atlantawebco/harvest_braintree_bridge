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
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row">
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
            <td class="text-right">$<?php echo $value['unit_price']; ?></td>
            <td class="text-right">$<?php echo $value['amount']; ?></td>
        </tr>
     <?php
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
                $1200.00 <br>
                $2.00 <br>
                N/A <br>
                $1200.00 <br>
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
                        <form id="checkout" method="post" action="/checkout">
                            <div id="payment-form"></div>
                            <input type="submit" value="Pay $10">
                        </form>

                        <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
                        <script>
                            // We generated a client token for you so you can test out this code
                            // immediately. In a production-ready integration, you will need to
                            // generate a client token on your server (see section below).
                            var clientToken = "eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiI5N2E3MTNlZTdjMDZkM2JkNzM1YjdlYzI0OTg0OGIyY2UyNjE0M2M5MDBhYjdlNjU1MmM0OWYwZjUyMjEwYmE2fGNyZWF0ZWRfYXQ9MjAxNS0xMC0wMlQwNjo0OTo0Mi4zMTk2NzUxNjcrMDAwMFx1MDAyNm1lcmNoYW50X2lkPTM0OHBrOWNnZjNiZ3l3MmJcdTAwMjZwdWJsaWNfa2V5PTJuMjQ3ZHY4OWJxOXZtcHIiLCJjb25maWdVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvMzQ4cGs5Y2dmM2JneXcyYi9jbGllbnRfYXBpL3YxL2NvbmZpZ3VyYXRpb24iLCJjaGFsbGVuZ2VzIjpbXSwiZW52aXJvbm1lbnQiOiJzYW5kYm94IiwiY2xpZW50QXBpVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzLzM0OHBrOWNnZjNiZ3l3MmIvY2xpZW50X2FwaSIsImFzc2V0c1VybCI6Imh0dHBzOi8vYXNzZXRzLmJyYWludHJlZWdhdGV3YXkuY29tIiwiYXV0aFVybCI6Imh0dHBzOi8vYXV0aC52ZW5tby5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tIiwiYW5hbHl0aWNzIjp7InVybCI6Imh0dHBzOi8vY2xpZW50LWFuYWx5dGljcy5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tIn0sInRocmVlRFNlY3VyZUVuYWJsZWQiOnRydWUsInRocmVlRFNlY3VyZSI6eyJsb29rdXBVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvMzQ4cGs5Y2dmM2JneXcyYi90aHJlZV9kX3NlY3VyZS9sb29rdXAifSwicGF5cGFsRW5hYmxlZCI6dHJ1ZSwicGF5cGFsIjp7ImRpc3BsYXlOYW1lIjoiQWNtZSBXaWRnZXRzLCBMdGQuIChTYW5kYm94KSIsImNsaWVudElkIjpudWxsLCJwcml2YWN5VXJsIjoiaHR0cDovL2V4YW1wbGUuY29tL3BwIiwidXNlckFncmVlbWVudFVybCI6Imh0dHA6Ly9leGFtcGxlLmNvbS90b3MiLCJiYXNlVXJsIjoiaHR0cHM6Ly9hc3NldHMuYnJhaW50cmVlZ2F0ZXdheS5jb20iLCJhc3NldHNVcmwiOiJodHRwczovL2NoZWNrb3V0LnBheXBhbC5jb20iLCJkaXJlY3RCYXNlVXJsIjpudWxsLCJhbGxvd0h0dHAiOnRydWUsImVudmlyb25tZW50Tm9OZXR3b3JrIjp0cnVlLCJlbnZpcm9ubWVudCI6Im9mZmxpbmUiLCJ1bnZldHRlZE1lcmNoYW50IjpmYWxzZSwiYnJhaW50cmVlQ2xpZW50SWQiOiJtYXN0ZXJjbGllbnQzIiwiYmlsbGluZ0FncmVlbWVudHNFbmFibGVkIjp0cnVlLCJtZXJjaGFudEFjY291bnRJZCI6ImFjbWV3aWRnZXRzbHRkc2FuZGJveCIsImN1cnJlbmN5SXNvQ29kZSI6IlVTRCJ9LCJjb2luYmFzZUVuYWJsZWQiOmZhbHNlLCJtZXJjaGFudElkIjoiMzQ4cGs5Y2dmM2JneXcyYiIsInZlbm1vIjoib2ZmIn0=";

                            braintree.setup(clientToken, "dropin", {
                                container: "payment-form"
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
