<?php
include_once '../db.php';
$tpf_code = $_POST['tpf_code'];
$qtn_date = $_POST['tpf_date'];
$amount = $_POST['amount'];
$sourcePath = $_FILES['file']['tmp_name'];
$targetPath = "qtn_folder/" . $_FILES['file']['name'];
$name = $_FILES['file']['name'];
$paths = "authorized/tpf_process/qtn_folder/" . $_FILES['file']['name'];
$Quotation_No = $_POST['qn_code'];
$Quotation_Date = $_POST['tpf_date'];
$Work_Order = "NULL";
$workorder_date = "NULL";
$wo_qt_duration = "00";
$status = "OPEN";

$bb = mysql_query("SELECT * FROM tbl_tpf_qt where tpf_no='$tpf_code'")or die(mysql_error());
$ccm = mysql_fetch_array($bb);
$tpf_date = $ccm['tpf_date'];



$str = $tpf_date;
$str = strtotime(date("M d Y ")) - (strtotime($str));
$TPF_QT_Durations= floor($str/3600/24);

//$str1 = $qtn_date;
//$str2 = $tpf_date;
//$str = strtotime(date($str1)) - (strtotime($str2));
//$TPF_QT_Durations = floor($str / 3600 / 24);


if (move_uploaded_file($sourcePath, $targetPath)) {
    $hifadhiqtn = mysql_query("UPDATE tbl_tpf_qt SET Quotation_No='$Quotation_No',qtn_amount='$amount', Quotation_Date='$Quotation_Date',TPF_QT_Durations='$TPF_QT_Durations',qtn_attachment='$paths' WHERE tpf_no='$tpf_code'") or die(mysql_error());   
    echo'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!..</strong>
</div>';
    
    
    
} else {
    ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Downloading...<?php echo $Quotation_No;echo ",";echo $tpf_code;?></h4>
    </div>
    <div class="modal-body">
        <div style="height:30px"><div id="progress" class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div></div>
    </div>
    <?php
}
?>


