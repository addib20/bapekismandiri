<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<header>
				<div class="icons"><i class="icon-th-large"></i></div>
				<h5>Block Validation</h5>
				<div class="toolbar">
					<ul class="nav">
						<li>
							<div class="btn-group">
								<a class="accordion-toggle btn btn-mini minimize-box" data-toggle="collapse"
								   href="#collapseOne">
									<i class="icon-chevron-up"></i>
								</a>
								<button class="btn btn-mini btn-danger close-box">
									<i class="icon-remove"></i>
								</button>
							</div>
						</li>
					</ul>
				</div>

			</header>
			<div class="body" id="btn_tbl">
				<form class="form-horizontal" method="post" action="<?php echo base_url() ?>evaluasi/paska_training/search" name="form_search_evaluasi" id="form_search_evaluasi" enctype="multipart/form-data">
					<div class="control-group">
						<label for="jenis_kegiatan" class="control-label">Jenis Kegiatan</label>
						<div class="controls">
							<?php echo form_dropdown('jenis_kegiatan', $opttipe, 'default','id="jenis_kegiatan"'); ?>
						</div>
					</div>
					<div class="control-group">
						<label for="batch" class="control-label">Batch</label>
						<div class="controls">
							<select id="batch" name="batch">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="2">3</option>
								<option value="2">4</option>
							</select>
						</div>
					</div>
					<button id="btnCariEvaluasi" name="btnCariEvaluasi" class="btn btn-inverse" type="button">Cari Data</button>
					<button class="btn btn-inverse" type="button">Export</button>
				</form>
				<div class="loading_ajax" style="display: none;">&nbsp;</div>
			</div>
			<div class="body collapse in" id="resultSearch">
				
			</div>
		</div>
	</div>
</div>