<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('date_function')) {
    function date_function()
    {
        date_default_timezone_set("Asia/Kolkata");
        $time =  Date('Y-m-d h:i:s');
    }
}