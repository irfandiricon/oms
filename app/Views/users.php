<?php 
$paramadd = array();
$SendAdd = base64_encode(json_encode($paramadd));

$DataUser = isset($Data['users']) ? $Data['users']: array();
?>

<table id="datagrid" style="height: 100%; overflow: auto;"></table>

<script type="text/javascript">
	$(document).ready(function(){
		var baseURI = localStorage.getItem('baseURI');
		var data = {'url':'dialog/form_user'};
		var FileData = btoa(JSON.stringify(data));

		$('#datagrid').datagrid({
	        url:baseURI+'/users/getUser',
	        columns:[[
	            {field:'USERNAME',title:'USERNAME', width: 200},
	            {field:'NAME',title:'NAMA LENGKAP', width: 200},
	            {field:'NOHP',title:'NO. TELP / HP', width: 200},
	            {field:'EMAIL',title:'EMAIL', width: 200}
	        ]],
		    toolbar: [{
	            text:'Add',
	            iconCls:'icon-add',
	            handler:function(){
	            	openDialogSave('Add User', FileData, 400);
	            }
	        },'-',{
	            text:'Edit',
	            iconCls:'icon-edit',
	            handler:function(){alert('Edit')}
	        },'-',{
	            text:'Delete',
	            iconCls:'icon-remove',
	            handler:function(){alert('Delete')}
	        },'-',{
	            text:'Reload',
	            iconCls:'icon-reload',
	            handler:function(){
	            	reload();
	            }
	        }],
	        fitColumns : true,
	        rownumbers:true,
	        singleSelect:true,
	        pagination: true
	    });
	});

	function reload()
	{
		$('#datagrid').datagrid('reload');
	}
</script>