<?php
require_once __DIR__ . '/../../mysql_compat.php';


include_once '../db.php';
$tpf_code=$_POST['tpf_code'];
$qt_code=$_POST['qt_code'];
$Work_Order=$_POST['workorder'];
$workorder_date=$_POST['workorder_date'];
$siteid=$_POST['siteid'];
$status="ON PROGRESS";

$bb = mysql_query("SELECT * FROM tbl_tpf_qt where tpf_no='$tpf_code'")or die(mysql_error());
$ccm = mysql_fetch_array($bb);
$Qtn_date = $ccm['Quotation_Date'];

$str = $Qtn_date;
$Wdate=date("M d Y ");
$str = strtotime(date("M d Y ")) - (strtotime($str));
$wo_QT_Durations= floor($str/3600/24);

//$hifadhiqtn = mysql_query("UPDATE tbl_tpf_qt SET Work_Order='$Work_Order',workorder_date='$workorder_date',wp_tpf_duration='$wo_QT_Durations',status='$status'  WHERE Quotation_No='$qt_code' AND tpf_no='$tpf_code'") or die(mysql_error());   
    
    
    
    $approve_workorder= mysql_query("INSERT INTO tbl_approved_work_order(`work_order_number`,`quotation_number`,`site_id`,`tpf_number`,`workorder_date`,`wp_qtn_duration`)"
            . "VALUES ('$Work_Order','$qt_code','$siteid','$tpf_code','$Wdate','$wo_QT_Durations')") OR die(mysql_error());
    echo'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!..</strong>
</div>';
    

?>

