function open(plugin, file){
    if ($('#tab').tabs('exists',plugin)){
        $('#tab').tabs('select', plugin);
    } else {
        $('#tab').tabs('add',{
            title:plugin,
            href:file,
            closable:true
        });
        
    }
}

$(document).ready(function(){
    $('#menu').tree({
        onClick : function(node){
          var text = node.text;
          var BaseUrl = node.target.baseURI;
          var url = BaseUrl+text.toLowerCase();
          open(text, url);
        }
    });
});

function openDialogSave(title, data, w)
{
    var baseURI = localStorage.getItem('baseURI');

    $('#dialog').dialog({
        title : title,
        width : w,
        href : baseURI+'/dialog/form/'+data,
        model : true,
        height: 'auto',
        buttons: [{
            text:'Save',
            iconCls:'icon-save',
            handler:function(){
                alert('ok');
            }
        },{
            text:'Cancel',
            handler:function(){
                $('#dialog').dialog('close');
            }
        }]
    });
}

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

function formatRupiah(angka, prefix)
{
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
}

function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

    return false;
    return true;
}