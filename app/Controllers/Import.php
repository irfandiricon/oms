<?php namespace App\Controllers;
use PHPExcel;
use PHPExcel_IOFactory;
use App\Models\Pdam_model;

class Import extends BaseController
{
	function __construct() {
        date_default_timezone_set('Asia/Jakarta');
    }

    public function prabayar()
	{
		error_reporting(0);

		$db = \Config\Database::connect();
		$CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;

		$SESSION_LOGIN = isset($_SESSION[$Apps]['SESSION_LOGIN']) ? $_SESSION[$Apps]['SESSION_LOGIN']:array();
		if(empty($SESSION_LOGIN)){
            return redirect()->to(base_url().'/login');
        }

		$file = $this->request->getFile('fileexcel');
		if($file){
			$excelReader  = new PHPExcel();
			$fileLocation = $file->getTempName();
			$objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
			$sheet	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			foreach ($sheet as $idx => $data) {
				if($idx==1){
					continue;
				}

				$param['TYPE'] = $data['A'];
				$param['ID_PROVIDER'] = $data['B'];
				$param['CODE'] = $data['C'];
				$param['NAME'] = $data['D'];
				$param['DESCRIPTION'] = $data['E'];
				$param['HARGA_MODAL'] = $data['F'];
				$param['HARGA_JUAL'] = $data['G'];
				$param['CREATED_DATE'] = date('Y-m-d H:i:s');
				$param['CREATED_BY'] = isset($SESSION_LOGIN->USERNAME) ? $SESSION_LOGIN->USERNAME:"";

				$Retrieve = $db->table('MS_PRODUK_PRABAYAR')->insert($param);
			}
		}
		
		return redirect()->to(base_url('prabayar'));
	}

    public function pascabayar(){
		error_reporting(0);

		$db = \Config\Database::connect();
		$CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;

		$SESSION_LOGIN = isset($_SESSION[$Apps]['SESSION_LOGIN']) ? $_SESSION[$Apps]['SESSION_LOGIN']:array();
		if(empty($SESSION_LOGIN)){
            return redirect()->to(base_url().'/login');
        }

		$file = $this->request->getFile('fileexcel');
		$TYPE = isset($_POST['type']) ? $_POST['type']:"";
		if($file){
			$excelReader  = new PHPExcel();
			$fileLocation = $file->getTempName();
			$objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
			$sheet	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			foreach ($sheet as $idx => $data) {
				if($idx==1){
					continue;
				}

				$param['TYPE'] = $TYPE;
				$param['CODE'] = $data['A'];
				$param['DESCRIPTION'] = $data['B'];
				$param['CREATED_DATE'] = date('Y-m-d H:i:s');
				$param['CREATED_BY'] = isset($SESSION_LOGIN->USERNAME) ? $SESSION_LOGIN->USERNAME:"";

				$Retrieve = $db->table('MS_PRODUK_PASCABAYAR')->insert($param);
			}
		}
		
		return redirect()->to(base_url('pascabayar'));
	}

	public function emoney()
	{
		error_reporting(0);

		$db = \Config\Database::connect();
		$CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;

		$SESSION_LOGIN = isset($_SESSION[$Apps]['SESSION_LOGIN']) ? $_SESSION[$Apps]['SESSION_LOGIN']:array();
		if(empty($SESSION_LOGIN)){
            return redirect()->to(base_url().'/login');
        }

		$file = $this->request->getFile('fileexcel');
		$TYPE = isset($_POST['type']) ? $_POST['type']:"";
		if($file){
			$excelReader  = new PHPExcel();
			$fileLocation = $file->getTempName();
			$objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
			$sheet	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			foreach ($sheet as $idx => $data) {
				if($idx==1){
					continue;
				}

				if(empty($TYPE)){
					$TYPE_DATA = $data['A'];
				}else{
					$TYPE_DATA = $TYPE;
				}

				$param['TYPE'] = $TYPE_DATA;
				$param['CODE'] = $data['B'];
				$param['NAME'] = $data['C'];
				$param['DESCRIPTION'] = $data['D'];
				$param['HARGA_MODAL'] = $data['E'];
				$param['HARGA_JUAL'] = $data['F'];
				$param['CREATED_DATE'] = date('Y-m-d H:i:s');
				$param['CREATED_BY'] = isset($SESSION_LOGIN->USERNAME) ? $SESSION_LOGIN->USERNAME:"";

				$Retrieve = $db->table('MS_PRODUK_EMONEY')->insert($param);
			}
		}
		
		return redirect()->to(base_url('emoney'));
	}

	public function voucher()
	{
		error_reporting(0);

		$db = \Config\Database::connect();
		$CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;

		$SESSION_LOGIN = isset($_SESSION[$Apps]['SESSION_LOGIN']) ? $_SESSION[$Apps]['SESSION_LOGIN']:array();
		if(empty($SESSION_LOGIN)){
            return redirect()->to(base_url().'/login');
        }

		$file = $this->request->getFile('fileexcel');
		if($file){
			$excelReader  = new PHPExcel();
			$fileLocation = $file->getTempName();
			$objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
			$sheet	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			foreach ($sheet as $idx => $data) {
				if($idx==1){
					continue;
				}

				$param['TYPE'] = $data['A'];
				$param['CODE'] = $data['B'];
				$param['NAME'] = $data['C'];
				$param['DESCRIPTION'] = $data['D'];
				$param['HARGA_MODAL'] = $data['E'];
				$param['HARGA_JUAL'] = $data['F'];
				$param['CREATED_DATE'] = date('Y-m-d H:i:s');
				$param['CREATED_BY'] = isset($SESSION_LOGIN->USERNAME) ? $SESSION_LOGIN->USERNAME:"";

				$Retrieve = $db->table('MS_PRODUK_VOUCHER')->insert($param);
			}
		}
		
		return redirect()->to(base_url('voucher'));
	}

	public function game()
	{
		error_reporting(0);

		$db = \Config\Database::connect();
		$CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;

		$SESSION_LOGIN = isset($_SESSION[$Apps]['SESSION_LOGIN']) ? $_SESSION[$Apps]['SESSION_LOGIN']:array();
		if(empty($SESSION_LOGIN)){
            return redirect()->to(base_url().'/login');
        }

		$file = $this->request->getFile('fileexcel');
		if($file){
			$excelReader  = new PHPExcel();
			$fileLocation = $file->getTempName();
			$objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
			$sheet	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			foreach ($sheet as $idx => $data) {
				if($idx==1){
					continue;
				}

				$param['TYPE'] = $data['A'];
				$param['CODE'] = $data['B'];
				$param['NAME'] = $data['C'];
				$param['DESCRIPTION'] = $data['D'];
				$param['HARGA_MODAL'] = $data['E'];
				$param['HARGA_JUAL'] = $data['F'];
				$param['CREATED_DATE'] = date('Y-m-d H:i:s');
				$param['CREATED_BY'] = isset($SESSION_LOGIN->USERNAME) ? $SESSION_LOGIN->USERNAME:"";

				$Retrieve = $db->table('MS_PRODUK_GAME')->insert($param);
			}
		}
		
		return redirect()->to(base_url('game'));
	}
}