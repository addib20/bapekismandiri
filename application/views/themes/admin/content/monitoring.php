<!--Begin Datatables-->
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<header>
				<div class="icons"><i class="icon-move"></i></div>
				<h5>Monitoring Table</h5>
			</header>
			<div id="btn_tbl" class="body">
				<div class="controls">
					<?php $url = ($tipe_monitoring == "akses" ? "obt" : "ujian_obt"); ?>
					<?php echo form_dropdown('cabang',$optcabang,'default','class="" id="cabang" onChange="change_cabang(this,\''.base_url().'\elearning/'.$url.'/search\');"'); ?>
				</div>
			</div>
			<div class="loading_ajax" style="display: none;">&nbsp;</div>
			<div id="collapse4" class="body">
				<table class="table table-bordered table-condensed table-hover table-striped">
					<thead>
						<tr>
							<?php foreach($cols as $col): ?>
							<th style="text-align:center;"><?php echo ucwords($col) ?></th>
							<?php endforeach ?>
						</tr>
					</thead>
					<tbody id="body_monitoring">
						<?php if($tipe_monitoring == "akses"): ?>
							<?php foreach($data_monitoring as $monitoring): ?>
							<?php 
								$kebijakan_sdm = $this->m_common->get_data_akses($monitoring['id'],32,$tgl_mulai,$tgl_selesai);
								$fraud = $this->m_common->get_data_akses($monitoring['id'],33,$tgl_mulai,$tgl_selesai);
								$bisnis_pnm = $this->m_common->get_data_akses($monitoring['id'],30,$tgl_mulai,$tgl_selesai);
								$nilai_perusahaan = $this->m_common->get_data_akses($monitoring['id'],29,$tgl_mulai,$tgl_selesai);
								$produk_ulamm = $this->m_common->get_data_akses($monitoring['id'],31,$tgl_mulai,$tgl_selesai);
								if($kebijakan_sdm > 0 && $fraud > 0 && $bisnis_pnm > 0 && $nilai_perusahaan > 0 && $produk_ulamm > 0){
									$status = '<span class="label label-success">Sudah Akses</span>';
								}
								else{
									$status = '<span class="label label-important">Belum Akses</span>';
								}
							?>
							<tr>
								<td><?php echo $monitoring['firstname']." ".$monitoring['lastname'] ?></td>
								<td><?php echo $monitoring['city']?></td>
								<td style="text-align:center;"><?php echo ($kebijakan_sdm > 0 ? '<img src ="'.base_url().'/assets/img/cek_small.png" height="20" width="20">' : '<img src ="'.base_url().'/assets/img/cross_small.png" height="20" width="20">' ); ?></td>
								<td style="text-align:center;"><?php echo ($fraud > 0 ? '<img src ="'.base_url().'/assets/img/cek_small.png" height="20" width="20">' : '<img src ="'.base_url().'/assets/img/cross_small.png" height="20" width="20">' ); ?></td>
								<td style="text-align:center;"><?php echo ($bisnis_pnm > 0 ? '<img src ="'.base_url().'/assets/img/cek_small.png" height="20" width="20">' : '<img src ="'.base_url().'/assets/img/cross_small.png" height="20" width="20">'); ?></td>
								<td style="text-align:center;"><?php echo ($nilai_perusahaan > 0 ? '<img src ="'.base_url().'/assets/img/cek_small.png" height="20" width="20">' : '<img src ="'.base_url().'/assets/img/cross_small.png" height="20" width="20">'); ?></td>
								<td style="text-align:center;"><?php echo ($produk_ulamm > 0 ? '<img src ="'.base_url().'/assets/img/cek_small.png" height="20" width="20">' : '<img src ="'.base_url().'/assets/img/cross_small.png" height="20" width="20">'); ?></td>
								<td style="text-align:center;"><?php echo $status ?></td>
							</tr>
							<?php endforeach ?>
						<?php elseif($tipe_monitoring == "ujian"): ?>
							<?php foreach($data_monitoring as $monitoring): ?>
							<?php $hasil_ujian = $this->m_common->get_hasil_ujian($monitoring['id'],55)->row_array(); ?>
							<?php $akses_ujian = $this->m_common->get_hasil_ujian($monitoring['id'],55)->num_rows(); ?>
							<?php $class = ($akses_ujian==0?"error":""); ?>
								<tr class="<?php echo $class ?>">
									<td><?php echo $monitoring['firstname']." ".$monitoring['lastname'] ?></td>
									<td><?php echo $monitoring['city']?></td>
									<?php if($akses_ujian==0): ?>
										<td colspan="3" style="text-align:center;">Belum Akses Ujian</td>
									<?php else: ?>
										<?php $badge = ($hasil_ujian['Pass']=="Tidak"?"badge-important":"badge-success"); ?>
										<td><?php echo $hasil_ujian['Correct']?></td>
										<td><?php echo $hasil_ujian['Score']?></td>
										<td><span class="badge <?php echo $badge ?>"><?php echo $hasil_ujian['Pass'] ?></span> </td>
									<?php endif; ?>
								</tr>
							<?php endforeach ?>
						<?php endif ;?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>