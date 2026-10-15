<?php

include_once '../db.php';


$show_driver = mysql_query("SELECT * FROM request_item_list ORDER BY request_id DESC") or die(mysql_error());
// get data and store in a json array
$u = 1;
while ($showing = mysql_fetch_array($show_driver)) {
    $request_idd = $showing['request_id'];
    $delivery_no = $showing['delivery_no'];
    $delivery_dt = $showing['delivery_date'];
    $delivery_st = $showing['delivery'];
    $itemname = $showing['item'];
    $list_id = $showing['list_id'];
    $specification = $showing['specification'];
    $quantity = $showing['quantity'];
    $unit = $showing['unit'];
    $query = "SELECT * FROM tbl_request_spare WHERE request_id='$request_idd'";
    $resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
    $rrow = mysql_fetch_array($resultT);
    $request_id = $rrow['request_id'];
    $request_date = $rrow['request_date'];
    $request_person = $rrow['requester'];
    $store_status = $rrow['store_status'];
    $hod_status = $rrow['hod_status'];
    $ttnumber = $rrow['ttnumber'];
    $client_status = $rrow['client_status'];
    $remarks = $rrow['remarks'];
    $store_date = $rrow['store_date'];
    $ref = 'SSWMR' . sprintf("%04d", $request_id);
    $approve_date = $rrow['approve_date'];
//    ;

    $item = $showing['item'];



    
     if(empty($delivery_no)){
         $modal="procure";
     }
 else {
         
         $modal="noc";
     }
//     $se=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$request_person'") or die(mysql_error());
//                $de=  mysql_fetch_array($se);
//                 $phone= $de['phone'];
//                 $dq=  mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$superid'") or die(mysql_error());
//                $da=  mysql_fetch_array($dq);
//                 $phone2= $da['phone'];
////     $tech_name=$showing['tech_phone'];
//     
    $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$request_person'") or die(mysql_error());
    $rows = mysql_fetch_array($tbl_customer);
    $first_name = $rows['first_name'];
    $surname = $rows['surname'];
    $jina = $first_name . " " . $surname;
//                ////////////////////////////////////////////////
//                $tbl_customerr = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$tech_id'") or die(mysql_error());
//                $rowss = mysql_fetch_array($tbl_customerr);
//                $first_namea = $rowss['first_name'];
//                $surnamea = $rowss['surname'];
//                $tech_name=$first_namea." ".$surnamea;
//                
//                $tbl_uo = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$noc_id'") or die(mysql_error());
//                $re = mysql_fetch_array($tbl_uo);
//                $f1 = $re['first_name'];
//                $s1 = $re['surname'];
//                $noc_operator=$f1." ".$s1;


    $stock[] = array(
        'link' => '<a href="#" class="view-rca" style="" '
        . 'data-a="' . $list_id . '" '
        . 'data-b="' . $itemname . '" '
        . 'data-c="' . $delivery_no . '" '
        . 'data-d="' . $delivery_dt . '" '
        . 'data-e="' . $delivery_st . '" '
        . 'data-toggle="modal" data-target="#'.$modal.'">Update</a>',
        'request_date' => $request_date,
        'requester' => $jina,
        'item' => $item,
        'store_status' => $store_status,
        'hod_status' => $hod_status,
        'ttnumber' => $ttnumber,
        'client_status' => $client_status,
        'remarks' => $remarks,
        'store_date' => $store_date,
        'client_status' => $client_status,
        'ref' => $ref,
        'approve_date' => $approve_date,
        'delivery_no' => $delivery_no,
        'delivery_dt' => $delivery_dt,
        'delivery_st' => $delivery_st,
        'specification' => $specification,
        'quantity' => $quantity,
        'unit' => $unit,
    );
}
echo json_encode($stock);
?>
