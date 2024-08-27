<?php

if (!function_exists('dataMY')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function dataMY($umadata){/// converter data para padrão do banco

        if($umadata == '' || $umadata == null)
            return null;

        $explode = explode(" ", $umadata);

        $mydata = substr($explode[0],6,4)."-".substr($explode[0],3,2)."-".substr($explode[0],0,2).' '.$explode[1];
        return $mydata;
    }
}
if (!function_exists('ConverteData')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function ConverteData($data){
        if(!is_null($data))
            return  date("d/m/Y H:i:s", strtotime($data));//exibe no formato d/m/a
        else
            return "";
    }
}

if (!function_exists('ConverteData2')) {

    function ConverteData2($data){
        return  date("d-m-Y H:i:s", strtotime($data));//exibe no formato d/m/a
    }
}

if (!function_exists('dateToISO')) {

    function dateToISO($data){
        return  date("Y-m-d H:i:s", strtotime($data));//exibe no formato d/m/a
    }
}

