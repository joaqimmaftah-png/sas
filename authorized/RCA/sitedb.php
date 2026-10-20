<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once 'db.php';
$userid = $_GET['siteid'];
$show_driver = mysql_query("SELECT * FROM tbl_site_db WHERE site_id='$userid'") or die(mysql_error());
$showing = mysql_fetch_array($show_driver);
$site_name = $showing['site_name'];
$ward = $showing['ward'];
$district = $showing['district'];
$region = $showing['region'];
$superid = $showing['field_supervisor'];
$tech_id = $showing['tech_name'];

$se = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$tech_id'") or die(mysql_error());
$de = mysql_fetch_array($se);
$phone = $de['phone'];
//     $tech_name=$showing['tech_phone'];

$tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$superid'") or die(mysql_error());
$rows = mysql_fetch_array($tbl_customer);
$first_name = $rows['first_name'];
$surname = $rows['surname'];
$field_supervisor = $first_name . " " . $surname;
////////////////////////////////////////////////
$tbl_customerr = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$tech_id'") or die(mysql_error());
$rowss = mysql_fetch_array($tbl_customerr);
$first_namea = $rowss['first_name'];
$surnamea = $rowss['surname'];
$tech_name = $first_namea . " " . $surnamea;
$checkdate = date("Ymd");



$b=  mysql_query("SELECT * FROM tbl_rca WHERE alarm_date='$checkdate'") or die(mysql_error());
$c=  mysql_num_rows($b)+1;
$f='SSW/'.$checkdate.'/'.sprintf("%03d", $c);

?>

<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Site ID:</span></span>
        <input name="siteid" id="product_name" class="form-control editable" placeholder="" value="<?php echo $userid; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Site Name:</span></span>
        <input name="sitename" id="product_name" class="form-control editable" placeholder="" value="<?php echo $site_name; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Ward:</span></span>
        <input name="ward" id="product_name" class="form-control editable" placeholder="" value="<?php echo $ward; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">District:</span></span>
        <input name="district" id="product_name" class="form-control editable" placeholder="" value="<?php echo $district; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Region:</span></span>
        <input name="region" id="product_name" class="form-control editable" placeholder="" value="<?php echo $region; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Supervisor:</span></span>
        <input name="supervisor" id="product_name" class="form-control editable" placeholder="" value="<?php echo $superid; ?>" aria-describedby="sizing-addon1" type="hidden">
        <input name="supervisor" id="product_name" class="form-control editable" placeholder="" value="<?php echo $field_supervisor; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div> 
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Technician Name:</span></span>
        <!--<input name="tech_name" id="product_name" class="form-control editable" placeholder="" value="<?php echo $tech_id; ?>" aria-describedby="sizing-addon1" type="hidden">-->
        <input name="tech_name" id="product_name" class="form-control editable" placeholder="" value="<?php  //$tech_name; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div> 
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Phone Number:</span></span>
        <input name="phone1" id="product_name" class="form-control editable" placeholder="" value="<?php echo $phone; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div> 
<div class="col-lg-4">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Phone Number:</span></span>
        <input name="phone2" id="product_name" class="form-control editable" placeholder="" value="<?php echo $phone; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Alarm Time:</span></span>
        <input name="alarm_date" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Alarm Date:</span></span>
        <input name="alarm_time" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Incident Date:</span></span>
        <input name="oosd" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Incident Time:</span></span>
        <input name="oost" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Date Reported:</span></span>
        <input name="date_report" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Time Reported:</span></span>
        <input name="time_report" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Time In:</span></span>
        <input name="tin" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Time Out:</span></span>
        <input name="tout" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Faulty Clear Date:</span></span>
        <input name="fcdate" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Clear Time:</span></span>
        <input name="ctime" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">AC Downtime:</span></span>
        <input name="acdtime" id="product_name" class="form-control editable" placeholder="NULL" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">DC Downtime:</span></span>
        <input name="dcdowntime" id="product_name" class="form-control editable" placeholder="NULL" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-6">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Faulty Alarm:</span></span>
        <input name="falarm" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-6">
    
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Primary Cause::</span></span>
        <input name="pcause" id="af" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
    
   
</div>
<div class="col-lg-12">
    
     <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Root Cause:</span></span>
        <input name="rcause" id="af" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>    
</div>
<div class="col-lg-12">
    
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Faulty Resolution:</span></span>
        <input name="fresolution" id="af" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<!--<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Tigo Ref No:</span></span>
        <input name="tgrefno" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>-->
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Sincro Ref No:</span></span>
        <input name="sincrorefn" id="product_name" class="form-control editable" placeholder="" value="<?php echo $f; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Callout Closed By:</span></span>
        <input name="ttclosedd" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>
<div class="col-lg-3">
    <div class="input-group" style="width:100%; margin:2px 0">
<!--        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">TT Status:</span></span>
        <input name="ttstatus" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">-->
<div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Status:</span></span>
                                                        <select class="form-control" data-live-search="true" id="af" name="ttstatus">
                                                            <option value="open">open</option>
                                                            <option value="closed">closed</option>
                                                        </select>
                                                    </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Remarks:</span></span>
        <input name="remarks" id="product_name" class="form-control editable" placeholder="" value="<?php echo ''; ?>" aria-describedby="sizing-addon1" type="text">

    </div>
</div>

<div class="col-lg-12">
    <button type="submit" class="btn btn-success" name="reg_rca" style="color:white"><i class="glyphicon glyphicon-plus"></i>Submit</button>
</div>




