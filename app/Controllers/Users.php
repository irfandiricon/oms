<?php namespace App\Controllers;

use App\Models\Users_model;

class Users extends BaseController
{
    function __construct() {
        date_default_timezone_set('Asia/Jakarta');
    }
    
	public function index()
	{
        return view('users');
	}

    public function getUser()
    {
        $UsersModel = New Users_model();

        $Result = $UsersModel->view();
        
        die(json_encode($Result));
    }

	public function add()
	{
        $CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;

        $SESSION_LOGIN = isset($_SESSION[$Apps]['SESSION_LOGIN']) ? $_SESSION[$Apps]['SESSION_LOGIN']:array();
        if(empty($SESSION_LOGIN)){
            $ERROR_MESSAGE = "Silahkan login kembali !";
            $ERROR_CODE = "EC:0000";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }

        $UsersModel = New Users_model();

		$USERNAME = isset($_POST['username']) ? $_POST['username']:"";
		$PASSWORD = isset($_POST['password']) ? $_POST['password']:"";
		$C_PASSWORD = isset($_POST['repassword']) ? $_POST['repassword']:"";
		$NAME = isset($_POST['name']) ? $_POST['name']:"";
		$NOHP = isset($_POST['nohp']) ? $_POST['nohp']:"";
		$EMAIL = isset($_POST['email']) ? $_POST['email']:"";
        $CREATED_BY = isset($SESSION_LOGIN->USERNAME) ? $SESSION_LOGIN->USERNAME:"";

		$VALID_TEXT = "/^[a-zA-Z ]*$/";
        $VALID_TEXT_NUMBER = "/^[a-zA-Z0-9]*$/";
        $VALID_EMAIL = "/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/";
        $VALID_NUMBER = "/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$/";
        $VALID_PASSWORD = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/";

        $Messagepass = "Kata sandi tidak valid, silahkan gunakan :<br>Setidaknya satu karakter huruf kecil<br>Setidaknya satu karakter huruf besar<br>Setidaknya satu digit angka<br>Harus terdiri dari 8-20 karakter<br>Setidaknya satu tanda khusus #?!@$%^&*-";

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
        }elseif(empty($C_PASSWORD)){
            $ERROR_MESSAGE = "Re-password wajib diisi!";
            $ERROR_CODE = "EC:001C";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(empty($NAME)){
            $ERROR_MESSAGE = "Nama lengkap wajib diisi!";
            $ERROR_CODE = "EC:001D";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(empty($NOHP)){
            $ERROR_MESSAGE = "No Handphone wajib diisi!";
            $ERROR_CODE = "EC:001E";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(empty($EMAIL)){
            $ERROR_MESSAGE = "Email wajib diisi!";
            $ERROR_CODE = "EC:001F";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif($PASSWORD != $C_PASSWORD) {
            $ERROR_MESSAGE = "Password tidak sama!";
            $ERROR_CODE = "EC:001G";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(!preg_match($VALID_PASSWORD, $PASSWORD)){
            $ERROR_MESSAGE = $Messagepass;
            $ERROR_CODE = "EC:001H";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(!preg_match($VALID_PASSWORD, $C_PASSWORD)){
            $ERROR_MESSAGE = $Messagepass;
            $ERROR_CODE = "EC:001I";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(!preg_match($VALID_NUMBER, $NOHP)) {
            $ERROR_MESSAGE = "No Handphone tidak diizinkan!";
            $ERROR_CODE = "EC:001K";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }

        $param['USERNAME'] = $USERNAME;
        $param['PASSWORD'] = md5($PASSWORD);
        $param['NAME'] = $NAME;
        $param['NOHP'] = $NOHP;
        $param['EMAIL'] = $EMAIL;
        $param['CREATED_DATE'] = date('Y-m-d H:i:s');
        $param['CREATED_BY'] = $CREATED_BY;

        $Retrieve = $UsersModel->add($param);
        $ERROR_MESSAGE = $Retrieve['ErrorMessage'];
        $ERROR_CODE = $Retrieve['ErrorCode'];
        if($ERROR_CODE != "EC:0000"){
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }

        $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
        die(json_encode($JSON));
	}

    public function updateinfo()
    {
        $CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;

        $SESSION_LOGIN = isset($_SESSION[$Apps]['SESSION_LOGIN']) ? $_SESSION[$Apps]['SESSION_LOGIN']:array();
        if(empty($SESSION_LOGIN)){
            $ERROR_MESSAGE = "Silahkan login kembali !";
            $ERROR_CODE = "EC:0000";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }

        $UsersModel = New Users_model();

        $USERNAME = isset($_POST['username']) ? $_POST['username']:"";
        $NAME = isset($_POST['name']) ? $_POST['name']:"";
        $NOHP = isset($_POST['nohp']) ? $_POST['nohp']:"";
        $EMAIL = isset($_POST['email']) ? $_POST['email']:"";
        $STATUS = isset($_POST['status']) ? $_POST['status']:"";
        $CREATED_BY = isset($SESSION_LOGIN->USERNAME) ? $SESSION_LOGIN->USERNAME:"";

        $VALID_TEXT = "/^[a-zA-Z ]*$/";
        $VALID_TEXT_NUMBER = "/^[a-zA-Z0-9]*$/";
        $VALID_EMAIL = "/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/";
        $VALID_NUMBER = "/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$/";
        $VALID_PASSWORD = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/";

        if(empty($USERNAME)){
            $ERROR_MESSAGE = "Username wajib diisi!";
            $ERROR_CODE = "EC:001A";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(empty($NAME)){
            $ERROR_MESSAGE = "Nama lengkap wajib diisi!";
            $ERROR_CODE = "EC:001B";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(empty($NOHP)){
            $ERROR_MESSAGE = "No Handphone wajib diisi!";
            $ERROR_CODE = "EC:001C";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(empty($EMAIL)){
            $ERROR_MESSAGE = "Email wajib diisi!";
            $ERROR_CODE = "EC:001D";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(!preg_match($VALID_NUMBER, $NOHP)) {
            $ERROR_MESSAGE = "No Handphone tidak diizinkan!";
            $ERROR_CODE = "EC:001E";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }

        $param['USERNAME'] = $USERNAME;
        $param['NAME'] = $NAME;
        $param['NOHP'] = $NOHP;
        $param['EMAIL'] = $EMAIL;
        $param['UPDATED_DATE'] = date('Y-m-d H:i:s');
        $param['UPDATED_BY'] = $CREATED_BY;
        $param['STATUS'] = $STATUS;

        $Retrieve = $UsersModel->updateinfo($param);
        $ERROR_MESSAGE = $Retrieve['ErrorMessage'];
        $ERROR_CODE = $Retrieve['ErrorCode'];
        if($ERROR_CODE != "EC:0000"){
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }

        $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
        die(json_encode($JSON));
    }

    public function updatepassword()
    {
        $CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;

        $SESSION_LOGIN = isset($_SESSION[$Apps]['SESSION_LOGIN']) ? $_SESSION[$Apps]['SESSION_LOGIN']:array();
        if(empty($SESSION_LOGIN)){
            $ERROR_MESSAGE = "Silahkan login kembali !";
            $ERROR_CODE = "EC:0000";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }

        $UsersModel = New Users_model();

        $USERNAME = isset($_POST['username']) ? $_POST['username']:"";
        $PASSWORD = isset($_POST['password']) ? $_POST['password']:"";
        $C_PASSWORD = isset($_POST['repassword']) ? $_POST['repassword']:"";
        $CREATED_BY = isset($SESSION_LOGIN->USERNAME) ? $SESSION_LOGIN->USERNAME:"";

        $VALID_TEXT = "/^[a-zA-Z ]*$/";
        $VALID_TEXT_NUMBER = "/^[a-zA-Z0-9]*$/";
        $VALID_EMAIL = "/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/";
        $VALID_NUMBER = "/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$/";
        $VALID_PASSWORD = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/";

        $Messagepass = "Kata sandi tidak valid, silahkan gunakan :<br>Setidaknya satu karakter huruf kecil<br>Setidaknya satu karakter huruf besar<br>Setidaknya satu digit angka<br>Harus terdiri dari 8-20 karakter<br>Setidaknya satu tanda khusus #?!@$%^&*-";

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
        }elseif(empty($C_PASSWORD)){
            $ERROR_MESSAGE = "Re-password wajib diisi!";
            $ERROR_CODE = "EC:001C";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif($PASSWORD != $C_PASSWORD) {
            $ERROR_MESSAGE = "Password tidak sama!";
            $ERROR_CODE = "EC:001D";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }elseif(!preg_match($VALID_PASSWORD, $PASSWORD)){
            $ERROR_MESSAGE = $Messagepass;
            $ERROR_CODE = "EC:001E";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }

        $param['USERNAME'] = $USERNAME;
        $param['PASSWORD'] = md5($PASSWORD);
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

    public function deleterow()
    {
        $CustomConfig = new \Config\CustomConfig();
        $Apps = $CustomConfig->apps;

        $SESSION_LOGIN = isset($_SESSION[$Apps]['SESSION_LOGIN']) ? $_SESSION[$Apps]['SESSION_LOGIN']:array();
        if(empty($SESSION_LOGIN)){
            $ERROR_MESSAGE = "Silahkan login kembali !";
            $ERROR_CODE = "EC:0000";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }
        
        $CREATED_BY = isset($SESSION_LOGIN->USERNAME) ? $SESSION_LOGIN->USERNAME:"";
        
        $UsersModel = New Users_model();
        $USERNAME = isset($_POST['username']) ? $_POST['username']:"";
        if(empty($USERNAME)){
            $ERROR_MESSAGE = "Username wajib diisi!";
            $ERROR_CODE = "EC:001A";
            $JSON = array("ERROR_CODE" => $ERROR_CODE, "ERROR_MESSAGE" => $ERROR_MESSAGE);
            die(json_encode($JSON));
        }

        $param['USERNAME'] = $USERNAME;
        $param['DELETED_DATE'] = date('Y-m-d H:i:s');
        $param['DELETED_BY'] = $CREATED_BY;

        $Retrieve = $UsersModel->deleterow($param);
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
