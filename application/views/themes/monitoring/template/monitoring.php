<!DOCTYPE html>
<!--[if lt IE 7]>       <html class="no-js lt-ie9 lt-ie8 lt-ie7">   <![endif]-->
<!--[if IE 7]>          <html class="no-js lt-ie9 lt-ie8">          <![endif]-->
<!--[if IE 8]>          <html class="no-js lt-ie9">                 <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js">                        <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistem Informasi Pelatihan</title>
        <meta name="description" content="Metis: Bootstrap Responsive Admin Theme">
        <meta name="viewport" content="width=device-width">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-responsive.min.css">
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
		<style>
			.blink {
			  animation-duration: 1000ms;
			  animation-name: tgle;
			  animation-iteration-count: infinite;
			}

			@keyframes tgle {
			  0% {
				opacity: 0;
			  }

			  49.99% {
				opacity: 0;
			  }
			  50% {
				opacity: 1;
			  }

			  99.99% {
				opacity: 1;
			  }
			  100% {
				opacity: 0;
			  }
			}
			.bs-example-tooltip .tooltip {
				position: relative;
				display: inline-block;
				margin: 0 4px;
				opacity: 1;
			}
		</style
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!--[if IE 7]>
        <link type="text/css" rel="stylesheet" href="assets/Font-awesome/css/font-awesome-ie7.min.css"/>
        <![endif]-->

        <script src="<?php echo base_url() ?>assets/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body class="hide-sidebar">
        <!-- BEGIN WRAP -->
        <div id="wrap">
            <!-- BEGIN TOP BAR -->
            <div id="top">
                <!-- .navbar -->
				<div class="navbar navbar-inverse navbar-static-top">
					<div class="navbar-inner">
						<div class="container-fluid">
							<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a>
							<a class="brand" href="<?php echo base_url() ?>">Divisi Pusat Pendidikan dan Pelatihan</a>
						</div>
					</div>
				</div>
			<!-- /.navbar -->
            </div>
            <!-- END TOP BAR -->

            <!-- BEGIN MAIN CONTENT -->
            <div id="content">
				<div class="container-fluid outer">
					<div class="row-fluid">
						<!-- .inner -->
						<div class="span12 inner">
							<div class="box">
								<header>
									<div class="icons"><i class="icon-sort"></i></div>
									<h5>Monitoring Proposal Cabang Bulan Desember</h5>
									<div class="toolbar">
										<a class="accordion-toggle minimize-box" data-toggle="collapse" href="#sortableTable">
											<i class="icon-chevron-up"></i>
										</a>
									</div>
								</header>
								<div id="sortableTable" class="body collapse in">
									<table class="table table-bordered sortableTable responsive">
										<thead>
											<tr>
												<th>No
													<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i>
												</th>
												<th>Memo
													<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i>
												</th>
												<th>Nama Kegiatan
													<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i>
												</th>
												<th>Pelaksanaan
													<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i>
												</th>
												<th>Peserta
													<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i>
												</th>
												<th>Biaya
													<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i>
												</th>
												<th>Status
													<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i>
												</th>
												<th>Pembuat
													<i class="icon-sort"></i><i class="icon-sort-down"></i> <i class="icon-sort-up"></i>
												</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>M-123/PNM-JKT/X/14</td>
												<td>Usulan Knowledge Sharing SK</td>
												<td>17 Desember 2014</td>
												<td>17</td>
												<td>6.500.000</td>
												<td>Belum pertanggung jawaban <span class="label label-important blink">>3 hari</span></td>
												<td>Suci Andriani Putri</td>
											</tr>
											<tr>
												<td>2</td>
												<td>M-127/PNM-JKT/X/14</td>
												<td>Usulan RTP Bisnis</td>
												<td>20 - 23 Desember 2014</td>
												<td>20</td>
												<td>10.500.000</td>
												<td>Proposal Baru Masuk <span class="label label-success blink">New</span></td>
												<td>Suci Andriani Putri</td>
											</tr>
											<tr>
												<td>3</td>
												<td>M-131/PNM-JKT/X/14</td>
												<td>Usulan Knowledge Sharing Opersional</td>
												<td>18 Desember 2014</td>
												<td>15</td>
												<td>5.500.000</td>
												<td>Proposal Baru Masuk <span class="label label-warning blink">SLA</span>
												<td>Suci Andriani Putri</td>
											</tr>
											<tr>
												<td>4</td>
												<td>M-135/PNM-JKT/X/14</td>
												<td>Usulan Marketing Unit Training Program</td>
												<td>8 - 13 Desember 2014</td>
												<td>30</td>
												<td>33.500.000</td>
												<td>Belum pertanggung jawaban <span class="label label-important blink">>3 hari</span></td>
												<td>Andri Irwan</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
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

        <!-- BEGIN FOOTER -->
			<div id="footer">
				<p>2014 &copy; Divisi Pusat Pendidikan dan Pelatihan Admin</p>
			</div>
		<!-- END FOOTER -->

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
