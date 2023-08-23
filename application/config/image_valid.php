<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$config['adm_digit_length'] = 6;

$config['image_validate'] = array(
    'allowed_mime_type' => array('image/jpeg', 'image/jpg', 'image/png', 'image/webp'), //mime_type
    'allowed_extension' => array('jpg', 'jpeg', 'png', 'webp'), // image extensions
    'upload_size'       => 1048576000, // bytes
);

$config['file_validate'] = array(
    'allowed_mime_type' => array('image/jpeg', 'image/jpg', 'image/png', 'image/webp' ,'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'), //mime_type
    'allowed_extension' => array('jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'webp'), // image extensions
    'upload_size'       => 1048576000, // bytes
);

$config['filecsv_validate'] = array(
    'allowed_mime_type' => array('text/csv', 'application/vnd.ms-excel', 'application/octet-stream'), //mime_type
    'allowed_extension' => array('csv', 'xls'), // image extensions
    'upload_size'       => 1048576000, // bytes
);
