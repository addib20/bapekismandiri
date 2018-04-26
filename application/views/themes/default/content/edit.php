<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<header>
				<div class="icons"><i class="icon-th-large"></i></div>
				<h5>Ubah Data</h5>
				<div class="toolbar">
					<ul class="nav">
						<li>
							<div class="btn-group">
								<a class="accordion-toggle btn btn-mini minimize-box" data-toggle="collapse"
								   href="#collapseOne">
									<i class="icon-chevron-up"></i>
								</a>
							</div>
						</li>
					</ul>
				</div>

			</header>
			<div id="collapseOne" class="accordion-body collapse in body">
				<span style="color: red;">*</span> Harus Diisi
				<form class="form-horizontal" method="post" action="<?php echo site_url($url) ?>" name="form_add" id="form_add" novalidate="novalidate" enctype="multipart/form-data">
					<?php echo form_hidden($pk,$data_val[$pk]); ?>
					<?php foreach ($insert_field as $field) { ?>
					<div class="control-group">
						<?php $must_filled = (!isset($field['class_validate'])) ? '' :' <span style="color: red;">*</span>'; ?>
                        <label class="control-label" for="<?php echo $field['name'] ?>"><?php echo $field['label'].$must_filled ?></label>
                        <div class="controls">
                        	<?php
                        		$class_validate = (!isset($field['class_validate'])) ? '' : $field['class_validate'] ; 
                        		/* Generating form for addform */
                        		if(!isset($field['type']) || $field['type']=='' || $field['type']=='input') {
									if(!isset($field['readonly'])){
										echo form_input(array('id'=>$field['name'],'name'=>$field['name'],'class'=>$class_validate.' form-control input-xxlarge','value'=>set_value($field['name'],$data_val[$field['name']])));
									}
									else {
										echo form_input(array('id'=>$field['name'],'name'=>$field['name'],'class'=>$class_validate.' form-control input-xxlarge','readonly'=>true,'value'=>set_value($field['name'],$data_val[$field['name']])));
									}
                        			
								}
								elseif($field['type']=='number'){
									echo form_input(array('id'=>$field['name'],'name'=>$field['name'],'style'=>'text-align: right','onKeyPress'=>'return isNumberKey(event)','class'=>$class_validate.' form-control input-xxlarge','value'=>set_value($field['name'],$data_val[$field['name']])));
								}
								elseif($field['type']=='select') {
									echo form_dropdown($field['name'],$opt[$field['opt']],$data_val[$field['name']],'class="'.$class_validate.'" id="'.$field['name'].'"');
								}
								elseif($field['type']=='multiple') {
									$arr_val = explode(";", $data_val[$field['name']]);
									echo '<select multiple class="form-control '.$class_validate.'" id= "'.$field['name'].'" name= "'.$field['name'].'[]">';
										foreach ($opt[$field['opt']] as $key => $value) {
											$selected = (in_array($key, $arr_val))?"selected":"";
											echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
										}
									echo'</select>';
								}
								elseif($field['type']=='radio'){
									foreach($radio[$field['radio']] as $o){
										echo "<label for='".$o['name']."'>";
										echo form_radio(array('id'=>$o['name'],'name'=>$o['name'],'value'=>$o['value'],'checked'=>$o['checked'],'class'=>$class_validate));
										echo '&nbsp;';
										echo $o['label'];
										echo "</label>";
									}
								}
								elseif($field['type']=='textarea') {
									echo form_textarea(array('id'=>$field['name'],'name'=>$field['name'],'class'=>$class_validate.' form-control','value'=>set_value($field['name'],$data_val[$field['name']])));
								}
								elseif($field['type']=='password') {
									echo form_password(array('id'=>$field['name'],'name'=>$field['name'],'class'=>$class_validate.' form-control input-xxlarge','value'=>set_value()));
								}
								elseif($field['type']=='upload') {
									echo '<img src="'.base_url().$data_val[$field['name']].'" alt="" style="height:100px;">';
									echo form_upload(array('id'=>$field['name'],'name'=>$field['name']));
								}
								elseif($field['type']=='upload_file') {
									$file = end(explode("/", $data_val[$field['name']]));
									echo anchor('download/modul/'.$file, $file ,array('title'=>'Link Title'));
									echo "<br \>";
									echo form_upload(array('id'=>$field['name'],'name'=>$field['name']));
								}
								elseif($field['type']=='checkbox'){
									foreach($chkbox[$field['chkbox']] as $o){
										echo "<label for='".$o['name']."'>";
										echo form_checkbox(array('id'=>$o['name'],'name'=>$o['name'],'value'=>$o['value'],'checked'=>$o['checked'],'class'=>$class_validate));
										echo '&nbsp;';
										echo $o['label'];
										echo "</label>";
									}
								}
								elseif($field['type']=='datepicker'){
									echo '<div class="input-append date" id="dp3" data-date="'.date('d-m-Y').'" style=" display: flex;margin-bottom: 10px;vertical-align: middle;white-space: nowrap;width: 25%;" data-date-format="dd-mm-yyyy">';
									echo form_input(array('id'=>$field['name'],'readonly'=>true,'name'=>$field['name'],'class'=>$class_validate.' form-control input-xxlarge','value'=>set_value($field['name'],$this->datecalc->datepanjang($data_val[$field['name']],'idn'))));
									echo'<span class="add-on" style="background-color: #EEEEEE;border: 1px solid #CCCCCC;padding: 4px 5px;text-align: center;width: auto;"><i class="icon-calendar"></i></span></div>';
								}
								elseif($field['type']=='free'){
									echo $source[$field['source']];
								}
								/* end generating */
								
								
								/* bantuan input */
								if(isset($field['help_text'])){
									echo '<span class="help-block">'.$field['help_text'].'</span>';
								}
								/* end bantuan input */
                        	?>
                        </div>
                    </div>
                    <?php } ?>
					<div class="form-actions">
						<button id="add_button" type="button" class="btn btn-primary">Save</button> or <a class="text-danger" href="javascript:history.go(-1)">Cancel</a>
					</div>
				</form>
				<span style="color: red;">*</span> Harus Diisi
			</div>
		</div>
	</div>
</div>