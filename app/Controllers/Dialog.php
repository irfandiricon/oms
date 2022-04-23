<?php namespace App\Controllers;

use App\Libraries\Service;

class Dialog extends BaseController
{
	function __construct() {
        date_default_timezone_set('Asia/Jakarta');
    }
    
	public function form($param)
	{	
		$Decrypt = json_decode(base64_decode($param));
		$Url = $Decrypt->url;
		echo view($Url);
	}
}