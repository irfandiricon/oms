<?php namespace App\Controllers;

use App\Models\Users_model;

class Changepassword extends BaseController
{
    function __construct() {
        date_default_timezone_set('Asia/Jakarta');
    }
    
	public function index()
	{
        $CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;

        $SESSION_LOGIN = isset($_SESSION[$Apps]['SESSION_LOGIN']) ? $_SESSION[$Apps]['SESSION_LOGIN']:array();
        if(empty($SESSION_LOGIN)){
            return redirect()->to(base_url().'/login');
        }

		$param = array();
		$param['cssName'] = "Css/public.css:Css/changepassword.css";
		$param['jsName'] = "JavaScript/public.js:JavaScript/changepassword.js";
		$param['title'] = "Ganti Password";
		$param['content'] = "changepassword";
		return view('template', $param);
	}

	public function updatedata()
	{
        $CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;

        $SESSION_LOGIN = isset($_SESSION[$Apps]['SESSION_LOGIN']) ? $_SESSION[$Apps]['SESSION_LOGIN']:array();
        if(empty($SESSION_LOGIN)){
            return redirect()->to(base_url().'/login');
        }
        
		$UsersModel = New Users_model();

		$USERNAME = isset($SESSION_LOGIN->USERNAME) ? $SESSION_LOGIN->USERNAME:"";
		$NEW_PASSWORD = isset($_POST['password2']) ? $_POST['password2']:"";
		$RE_NEW_PASSWORD = isset($_POST['password3']) ? $_POST['password3']:"";

		$VALID_PASSWORD = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/";

        $Messagepass = "Kata sandi tidak valid, silahkan gunakan :<br>Setidaknya satu karakter huruf kecil<br>Setidaknya satu karakter huruf besar<br>Setidaknya satu digit angka<br>Harus terdiri dari 8-20 karakter<br>Setidaknya satu tanda khusus #?!@$%^&*-";

        if(empty($NEW_PASSWORD)){
            $ERROR_MESSAGE = "Password baru wajib diisi!";
            $ERROR_CODE = "EC:001C";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(empty($RE_NEW_PASSWORD)){
            $ERROR_MESSAGE = "Ulangi password baru wajib diisi!";
            $ERROR_CODE = "EC:001C";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif($NEW_PASSWORD != $RE_NEW_PASSWORD) {
            $ERROR_MESSAGE = "Password tidak sama!";
            $ERROR_CODE = "EC:001G";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(!preg_match($VALID_PASSWORD, $NEW_PASSWORD)){
            $ERROR_MESSAGE = $Messagepass;
            $ERROR_CODE = "EC:001I";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(!preg_match($VALID_PASSWORD, $RE_NEW_PASSWORD)){
            $ERROR_MESSAGE = $Messagepass;
            $ERROR_CODE = "EC:001I";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }

        $param['USERNAME'] = $USERNAME;
        $param['PASSWORD'] = md5($NEW_PASSWORD);
        $param['UPDATED_DATE'] = date('Y-m-d H:i:s');
        $param['UPDATED_BY'] = $CREATED_BY;

        $Retrieve = $UsersModel->updatepassword($param);
        $ERROR_MESSAGE = $Retrieve['ErrorMessage'];
        $ERROR_CODE = $Retrieve['ErrorCode'];
        if($ERROR_CODE != "EC:0000"){
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }

        $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
        die(json_encode($JSON));

	}
}