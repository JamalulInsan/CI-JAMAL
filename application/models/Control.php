<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Model {

 function rules($rules=null){
     switch($rules):
        case 'pengantar':
          $config = [
            ['field' => 'nama', 'label' => 'Nama Pengantar', 'rules' => 'required'],
            ['field' => 'ket', 'label' => 'Keterangan', 'rules' => 'required'],
        ];
        break;
     endswitch;

     return $config;
 }



 function crud($aksi,$table=null,$data=null,$where=null,$in=null){
    if($where){
      if(is_string($where)){
        $this->db->where_in($where,$in); 
      }else{
        $this->db->where($where); 
      }
    }
    
    switch ($aksi) {
      case 'add':
        if(empty($data)){return false;}
        $this->db->insert($table, $data);
        $id_terakhir_masuk=$this->db->insert_id();
        return $id_terakhir_masuk;
      break;
      case 'delete':
        $this->db->delete($table);   
        return true; 
      break;
      case 'edit':
        if(empty($data)){return false;}
        $this->db->update($table,$data);
        return true;
      break;
      case 'add-multi':
        if(empty($data)){return false;}
        $this->db->insert_batch($table,$data);
        return true;
      break;
      
      default:
       return false;
      break;
   }
   $db_error = $this->db->error();
    if(!empty($db_error)){
      return false;
    }
  }



}

/* End of file Control.php */


?>