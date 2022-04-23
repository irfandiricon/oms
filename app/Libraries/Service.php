<?php 
namespace App\Libraries;

class Service{

    public function api($UrlRequest)
    {
        $json = file_get_contents($UrlRequest);
        $array = array(json_decode(strip_tags($json)));
        $DataRequest = isset($array[0]->data) ? $array[0]->data:array();
        return $DataRequest;
    }

	public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateReffId()
    {
    	$ReffId = substr(number_format(time() * rand(),0,'',''),0,12);
    	return $ReffId;
    }

    public function generateTicet()
    {
        $TicketId = substr(number_format(time() * rand(),0,'',''),0,10);
        return $TicketId;
    }

    public function generateReferral()
    {
        $ReffId = substr(number_format(time() * rand(),0,'',''),0,6);
        return $ReffId;
    }

    public function slugify($text)
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }

    public function month()
    {
        $Month[] = array("id"=>"1", "desc"=>"Januari");
        $Month[] = array("id"=>"2", "desc"=>"Februari");
        $Month[] = array("id"=>"3", "desc"=>"Maret");
        $Month[] = array("id"=>"4", "desc"=>"April");
        $Month[] = array("id"=>"5", "desc"=>"Mei");
        $Month[] = array("id"=>"6", "desc"=>"Juni");
        $Month[] = array("id"=>"7", "desc"=>"Juli");
        $Month[] = array("id"=>"8", "desc"=>"Agustus");
        $Month[] = array("id"=>"9", "desc"=>"September");
        $Month[] = array("id"=>"10", "desc"=>"Oktober");
        $Month[] = array("id"=>"11", "desc"=>"November");
        $Month[] = array("id"=>"12", "desc"=>"Desember");

        return $Month;
    }
}