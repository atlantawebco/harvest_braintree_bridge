# harvest_braintree_bridge
Braintree Payments for Harvest Invoices (Self Hosted)

# Harvest Braintree Bridge Beta V1

### Why did i create this bridge between harvest and braintree?

I created this bridge simply because Harvest does not support braintree as a payment gateway and i use braintree to accept payments form my clients and i love the look and feel of harvest and the ease of use.

### How do i setup this bridge to work?

Very simple to setup, that's for sure. It will take about 3 minutes or less to setup. 

1. Open the file "config.php" and enter your username, password and account within the correct vars they are named accordingly and have no default values. 
2. Now head over to braintree and grab your client token, you will need to enter this in the $braintreeClientToken var in the config.php
3. Now head over to youraccount.harvestapp.com and go to Invoices >> Configure >> Messages and find "Invoice Message" within the body text box add this to your "Invoice Summary" >> To pay this invoice with your credit card please visit http://myurl.com/harvest_braintree_bridge/?key=%invoice_id%
3. Upload all of the files to you're server in a folder called "harvest_braintree_bridge" or you can name this folder what ever you'd like to call it.
