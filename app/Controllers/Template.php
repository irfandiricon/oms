<?php namespace App\Controllers;

use App\Libraries\Service;

class Template extends BaseController
{
	function __construct() {
        date_default_timezone_set('Asia/Jakarta');
    }
    
	public function index()
	{	
		$Service = new Service();
		$CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;
        $UrlB2C = $CustomConfig->UrlB2C;

		$param = array();
		$param['cssName'] = "Css/public.css";
		$param['jsName'] = "JavaScript/public.js";
		$param['content'] = "template";

		return view('template', $param);
	}
}