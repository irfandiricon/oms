<?php namespace App\Models;

use CodeIgniter\Model;

class Login_model extends Model
{		
	public function check($param)
	{
		$db = \Config\Database::connect();

		$USERNAME = isset($param['USERNAME']) ? $param['USERNAME']:"";
		$PASSWORD = isset($param['PASSWORD']) ? $param['PASSWORD']:"";
		$START_LOG = isset($param['START_LOG']) ? $param['START_LOG']:"";
		$SESSION_ID = isset($param['SESSION_ID']) ? $param['SESSION_ID']:"";
		$WRONG_PASSWORD = isset($_SESSION['WRONG_PASSWORD'][$USERNAME]['TOTAL']) ? $_SESSION['WRONG_PASSWORD'][$USERNAME]['TOTAL']:0;

		$query = $db->query("SELECT USERNAME, PASSWORD, NAME, NOHP, EMAIL, STATUS FROM MS_USERS WHERE USERNAME = '".$USERNAME."'");
		$row = $query->getResult();
		if(sizeof($row) == 0){
			$ErrorCode = "EC:002A";
			$ErrorMessage = "Akun anda tidak terdaftar, Silahkan hubungi admin!";
            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
           	return $JSON;
		}

		$params = array();
		foreach($row as $data){
			$NAME = $data->NAME;
			$NOHP = $data->NOHP;
			$EMAIL = $data->EMAIL;
			$STATUS = $data->STATUS;
			$PASSWORD_DB = $data->PASSWORD;

			if($STATUS == 0){
				$ErrorCode = "EC:002B";
				$ErrorMessage = "Akun anda sudah tidak aktif, Silahkan hubungi admin!";
	            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
	           	return $JSON;
			}elseif($STATUS == 2){
				$ErrorCode = "EC:002C";
				$ErrorMessage = "Akun anda sudah dihapus, Silahkan hubungi admin!";
	            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
	           	return $JSON;
			}elseif($STATUS == 3){
				$ErrorCode = "EC:002D";
				$ErrorMessage = "Anda telah 3 kali salah memasukan password, akun anda telah kami blokir. Silahkan hubungi admin!";
	            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
	           	return $JSON;
			}

			if($PASSWORD != $PASSWORD_DB){
				$COUNT = 1;
				$WP = $WRONG_PASSWORD + $COUNT;
				$_SESSION['WRONG_PASSWORD'][$USERNAME]['TOTAL'] = $WP;

				if($WP <= 3){
					$ErrorCode = "EC:002E";
					$ErrorMessage = "Username / password anda salah!";
		            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
		           	return $JSON;
				}else{
					$query2 = $db->query("UPDATE MS_USERS SET STATUS = '3' WHERE USERNAME = '".$USERNAME."'");
					if(!$query2){
						$ErrorCode = "EC:003A";
						$ErrorMessage = "Gagal mengupdate data blokir!";
			            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
			           	return $JSON;
					}
					unset($_SESSION['WRONG_PASSWORD'][$USERNAME]);
					$ErrorCode = "EC:002F";
					$ErrorMessage = "Anda telah 3 kali salah memasukan password, akun anda akan kami blokir. Silahkan hubungi admin!";
		            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
		           	return $JSON;

					$ErrorCode = "EC:002G";
					$ErrorMessage = "Username / password anda salah!";
		            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
		           	return $JSON;
				}
			}

			$params = $data;

			$ErrorCode = "EC:0000";
			$ErrorMessage = "Anda berhasil masuk";
	        $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage, "Data"=>$params);
	       	return $JSON;
		}
	}
}