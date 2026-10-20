<?php
require_once __DIR__ . '/../../mysql_compat.php';

$date1=date('Ym01');
$date1=date('Ym');
include_once '../db.php';

$fromm=$_GET['from'];
$too=$_GET['to'];
$from=date("Ymd", strtotime($fromm));
$to=date("Ymd", strtotime($too));


if($fromm==''){
    $cashlist = mysql_query("SELECT * FROM cash_request WHERE requestdatereport BETWEEN 20181201 AND 20191231 ORDER BY cash_id DESC" ) or die(mysql_error());
}

else{
   $cashlist = mysql_query("SELECT * FROM cash_request WHERE requestdatereport BETWEEN '$from' AND $to ORDER BY cash_id DESC" ) or die(mysql_error()); 
}


//$cashlist = mysql_query("SELECT * FROM cash_request WHERE requestdatereport BETWEEN '$fromm' AND $too ORDER BY cash_id DESC" ) or die(mysql_error());
while ($roww = mysql_fetch_array($cashlist)) {
    $cash_id = $roww['cash_id'];
    $cash_idd = $cash_id + 1;
    $reportdate=$roww['requestdatereport'];
    $request_by = $roww['request_by'];
    
    $siteid = $roww['sitename'];
    $vehid = $roww['vehiclenumber'];
    
    $trccb = mysql_query("SELECT * FROM tbl_class_a_site WHERE s_id='$siteid'") or die(mysql_error());
    $rsb = mysql_fetch_array($trccb);
    $sitename=$rsb['sitename'];
    
    $trcca = mysql_query("SELECT * FROM tbl_car_monitoring WHERE car_id='$vehid'") or die(mysql_error());
    $rsa = mysql_fetch_array($trcca);
    $vhclereg=$rsa['vehicle_reg_num'];
    
    
    $identificationnumber = 'SSWRQ' . sprintf("%04d", $cash_id);
    $trcc = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_idd' ORDER BY reference LIMIT 1") or die(mysql_error());
    $rs = mysql_fetch_array($trcc);

    $detail = $rs['detail'];

    $tss = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$request_by'") or die(mysql_error());
    $jstt = mysql_fetch_array($tss);
    $jinalako = $jstt['first_name'] . ' ' . $jstt['surname'];

    $att = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_idd'") or die(mysql_error());
    $show_item = mysql_fetch_array($att);
    $sumitem = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$cash_idd'") or die(mysql_error());
    $totals = mysql_fetch_array($sumitem);
    $jumla = $totals['SUM(total)'];
      $attc = mysql_query("SELECT * FROM tbl_quotationitem WHERE Item_id='$quotati_item'") or die(mysql_error());
    $show_itemc= mysql_fetch_array($attc);
    $Description=$show_itemc['Description'];

    $cash_idz = $cash_id + 1;
    $atta = mysql_query("SELECT * FROM cash_request_item WHERE reference='$cash_idd'") or die(mysql_error());
    while ($rzz = mysql_fetch_array($atta)) {
        $referencez = $rzz['reference'];
        $sm = mysql_query("SELECT SUM(total) FROM cash_request_item where reference='$referencez'") or die(mysql_error());
        $tf = mysql_fetch_array($sm);
        $tatals = $tf['SUM(total)'];
        $details = $rzz['detail'];
        $totald = $rzz['total'];
//        $jibuu+=$tatals;
$new_date = date('Y-m-d', strtotime($reportdate));


        $data[] = array(
            'Request_ID' => $identificationnumber,
            'Requested_by' => $jinalako,
            'Request' => $details,
            'Request_Date' => $new_date,
            'Invoice_Number' => $roww['invoice_number'],
            'Company_Name' => $roww['company_name'],
            'Project_Name' => $roww['pname'],
            'Quoatation_item'=>$Description,
            'vehicle' => $vhclereg,
            'sitename' => $sitename,
            'Manager_Status' => $roww['approved_by_status'],
            'Account_Status' => $roww['received_by_status'],
            'Total' => $totald
        );
    }
}
    echo json_encode($data);
?>
