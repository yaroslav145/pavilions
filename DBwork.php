<?php

class DBwork
{
    public static $ip;
    public static $login;
    public static $pass;

    public function setIpLoginPass($ip, $login, $pass)
    {
        self::$ip = $ip;
        self::$login = $login;
        self::$pass = $pass;
    }
}

?>