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
				<form class="form-horizontal" method="post" action="<?php echo base_url() ?>report/report_pelatihan/search" name="form_search_pelatihan" id="form_search_pelatihan" enctype="multipart/form-data">
					<div class="control-group">
						<label for="bulan" class="control-label">Bulan</label>
						<div class="controls">
							<select id="bulan" name="bulan">
								<?php 
										$bln = array("1"=>"Januari","2"=>"Februari","3"=>"Maret","4"=>"April","5"=>"Mei","6"=>"Juni","7"=>"Juli",
												"8"=>"Agustus","9"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
										for($i=1;$i<=12;$i++){
										echo ($i<=9)? '<option value="0'.$i.'">'.$bln[$i].'</option>' : '<option value="'.$i.'">'.$bln[$i].'</option>';
										}
								?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label for="tahun" class="control-label">Tahun</label>
						<div class="controls">
							<select id="tahun" name="tahun">
								<?php 
									for($i=2012;$i<=2020;$i++){
										echo '<option value="'.$i.'">'.$i.'</option>';
									}
								?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label for="showby" class="control-label">Tampil Berdasarkan</label>
						<div class="controls">
							<select id="showby" name="showby">
								<option value="1">Jenis Kegiatan</option>
								<option value="2">Cabang</option>
							</select>
						</div>
					</div>
					<button id="btnCariPelatihan" name="btnCariPelatihan" class="btn btn-inverse" type="button">Cari Data</button>
					<button class="btn btn-inverse" type="button">Export</button>
				</form>
				<div class="loading_ajax" style="display: none;">&nbsp;</div>
			</div>
			<div class="body collapse in" id="resultSearch">
				
			</div>
		</div>
	</div>
</div>