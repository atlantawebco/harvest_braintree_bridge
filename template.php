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
                <h4>Service</h4>
            </th>
            <th>
                <h4>Description</h4>
            </th>
            <th>
                <h4>Hrs/Qty</h4>
            </th>
            <th>
                <h4>Rate/Price</h4>
            </th>
            <th>
                <h4>Sub Total</h4>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Article</td>
            <td><a href="#">Title of your article here</a></td>
            <td class="text-right">-</td>
            <td class="text-right">$200.00</td>
            <td class="text-right">$200.00</td>
        </tr>
        <tr>
            <td>Template Design</td>
            <td><a href="#">Details of project here</a></td>
            <td class="text-right">10</td>
            <td class="text-right">75.00</td>
            <td class="text-right">$750.00</td>
        </tr>
        <tr>
            <td>Development</td>
            <td><a href="#">WordPress Blogging theme</a></td>
            <td class="text-right">5</td>
            <td class="text-right">50.00</td>
            <td class="text-right">$250.00</td>
        </tr>
        </tbody>
    </table>
    <div class="row text-right">
        <div class="col-xs-2 col-xs-offset-8">
            <p>
                <strong>
                    Sub Total : <br>
                    TAX : <br>
                    Total : <br>
                </strong>
            </p>
        </div>
        <div class="col-xs-2">
            <strong>
                $1200.00 <br>
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
                        <p>
                            Email : you@example.com <br><br>
                            Mobile : -------- <br> <br>
                            Twitter : <a href="https://twitter.com/tahirtaous">@TahirTaous</a>
                        </p>
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
