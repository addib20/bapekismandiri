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
				<form class="form-horizontal" method="post" action="<?php echo base_url() ?>report/report_trainer/search" name="form_search_trainer" id="form_search_trainer" enctype="multipart/form-data">
					<div class="control-group">
						<label for="pemateri" class="control-label">Pemateri</label>
						<div class="controls">
							<input type="text" class="form-control input-large" id="pemateri" value="" name="pemateri">
						</div>
					</div>
					<div class="control-group">
						<label for="materi" class="control-label">Materi</label>
						<div class="controls">
							<input type="text" class="form-control input-large" id="materi" value="" name="materi">
						</div>
					</div>
					<div class="control-group">
						<label for="showby" class="control-label">Tampil Berdasarkan</label>
						<div class="controls">
							<select id="showby" name="showby">
								<option value="1">Pemateri</option>
								<option value="2">Materi</option>
							</select>
						</div>
					</div>
					<button id="btnCariTrainer" name="btnCariTrainer" class="btn btn-inverse" type="button">Cari Data</button>
					<button class="btn btn-inverse" type="button">Export</button>
				</form>
				<div class="loading_ajax" style="display: none;">&nbsp;</div>
			</div>
			<div class="body collapse in" id="resultSearch">
				
			</div>
		</div>
	</div>
</div>