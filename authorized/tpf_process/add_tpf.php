<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once '../db.php';
$tpf_code=$_POST['tpf_code'];
$tpf_date=$_POST['tpf_date'];
$tpf_name=$_POST['tpf_name'];
$sourcePath = $_FILES['file']['tmp_name'];
$targetPath = "tpf_folder/".$_FILES['file']['name'];
$name=$_FILES['file']['name'];
$paths="authorized/tpf_process/tpf_folder/".$_FILES['file']['name'];
$Quotation_No="Empty";
$Quotation_Date="NULL";
$TPF_QT_Durations="00";
$Work_Order="NULL";
$workorder_date="NULL";
$wo_qt_duration="00";
$status="OPEN";
$qtn_amount="NULL";
$no_of_tpf=$_POST['no_of_tpf'];
$region_id=$_POST['region_id'];

if(move_uploaded_file($sourcePath,$targetPath)) {
$hifadhitpf=  mysql_query("INSERT INTO tbl_tpf_qt(`tpf_no`,`tpf_date`,`tpf_name`, `tpf_attachment`, `Quotation_No`,`qtn_amount` ,`Quotation_Date`, `TPF_QT_Durations`, `Work_Order`, `workorder_date`,wp_tpf_duration, `status`,total_number_of_site,Region_id)"
        . "VALUE('$tpf_code','$tpf_date','$tpf_name','$paths','$Quotation_No','$qtn_amount','$Quotation_Date','$TPF_QT_Durations','$Work_Order','$workorder_date','$wo_qt_duration','$status','$no_of_tpf','$region_id')") or die(mysql_error());
  echo'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!..</strong>
</div>';

}
else{ 
    ?>
    <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Downloading...</h4>
</div>
<div class="modal-body">
<div style="height:30px"><div id="progress" class="progress">
<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
</div></div>
</div>
<?php
}
?>


