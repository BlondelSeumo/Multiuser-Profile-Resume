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
        .success{
            color: #28a745;
        }
</style>

<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <?php $settings = get_settings(); ?>
    <?php
        $payment = check_my_payment_status();
        //$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr';
        $paypal_url='https://www.paypal.com/cgi-bin/webscr';
        $paypal_id= html_escape($settings->paypal_email);
    ?>
     
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                
                <div class="box p-50">


                    <?php if (isset($my_payment) && $my_payment->status == 'verified'): ?>
                        
                        <h3 class="text-success"><i class="fa fa-check-circle"></i> Payment Completed</h3>
                        <h5 class="">You have successfully completed your payment process on <b class="text-success"><?php echo my_date_show($my_payment->created_at) ?></b></h5>
                        <h5 class="">Your next payment cycle: <b class="text-danger"><?php echo my_date_show($my_payment->expire_on) ?></b></h5>

                    <?php else: ?>

                        <h1><i class="icon-ban text-danger"></i></h1>
                        <h3 class="error text-danger">Pending payment</h3>
                        <h4 class="error">Please complete your payment and unlock pro features</h4><br><hr>
                
                        <!-- PRICE ITEM -->
                        <form action="<?php echo html_escape($paypal_url); ?>" method="post" name="frmPayPal1">
                            <div class="panels price panel-red">
                                <input type="hidden" name="business" value="<?php echo html_escape($paypal_id); ?>" readonly>
                                <input type="hidden" name="cmd" value="_xclick">
                                <input type="hidden" name="item_name" value="<?php echo html_escape($package->name);?>">
                                <input type="hidden" name="item_number" value="1">
                                <input type="hidden" name="amount" value="<?php echo round($package->price);?>" readonly>
                                <input type="hidden" name="no_shipping" value="1">
                                <input type="hidden" name="currency_code" value="<?php echo html_escape($settings->currency_code);?>">
                                <input type="hidden" name="cancel_return" value="<?php echo base_url('payment-cancel/'.html_escape($payment_id)) ?>">
                                <input type="hidden" name="return" value="<?php echo base_url('payment-success/'.html_escape($payment_id)) ?>">  
                                    
                                <div class="panel-headings  text-center">
                                    <h4>Package Plan: <?php echo html_escape($package->name);?></h4>
                                </div>
                                <div class="panel-bodys text-center">
                                    <p class="lead" style="font-size:40px"><strong><?php echo html_escape($settings->currency_symbol);?><?php echo round($package->price);?> / year</strong></p>
                                </div>
                                <div class="panel-footers">
                                    <button class="btn btn-info btn-lg" href="#">Pay Now - <?php echo html_escape($settings->currency_symbol.''.round($package->price));?></button>
                                </div>
                            </div>
                        </form>
                        <!-- /PRICE ITEM -->

                    
                    <?php endif ?>

                </div>

            </div>
        </div>
    </div>

    
  </section>

</div>