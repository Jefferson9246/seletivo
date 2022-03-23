<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function debugar($conteudo){
    echo '<pre>';
    var_dump($conteudo);
    exit;
}

function json_output($obj)
{
    $CI = &get_instance();
    $CI->output
        ->set_content_type('application/json')
        ->set_output(json_encode($obj));
}





?>