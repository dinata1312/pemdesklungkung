<?php
if (!function_exists('censor_string')) {
    function censor_string($target)
    {
        $count = strlen($target) - 7;
        $output = substr_replace($target, str_repeat('*', $count), 4, $count);
        return $output;
    }
}

if (!function_exists('no_space')) {
    function no_space($target)
    {
        $sign = [' ', '_', '#', '*'];
        return str_replace($sign, '-', $target);
    }
}

if (!function_exists('money')) {
    function money($number)
    {
        return number_format( (float) $number, 0, ',', '.');
    }
}

if (!function_exists('phone_make')) {
    function phone_make($phone){
        $replace = [' ', ',', '-', '.', '(', ')', '+'];
        $phone = str_replace($replace, '', $phone);

        if( !preg_match('/[^0-9]/', trim($phone)) ) {
            if(substr(trim ($phone), 0, 2) == '62') {
                if(substr(trim ($phone), 0, 3) == '620') {
                    $phone =  '62'.substr(trim($phone), 3);
                }
                $phone = trim($phone);
            }else if ( substr(trim ($phone), 0, 2) == '08') {
                $phone =  '62'.substr(trim($phone), 1);
            }else{
                $phone =  '628'.substr(trim($phone), 2);
            }
        }
        return $phone;
    }
}

if (!function_exists('phone_validate')) {
    function phone_validate($phone){
        if( !preg_match('/[^0-9]/', trim($phone)) ) {
            if(substr(trim ($phone), 0, 2) == '62') {
                $result = true;
            }else if ( substr(trim ($phone), 0, 2) == '08') {
                $result = false;
            }else{
                $result = false;
            }
        }else{
            $result = false;
        }
        if($result) {
            return $phone;
        }else{
            return phone_make($phone);
        }
    }
}

if (!function_exists('value_of_key')) {
    function value_of_key($arr, $key)
    {
        if( isset($arr[$key]) ){
            return $arr[$key];
        }else{
            return null;
        }
    }
}

if (!function_exists('word_to_ord')) {
    function word_to_ord ($str)
    {
        $word = str_split($str);
        $temp = 0;
        foreach($word as $c) {
            $temp += ord($c);
        }
        return $temp;
    }
}

if (!function_exists('id_enc')) {
    function id_enc ($id, $modifier=0)
    {
        $enc  = strrev(base64_encode($id*22+(1922+word_to_ord($modifier))));
        $sign = substr_count($enc,"=")*2+1;
        $enc  = str_replace('=', '', $enc).$sign;
        return $enc;
    }
}

if (!function_exists('id_dec')) {
    function id_dec ($enc, $modifier=0)
    {
        $sign = ((int) substr($enc, -1)-1)/2;
        $enc  = strrev(substr($enc, 0, -1));
        $enc .= str_repeat('=', $sign);
        $dec = (int) base64_decode($enc);
        if(is_int($dec)){
            $enc  = ($dec-(1922+word_to_ord($modifier)))/22;
            return $enc;
        }else {return False;}
    }
}
