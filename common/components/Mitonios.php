<?php
/**
 * Created by PhpStorm.
 * User: Mitonios-Tofu
 * Date: 1/26/2016
 * Time: 11:55 AM
 */

namespace common\components;


class Mitonios
{
    public static function gioi_han_so_tu($string, $so_luong = 50)
    {
        $tempArr = explode(' ', $string);
        $string = array();
        for ($i = 0; $i <= $so_luong; $i++) {
            if (isset($tempArr[$i])) {
                $string[] = $tempArr[$i];
            }
        }
        return join(' ', $string);
    }
}