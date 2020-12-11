<?php

Class Modul {
    protected $CI;
    public function __construct() { 
        $this->CI =& get_instance();
    }
    function uploadexcel($path){
        // $config['encrypt_name']=TRUE;
        $config['overwrite'] = TRUE;
        $config['upload_path'] = $path;
        $config['file_name']    ='dataset';
        $config['allowed_types'] = 'xlsx';
        
        $this->CI->load->library('upload', $config);
        if ( ! $this->CI->upload->do_upload('file')){
            $data = array('error' => $this->CI->upload->display_errors());
        }
        else{
            $data = $this->CI->upload->data('file_name');
        }
        return $data;
        
    }
    function removeJSON($file){
        
    }
    function alert($pesan=null,$parameter='berhasil',$redirect=null){
       
        $redirect =($redirect) ?? $_SERVER['HTTP_REFERER'];
        switch ($parameter) {
                case 'berhasil':
                    $icon	='success';
                    $title  ='Sukses';
                break;
                case 'gagal':
                    $icon	='error';
                    $title  ='Gagal';
                break;
                case 'peringatan':
                    $icon	='warning';
                    $title  ='peringatan';
                break;
                case 'info':
                    $icon	='info';
                    $title  ='info';
                break;
                default:
                    return false;
                    break;
            
            }
            if($pesan=='f_error'):
                $this->CI->session->set_flashdata('f_error',$this->CI->form_validation->error_array());
            endif;
            if($pesan!='f_error'):

                $alert="swal({
                    'title':'".$title."',
                    'text':'".$pesan."',
                    'icon':'".$icon."'
                })";
                $this->CI->session->set_flashdata('pesan',$alert);
            endif;
            redirect($redirect);
       }
       function navMenu(){
                $nav=[
                        ['group'=>'Master','list'=>[
                            ['link'=>'Dashboard/home','icon'=>'fa fa-home','title'=>'Home','uri'=>'home'],
                            ['link'=>'Dashboard/data-set','icon'=>'fa fa-archive','title'=>'Data Balita','uri'=>'data-set'],
                            ['link'=>'Dashboard/cluster','icon'=>'fa fa-bar-chart','title'=>'Cluster','uri'=>'cluster'],
                            ['link'=>'Dashboard/seleksi','icon'=>'fa fa-area-chart','title'=>'Kalsifikasi','uri'=>'seleksi'],
                            ['link'=>'Dashboard/user','icon'=>'fa fa-user','title'=>'Data User','uri'=>'user'],                     
                            ['link'=>'Dashboard/setting','icon'=>'fa fa-gears','title'=>'Setting','uri'=>'setting']                     
                             ]
                        ]
                ];
            
           return $nav;
       }
       public function emptySession(){
        $session= $this->CI->session->userdata('id_user');
        if(empty($session)) $this->alert('Anda Belum melakukan login','gagal',base_url('login')); 
       }
       function getId(){
           $stamp = date("Ymdhis");
           return "TX-".$stamp.rand(100,999);
       }
}

?>