<html lang="en">
<head>
    <title>Paypal Payment Gateway</title>
</head>
<body style="background:#fafafa">
<style type="text/css">
		.price.panel-red>.panel-heading {
		    color: #009cde;
		    background-color: #fafafa;
		    margin: 0;
		    padding: 5px;
		}	
		.price.panel-red>.panel-body {
		    color: #333;
		    background-color: #f1f1f1;
		}
		.price .list-group-item{
			border-bottom-:1px solid rgba(250,250,250, .5);
		}
		.panel.price .list-group-item:last-child {
			border-bottom-right-radius: 0px;
			border-bottom-left-radius: 0px;
		}
		.panel.price .list-group-item:first-child {
			border-top-right-radius: 0px;
			border-top-left-radius: 0px;
		}
		.price .panel-footer {
			color: #fff;
			border-bottom:0px;
			background-color:  rgba(0,0,0, .1);
			box-shadow: 0px 3px 0px rgba(0,0,0, .3);
		}
		.panel.price .btn{
			box-shadow: 0 -1px 0px rgba(50,50,50, .2) inset;
			border:0px;
		}
		.pay-box{
			width: 50%;
			margin: 150px auto;
		}
		.btn-info {
		    color: #fff;
		    background-color: #009cde !important;
		    background-image: none;
		    border: none !important;
		    cursor: pointer !important;
		}
</style>

<?php
	$paypalUrl='https://www.sandbox.paypal.com/cgi-bin/webscr';
	$paypalId='2kbd.noyon-facilitator@gmail.com';
?>
 
<div class="container text-center">
	<div class="row">
		<div class="col-md-12">
			
			<div class="pay-box">

				<h2><strong>Paypal Payment</strong></h2><br>
				<!-- PRICE ITEM -->
				<form action="<?php echo html_escape($paypalUrl); ?>" method="post" name="frmPayPal1">
					<div class="panel price panel-red">
					    <input type="hidden" name="business" value="<?php echo html_escape($paypalId); ?>">
					    <input type="hidden" name="cmd" value="_xclick">
					    <input type="hidden" name="item_name" value="It Solution Stuff">
					    <input type="hidden" name="item_number" value="2">
					    <input type="hidden" name="amount" value="20">
					    <input type="hidden" name="no_shipping" value="1">
					    <input type="hidden" name="currency_code" value="USD">
					    <input type="hidden" name="cancel_return" value="http://demo.itsolutionstuff.com/paypal/cancel.php">
					    <input type="hidden" name="return" value="http://demo.itsolutionstuff.com/paypal/success.php">  
						    
						<div class="panel-heading  text-center">
						<h3>PRO PLAN</h3>
						</div>
						<div class="panel-body text-center">
							<p class="lead" style="font-size:40px"><strong>$20 / month</strong></p>
						</div>
						<div class="panel-footer">
							<button class="btn btn-lg btn-block btn-info" href="#">PAY NOW!</button>
						</div>
					</div>
				</form>
				<!-- /PRICE ITEM -->
			</div>

		</div>
	</div>
</div>
</body>
</html>
