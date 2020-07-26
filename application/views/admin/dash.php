<div class="content-wrapper">

  <section class="content">

    <div class="row">
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round align-self-center round-success"><i class="icon-people"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h2 class="m-b-0"><?php if(!empty($user)) {echo $user->total;}else{echo 0;} ?></h2>
                            <h5 class="text-muted m-b-0">Total Users</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round align-self-center bg-primary"><i class="icon-user-following"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h2 class="m-b-0"><?php if(!empty($user)) {echo $user->pro_user;}else{echo 0;} ?></h2>
                            <h5 class="text-muted m-b-0">Pro Users</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round align-self-center bg-info"><i class="icon-user"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h2 class="m-b-0"><?php if(!empty($user)) {echo $user->free_user;}else{echo 0;} ?></h2>
                            <h5 class="text-muted m-b-0">Free Users</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="round align-self-center bg-danger"><i class="icon-user-unfollow"></i></div>
                        <div class="m-l-10 align-self-center">
                            <h2 class="m-b-0"><?php if(!empty($user)) {echo $user->pending_user;}else{echo 0;} ?></h2>
                            <h5 class="text-muted m-b-0">Pending Users</h5></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>


    <div class="row">
      
        <div class="col-xl-6 col-lg-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Last 12 months Income</h3>
                </div>
                <div class="box-body">
                    <div id="adminIncomeChart" style="width:100%; height:320px;"></div>
                </div>
            </div>

            <div class="box">
              <div class="box-header with-border">
                  <h5 class="box-title">Recently joined Users</h5>
              </div>
              <div class="box-body p-0">
                <div class="media-list media-list-hover media-list-divided">
                
                <?php foreach ($users as $user): ?>
                
                  <div class="media">
                    <span class="avatar avatar-sm bg-info"><i class="icon-user"></i></span>
                    <div class="media-body">
                    <p>
                      <a class="hover-primary" href="#"><strong><?php echo html_escape($user->name) ?></strong></a>
                      <time class="float-right" datetime="<?php echo my_date_show($user->created_at) ?>"><?php echo get_time_ago($user->created_at) ?></time>
                    </p>
                    <p><?php echo html_escape($user->email); ?></p>
                    <p>
                        <?php if ($user->account_type == 'pro'): ?>
                            <label class="label label-warning"><i class="fa fa-star"></i> <?php echo html_escape($user->account_type); ?></label>
                        <?php else: ?>
                            <label class="label label-info"><?php echo html_escape($user->account_type); ?></label>
                        <?php endif ?>
                    
                        <?php if ($user->status == 1): ?>
                            <label class="label label-success"><i class="fa fa-check"></i> Verified</label>
                        <?php endif ?>
                    </p>
                    </div>
                  </div>

                <?php endforeach ?>

                  <div class="text-center bt-1 border-light p-2">
                    <a class="text-uppercase d-block font-size-12" href="<?php echo base_url('admin/users') ?>">See all Users <i class="fa fa-long-arrow-right"></i></a>
                  </div>

                </div>
              </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Package by Users</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                      <div class="col-md-4">
                          <div class="row br1">
                            <?php foreach ($upackages as $package): ?>
                              <div class="dash-package text-center">
                                <h5 class="mb-0 text-center pay_status"><?php echo html_escape($package->name) ?></h5>
                                <p class="mt-0"><strong><?php echo html_escape($package->total) ?></strong> users</p>
                              </div>
                            <?php endforeach ?>
                          </div>
                      </div>

                      <div class="col-md-8">
                        <div class="row">
                          <div class="col-sm-12">
                            <div id="packagePie" style="min-width: 210px; height: 300px; max-width: 600px; margin: 0 auto"></div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
            </div>

            <div class="box mt-10">
                <div class="box-header with-border">
                    <h3 class="box-title">Net Income</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Fiscal year <i class="fa fa-info-circle" data-toggle="tooltip" data-title="Fiscal year start is January 01"></i></th>
                            <?php foreach ($net_income as $netincome): ?>
                              <th><?php echo show_year($netincome->created_at) ?></th>
                            <?php endforeach ?>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Income</td>
                            <?php foreach ($net_income as $netincome): ?>
                              <td>$<?php echo html_escape(round($netincome->total)) ?></td>
                            <?php endforeach ?>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
            
        </div>

    </div>

  </section>

</div>