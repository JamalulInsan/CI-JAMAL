<?php if (!defined("BASEPATH")) exit("No direct script access allowed");
    use Jenssegers\Blade\Blade;

    if(!function_exists('view')){
        function view($view,$data=[]){
            $path   = APPPATH.'views';
            $blade  = new Blade($path,APPPATH.'/cache/view');
            echo $blade->make($view,$data);
        }
    }
    

?>
