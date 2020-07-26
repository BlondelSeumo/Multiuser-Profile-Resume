<!DOCTYPE html>
<html lang="en">
<?php $settings = get_settings(); ?>
<head>
    <title>Paypal | <?php echo html_escape($settings->site_name);?></title>
</head>
<body style="background:#fafafa">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/front/css/simple-line-icons.css">
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
            margin: 250px auto;
        }
        .btn-info {
            color: #fff;
            background-color: #009cde !important;
            background-image: none;
            border: none !important;
            cursor: pointer !important;
        }
        .success{
            color: #28a745;
        }
</style>

<?php
    $paypal_url='https://www.paypal.com/cgi-bin/webscr';
    $paypal_id= html_escape($settings->paypal_email);
?>
 
<div class="container text-center">
    <div class="row">
        <div class="col-md-12">
            
            <div class="pay-box">


                <?php if (isset($success_msg) && $success_msg=='Success'): ?>
                    <h3 class="success"><i class="icon-check"></i> Done</h3>
                    <h5 class="success">Your payment has be completed successfully !</h5><br>
                    <a href="<?php echo base_url('admin/profile') ?>" class="btn btn-md btn-info">Continue</a>

                <?php elseif (isset($error_msg) && $error_msg=='Error'): ?>
                    <h3 class="success"><i class="icon-check"></i> Oops !</h3>
                    <h5 class="error">Payment has be failed</h5><br>
                    <a href="<?php echo base_url() ?>" class="btn btn-md btn-danger">Back Home</a>
                <?php else: ?>

                    <h2><strong>Paypal Payment</strong></h2><br>

                    <!-- PRICE ITEM -->
                    <form action="<?php echo html_escape($paypal_url); ?>" method="post" name="frmPayPal1">
                        <div class="panel price panel-red">
                            <input type="hidden" name="business" value="<?php echo html_escape($paypal_id); ?>" readonly>
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="item_name" value="<?php echo html_escape($package->name);?>">
                            <input type="hidden" name="item_number" value="1">
                            <input type="hidden" name="amount" value="<?php echo round($package->price);?>" readonly>
                            <input type="hidden" name="no_shipping" value="1">
                            <input type="hidden" name="currency_code" value="<?php echo html_escape($settings->currency_code);?>">
                            <input type="hidden" name="cancel_return" value="<?php echo base_url('payment-cancel/'.html_escape($payment_id)) ?>">
                            <input type="hidden" name="return" value="<?php echo base_url('payment-success/'.html_escape($payment_id)) ?>">  
                                
                            <div class="panel-heading  text-center">
                            <h3>Package Plan: <?php echo html_escape($package->name);?></h3>
                            </div>
                            <div class="panel-body text-center">
                                <p class="lead" style="font-size:40px"><strong><?php echo html_escape($settings->currency_symbol);?><?php echo round($package->price);?> / year</strong></p>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-lg btn-block btn-info" href="#">PAY NOW!</button>
                            </div>
                        </div>
                    </form>
                    <!-- /PRICE ITEM -->

                <?php endif ?>

            </div>

        </div>
    </div>
</div>
</body>
</html>
