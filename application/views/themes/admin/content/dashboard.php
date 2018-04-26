<!-- .outer -->
<div class="container-fluid outer">
	<div class="row-fluid">
		<!-- .inner -->
		<div class="span12 inner">
			<!--<div class="tac">
				<ul class="stats_box">
					<li>
						<div class="quick-btn-new">
							<h4>Marketing Unit Training Program</h4>
							<span class="label label-success">open class</span>
						</div>
						<div class="stat_text_1">
							<strong>250</strong> Peserta sudah mendaftar <br />
							<button type="button" class="btn btn-metis-1">Ayo Daftarkan !</button>
						</div>
					</li>
					<li>
						<div class="quick-btn-new">
							<h4>Marketing Unit Training Program</h4>
							<span class="label label-success">open class</span>
						</div>
						<div class="stat_text_1">
							<strong>250</strong> Peserta sudah mendaftar <br />
							<button type="button" class="btn btn-metis-1">Ayo Daftarkan !</button>
						</div>
					</li>
				</ul>
			</div>-->
			<hr>
			<div class="row-fluid">
				<div class="span12">
					<div class="alert alert-info" role="alert">
						Selamat Datang <strong><?php echo $this->session->userdata("name"); ?></strong> di Program e-Reporting PPL
					</div>
					<?php if($jml_realisasi["jml_realisasi"]>0 || $jml_approve["jml_approve"]>0 || $jml_validate["jml_validate"]>0 && $role_id["role_id"] <> 1): ?>
					<div class="alert alert-danger" role="alert">
						<h4>Warning!</h4>
						<?php if($role_id["role_id"] == 2 || $role_id["role_id"] == 6): ?>
							Ada <strong> <?php echo $jml_realisasi["jml_realisasi"] ?> </strong> Pengajuan yang belum Anda pertanggung jawabkan<br />
							<a href="<?php echo base_url() ?>pelatihan/pelaporan_pelatihan" class="alert-link">Klik disini</a> untuk input pertanggung jawaban
						<?php elseif($role_id["role_id"] == 3 || $role_id["role_id"] == 7): ?>
							Ada <strong> <?php echo $jml_approve["jml_approve"] ?> </strong> Pengajuan yang belum Anda Approve<br />
							<a href="<?php echo base_url() ?>pelatihan/approval" class="alert-link">Klik disini</a> untuk melakukan approve
						<?php elseif($role_id["role_id"] == 4): ?>
							Ada <strong> <?php echo $jml_validate["jml_validate"] ?> </strong> Pengajuan yang belum Anda validasi<br />
							<a href="<?php echo base_url() ?>pelatihan/validasi_pengajuan" class="alert-link">Klik disini</a> untuk melakukan validasi
						<?php endif ?>
					</div>
					<?php endif; ?>
					<!--<div class="tac">
						<ul class="stats_box">
							<li>
								<div class="quick-btn-new">
									<h4>Marketing Unit Training Program</h4>
									<span class="label label-success">open class</span>
								</div>
								<div class="stat_text_1">
									<strong>250</strong> Peserta sudah mendaftar <br />
									<button type="button" class="btn btn-metis-1">Ayo Daftarkan !</button>
								</div>
							</li>
							<li>
								<div class="quick-btn-new">
									<h4>Manajer Unit Training Program</h4>
									<span class="label label-success">open class</span>
								</div>
								<div class="stat_text_1">
									<strong>250</strong> Peserta sudah mendaftar <br />
									<button type="button" class="btn btn-metis-1">Ayo Daftarkan !</button>
								</div>
							</li>
						</ul>
					</div>-->
					<hr>
					<div class="box">
						<header>
							<div class="icons"><i class="icon-sort"></i></div>
							<h5>Pengajuan Pelatihan Bulan <?php echo $this->datecalc->get_bulan(date("Y-m-d")) ?></h5>
							<div class="toolbar">
								<a href="#sortableTable" data-toggle="collapse" class="accordion-toggle minimize-box">
									<i class="icon-chevron-up"></i>
								</a>
							</div>
						</header>
						<div class="body collapse in" id="sortableTable">
							<table class="table table-bordered sortableTable responsive">
								<thead>
									<tr>
										<th>#</th>
										<th style="width:14%;">Nama Kegiatan</th>
										<th style="width:18%;">No. Memo</th>
										<th style="width:17%;">Tanggal Pelaksanaan</th>
										<th>Cabang</th>
										<th style="width:13%;">Tanggal Memo</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<?php $no=1; ?>
									<?php foreach($memo as $m): ?>
										<?php 
											$notif = "";
											if($m['status'] == 1 || $m['status'] == 0){
												$status = "Pengajuan baru dibuat";
												$tanggal = $this->datecalc->datepanjang($m['create_date'],'uk',true);
												$user = $this->m_common->get_user_nama($m['user_create'])->row_array();
												$notif = ' <span class="label label-success blink">New</span>';
												$selanjutnya = "Persetujuan Pinca";
											}
											elseif($m['status'] == 2 ){
												$tanggal = $this->datecalc->datepanjang($m['approve_date'],'uk',true);
												$user = $this->m_common->get_user_nama($m['approve_by'])->row_array();
												$selanjutnya = "Validasi data Peserta";
												if($m['approve'] == 1){
													$status = "Pengajuan disetujui Pinca";
												}
												elseif($m['approve'] == 2){
													$status = "Pengajuan tidak disetujui Pinca";
												}
											}
											elseif($m['status'] == 3 ){
												$tanggal = $this->datecalc->datepanjang($m['register_date'],'uk',true);
												$user = $this->m_common->get_user_nama($m['register_by'])->row_array();
												$selanjutnya = "Persetujuan Kantor Pusat";
												if($m['register'] == 1){
													$status = "Data Pengajuan Valid";
												}
												elseif($m['register'] == 2){
													$status = "Data Pengajuan harus direvisi";
												}
											}
											elseif($m['status'] == 4 ){
												$tanggal = $this->datecalc->datepanjang($m['approve_ppl_date'],'uk',true);
												$user = $this->m_common->get_user_nama($m['approve_ppl_by'])->row_array();
												$selanjutnya = "-";
												if($m['approve_ppl'] == 1){
													if($m['lpj'] < 1){
														$selanjutnya = "Pertanggung jawaban";
													}
													$status = "Data Pengajuan disetujui Pusat";
												}
												elseif($m['approve_ppl'] == 2){
													$status = "Data Pengajuan tidak disetujui Pusat";
												}
											}
										?>
										<tr>
											<td><?php echo $no ?></td>
											<td><?php echo $m['perihal_memo'].$notif ?> </td>
											<td><?php echo $m['no_memo'] ?></td>
											<td><?php echo $this->datecalc->penanggalan($m['tgl_mulai_kegiatan'],$m['tgl_selesai_kegiatan']); ?></td>
											<td><?php echo $m['cabang'] ?></td>
											<td><?php echo $this->datecalc->datepanjang($m['tgl_memo'],'uk') ?></td>
											<td>
												<?php 
													echo "<span class='label label-success'>".$status."</span><br />
														Tanggal : <span class='badge badge-inverse'>".$tanggal."</span><br />
														Next : <span class='label label-info'>".$selanjutnya."</span>";
												?>
											</td>
										</tr>
										<?php $no++; ?>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
					<hr>
					<div class="row-fluid">
						<div class="span12">
							<div class="box">
								<header>
									<h5>Calendar</h5>
								</header>
								<div id="calendar_content" class="body">
									<div id='calendar'></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			
			<div class="row-fluid">
				<div class="span4">
					<div class="box">
						<header>
							<div class="icons"><i class="icon-tags"></i></div>
							<h5>Total Pengajuan Kegiatan Training per Cabang</h5>
						</header>
						<div class="body">
							<table class="table table-bordered table-condensed table-hovered sortableTable">
								<thead>
									<tr>
										<th>Cabang <i class="icon-sort"></i><i class="icon-sort-down"></i><i
												class="icon-sort-up"></i></th>
										<th>Jumlah Pengajuan <i class="icon-sort"></i><i class="icon-sort-down"></i><i
												class="icon-sort-up"></i></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Balikpapan</td>
										<td>1126</td>
									</tr>
									<tr>
										<td>Banda Aceh</td>
										<td>350</td>
									</tr>
									<tr>
										<td>Bandung</td>
										<td>43</td>
									</tr>
									<tr>
										<td>Cirebon</td>
										<td>547</td>
									</tr>
									<tr>
										<td>Kediri</td>
										<td>560</td>
									</tr>
									<tr>
										<td>Kendari</td>
										<td>42</td>
									</tr>
									<tr>
										<td>Solo</td>
										<td>2450</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="box">
						<header>
							<div class="icons"><i class="icon-tags"></i></div>
							<h5>Rekap Pelaksanaan Training per Cabang</h5>
						</header>
						<div class="body">
							<table class="table table-bordered table-condensed table-hovered sortableTable">
								<thead>
									<tr>
										<th>Cabang <i class="icon-sort"></i><i class="icon-sort-down"></i><i
												class="icon-sort-up"></i></th>
										<th>Jumlah Peserta <i class="icon-sort"></i><i class="icon-sort-down"></i><i
												class="icon-sort-up"></i></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Balikpapan</td>
										<td>1126</td>
									</tr>
									<tr>
										<td>Banda Aceh</td>
										<td>350</td>
									</tr>
									<tr class="error">
										<td>Bandung</td>
										<td>43</td>
									</tr>
									<tr>
										<td>Cirebon</td>
										<td>547</td>
									</tr>
									<tr>
										<td>Kediri</td>
										<td>560</td>
									</tr>
									<tr class="error">
										<td>Kendari</td>
										<td>42</td>
									</tr>
									<tr>
										<td>Solo</td>
										<td>2450</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="box">
						<header>
							<div class="icons"><i class="icon-tags"></i></div>
							<h5>Rekap Pelaksanaan Training per Program</h5>
						</header>
						<div class="body">
							<table class="table table-bordered table-condensed table-hovered sortableTable">
								<thead>
									<tr>
										<th>Program <i class="icon-sort"></i><i class="icon-sort-down"></i><i
												class="icon-sort-up"></i></th>
										<th>Total Peserta <i class="icon-sort"></i><i class="icon-sort-down"></i><i
												class="icon-sort-up"></i></th>
										<th>Total Batch <i class="icon-sort"></i><i class="icon-sort-down"></i><i
												class="icon-sort-up"></i></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>SMART TP</td>
										<td>1126</td>
										<td>4</td>
									</tr>
									<tr>
										<td>MKTUP</td>
										<td>350</td>
										<td>10</td>
									</tr>
									<tr>
										<td>MUTP</td>
										<td>43</td>
										<td>8</td>
									</tr>
									<tr>
										<td>Orientation Based Training</td>
										<td>547</td>
										<td>10</td>
									</tr>
									<tr>
										<td>Supervisory Management Training</td>
										<td>560</td>
										<td>6</td>
									</tr>
									<tr>
										<td>Knowledge Sharing</td>
										<td>42</td>
										<td>-</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<!--BEGIN LATEST COMMENT-->
			<!-- .row-fluid -->
			<!--<div class="row-fluid">
				
				<div class="span6">
					
					<div class="box comments">
						<header>
							<div class="icons">
								<i class="icon-comments"></i>
							</div>
							<h5>Latest Comment</h5>
						</header>
						
						<div class="body">
							<div class="media">
								<a href="#" class="pull-left">
									<img data-src="holder.js/64x64" class="media-object" alt="64x64" style="width: 64px; height: 64px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACGklEQVR4nO2V0XKaUBRF8/+fckREJSYmirY2HWtJBxMnMtV2qCGFoL2/sPsAdRKjD62Q3WnPw3qBM2eWiwueGGPwP3PCFmCjAdgCbDQAW4CNBmALsNEAbAE2GoAtwEYDsAXYaAC2ABsNwBZgowHYAmw0AFuAjQZgC7DRAGwBNn8cYL28xsCtQ0QKOgiS5zObxQiN4n5zvPqr9h8VYB0OYYvA9m5xf2hu/RlvHAt2/fcFq95/ZIAVxi2BSBezx0Mza4RDG1bXx81b55lgNvdgiUA613gwBiadoisCkQvcJMfvrz7AwyecikDEQtOx8uNpuRgG0XYmmw9gSRPjVYboaldwg3CYH+1zP0RwKRCpoTdLS9pfdYDoPZzivXMnEYz5Bt/NhfvzDCa7g2cJar0ZHo3ZL7hZYNSQ7ftt9e+Qlbm/0gDxBG0RiLTw4T6/Fn908x/iLZFMzyDS3t47JBj7bhHAwVVU/v7qAvxYYGDtF6wPvyIJzp58uXfoBEiMgUlv0as9vV58D8raX2kAYxBP3D1H1MG7Ly9nXz6hBNOL/Eh7swjhqAERwakfl7T/FQIYs8HS76P16yk2LzEO072zu4Lfg3OI5O9wakz+d2YLRNoYR8fvf6UA/w4agC3ARgOwBdhoALYAGw3AFmCjAdgCbDQAW4CNBmALsNEAbAE2GoAtwEYDsAXYaAC2ABsNwBZgowHYAmw0AFuAzU+QYREQ9dxBOwAAAABJRU5ErkJggg==">
								</a>
								<div class="media-body">
									<div class="popover right">
										<div class="arrow"></div>
										<h3 class="popover-title">Popover right</h3>
										<div class="popover-content">
											<p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="media">
								<a href="#" class="pull-right">
									<img data-src="holder.js/64x64" class="media-object" alt="64x64" style="width: 64px; height: 64px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACGklEQVR4nO2V0XKaUBRF8/+fckREJSYmirY2HWtJBxMnMtV2qCGFoL2/sPsAdRKjD62Q3WnPw3qBM2eWiwueGGPwP3PCFmCjAdgCbDQAW4CNBmALsNEAbAE2GoAtwEYDsAXYaAC2ABsNwBZgowHYAmw0AFuAjQZgC7DRAGwBNn8cYL28xsCtQ0QKOgiS5zObxQiN4n5zvPqr9h8VYB0OYYvA9m5xf2hu/RlvHAt2/fcFq95/ZIAVxi2BSBezx0Mza4RDG1bXx81b55lgNvdgiUA613gwBiadoisCkQvcJMfvrz7AwyecikDEQtOx8uNpuRgG0XYmmw9gSRPjVYboaldwg3CYH+1zP0RwKRCpoTdLS9pfdYDoPZzivXMnEYz5Bt/NhfvzDCa7g2cJar0ZHo3ZL7hZYNSQ7ftt9e+Qlbm/0gDxBG0RiLTw4T6/Fn908x/iLZFMzyDS3t47JBj7bhHAwVVU/v7qAvxYYGDtF6wPvyIJzp58uXfoBEiMgUlv0as9vV58D8raX2kAYxBP3D1H1MG7Ly9nXz6hBNOL/Eh7swjhqAERwakfl7T/FQIYs8HS76P16yk2LzEO072zu4Lfg3OI5O9wakz+d2YLRNoYR8fvf6UA/w4agC3ARgOwBdhoALYAGw3AFmCjAdgCbDQAW4CNBmALsNEAbAE2GoAtwEYDsAXYaAC2ABsNwBZgowHYAmw0AFuAzU+QYREQ9dxBOwAAAABJRU5ErkJggg==">
								</a>
								<div class="media-body">
									<div class="popover left">
										<div class="arrow"></div>
										<h3 class="popover-title">Popover right</h3>
										<div class="popover-content">
											<p>Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
				
				
				<div class="span6">
					
					<div class="box">
						<header></header>
						
						<div class="body"></div>
						
					</div>
					
				</div>
				
			</div>-->
			
			<!--END LATEST COMMENT-->
		</div>
		<!-- /.inner -->
	</div>
	<!-- /.row-fluid -->
</div>
<!-- /.outer -->