<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once '../db.php';
$date=$_POST['date'];
$client=$_POST['client'];
$sitename=$_POST['sitename'];
$site_id=$_POST['site_id'];
$spare=$_POST['spare'];
$specification=$_POST['specification'];
$uom=$_POST['uom'];
$qty=$_POST['qty'];
$unit_price_vat=$_POST['unit_price_vat'];
$total_price=$unit_price_vat*$qty;
$rq=$_POST['rq'];
$qt=$_POST['qt'];
$tpf=$_POST['tpf'];
$acc=$_POST['acc'];
$po=$_POST['po'];
$invoice=$_POST['invoice'];
$pyt_status=$_POST['pyt_status'];
$select=  mysql_query("SELECT * FROM tbl_accounts_sheets ORDER BY sheet_id DESC") or die(mysql_error());
$chagua=mysql_fetch_array($select);
$sn=$chagua['sn']+1;
$reconsile_batch=$_POST['reconsile_batch'];
$sheet=  mysql_query("INSERT INTO `tbl_accounts_sheets`( `sn`, `date`, `clients`, `site_name`, `site_id`, `spare_rwork`, `specification`, `uom`, `qty`,"
        . " `unit_price_vat_ex`, `total_price_vat_ex`, `rq_no`, `qt_no`, `tpf_no`, `acc_no`, `po_no`, `invoice_no`, `pyt_status`, `recon_batch`) "
        . "VALUES ('$sn','$date','$client','$sitename','$site_id','$spare','$specification','$uom','$qty','$unit_price_vat',"
        . "'$total_price','$rq','$qt','$tpf','$acc','$po','$invoice','$pyt_status','$reconsile_batch')")
        or die(mysql_error());
        if($sheet){
            echo '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successfull!</strong>
</div>';
        }
?>