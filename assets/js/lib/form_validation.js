var tool;
ns4 = (document.layers)? true:false
ns6 = ((!document.all) && (document.getElementById))? true:false
ie4 = (document.all)? true:false

function popup(url) {
	if(tool && tool.open && ns4) {
		tool.focus()
	} else {
		tool=window.open('', '_tool_','location=no,menubar=no,toolbar=no,scrollbars=yes,width=800,height=500,resizable=yes')
		if(tool.opener==null) tool.opener=self
		tool.location=url
		tool.focus()
	}
}
function send_peserta(id){
	var url = window.location.href.split("/");
	var uri = "/"+url[3]+"/"+url[4];
	bootbox.dialog({
		message: '<span>Anda yakin Kirim data ?</span><div class="loading_ajax" style="display: none;">&nbsp;</div>',
		title: "Kirim Data ke HRIS",
		buttons: {
			success: {
				label: "Kirim Data!",
				className: "btn-primary kirim_data",
				callback: function() {
						$.ajax({
							type: "POST",
							url: uri+"/upload_hris/peserta",
							data: "realisasi_id="+id,
							async: true,
							/*xhrFields: {
								onprogress: function (evt) {
								   if (evt.lengthComputable) {
										var percentComplete = Math.floor(evt.loaded / evt.total) * 100;
										var $pb = $('.progress .bar');
										$pb.attr('data-transitiongoal', percentComplete).progressbar({
											display_text: 'center', use_percentage: false, amount_format: function(p, t) {return p + ' of ' + t;}
										});
								   }
								}
							},
							xhr: function () {
								var xhr = new window.XMLHttpRequest();
								//Upload Progress
								xhr.upload.addEventListener("progress", function (evt) {
									if (evt.lengthComputable) {
										//
									} 
								}, false);
						 
								//Download progress
								xhr.addEventListener("progress", function (evt){
									if (evt.lengthComputable){
										var $pb = $('.progress .bar');
										var percentComplete = (evt.loaded / evt.total) * 100;
										$pb.attr('data-transitiongoal', percentComplete).progressbar({
											display_text: 'center', use_percentage: false, amount_format: function(p, t) {return p + ' of ' + t;},
											done: function() { window.setTimeout(function(){ bootbox.hideAll(); }, 500);}
										});
									} 
								},false);
								return xhr;
							},*/
							success: function(data){
								var obj = $.parseJSON(data);
								console.log(obj);
								$(".loading_ajax").hide();
								if(obj.status==1){
									alert("Data Berhasil di upload");
								}
								else if(obj.status==0){
									alert("Data Gagal di upload");
								}
								bootbox.hideAll();
							},
							beforeSend:function(){
								$(".kirim_data").addClass("disabled");
								$(".loading_ajax").show();
							}
						});
					return false;
				}
			},
			danger: {
				label: "Batal!",
				className: "btn",
				callback: function() {
					
				}
			}
		}
	}); 
}
function tambah_peserta(){
	var url = window.location.href.split("/");
	var uri = "/"+url[3]+"/"+url[4];
	bootbox.dialog({
		message: '<span>Anda yakin Kirim data ?</span><div class="loading_ajax" style="display: none;">&nbsp;</div>',
		title: "Kirim Data ke HRIS",
		buttons: {
			success: {
				label: "Kirim Data!",
				className: "btn-primary kirim_data",
				callback: function() {
						$.ajax({
							type: "POST",
							url: uri+"/upload_hris/peserta",
							data: "realisasi_id="+id,
							async: true,
							/*xhrFields: {
								onprogress: function (evt) {
								   if (evt.lengthComputable) {
										var percentComplete = Math.floor(evt.loaded / evt.total) * 100;
										var $pb = $('.progress .bar');
										$pb.attr('data-transitiongoal', percentComplete).progressbar({
											display_text: 'center', use_percentage: false, amount_format: function(p, t) {return p + ' of ' + t;}
										});
								   }
								}
							},
							xhr: function () {
								var xhr = new window.XMLHttpRequest();
								//Upload Progress
								xhr.upload.addEventListener("progress", function (evt) {
									if (evt.lengthComputable) {
										//
									} 
								}, false);
						 
								//Download progress
								xhr.addEventListener("progress", function (evt){
									if (evt.lengthComputable){
										var $pb = $('.progress .bar');
										var percentComplete = (evt.loaded / evt.total) * 100;
										$pb.attr('data-transitiongoal', percentComplete).progressbar({
											display_text: 'center', use_percentage: false, amount_format: function(p, t) {return p + ' of ' + t;},
											done: function() { window.setTimeout(function(){ bootbox.hideAll(); }, 500);}
										});
									} 
								},false);
								return xhr;
							},*/
							success: function(data){
								var obj = $.parseJSON(data);
								console.log(obj);
								$(".loading_ajax").hide();
								if(obj.status==1){
									alert("Data Berhasil di upload");
								}
								else if(obj.status==0){
									alert("Data Gagal di upload");
								}
								bootbox.hideAll();
							},
							beforeSend:function(){
								$(".kirim_data").addClass("disabled");
								$(".loading_ajax").show();
							}
						});
					return false;
				}
			},
			danger: {
				label: "Batal!",
				className: "btn",
				callback: function() {
					
				}
			}
		}
	}); 
}
function delete_row(id,e){
	var confirm_delete_message = 'Are You Sure to Delete ?';
	e.preventDefault();
	url = $('.del_row_'+id).attr("href");
	bootbox.confirm(confirm_delete_message, function(result) {
		if(result){
			window.location.href = url;
		}
	});
}
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
    	return false;
    return true;
}
function _toggleCheckBoxes(td){
	if(td){
		if(td.checked == 'check'){
			td.checked = 'uncheck';
		}else{
			td.checked = 'check';
		}
		var tr = td.parentNode;
		if(tr && tr.cells){
			var l = tr.cells.length - 1;
			
			for(var i = 1 ; i <= l ; i++){
				var tmpTd = tr.cells[i];
				var checkbox = tmpTd.childNodes[0].childNodes[0];
				if(td.checked == 'check'){
					$(checkbox).iCheck(td.checked);
				}else{
					$(checkbox).iCheck(td.checked);
				}
			}
		}
	}
}
$(document).ready(function(){
	var url = window.location.href.split("/");
	var uri = "/"+url[3]+"/"+url[4];
	$('.progress .bar').progressbar({display_text: 'center', use_percentage: false});
	$("#add_realisasi").on("click", function () {
        counter = $('#tabelTrainer tr').length - 2;

        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="required form-control trainer_search" id="trainer" name="trainer['+ counter +']"/><input type="hidden" id="trainer_id" name="trainer_id['+ counter +']" /></td>';
        cols += '<td><input type="text" class="required form-control materi_search" id="materi" name="materi['+ counter +']"/><input type="hidden" id="materi_id" name="materi_id['+ counter +']" value="" /></td>';
		cols += '<td><input type="text" class="required form-control span6" onkeypress="return isNumberKey(event)" style="text-align: right" id="durasi" value="" name="durasi['+ counter +']"/></td>';
		cols += '<td><input type="text" class="required form-control span6" style="text-align: right" id="nilai" value="" name="nilai['+ counter +']"/></td>';

        cols += '<td><a class="btn btn-danger remove ibtnDel"><i class="icon-remove"></i></a></td>';
        newRow.append(cols);
		
		var trainer_id_box = 'trainer_id['+ counter +']';
		var materi_id_box = 'materi_id['+ counter +']';
        /*if (counter == 4) $('#addrow').attr('disabled', true).prop('value', "You've reached the limit");*/
        $("table.trainer-list").append(newRow);
		$('.trainer_search').typeahead({
		   // definisikan source - sumber data
			source: function(query,process){
				data = [];
				map = {};
				var source = [];
		 
				// ambil JSON ke server
				$.getJSON(uri+'/getTrainer/'+query, function(result) {
						source = result;
						$.each(source, function (i, dt) {
							map[dt.NAMA] = dt;
							data.push(dt.NAMA);
						});
					process(data);
				});
			},
		 
		   // panjang string (query) minimal untuk dikirim ke server
		   minLength:3,
		   updater: function(item){$('[name="'+trainer_id_box+'"]').val(map[item].ID); return item}
		});
		
		$('.materi_search').typeahead({
		   // definisikan source - sumber data
			source: function(query,process){
				data = [];
				map = {};
				var source = [];
		 
				// ambil JSON ke server
				$.getJSON(uri+'/getMateri/'+query, function(result) {
						source = result;
						$.each(source, function (i, dt) {
							map[dt.materi] = dt;
							data.push(dt.materi);
						});
					process(data);
				});
			},
		 
		   // panjang string (query) minimal untuk dikirim ke server
		   minLength:3,
		   updater: function(item){$('[name="'+materi_id_box+'"]').val(map[item].materi_id); return item}
		});
        counter++;
    });
	
	$("#addrow").on("click", function () {
        counter = $('#tabelTrainer tr').length - 2;

        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" class="required form-control trainer_search" id="trainer" name="trainer['+ counter +']"/><input type="hidden" id="trainer_id" name="trainer_id['+ counter +']" /></td>';
        cols += '<td><input type="text" class="required form-control materi_search" id="materi" name="materi['+ counter +']"/><input type="hidden" id="materi_id" name="materi_id['+ counter +']" value="" /></td>';
		cols += '<td><input type="text" class="required form-control span6" onkeypress="return isNumberKey(event)" style="text-align: right" id="durasi" value="" name="durasi['+ counter +']"/></td>';

        cols += '<td><a class="btn btn-danger remove ibtnDel"><i class="icon-remove"></i></a></td>';
        newRow.append(cols);
		
		var trainer_id_box = 'trainer_id['+ counter +']';
		var materi_id_box = 'materi_id['+ counter +']';
        /*if (counter == 4) $('#addrow').attr('disabled', true).prop('value', "You've reached the limit");*/
        $("table.trainer-list").append(newRow);
		$('.trainer_search').typeahead({
		   // definisikan source - sumber data
			source: function(query,process){
				data = [];
				map = {};
				var source = [];
		 
				// ambil JSON ke server
				$.getJSON(uri+'/getTrainer/'+query, function(result) {
						source = result;
						$.each(source, function (i, dt) {
							map[dt.trainer] = dt;
							data.push(dt.trainer);
						});
					process(data);
				});
			},
		 
		   // panjang string (query) minimal untuk dikirim ke server
		   minLength:3,
		   updater: function(item){$('[name="'+trainer_id_box+'"]').val(map[item].trainer_id); return item}
		});
		
		$('.materi_search').typeahead({
		   // definisikan source - sumber data
			source: function(query,process){
				data = [];
				map = {};
				var source = [];
		 
				// ambil JSON ke server
				$.getJSON(uri+'/getMateri/'+query, function(result) {
						source = result;
						$.each(source, function (i, dt) {
							map[dt.materi] = dt;
							data.push(dt.materi);
						});
					process(data);
				});
			},
		 
		   // panjang string (query) minimal untuk dikirim ke server
		   minLength:3,
		   updater: function(item){$('[name="'+materi_id_box+'"]').val(map[item].materi_id); return item}
		});
        counter++;
    });
	
	$("table.trainer-list").on("click", ".ibtnDel", function (event) {
		counter = $('#tabelTrainer tr').length - 2;
        $(this).closest("tr").remove(); 
        counter -= 1
        /*$('#addrow').attr('disabled', false).prop('value', "Add Row");*/
    });
	
	$('.trainer_search').typeahead({
	   // definisikan source - sumber data
		source: function(query,process){
			data = [];
			map = {};
			var source = [];
	 
			// ambil JSON ke server
			$.getJSON(uri+'/getTrainer/'+query, function(result) {
					source = result;
					$.each(source, function (i, dt) {
						map[dt.NAMA] = dt;
						data.push(dt.NAMA);
					});
				process(data);
			});
		},
	 
	   // panjang string (query) minimal untuk dikirim ke server
	   minLength:3,
	   updater: function(item){$('[name="trainer_id[0]"]').val(map[item].ID); return item}

	})
	$('.materi_search').typeahead({
	   // definisikan source - sumber data
		source: function(query,process){
			data = [];
			map = {};
			var source = [];
	 
			// ambil JSON ke server
			$.getJSON(uri+'/getMateri/'+query, function(result) {
					source = result;
					$.each(source, function (i, dt) {
						map[dt.materi] = dt;
						data.push(dt.materi);
						$("#materi_id").val(dt.materi_id);
					});
				process(data);
			});
		},
	 
	   // panjang string (query) minimal untuk dikirim ke server
	   minLength:3,
	   updater: function(item){$('#materi_id').val(map[item].materi_id); return item}
	});
	
	$('input[type=checkbox],input[type=radio]').iCheck({
    	checkboxClass: 'icheckbox_flat-blue',
    	radioClass: 'iradio_flat-blue'
	});
	
	var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    
	var checkin_1 = $('#dp1').datepicker({
		language: 'en-US'
    }).on('changeDate', function(ev) {
		if (ev.date.valueOf() > checkout_1.date.valueOf() || ev.date.valueOf() < checkout_1.date.valueOf()) {
			var newDate = new Date(ev.date)
			newDate.setDate(newDate.getDate());
			checkout_1.setValue(newDate);
		}
		checkin_1.hide();
		$('#dp2')[0].focus();
    }).data('datepicker');
    var checkout_1 = $('#dp2').datepicker({
		onRender: function(date) {
			return date.valueOf() < checkin_1.date.valueOf() ? 'disabled' : '';
		}
    }).on('changeDate', function(ev) {
		checkout_1.hide();
    }).data('datepicker');
	
    var checkin = $('#dpd1').datepicker({
		onRender: function(date) {
			return date.valueOf() < now.valueOf() ? 'disabled' : '';
		}
    }).on('changeDate', function(ev) {
		if (ev.date.valueOf() > checkout.date.valueOf()) {
			var newDate = new Date(ev.date)
			newDate.setDate(newDate.getDate());
			checkout.setValue(newDate);
		}
		checkin.hide();
		$('#dpd2')[0].focus();
    }).data('datepicker');
    var checkout = $('#dpd2').datepicker({
		onRender: function(date) {
			return date.valueOf() < checkin.date.valueOf() ? 'disabled' : '';
		}
    }).on('changeDate', function(ev) {
		checkout.hide();
    }).data('datepicker');
	
	$.validator.addMethod('selectcheck', function (value) {
        return (value != ' ');
    }, " Pilihlah Salah Satu");
    
    $.validator.addMethod('multiplecheck', function (value, element) {
    	var element_name = $(element).attr('name');
    	var element_id = $(element).attr('id');
    	state = $("#"+element_id).select2("val");
        return (state != '');
    }, " Pilihlah Salah Satu");
    
    $.validator.addMethod("greaterThan", function(value, element, params) {
    	var s = value;
		var e = $(params).val();
		tgl1_pisah = s.split('-');
		tgl2_pisah = e.split('-');
		
		var tanggal1 = new Date();
		tanggal1.setDate(tgl1_pisah[2]);
		tanggal1.setMonth(tgl1_pisah[1]);
		tanggal1.setYear(tgl1_pisah[0]);
				
		var tanggal2 = new Date();
		tanggal2.setDate(tgl2_pisah[2]);
		tanggal2.setMonth(tgl2_pisah[1]);
		tanggal2.setYear(tgl2_pisah[0]);
		
	    if (!/Invalid|NaN/.test(new Date(tanggal1))) {
	        return new Date(tanggal1) >= new Date(tanggal2);
	    }
	    return isNaN(tanggal1) && isNaN(tanggal2) 
	        || (Number(tanggal1) > Number(tanggal2)); 
	},'Harus Lebih Besar dari Tanggal Mulai.');
	
    $.validator.addMethod("radiocheck", function(value, element) {
    	var element_name = $(element).attr('name');
		state = $('input:radio[name="'+element_name +'"]').is(':checked');
        return (state != false);
    }, " Pilihlah Salah Satu Radio");
	
	$.validator.addMethod("boxcheck", function(value, element) {
    	var element_name = $(element).attr('name');
    	var label = $("label[for='"+element_name+"']").text();
		state = $('input:checkbox[name="'+element_name +'"]').is(':checked');
        return (state != false);
    }, " Pilihlah Salah Satu checkbox");
    
	var confirm_save_message = 'Are You Sure to Save?';

	$('select').select2({
		allowClear: true,
		dropdownAutoWidth: true
	});
	$("#form_add").validate({
		ignore: 'input[type=hidden], .select2-input, .select2-focusser',
		errorClass: 'help-block',
        errorElement: 'span',
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('success').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error').addClass('success');
        },
		errorPlacement: function(error, element) {
			error.appendTo(element.parents('.controls'));
	    }
	});
	$('.required').each(function() {
		var name = $(this).attr('name');
		var label = $("label[for='"+name+"']").text();
	    $(this).rules('add', {
	        required: true,
	        messages: {
	            required:  "Field <b>"+label+"</b> Harus di isi."
	        }
	    });
	});
	$('.required-num').each(function() {
		var name = $(this).attr('name');
		var label = $("label[for='"+name+"']").text();
	    $(this).rules('add', {
	        required: true,
	        number: true,
	        messages: {
	            required:  "Field <b>"+label+"</b> Harus di isi.",
	            number:  "Field "+label+" Harus Angka."
	        }
	    });
	});
	$('.check-valid-num').each(function() {
		var name = $(this).attr('name');
		var label = $("label[for='"+name+"']").text();
	    $(this).rules('add', {
	        required: false,
	        number: true,
	        messages: {
	            number:  "Field "+label+" Harus Angka."
	        }
	    });
	});
	$('.required-email').each(function() {
		var name = $(this).attr('name');
		var label = $("label[for='"+name+"']").text();
	    $(this).rules('add', {
	        required: true,
	        email: true,
	        messages: {
	            required:  "Field <b>"+label+"</b> Harus di isi.",
	            email:  "Masukkan Email yang Valid."
	        }
	    });
	});
	$('.check-valid-email').each(function() {
		var name = $(this).attr('name');
		var label = $("label[for='"+name+"']").text();
	    $(this).rules('add', {
	        required: false,
	        email: true,
	        messages: {
	            email:  "Masukkan Email yang Valid."
	        }
	    });
	});
	$('.required-same').each(function() {
		var name = $(this).attr('name');
		var label = $("label[for='"+name+"']").text();
	    $(this).rules('add', {
	        required: true,
	        equalTo:"#sandi",
	        messages: {
	            required:  "Field <b>"+label+"</b> Harus di isi.",
	            equalTo:  "Masukkan Konfirmasi Password yang Sama dengan Password."
	        }
	    });
	});
	$('.required-url').each(function() {
		var name = $(this).attr('name');
		var label = $("label[for='"+name+"']").text();
	    $(this).rules('add', {
	        required:true,
			url: true,
	        messages: {
	            required:  "Field <b>"+label+"</b> Harus di isi.",
	            url:  "Masukkan URL yang Valid."
	        }
	    });
	});
	$('.check-valid-url').each(function() {
		var name = $(this).attr('name');
		var label = $("label[for='"+name+"']").text();
	    $(this).rules('add', {
	        required:false,
			url: true,
	        messages: {
	            url:  "Masukkan URL yang Valid."
	        }
	    });
	});
	$('select.required_opt').each(function() {
		var name = $(this).attr('name');
		var label = $("label[for='"+name+"']").text();
	    $(this).rules('add', {
	        selectcheck:true,
	        messages: {
	            selectcheck:  " Pilihlah Salah Satu ."
	        }
	    });
	});
	$('select.required_multiple').each(function() {
		var name = $(this).attr('name');
		var label = $("label[for='"+name+"']").text();
	    $(this).rules('add', {
	        multiplecheck:true,
	        messages: {
	            selectcheck:  " Pilihlah Salah Satu ."
	        }
	    });
	});
	$('.required_radio').each(function() {
		//var el = $('.required_radio').find("input[type=radio]");
		//var name =  el.attr('name');
		//var label = $("label[for='"+name+"']").text();
		var name = $(this).attr('name');
		var label = $("label[for='"+name+"']").text();
	    $(this).rules('add', {
	        radiocheck:true,
	        messages: {
	            radiocheck:  " Pilihlah Salah Satu Radio."
	        }
	    });
	});
	$('.required_chkbox').each(function() {
		//var el = $('.required_chkbox').find("input[type=checkbox]");
		//var name =  el.attr('name');
		//var label = $("label[for='"+name+"']").text();
	    var name = $(this).attr('name');
		var label = $("label[for='"+name+"']").text();
	    $(this).rules('add', {
	        boxcheck:true,
	        messages: {
	            radiocheck:  " Pilihlah Salah Satu Checkbox."
	        }
	    });
	});
	$('.required-greater').each(function() {
		var name = $(this).attr('name');
		var label = $("label[for='"+name+"']").text();
	    $(this).rules('add', {
	        required: true,
	        greaterThan: "#tgl_mulai_kegiatan",
	        messages: {
	            required:  "Field <b>"+label+"</b> Harus di isi.",
	        }
	    });
	});
	$('#add_button').click(function(){
		if($("#form_add").valid()){
			bootbox.confirm(confirm_save_message, function(result) {
				if(result){
					$('#form_add').submit();	
				}
			});
		}
	});
	$('#change_password').click(function(){
		var old_password = $('#old_password').val();
    	var new_password = $('#new_password').val();
		var konf_password = $('#konf_password').val();
    	if(old_password==''){
    		alert('Masukkan Password Lama Anda');
    		$('#old_password').focus();
    		return false;
    	}
    	if(new_password==''){
    		alert('Masukkan Password Baru');
    		$('#new_password').focus();
    		return false;
    	}
		if(konf_password==''){
    		alert('Masukkan Konfirmasi Password Baru');
    		$('#konf_password').focus();
    		return false;
    	}
		if(new_password!=konf_password){
			alert('Masukkan Konfirmasi Password Baru Tidak Sama');
    		$('#konf_password').focus();
    		return false;
		}
		$.ajax({
	      type: "POST",
	      url: $('#changePassword').attr('action'),
	      data: "old_pass="+old_password+"&new_pass="+new_password,
	      success: function(data){
	      	var obj = $.parseJSON(data);
	      	console.log(obj);
	      	$(".loading_ajax").hide();
	      	if(obj.error_message=="true"){
	      		alert("Password Anda Berhasil dirubah");
	      		if(obj.url){
	      			location = obj.base_admin+'/'+obj.url;
	      		}
	      		else{
	      			location = obj.base_admin;
	      		}
	      	}
	      	else{
	      		$("#alert_change").show().empty().append("<button type='button' class='close' onclick=$('#alert_change').hide()>&times;</button>"+obj.error_message);
	      	}
	      },
	      beforeSend:function(){
	        $(".loading_ajax").show();
	      }
		});
	});
});