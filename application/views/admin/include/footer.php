<footer class="main-footer">
  <div class="pull-right d-none d-sm-inline-block">
    <div class="version">Version: <?php echo html_escape($settings->version) ?></div>
  </div>
  <a href="<?php echo base_url() ?>"><?php echo html_escape($settings->copyright) ?></a>
</footer>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-light">
  <!-- Create the tabs -->
  <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    <li class="nav-item"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
    <li class="nav-item"><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-cog fa-spin"></i></a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Home tab content -->
    <div class="tab-pane" id="control-sidebar-home-tab">
      <h3 class="control-sidebar-heading">Recent Activity</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Admin Birthday</h4>

              <p>Will be July 24th</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-user bg-yellow"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Jhone Updated His Profile</h4>

              <p>New Email : jhone_doe@demo.com</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Disha Joined Mailing List</h4>

              <p>disha@demo.com</p>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <i class="menu-icon fa fa-file-code-o bg-green"></i>

            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Code Change</h4>

              <p>Execution time 15 Days</p>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->

      <h3 class="control-sidebar-heading">Tasks Progress</h3>
      <ul class="control-sidebar-menu">
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Web Design
              <span class="label label-danger pull-right">40%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-danger" style="width: 40%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Update Data
              <span class="label label-success pull-right">75%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-success" style="width: 75%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Order Process
              <span class="label label-warning pull-right">89%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-warning" style="width: 89%"></div>
            </div>
          </a>
        </li>
        <li>
          <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading">
              Development 
              <span class="label label-primary pull-right">72%</span>
            </h4>

            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-primary" style="width: 72%"></div>
            </div>
          </a>
        </li>
      </ul>
      <!-- /.control-sidebar-menu -->

    </div>
    <!-- /.tab-pane -->
    <!-- Stats tab content -->
    <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
    <!-- /.tab-pane -->
    <!-- Settings tab content -->
    <div class="tab-pane" id="control-sidebar-settings-tab">
      <form method="post">
        <h3 class="control-sidebar-heading">General Settings</h3>

        <div class="form-group">
          <input type="checkbox" id="report_panel" class="chk-col-grey" >
          <label for="report_panel" class="control-sidebar-subheading ">Report panel usage</label>

          <p>
            general settings information
          </p>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <input type="checkbox" id="allow_mail" class="chk-col-grey" >
          <label for="allow_mail" class="control-sidebar-subheading ">Mail redirect</label>

          <p>
            Other sets of options are available
          </p>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <input type="checkbox" id="expose_author" class="chk-col-grey" >
          <label for="expose_author" class="control-sidebar-subheading ">Expose author name</label>

          <p>
            Allow the user to show his name in blog posts
          </p>
        </div>
        <!-- /.form-group -->

        <h3 class="control-sidebar-heading">Chat Settings</h3>

        <div class="form-group">
          <input type="checkbox" id="show_me_online" class="chk-col-grey" >
          <label for="show_me_online" class="control-sidebar-subheading ">Show me as online</label>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <input type="checkbox" id="off_notifications" class="chk-col-grey" >
          <label for="off_notifications" class="control-sidebar-subheading ">Turn off notifications</label>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
          <label class="control-sidebar-subheading">              
            <a href="javascript:void(0)" class="text-red margin-r-5"><i class="fa fa-trash-o"></i></a>
            Delete chat history
          </label>
        </div>
        <!-- /.form-group -->
      </form>
    </div>
    <!-- /.tab-pane -->
  </div>
</aside>
<!-- /.control-sidebar -->

<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<?php $success = $this->session->flashdata('msg'); ?>
<?php $error = $this->session->flashdata('error'); ?>
<input type="hidden" id="success" value="<?php echo html_escape($success); ?>">
<input type="hidden" id="error" value="<?php echo html_escape($error);?>">
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

<!-- jQuery 3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- popper -->
<script src="<?php echo base_url() ?>assets/admin/js/popper.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>
<!-- Custom js -->
<script src="<?php echo base_url() ?>assets/admin/js/admin.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/toast.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/sweet-alert.min.js"></script>
<!-- Datatables-->
<script src="<?php echo base_url() ?>assets/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/validation.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>assets/admin/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/ckeditor/ckeditor.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/admin/js/fastclick.js"></script>
<!-- MinimalPro Admin App -->
<script src="<?php echo base_url() ?>assets/admin/js/template.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<!-- MinimalPro Admin for demo purposes -->
<script src="<?php echo base_url() ?>assets/admin/js/demo.js"></script>

<script src="<?php echo base_url() ?>assets/admin/js/select2.min.js"></script>

<!-- Color Picker Plugin JavaScript -->
<script src="<?php echo base_url() ?>assets/admin/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

<?php if (isset($page_title) && $page_title == 'Appointment'): ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
  (function($) {
      $(function() {
          $('input.timepicker').timepicker();
      });
  })(jQuery);
</script>
<?php endif ?>


<?php if (isset($page_title) && $page_title == 'Dashboard'): ?>
  
<!-- high charts js-->
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>

  var incomeData = <?php echo $income_data; ?>;
  var incomeAxis = <?php echo $income_axis; ?>;

  Highcharts.chart('adminIncomeChart', {
      chart: {
          type: 'column'
      },
      credits: {
          enabled: false
      },
      title: {
          text: ''
      },
      xAxis: {
          categories: incomeAxis
      },
      yAxis: {
          title: {
              text: ''
          }

      },
      legend: {
          enabled: true
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '<?php echo html_escape($currency) ?>{point.y}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span> <b><?php echo html_escape($currency) ?>{point.y}</b><br/>'
      },

      series: [
          {
              name: "Income",
              data: incomeData,
              color: '#2568ef'
          }
      ]
  });

  
  Highcharts.chart('packagePie', {
  chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
  },
  title: {
    text: ''
  },
  credits: {
      enabled: false
  },
  tooltip: {
    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
  },
  plotOptions: {
    pie: {
      allowPointSelect: true,
      cursor: 'pointer',
      dataLabels: {
        enabled: true,
        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
      }
    }
  },
  series: [{
    name: 'Users',
    colorByPoint: true,
    
    data: [
        <?php 
          foreach ($upackages as $upackage) {
            echo '{
                  name: "'.$upackage->name.'",
                  y: '.$upackage->total.'
                },';
          }
        ?>
      ]
  }]
});
</script>

<?php endif ?>
<!-- bt-switch -->
    <script src="<?php echo base_url() ?>assets/admin/js/bootstrap-switch.min.js"></script>
    <script type="text/javascript">
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
    </script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url() ?>assets/admin/js/jQuery.style.switcher.js"></script>

    <script type="text/javascript">
      <?php if (isset($success)): ?>
      $(document).ready(function() {
        var msg = $('#success').val();
        $.toast({
          heading: 'Success',
          text: msg,
          position: 'top-right',
          loaderBg:'#fff',
          icon: 'success',
          hideAfter: 3500
        });

      });
      <?php endif; ?>


      <?php if (isset($error)): ?>
      $(document).ready(function() {
        var msg = $('#error').val();
        $.toast({
          heading: 'Error',
          text: msg,
          position: 'top-right',
          loaderBg:'#fff',
          icon: 'error',
          hideAfter: 3500
        });

      });
      <?php endif; ?>
    </script>

    <script>
        ! function(window, document, $) {
            "use strict";
          $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
        }(window, document, jQuery);
    </script>

    <script type="text/javascript">
      jQuery('.datepicker').datepicker({
          format: 'yyyy-mm-dd'
      });

      //colorpicker start
      $('.colorpicker-default').colorpicker({
          format: 'hex'
      });
      $('.colorpicker-rgba').colorpicker();


      $('.multiple_select').select2();
      $('.single_select').select2();

    </script>

    <!-- Ckeditor -->
    <script>
        if($("#ckEditor").length > 0){
          CKEDITOR.replace('ckEditor', {
              language: 'en'
          });
        }
    </script>

</body>
</html>
