$(document).ready(function(){
    $('#loginform input#usr_admin').bind('keypress',function(e){
		if(e.which == 13) {
			$('#btnLogin').trigger('click')
			return false;
		}
	})
	$('#loginform input#pwd_admin').bind('keypress',function(e){
		if(e.which == 13) {
			$('#btnLogin').trigger('click')
			return false;
		}
	})
    $('#btnLogin').click(function(){
    	var usr_admin = $('#usr_admin').val();
    	var pwd_admin = $('#pwd_admin').val();
    	if(usr_admin==''){
    		alert('Masukkan Username');
    		$('#usr_admin').focus();
    		return false;
    	}
    	if(pwd_admin==''){
    		alert('Masukkan Password');
    		$('#pwd_admin').focus();
    		return false;
    	}
    	$.ajax({
	      type: "POST",
	      url: $('#loginform').attr('action'),
	      data: "usr="+usr_admin+"&pwd="+pwd_admin,
	      success: function(data){
	      	var obj = $.parseJSON(data);
	      	console.log(obj);
	      	$(".loading_ajax").hide();
	      	if(obj.error_message=="true"){
	      		alert("Thank you for login");
	      		if(obj.url){
	      			location = obj.base_admin+'/'+obj.url;
	      		}
	      		else{
	      			location = obj.base_admin;
	      		}
	      	}
	      	else{
	      		$("#alert_login").show().empty().append("<button type='button' class='close' onclick=$('#alert_login').hide()>&times;</button>"+obj.error_message);
	      	}
	      },
	      beforeSend:function(){
	        $(".loading_ajax").show();
	      }
		});
    });
});