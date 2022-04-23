<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
    <meta name="author" content="SoapTheme">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>OMS - Order Management System</title>
	<link rel="shortcut icon" href="#" type="image/png">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/easyui-1.9.15/themes/metro/easyui.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/easyui-1.9.15/themes/icon.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/easyui-texteditor/texteditor.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/easyui-1.9.15/themes/color.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/easyui-1.9.15/demo/demo.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/Css/public.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/assets/Css/style.css">
	<?php
	if(!empty($cssName)){ 
	    $AddtionalCss = explode(":",$cssName);
	    for($i=0;$i<sizeof($AddtionalCss);$i++){
	    ?>
	    	<link rel="stylesheet" href="<?php echo base_url('assets'); ?><?php echo "/".$AddtionalCss[$i] ?>">
	    <?php
	    }
	}
   	?>
</head>
<body class="easyui-layout">
    <div data-options="region:'west',title:'Menu',split:true" style="width:300px; height: 100%">
    	<?php
    		$param['menu'] = array(); 
    		echo view('menu', $param);
    	?>
    </div>
    <div data-options="region:'center',title:'Order Management System'" style="padding:5px;">
    	<div id="tab" class="easyui-tabs" style="width:100%;height:100%;">
    		<div title="Dashboard" data-options="href:'<?php echo base_url()?>/dashboard'" style="display:none;"></div>
		</div>
    </div>

    <div id="dialog" style="padding: 10px; display: none; position: relative;">
</body>
<footer>
	<script type="text/javascript" src="<?php echo base_url(); ?>/assets/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/assets/jquery/popper.min.js"></script>
   	<script type="text/javascript" src="<?php echo base_url(); ?>/assets/easyui-1.9.15/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/easyui-texteditor/jquery.texteditor.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/JavaScript/public.js"></script>
	<?php
    if(!empty($jsName)){
	    $AddtionalJs = explode(":",$jsName);
	    for($i=0;$i<sizeof($AddtionalJs);$i++){
	    ?>
	    	<script type="text/javascript" src="<?php echo base_url('assets'); ?><?php echo "/".$AddtionalJs[$i] ?>"></script>
	    <?php
	    }
	}
   	?>
   	<script type="text/javascript">
   		$(function(){
   			var BaseUrl = '<?php echo base_url() ?>';
   			localStorage.setItem("baseURI", BaseUrl);
   		});
   	</script>
</footer>
</html>
