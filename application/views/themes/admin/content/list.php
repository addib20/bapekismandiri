<!--Begin Datatables-->
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<header>
				<div class="icons"><i class="icon-move"></i></div>
				<h5>Dynamic Table</h5>
			</header>
			<div id="btn_tbl" class="body">
				<?php echo $btn_add ?>
			</div>
			<div id="collapse4" class="body">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
					<thead>
						<tr>
							<?php foreach($cols as $col): ?>
							<th><?php echo ucwords($col) ?></th>
							<?php endforeach ?>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Loading..</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>