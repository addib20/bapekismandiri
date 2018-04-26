<!DOCTYPE html>
<!--[if lt IE 7]>       <html class="no-js lt-ie9 lt-ie8 lt-ie7">   <![endif]-->
<!--[if IE 7]>          <html class="no-js lt-ie9 lt-ie8">          <![endif]-->
<!--[if IE 8]>          <html class="no-js lt-ie9">                 <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js">                        <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/favicon.ico" type="image/x-icon">
		<link rel="icon" href="<?php echo base_url() ?>assets/img/favicon.ico" type="image/x-icon">
        <title>Sistem Informasi Pelatihan</title>
        <meta name="description" content="Metis: Bootstrap Responsive Admin Theme">
        <meta name="viewport" content="width=device-width">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-responsive.min.css">
		<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-progressbar.min.css">
		<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/datepicker.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/Font-awesome/css/font-awesome.min.css">
		<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/icheck/flat/blue.css" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/calendar.css">
		<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/DT_bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/select2.css"/>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/CLEditor1_4_3/jquery.cleditor.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/responsive-tables.css">

        <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/theme.css">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!--[if IE 7]>
        <link type="text/css" rel="stylesheet" href="assets/Font-awesome/css/font-awesome-ie7.min.css"/>
        <![endif]-->

        <script src="<?php echo base_url() ?>assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <!-- BEGIN WRAP -->
        <div id="wrap">
            <!-- BEGIN TOP BAR -->
            <div id="top">
                <?php echo $_top_bar ?>
            </div>
            <!-- END TOP BAR -->

            <!-- BEGIN HEADER.head -->
            <header class="head">
                <?php echo $_header ?>
            </header>
            <!-- END HEADER.head -->

            <!-- BEGIN LEFT  -->
            <div id="left">
                <?php echo $_menu ?>
            </div>
            <!-- END LEFT -->

            <!-- BEGIN MAIN CONTENT -->
            <div id="content">
				<div class="container-fluid outer">
					<div class="row-fluid">
						<!-- .inner -->
						<div class="span12 inner">
							<?php echo $_content ?>
						</div>
					</div>
				</div>
            </div>
            <!-- END CONTENT -->

            <!-- #push do not remove -->
            <div id="push"></div>
            <!-- /#push -->
        </div>
        <!-- END WRAP -->

        <div class="clearfix"></div>

        <?php echo $_footer ?>

        <!-- #helpModal -->
        <div id="helpModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel"
             aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="helpModalLabel"><i class="icon-external-link"></i> Help</h3>
            </div>
            <div class="modal-body">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                    ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                    nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                    anim id est laborum.
                </p>
            </div>
            <div class="modal-footer">

                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            </div>
        </div>
        <!-- /#helpModal -->
		
		<!-- #passwordModal -->
        <div id="passwordModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel"
             aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="helpModalLabel"><i class="icon-external-link"></i> Ganti Password</h3>
            </div>
            <div class="modal-body">
                <form id="changePassword" name="changePassword" action="<?php echo site_url("user/profile/change_password"); ?>" class="form-signin">
					<input id="old_password" name="old_password" type="password" placeholder="Password Lama" class="input-block-level password-field">
					<input id="new_password" name="new_password" type="password" placeholder="Password Baru" class="input-block-level password-field">
					<input id="konf_password" name="konf_password" type="password" placeholder="Konfirmasi Password" class="input-block-level password-field">
					<div class="loading_ajax" style="display: none;">&nbsp;</div>
					<div id="alert_change" class="alert alert-danger" style="display: none;"></div>
					<button id="change_password" type="button" class="btn btn-primary">Save</button>
				</form>
            </div>
        </div>
        <!-- /#passwordModal -->

        <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-1.10.1.min.js"><\/script>')</script>



        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script>window.jQuery.ui || document.write('<script src="assets/js/vendor/jquery-ui-1.10.0.custom.min.js"><\/script>')</script>-->

		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/vendor/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/vendor/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/vendor/jquery.icheck.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/vendor/bootbox.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/vendor/select2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/vendor/bootstrap-progressbar.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/lib/jquery.tablesorter.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/lib/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/lib/jquery.sparkline.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/lib/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/lib/form_validation.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/lib/search.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/lib/jquery.inputmask.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/lib/DT_bootstrap.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/validation/jquery.validate.js"></script>
		
		<script type="text/javascript" src="<?php echo base_url() ?>assets/CLEditor1_4_3/jquery.cleditor.min.js"></script>
		
        <script type="text/javascript" src="<?php echo base_url() ?>assets/flot/jquery.flot.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/flot/jquery.flot.pie.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/flot/jquery.flot.selection.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/flot/jquery.flot.resize.js"></script>

        <script type="text/javascript" src="<?php echo base_url() ?>assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
        
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/main.js"></script>
        
		<script type="text/javascript">
		$(document).ready(function(){
			$("#wilayah_id").change(function(){
				var id=$(this).val();
				var dataString = 'id='+ id;
				$.ajax({
					type: "POST",
					url: "<?php echo base_url() ?>rayonisasi/cekRayon",
					data: dataString,
					cache: false,
					success: function(html){
						$("#rayon_id").html(html);
					}
				});
			});
			$("#rayon_id").change(function(){
				var wilayah_id=$("#wilayah_id").val();
				var rayon_id=$(this).val();
				var dataString = 'rayon_id='+ rayon_id+'&wilayah_id='+ wilayah_id;
				$.ajax({
					type: "POST",
					url: "<?php echo base_url() ?>rayonisasi/cekCabang",
					data: dataString,
					cache: false,
					success: function(html){
						$("#cabang_id").html(html);
					}
				});
			});
			$("#sifat_id").change(function(){
				var sifat_id=$(this).val();
				var dataString = 'sifat_id='+ sifat_id;
				$.ajax({
					type: "POST",
					url: "<?php echo base_url() ?>rayonisasi/cekKegiatan",
					data: dataString,
					cache: false,
					success: function(html){
						$("#tipe_id").html(html);
					}
				});
			});
		});
		</script>

        <script type="text/javascript">
            $(function() {
				table_ppl();
				<?php if($this->uri->segment(3) == 'add_form' || $this->uri->segment(3) == 'edit_form' || $this->uri->segment(3) == 'input'): ?>
				formWysiwyg();
				<?php else: ?>
				dashboard();
				<?php endif; ?>
            });
        </script>

        <!--<script type="text/javascript" src="assets/js/style-switcher.js"></script>-->

    </body>
</html>
