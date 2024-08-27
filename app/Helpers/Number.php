<?php

if (!function_exists('floatvalue')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function floatvalue($val){
        $val = str_replace(",",".",$val);
        $val = preg_replace('/\.(?=.*\.)/', '', $val);
        return floatval($val);
    }
}
