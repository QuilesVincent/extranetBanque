<?php


class DatabaseFunction
{
    public static function writteAlert($obj, $balise)
    {
        return "<$balise class='msgAdvertissement'>".$obj."</$balise>";
    }
}