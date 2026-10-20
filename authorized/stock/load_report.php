<?php
require_once __DIR__ . '/../../mysql_compat.php';


include_once '../db.php';
$query = mysql_query("SELECT * FROM tbl_spare_parts") or mysql_error();

$h=1;
while ($rrow = mysql_fetch_array($query)) {
    $part_id=$rrow['part_id'];
    $part_number=$rrow['part_number'];
    $part_common_name=$rrow['part_common_name'];
    $model=$rrow['model'];
    $spe=$rrow['specification'];
     $quantity=$rrow['quantity'];
     
     $spar = mysql_query("SELECT SUM(quantity) FROM request_item_list WHERE ref_no='$part_id'") or mysql_error();
     $df = mysql_fetch_array($spar);
     $total= $df['SUM(quantity)'];
     
       $rd = mysql_query("SELECT * FROM request_item_list WHERE ref_no='$part_id'") or mysql_error();
     $rdd = mysql_fetch_array($rd);
     $request_id= $rdd['request_id'];
     
       $spar2 = mysql_query("SELECT * FROM tbl_request_spare WHERE store_status='Approved' and request_id='$request_id'") or mysql_error();
     $df2 = mysql_fetch_array($spar2);
     $request_id2= $df2['request_id'];
     
      $spar3 = mysql_query("SELECT SUM(quantity) FROM request_item_list WHERE request_id='$request_id2'") or mysql_error();
     $df3 = mysql_fetch_array($spar3);
     $total2= $df3['SUM(quantity)'];
 
    $stock[] = array( 
        'Action'=>'<a href="#" class="edit_request" data-toggle="modal" data-target="#myModal"'
        . ' data-id="'.$part_id.'" '
        . 'data-a="'.$part_common_name.'"'
         . 'data-b="'.$part_number.'"'
        . 'data-d="'.$model.'"'
        . 'data-e="'.$spe.'"'
        . 'data-g="'.$quantity.'"'
        
        . '>View</a>',
        'No'=>sprintf('%04d',$h++),      
        'part_common_name'=>$part_common_name,
        'part_number'=>$part_number,
        'model'=>$model,
        'specification'=>$spe, 
        'quantity'=>$quantity,
        'stockout'=>$total2,
        'spare_requested'=>$total,
        
//     
    );
}
echo json_encode($stock);
?>
