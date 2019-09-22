<?php

class Helper
{
    static public function GetIp()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];

        return $ipaddress;
    }

    static public function TimeText($seconds)
    {
        $timeName = "";
        if ($seconds < 1)
            $timeName = _(" DABAR");
        elseif ($seconds == 1)
            // <1 second
            $timeName = $timeName . _(" sekundę");
        elseif ($seconds < 60)
            // <1 minute
            $timeName = $seconds . _(" sekundžių");
        elseif ($seconds < 120)
            // 1 minute
            $timeName = _(" minutę");

        elseif ($seconds < 60 * 60)
            // <1 hour
            $timeName = floor($seconds / 60) . _(" minučių");
        elseif ($seconds < 60 * 60 * 2)
            // <2 hour
            $timeName = _("1 valandą");
        elseif ($seconds < 60 * 60 * 24 * 2)
            // <24 hours = 1 day
            $timeName = floor($seconds / (60 * 60)) . _(" valandas");
        elseif ($seconds < (60 * 60 * 24 * 7))
            // <7 days = 1 week
            $timeName = floor($seconds / (60 * 60 * 24)) . _(" dienas");
        else
            // <30.5 days ~  1 month
            $timeName = floor($seconds / (60 * 60 * 24 * 7)) . _(" savaites");

        return $timeName;
    }
}