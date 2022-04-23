function submitform(){
    var form = $('#formData');
    var data = form.serialize();
    var url = form.data('url');
    $.ajax({
        url : url,
        data : data,
        type : 'post',
        dataType : 'json',
        cache : false,
        beforeSend : function(){
            $('.preloader').fadeIn();
        },
        success : function(res){
            $('.preloader').fadeOut();
            var error_message = res.ERROR_MESSAGE;
            var error_code = res.ERROR_CODE;
            if(error_code != "EC:0000"){
                Swal.fire({
                    icon: 'error',
                    html: error_message,
                    confirmButton: true,
                    confirmButtonColor : '#1FB3E5',
                    confirmButtonText : 'Close'
                });
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: error_message,
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(function(){
                    window.location.reload();
                },1500);
            }
        }
    });
}