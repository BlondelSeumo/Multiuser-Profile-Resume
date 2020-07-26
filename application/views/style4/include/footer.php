

<footer class="col-md-12">
    <div class="footer bottom_30">
        <div class="col-md-12 text-center"><?php echo html_escape($settings->copyright) ?> - <?php echo html_escape($settings->site_name) ?></div>
    </div>
</footer>
    
</div> <!-- Tab Container End -->
</div> <!-- Row End --> 
</div> <!-- Wrapper End -->   

<!-- Javascripts -->  
<script src="<?php echo base_url() ?>assets/default/js/jquery-2.1.4.min.js"></script> 
<script src="<?php echo base_url() ?>assets/default/js/jquery.cubeportfolio.min.js"></script>
<script src="<?php echo base_url() ?>assets/default/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url() ?>assets/default/js/jquery.easytabs.min.js"></script>
<script src="<?php echo base_url() ?>assets/default/js/owl.carousel.min.js"></script> 
<script src="<?php echo base_url() ?>assets/default/js/main.js"></script>

<script src="<?php echo base_url() ?>assets/default/js/moment.js"></script>
<script src="<?php echo base_url() ?>assets/default/js/jquery.cookie-1.4.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/default/datetime/datetimepicker.js"></script>


<script type="text/javascript">
	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip(); 
    
        $(function () {
            $('.datetimepicker1').datetimepicker({
               format:'YYYY-MM-DD HH:mm:ss',
            });
        });
         $(function () {
            $('.datetimepicker2').datetimepicker({
                format:'YYYY-MM-DD HH:mm:ss',
            });
        });

    });
</script>


</body>

</html>
