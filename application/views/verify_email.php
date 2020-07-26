
 <section class="section">
    <div class="container">
        <div class="row">
            <div class="space-200"></div>
            <?php if (empty($code)): ?>
                <div class="col-md-12 text-center">
                    <h2 class="text-danger mb-0"><i class="icon-info"></i></h2>
                    <h3 class="mt-0 text-danger">Verify Account</h3>
                    <p class="mt-2">We have sent a link to your registered email address, please click this link to verify your account (Check your inbox / spam folder)</p>
                </div>
            <?php else: ?>
                <?php if ($code == 'invalid'): ?>
                    <div class="col-md-12 text-center">
                        <h1 class="text-danger mb-5"><i class="icon-close"></i></h1>
                        <h3 class="mt-5 text-danger">Error</h3>
                        <p class="mt-2">Verification Failed !</p>

                        <a class="bttn-1" href="<?php echo base_url() ?>">Back to Home</a>
                    </div>
                <?php else: ?>
                    <div class="col-md-12 text-center">
                        <h1 class="text-success"><i class="icon-check"></i></h1>
                        <h2 class="mb-0">Congratulations</h2>
                        <p class="mt-2">Your account verified successfully !</p>

                        <a class="bttn-2" href="<?php echo base_url('admin/profile') ?>">Continue</a>
                    </div>
                <?php endif ?>
            <?php endif ?>
            <div class="space-200"></div>
        </div>

    </div>
</section>

