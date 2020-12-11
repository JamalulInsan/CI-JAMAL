<?php
class plugin{
    protected $plugin;
    protected $tag;
    private function css(){
        $css['Bootstrap 3.3.7'] = 'assets/bower_components/bootstrap/dist/css/bootstrap.min.css';
        $css['Font Awesome']    = 'assets/bower_components/font-awesome/css/font-awesome.min.css';
        $css['iconic']          = 'assets/bower_components/Ionicons/css/ionicons.min.css';
        $css['adminLte']        = 'assets/dist/css/AdminLTE.min.css';
        $css['iCheck']         = 'assets/plugins/iCheck/square/blue.css';
        return $css;
    }
    private function javascript(){
        $javascript['jquery 3']         = 'assets/bower_components/jquery/dist/jquery.min.js';
        $javascript['Bootstrap v3.3.7'] = 'assets/bower_components/bootstrap/dist/js/bootstrap.min.js';
        $javascript['iCheck']           = 'assets/plugins/iCheck/icheck.min.js';
        
        return $javascript;
    }

    public function vendor(string $need,array $vendor){
        try {            
        if($need=='css') :
            $listPlugin = $this->css();    
        elseif($need=='js'):
            $listPlugin = $this->javascript();
        else:
            throw new Exception("Your Need String Not Found On List css and js");
        endif;
        $this->plugin=$this->array_plugin($vendor,$listPlugin);
        $this->tag=$need;
        return $this;
        } catch (Exception $th) {
            throw $th;
        }
    }

    private function array_plugin(array $need,$plugin){
        try {
        $result=[];
        $arrayKey =array_keys($plugin);
        foreach($need as $key=>$row):
            if(array_key_exists($row,$plugin)==false): throw new Exception("Your Key Need Not ".$row."Found [".implode(',',$arrayKey)."]"); break;endif;
            $result[$key]['modul']=$plugin[$row];
            $result[$key]['comment']=$row;
        endforeach;
        return $result;
        } catch (Exception $th) {
            throw $th;
        }
    }

    public function html(){
        $tag= $this->tag;
        $html='';
        // var_dump($this->plugin);
        foreach($this->plugin as $row):
            $html .='<!-- Modul '.$row['comment'].' -->';
            $html .="\n";
            if($tag==='css') $html .= '<link rel="stylesheet" href="'.base_url($row['modul']).'">';
            if($tag==='js') $html .= '<script  src="'.base_url($row['modul']).'" ></script>';
            $html .="\n";
            $html .='<!-- End Modul '.$row['comment'].' -->';
            $html .="\n";
            
        endforeach;
        echo $html;
    }

    public function result(){
        return $this->plugin;
    }



}



?>