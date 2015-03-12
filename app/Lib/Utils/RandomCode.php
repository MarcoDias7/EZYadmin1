<?php
/**
 * Created by PhpStorm.
 * User: Anthony
 * Date: 29.11.2014
 * Time: 16:14
 */

class RandomCode {

    public static function generateRandomCode($sizeOfCode = 12){

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $randomCode = substr( str_shuffle( $chars ), 0, $sizeOfCode );

        return $randomCode;

    }

} 