<?php namespace App\Models;

use CodeIgniter\Model;

class Users_model extends Model
{	

	protected $table = 'MS_USERS';
	
	public function view()
	{
		$db = \Config\Database::connect();
		// $query = $db->query("SELECT * FROM MS_USERS WHERE STATUS NOT IN ('2')");
		$query = $db->query("SELECT * FROM MS_USERS");
		$row = $query->getResult();
		return $row;
	}

	public function add($param)
	{
		$db = \Config\Database::connect();

		$USERNAME = isset($param['USERNAME']) ? $param['USERNAME']:"";
		$PASSWORD = isset($param['PASSWORD']) ? $param['PASSWORD']:"";
		$NAME = isset($param['NAME']) ? $param['NAME']:"";
		$NOHP = isset($param['NOHP']) ? $param['NOHP']:"";
		$EMAIL = isset($param['EMAIL']) ? $param['EMAIL']:"";
		$CREATED_DATE = isset($param['CREATED_DATE']) ? $param['CREATED_DATE']:"";
		$CREATED_BY = isset($param['CREATED_BY']) ? $param['CREATED_BY']:"";
		
		$query = $db->query("SELECT COUNT(*) AS TOTAL FROM MS_USERS WHERE USERNAME='".$USERNAME."'");
		$row = $query->getRow();

		if($row->TOTAL > 0){
			$ErrorMessage = "Username sudah tersedia, silahkan gunakan username yang lain!";
            $ErrorCode = "EC:002A";
            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
           	return $JSON;
		}

		$query2 = "INSERT INTO MS_USERS (USERNAME, PASSWORD, NAME, NOHP, EMAIL, CREATED_DATE, CREATED_BY) 
			values ('$USERNAME', '$PASSWORD', '$NAME', '$NOHP', '$EMAIL', '$CREATED_DATE', '$CREATED_BY')";
		$run =  $db->query($query2);
		if(!$run){
			$ErrorMessage = $db->error();
            $ErrorCode = "EC:002B";
            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
           	return $JSON;
			
		}

		$ErrorMessage = "Data berhasil disimpan";
        $ErrorCode = "EC:0000";
        $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
       	return $JSON;
	}

	public function updateinfo($param)
	{
		$db = \Config\Database::connect();

		$USERNAME = isset($param['USERNAME']) ? $param['USERNAME']:"";
		$NAME = isset($param['NAME']) ? $param['NAME']:"";
		$NOHP = isset($param['NOHP']) ? $param['NOHP']:"";
		$EMAIL = isset($param['EMAIL']) ? $param['EMAIL']:"";
		$UPDATED_DATE = isset($param['UPDATED_DATE']) ? $param['UPDATED_DATE']:"";
		$UPDATED_BY = isset($param['UPDATED_BY']) ? $param['UPDATED_BY']:"";
		$STATUS = isset($param['STATUS']) ? $param['STATUS']:"";
		
		$query = $db->query("SELECT COUNT(*) AS TOTAL FROM MS_USERS WHERE USERNAME='".$USERNAME."'");
		$row = $query->getRow();

		if($row->TOTAL == 0){
			$ErrorMessage = "Username tidak ditemukan!";
            $ErrorCode = "EC:002A";
            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
           	return $JSON;
		}

		$query2 = "UPDATE MS_USERS SET NAME = '".$NAME."', NOHP = '".$NOHP."', EMAIL = '".$EMAIL."', UPDATED_DATE = '".$UPDATED_DATE."', UPDATED_BY = '".$UPDATED_BY."', STATUS = '".$STATUS."'
			WHERE USERNAME = '".$USERNAME."'";
		$run =  $db->query($query2);
		if(!$run){
			$ErrorMessage = $db->error();
            $ErrorCode = "EC:002B";
            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
           	return $JSON;
			
		}

		$ErrorMessage = "Data berhasil disimpan";
        $ErrorCode = "EC:0000";
        $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
       	return $JSON;
	}

	public function updatepassword($param)
	{
		$db = \Config\Database::connect();

		$USERNAME = isset($param['USERNAME']) ? $param['USERNAME']:"";
		$PASSWORD = isset($param['PASSWORD']) ? $param['PASSWORD']:"";
		$UPDATED_DATE = isset($param['UPDATED_DATE']) ? $param['UPDATED_DATE']:"";
		$UPDATED_BY = isset($param['UPDATED_BY']) ? $param['UPDATED_BY']:"";
		
		$query = $db->query("SELECT COUNT(*) AS TOTAL FROM MS_USERS WHERE USERNAME='".$USERNAME."'");
		$row = $query->getRow();

		if($row->TOTAL == 0){
			$ErrorMessage = "Username tidak ditemukan!";
            $ErrorCode = "EC:002A";
            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
           	return $JSON;
		}

		$query2 = "UPDATE MS_USERS SET PASSWORD = '".$PASSWORD."', UPDATED_DATE = '".$UPDATED_DATE."', UPDATED_BY = '".$UPDATED_BY."'
			WHERE USERNAME = '".$USERNAME."'";
		$run =  $db->query($query2);
		if(!$run){
			$ErrorMessage = $db->error();
            $ErrorCode = "EC:002B";
            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
           	return $JSON;
			
		}

		$ErrorMessage = "Data berhasil disimpan";
        $ErrorCode = "EC:0000";
        $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
       	return $JSON;
	}

	public function deleterow($param)
	{
		$db = \Config\Database::connect();

		$USERNAME = isset($param['USERNAME']) ? $param['USERNAME']:"";
		$DELETED_DATE = isset($param['DELETED_DATE']) ? $param['DELETED_DATE']:"";
		$DELETED_BY = isset($param['DELETED_BY']) ? $param['DELETED_BY']:"";
		
		$query = $db->query("SELECT COUNT(*) AS TOTAL FROM MS_USERS WHERE USERNAME='".$USERNAME."'");
		$row = $query->getRow();

		if($row->TOTAL == 0){
			$ErrorMessage = "Username tidak ditemukan!";
            $ErrorCode = "EC:002A";
            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
           	return $JSON;
		}

		$query2 = "UPDATE MS_USERS SET STATUS = '2', DELETED_DATE = '".$DELETED_DATE."', DELETED_BY = '".$DELETED_BY."'
			WHERE USERNAME = '".$USERNAME."'";
		$run =  $db->query($query2);
		if(!$run){
			$ErrorMessage = $db->error();
            $ErrorCode = "EC:002B";
            $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
           	return $JSON;
			
		}

		$ErrorMessage = "Data berhasil dihapus";
        $ErrorCode = "EC:0000";
        $JSON = array("ErrorCode" => $ErrorCode, "ErrorMessage" => $ErrorMessage);
       	return $JSON;
	}
}