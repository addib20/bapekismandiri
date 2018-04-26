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
			<div class="body collapse in" id="resultSearch">
				<table class="table table-bordered responsive">
					<thead>
						<tr>
							<th>#</th>
							<th>Training</th>
							<th>Lokasi</th>
							<th>Batch</th>
							<th>Tahun</th>
							<th>Jam</th>
							<th>Nilai</th>
							<th>Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($data_peserta as $peserta): ?>
							<tr class="error">
								<td colspan="8"><?php echo $peserta["nik"] ?> - <?php echo $peserta["nama"] ?></td>
							</tr>
							<?php $history_training = $this->hris->data_history_training($peserta["nik"]); ?>
							<?php //echo"<pre>";print_r($history_training);echo"</pre>"; ?>
							<?php $no = 1; ?>
							<?php $jml_history = count($history_training); ?>
							<?php if($jml_history>0): ?>
								<?php foreach($history_training as $hst): ?>
									<tr class="info">
										<td><?php echo $no ?></td>
										<td><?php echo $hst["TRAINING"] ?></td>
										<td><?php echo $hst["LOKASI"] ?></td>
										<td><?php echo $hst["BATCH"] ?></td>
										<td><?php echo $hst["TAHUN"] ?></td>
										<td><?php echo $hst["JAM"] ?></td>
										<td><?php echo $hst["NILAI"] ?></td>
										<td><?php echo $hst["KETERANGAN"] ?></td>
									</tr>
									<?php $no++; ?>
								<?php endforeach; ?>
							<?php else: ?>
								<tr class="info">
									<td colspan="8" style="text-align: center;">Data History Training Belum Tersedia</td>
								</tr>
							<?php endif; ?>
							<tr>
								<td>&nbsp;</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<a class="text-danger" href="javascript:history.go(-1)"><< Kembali ke Form Validasi</a>
			</div>
		</div>
	</div>
</div>