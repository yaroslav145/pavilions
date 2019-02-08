<?php
    /**
     * Created by PhpStorm.
     * User: Пользователь
     * Date: 08.02.2019
     * Time: 11:50
     */

    class noXSS
    {
        public static function noXSS($s)
        {
            $s = strip_tags($s);
            $s = htmlentities($s, ENT_QUOTES, "UTF-8");
            $s = htmlspecialchars($s, ENT_QUOTES);
            return $s;
        }
    }