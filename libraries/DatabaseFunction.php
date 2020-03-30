<?php


class DatabaseFunction
{
    public static function writteAlert($obj, $balise)
    {
        return "<$balise class='msgAdvertissement'>".$obj."</$balise>";
    }
    public static function tronquer($content,$maxCarac)
    {
        $positionSpace = strpos($content, ' ',$maxCarac);
        $newContent = substr($content,0,$positionSpace);
        $newContent .= '...';
        return $newContent;
    }
}