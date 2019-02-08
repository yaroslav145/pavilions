<?php
    class XSSWork
    {
        public static function noXSS($s)
        {
            $s = strip_tags($s);
            $s = htmlentities($s, ENT_QUOTES, "UTF-8");
            $s = htmlspecialchars($s, ENT_QUOTES);
            return $s;
        }
    }