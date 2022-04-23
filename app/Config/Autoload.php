<?php
namespace Config;
use CodeIgniter\Config\AutoloadConfig;

class Autoload extends AutoloadConfig
{
	public $psr4 = [];

	public $classmap = [];

	public function __construct()
	{
		parent::__construct();
		$psr4 = [
			APP_NAMESPACE => APPPATH, 
			'Config'      => APPPATH . 'Config',
			'Mpdf' => APPPATH .'ThirdParty/mpdf/src'
		];

		$classmap = [
			'PHPExcel' => APPPATH.'ThirdParty/PHPExcel/PHPExcel.php',
			'Service' => APPPATH.'Libraries/Service.php',
		];

		$this->psr4     = array_merge($this->psr4, $psr4);
		$this->classmap = array_merge($this->classmap, $classmap);

		unset($psr4, $classmap);
	}
}
