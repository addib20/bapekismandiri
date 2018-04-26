$(document).ready(function(){
	$('#btnCariTrainer').click(function(){
    	var pemateri = $('#pemateri').val();
    	var materi = $('#materi').val();
		var showby = $('#showby').val();
    	$.ajax({
	      type: "POST",
	      url: $('#form_search_trainer').attr('action'),
	      data: "pemateri="+pemateri+"&materi="+materi+"&showby="+showby,
	      success: function(data){
	      	var obj = $.parseJSON(data);
	      	$(".loading_ajax").hide();
	      	$('#resultSearch').html(obj.html);
	      },
	      beforeSend:function(){
	        $(".loading_ajax").show();
	      }
		});
    });
	
	$('#btnCariPelatihan').click(function(){
    	var bulan = $('#bulan').val();
		var tahun = $('#tahun').val();
		var showby = $('#showby').val();
    	$.ajax({
	      type: "POST",
	      url: $('#form_search_pelatihan').attr('action'),
	      data: "bulan="+bulan+"&tahun="+tahun+"&showby="+showby,
	      success: function(data){
	      	var obj = $.parseJSON(data);
	      	$(".loading_ajax").hide();
	      	$('#resultSearch').html(obj.html);
	      },
	      beforeSend:function(){
	        $(".loading_ajax").show();
	      }
		});
    });
	
	$('#btnCariEvaluasi').click(function(){
    	var jenis_kegiatan = $('#jenis_kegiatan').val();
		var batch = $('#batch').val();
    	$.ajax({
	      type: "POST",
	      url: $('#form_search_evaluasi').attr('action'),
	      data: "jenis_kegiatan="+jenis_kegiatan+"&batch="+batch,
	      success: function(data){
	      	var obj = $.parseJSON(data);
	      	$(".loading_ajax").hide();
	      	$('#resultSearch').html(obj.html);
	      },
	      beforeSend:function(){
	        $(".loading_ajax").show();
	      }
		});
    });
});
function change_cabang(sel,url_cabang){
	//console.log($('#'+sel.id).select2('data'));
	var cabang = $('#'+sel.id).select2('data').id;
	
	$.ajax({
		type: "POST",
		url: url_cabang,
		data: "cabang="+cabang,
		success: function(data){
			var obj = $.parseJSON(data);
			$(".loading_ajax").hide();
			$('#body_monitoring').html(obj.html);
		},
		beforeSend:function(){
			$(".loading_ajax").show();
		}
	});
}