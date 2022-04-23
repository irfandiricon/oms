function checkpass(){
	var chk_pass = document.getElementById('chk_pass');
	if(chk_pass.checked){
		$('#password2').prop({'type':'text'});
		$('#password3').prop({'type':'text'});
		$('#show_hide_pass').html('Hide Password');
	}else{
		$('#password2').prop({'type':'password'});
		$('#password3').prop({'type':'password'});
		$('#show_hide_pass').html('Show Password');
	}
}