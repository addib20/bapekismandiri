<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-responsive.min.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/responsive-tables.css">

<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/vendor/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/lib/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$('#dataTable_peserta').dataTable({
	"sDom": "<'pull-right'l>t<'row-fluid'<'span6'f><'span6'p>>",
	"sPaginationType": "bootstrap",
	"sAjaxSource": uri+"/list_table",
	"fnServerData": function(sSource, aoData, fnCallback){
		 $.ajax ({
		  'dataType': 'json',
		  'type'    : 'POST',
		  'url'     : sSource,
		  'data'    : aoData,
		  'success' : fnCallback
		 });
	},
	"oLanguage": {
		"sLengthMenu": "Show _MENU_ entries"
	}
});
</script>
<table class="table table-bordered table-condensed table-hover table-striped dataTable" id="dataTable_peserta">
    <thead>
        <tr>
          <th>Perusahaan</th>
          <th>NIP</th>
          <th>Nama</th>
          <th>Unit Kerja</th>
          <th>Lokasi</th>
          <th><input type="checkbox" id="select all"></th>
        </tr>
    </thead>
    <tbody> 
		<?php foreach($data_employee as $row): ?>
        <tr class="even gradeC">
            <td><?php echo $row['PERUSAHAAN'];?></td>
            <td><?php echo $row['NIP'];?></td>
            <td><?php echo $row['NAMA'];?></td>
            <td><?php echo $row['UNITKERJA'];?></td>
            <td><?php echo $row['LOKASI'];?></td>
            <td><input type="checkbox" name="checkID[]" id="checkID" value="<?php echo $row['ID'];?>" />

              <label for="checkID"></label></td>
        </tr>
		<?php endforeach; ?>
    </tbody>
</table>