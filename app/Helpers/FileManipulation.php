<?php

if (!function_exists('get_file_name')) {

    function get_file_name($file)
    {
        return pathinfo($file, PATHINFO_FILENAME);
    }
}

if (!function_exists('get_file_ext')) {

    function get_file_ext($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION);
    }
}
