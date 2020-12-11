<?php if (!defined("BASEPATH")) exit("No direct script access allowed");


function form_e($str=null)
{ 
    $CI    = & get_instance();
    $array = $CI->session->flashdata('f_error');//array  
    if($array){    
        if(array_key_exists($str,$array)){
            return $array[$str];
        }else{
            return false;
        }
    }
}
function form_debug(){
    $CI    = & get_instance();
    $array = $CI->session->flashdata('f_error');//
    var_dump($array);
}
function getsession($str=null){
        $CI    = & get_instance();
        return $CI->session->userdata($str);
}


?>