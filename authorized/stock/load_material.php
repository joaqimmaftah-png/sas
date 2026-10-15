<?php

include_once '../db.php';

$fromm=$_GET['from'];
$too=$_GET['to'];
$from=date("Ymd", strtotime($fromm));
$to=date("Ymd", strtotime($too)); 


if($fromm==''){
    $query = mysql_query("SELECT * FROM tbl_spare_parts") or mysql_error();
}

else{
   $query = mysql_query("SELECT * FROM tbl_spare_parts WHERE report_date BETWEEN '$from' AND '$to'") or mysql_error(); 
}


//$resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array

$h=1;
while ($rrow = mysql_fetch_array($query)) {
    $part_id=$rrow['part_id'];
    $part_number=$rrow['part_number'];
    $part_common_name=$rrow['part_common_name'];
    $description=$rrow['description'];
    $model=$rrow['model'];
    $spe=$rrow['specification'];
    $manufacturer=$rrow['manufacturer'];
    $min_quanty=$rrow['min_quanty'];
    $quantity=$rrow['quantity'];
    $entry_date=$rrow['entry_date'];
//     echo $spe;
    if ($min_quanty>=$quantity) {
        
        $status='out of stock';
        
    }
 else {
      $status='Available';  
    }
     
    $stock[] = array( 
        'Action'=>'<a href="#" class="edit_request" data-toggle="modal" data-target="#myModal"'
        . ' data-id="'.$part_id.'" '
        . 'data-a="'.$part_common_name.'"'
         . 'data-b="'.$part_number.'"'
        . 'data-c="'.$description.'"'
        . 'data-d="'.$model.'"'
        . 'data-e="'.$spe.'"'
        . 'data-f="'.$manufacturer.'"'
        . 'data-g="'.$quantity.'"'
        . '>View</a>',
        'No'=>sprintf('%04d',$h++),      
        'part_common_name'=>$part_common_name,
        'part_number'=>$part_number,
        'description'=>$description,
        'model'=>$model,
        'specification'=>$spe, 
        'manufacturer'=>$manufacturer,
        'quantity'=>$quantity,
        'min_quanty'=>$min_quanty,
        'entry_date'=>date('Y-m-d',strtotime($entry_date)),
        'status'=>$status
//     
    );
}
echo json_encode($stock);
?>
