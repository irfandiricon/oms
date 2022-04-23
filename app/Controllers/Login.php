<?php namespace App\Controllers;

use App\Models\Login_model;

class Login extends BaseController
{
    function __construct() {
        date_default_timezone_set('Asia/Jakarta');
    }
    
	public function index()
	{
		$CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;

        $SESSION_LOGIN = isset($_SESSION[$Apps]['SESSION_LOGIN']) ? $_SESSION[$Apps]['SESSION_LOGIN']:array();
		if(!empty($SESSION_LOGIN)){
            return redirect()->to(base_url().'/dashboard');
		}
        return view('login');
	}

	public function check()
	{
        $CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;

		$LoginModel = New Login_model();

		$USERNAME = isset($_POST['username']) ? $_POST['username']:"";
		$PASSWORD = isset($_POST['password']) ? $_POST['password']:"";

		$Messagepass = "Kata sandi tidak valid, silahkan gunakan :<br>Setidaknya satu karakter huruf kecil<br>Setidaknya satu karakter huruf besar<br>Setidaknya satu digit angka<br>Harus terdiri dari 8-20 karakter<br>Setidaknya satu tanda khusus #?!@$%^&*-";

		$VALID_PASSWORD = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/";
		if(empty($USERNAME)){
            $ERROR_MESSAGE = "Username wajib diisi!";
            $ERROR_CODE = "EC:001A";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(empty($PASSWORD)){
            $ERROR_MESSAGE = "Password wajib diisi!";
            $ERROR_CODE = "EC:001B";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(!preg_match($VALID_PASSWORD, $PASSWORD)){
            $ERROR_MESSAGE = $Messagepass;
            $ERROR_CODE = "EC:001C";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }

        $date = date('siHdmY');
        $enc = strtoupper(md5($date));
        $SESSION_ID = substr($enc, 0, 10);

        $param['USERNAME'] = $USERNAME;
        $param['SESSION_ID'] = $SESSION_ID;
        $param['PASSWORD'] = md5($PASSWORD);
        $param['START_LOG'] = date('Y-m-d H:i:s');

        $Retrieve = $LoginModel->check($param);
        $ERROR_MESSAGE = $Retrieve['ErrorMessage'];
        $ERROR_CODE = $Retrieve['ErrorCode'];
        if($ERROR_CODE != "EC:0000"){
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }

        $Data = $Retrieve['Data'];

        $_SESSION[$Apps]['SESSION_LOGIN'][$Apps] = $Data;
        $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
        die(json_encode($JSON));
	}

    public function logout()
    {
        $CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;
        
        unset($_SESSION[$Apps]['SESSION_LOGIN']);
        return redirect()->to(base_url().'/home');
    }
}