<?php 

class Kmeanshtml 
{
    public $class='table display';
    public $label;
    public $data;
    private $tmpCentroidCenter;
    private $tmp;
    private $dataResult;
    function dataSet(array $array,$variabel){
        $label=$this->label;
        $html ='';
        $html .='<div class="table-responsive">';
        $html .='<table class="'.$this->class.'" >';
        $html .='<thead>';
        $html .='<tr>';
        for($i=0;$i<count($label);$i++){
            $html .='<th>'.$label[$i].'</th>';
        }
        $html .='</tr>';
        $html .='</thead><tbody>';
        $no=1; 
        for ($j=0; $j<count($array) ; $j++) {
            $html .='<tr>';
            $html .='<td>'.$label[0].$no++.'</td>';
            for($i=0;$i<$variabel;$i++){
                $html .='<td>'.$array[$j][$i].'</td>';
            }
            $html .='</tr>';
        }
        $html .='</tbody></table>';
        $html .='</div>';
        return $html;
    }

    function initCluster($cluster){
        $nfields =$cluster->num_fields();
        $field   =$cluster->list_fields();
        $label   =$this->label;
        $html    ='';
        $html .='<div class="table-responsive">';
        $html .='<table class="'.$this->class.'" >';
        $html .='<thead>';
        $html .='<tr>';
        // echo $nfields;
        for($i=0;$i<$nfields;$i++){
            // echo $i;
            $html .='<th>'.$label[$i].'</th>';
        }
        $html .='</tr>';
        $html .='</thead><tbody>';
        $no =1;
        $tmp=[];
        foreach ($cluster->result_array() as $key => $row) {
            $html .='<tr>';
            $tmp['C'.$no]=$row[$field[1]];
            $html .='<td>C'.$no++.'</td>';
            for($i=1;$i<$nfields;$i++){
                $html .='<td>'.$row[$field[$i]].'</td>';
            }
            $html .='</tr>';
        }
        $html .='</tbody></table>';
        $html .='</div>';
        $this->tmpCentroidCenter=$tmp;
        return $html;
        
    }
    function hitung($distance,$group,$iterasi){
        $normalisasi =$this->data;
        $html ='';
        // $html .='<i><h4>Pengulangan Ke-'.$iterasi.' :</h4></i>';
        $label   =$this->label;
        $html .='<div class="table-responsive">';
        $html .='<table class="'.$this->class.'" >';
        $html .='<thead>';
        $html .='<tr>';
        $html .='<th colspan="'.count($label).'" class="text-center"> Iterasi ke-'.$iterasi.'</th>';
        $html .='</tr>';
        $html .='<tr>';
        // echo $nfields;
        for($i=0;$i<count($label);$i++){
            // echo $i;
            $html .='<th>'.$label[$i].'</th>';
        }
        $html .='</tr>';
        $html .='</thead><tbody>';
        $no    =1;
        for ($j=0; $j<count($normalisasi) ; $j++) {
            $html .='<tr>';
            $html .='<td>'.$label[0].$no++.'</td>';
            for($i=0;$i<count($normalisasi[$j]);$i++){
                $html .='<td>'.$normalisasi[$j][$i].'</td>';
            }
            for($i=0;$i<count($distance[$j]);$i++){
                $html .='<td>'.$distance[$j][$i].'</td>';
            }
                $html .='<td>'.$group[$j]['value'].'</td>';
                $html .='<td>'.$group[$j]['position'].'</td>';
            $html .='</tr>';
        }
        $html .='</tbody></table>';
        $html .='</div>';
        
        echo $html;
    }
    function diffCentroid($centroidOld,$centroidNew){
        $html ='';
        $html .='<i><h4>Perbandingan Centroid :</h4></i>';
        $html .='<div class="table-responsive">';
        $html .='<table class="table">';
        $html .= '<thead>';
        $html .='<tr>';
        $html .='<th rowspan="2">Cluster</th>';
        $html .='<th colspan="'.count($centroidOld[0]).'">Centroid Lama</th>';
        $html .='<th colspan="'.count($centroidNew[0]).'">Centroid Baru</th>';
        $html .='</tr>';
        $html .='<tr>';
        for($j=1;$j<=count($centroidOld[0]);$j++){
            $html .='<th>A'.$j.'</th>';
        }
        for($j=1;$j<=count($centroidNew[0]);$j++){
            $html .='<th>A'.$j.'</th>';
        }
        $html .='</tr>';
        $html .= '</thead><tbody>';
        $no=1;
        for($i=0;$i<count($centroidOld);$i++){
            $html .='<tr>';
            $html .='<td>C'.$no++.'</td>';
            for($j=0;$j<count($centroidOld[$i]);$j++){
                // echo $centroidOld[$i][$j];
                $html .='<td >'.$centroidOld[$i][$j].'</td>';
            }
            for($j=0;$j<count($centroidNew[$i]);$j++){
                $html .='<td >'.$centroidNew[$i][$j].'</td>';

            }
            $html .='<tr>';
        }
        $html .='</tbody></table>';
        $html .='</div>';
        echo $html;
        // var_dump($centroidOld);
        // var_dump($centroidNew);
    }
    function resultHtml($result,$balita=null){
        $html ='';
        $label=$this->label;
        $html .='<div class="table-responsive">';
        $html .='<table  class="table display">';
        $html .='<thead>';
        $html .='<tr>';
        // echo $nfields;
        for($i=0;$i<count($label);$i++){
            // echo $i;
            $html .='<th>'.$label[$i].'</th>';
        }
        $html .='</tr>';
        $html .='</thead><tbody>';
        $no=1;
        $tmp=[];
        for ($j=0; $j<count($result) ; $j++) {
            $html .='<tr>';
            $html .='<td>'.$label[0].$no++.'</td>';
        for ($i=0; $i<3 ; $i++) {
            $html .='<td>'.$balita[$j][$i].'</td>';
        }
            array_push($tmp,$result[$j]['position']);
            $html .='<td>'.$result[$j]['position'].'</td>';
            $html .='<td>'.$this->getStatus($result[$j]['position']).'</td>';
            $html .='</tr>';
        }
        $html .='</tbody></table>';
        $html .='</div>';

        $this->tmp=array_count_values($tmp);    
        echo $html;  
    }
    function getStatus($index){
        return $this->tmpCentroidCenter[$index]; 
    }
    function rangkuman(){
        $nData=count($this->data);
        $html ='';
        $data =$this->tmp;
        $html .='<div class="table-responsive">';
        $html .='<table class="table">';
        $html .='<thead>';
        $html .='<tr>';
        $html .='<th></th>';
        $result=[];
        $labelData=[];
        // $index=0;
        for($i=1;$i<=count($data);$i++){
            // echo $i;
            $labelData[$i]=$this->getStatus('C'.$i);
            $html .='<th>'.$this->getStatus('C'.$i).'</th>';
        }
        $html .='</tr>';
        $html .='</thead><tbody>';
        $html .='<tr>';
        $html .='<td>Jumlah :'.$nData.'</td>';
        for($i=1;$i<=count($data);$i++){
            $result['jumlah'][$labelData[$i]]=$data['C'.$i];
            $html .='<td>'.$data['C'.$i].'</td>';
        }
        $html .='</tr>';
        $html .='<td>Persen :100%</td>';
        for($i=1;$i<=count($data);$i++){
            $persen=round(($data['C'.$i]/$nData)*100);
            $result['persen'][$labelData[$i]]=$persen;
            $html .='<td>'.$persen.' %</td>';
        }
        $html .='</tr>';
        $html .='</tbody></table>';
        $html .='</div>';
        echo $html;
        return $result;
    }
    
}


?>