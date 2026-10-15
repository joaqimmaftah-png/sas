<?php
include_once '../model/db.php';
if(isset($_POST['postincident'])){
    $employee_no=$_POST['employee_no'];
    $incidentname=$_POST['incidentname'];
    $related_to=$_POST['related_to'];
    $incident_period=$_POST['incident_period'];
    $incident_status=$_POST['incident_status'];
    $reported_by=$_POST['reported_by'];
    $Resolver=$_POST['Resolver'];
    
    $add_incident=  mysql_query("INSERT INTO tbl_incident_report(`incident_name`, `related_to`, `incident_period`, `incident_status`, `reported_by`, `resolver_owner`, `employee_no`)"
            . "VALUE('$incidentname','$related_to','$incident_period','$incident_status','$reported_by','$Resolver','$employee_no')") or die(mysql_error());
    echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully!</strong>
</div>';
    
}

if(isset($_POST['attachment'])){
$sourcePath = $_FILES['file']['tmp_name'];
$targetPath = "incident_attachments/".$_FILES['file']['name'];
$name=$_FILES['file']['name'];
$incident_id=$_POST['incident_id'];
//$employee=$_POST['attachment'];
$paths="view/incident_attachments/".$_FILES['file']['name'];
if(move_uploaded_file($sourcePath,$targetPath)) {
    $update=  mysql_query("INSERT INTO tbl_incident_report_attachments(`report_name`, `incident_id`)"
            . "VALUE('$name','$incident_id')") or die(mysql_error());
     echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    Thank You! '.$name.' Added
</div>';

    
}
}
if(isset($_GET['incident_delete'])){
    $incident_id=$_GET['incident_delete'];
    $incidence = "SELECT * FROM tbl_incident_report_attachments WHERE incident_id='$incident_id'";
    $displayy = mysql_query($incidence) or die(mysql_error());
   $re=mysql_fetch_array($displayy);
   $report_name=$re['report_name'];   
    $file="incident_attachments/".$report_name;
    unlink($file);
    $delete_incident=  mysql_query("Delete from tbl_incident_report_attachments where incident_id='$incident_id'") or die(mysql_error());
    $delete_attachment=  mysql_query("delete from tbl_incident_report where incident_id='$incident_id'") or die(mysql_error());
    if($delete_incident){       
         echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    Successful Deleted!
</div>';
    }

    

    

}

