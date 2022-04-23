<?php namespace Config;

class CustomConfig extends \CodeIgniter\Config\BaseConfig
{
    Public $apps  = 'OMS';

    Public $Development = true ;
    Public $UrlPrepaidDev = "https://testprepaid.mobilepulsa.net/v1/legacy/index";
    Public $UrlPrepaidPro = "https://api.mobilepulsa.net/v1/legacy/index";

    Public $UrlB2C = "http://localhost:8080/ircn-oms/api/";
}