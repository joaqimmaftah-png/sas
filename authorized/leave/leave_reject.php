<?php
include '../db.php';
                $select_asset = mysql_query("SELECT * FROM tbl_leaves WHERE leave_id='".$_GET['leave_id']."'") or die(mysql_error());
               $roww = mysql_fetch_array($select_asset);
                $leave_type = $roww['leave_type'];
                $reason = $roww['reason'];
                $start_date = $roww['start_date'];
                $end_date = $roww['end_date'];
                $no_of_days = $roww['no_of_days'];
                $hod_status = $roww['hod_status'];
                $hrm_status = $roww['hrm_status'];
                $emp_file_no = $roww['emp_file_no'];
                $fs_email=$roww['fs_email'];
                $hod_email=$roww['hod_email'];
                $a = mysql_query("SELECT * FROM tbl_leave_type WHERE leave_type_id='$leave_type'") or die(mysql_error());
                $b = mysql_fetch_array($a);
                $leave_typee =$b['leave_type'];
                $fs_status = $roww['fs_status'];
                $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no' ")or die(mysql_error());
                $majina = mysql_fetch_array($jina);
                $firstname = $majina['first_name'];
                $sirname = $majina['surname'];
                $fullname = $firstname . " " . $sirname;
                
                $contactFS=  mysql_query("SELECT * FROM tbl_contact WHERE email='$fs_email'") or die(mysql_error());
                $qs=mysql_fetch_array($contactFS);
                $emp_id=$qs['emp_file_no'];
                $jinafs = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_id' ")or die(mysql_error());
                $majinafs = mysql_fetch_array($jinafs);
                $f1 = $majinafs['first_name'];
                $s1 = $majinafs['surname'];
                $fsname = $f1 . " " . $s1;
                
                
                $contacthod=  mysql_query("SELECT * FROM tbl_contact WHERE email='$hod_email'") or die(mysql_error());
                $hod=mysql_fetch_array($contacthod);
                $emp_idd=$hod['emp_file_no'];
                $jinahod = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_idd' ")or die(mysql_error());
                $majinahod = mysql_fetch_array($jinahod);
                $f2 = $majinahod['first_name'];
                $s2 = $majinahod['surname'];
                $hodname = $f2 . " " . $s2;
                                           
?>
<head>
     <script type="text/javascript">
        $(document).ready(function (e) {
            $("#sub_approve").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/leave/rejection.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#approved_sms").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>
</head>

<input name="id" value="16" type="hidden">

<div role="tabpanel">
    <div id="approved_sms">
       <div class="tab-content" style="padding:3px 0">
<div role="tabpanel" class="tab-pane active" id="customer">
    <form action="" method="post" >
<div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right">
    <span class="text-right">Employee Name:</span></span>
    <input name="fullname" id="customer_code" class="form-control" value="<?php echo $fullname;?>" aria-describedby="sizing-addon1" readonly="" type="text">
</div>

<div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right">
    <span class="text-right">Leave Type:</span></span>
    <input name="leave_typee" id="customer_name" class="form-control editable" placeholder="" value="<?php echo $leave_typee;?>" aria-describedby="sizing-addon1" readonly="" type="text">
</div>

<div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right">
    <span class="text-right">Leave Date:</span></span>
    <input name="datetime" id="customer_name" class="form-control editable" placeholder="" value="<?php echo $start_date;?> - <?php echo $end_date;?>" aria-describedby="sizing-addon1" disabled="" type="text">
</div>
    <div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right">
    <span class="text-right">Supervisor:</span></span>
        <input name="fsname" id="customer_name" class="form-control editable" placeholder="" value="<?php echo $fsname;?> | Status: <?php echo $fs_status;?>" aria-describedby="sizing-addon1" disabled="" type="text">
        <input name="fsname" id="customer_name" class="form-control editable" placeholder="" value="<?php echo $fsname;?>" aria-describedby="sizing-addon1"  type="hidden">
        <input name="fs_status" id="customer_name" class="form-control editable" placeholder="" value="<?php echo $fs_status;?>" aria-describedby="sizing-addon1"  type="hidden">
</div>
    <div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right">
    <span class="text-right">Head Of Department:</span></span>
        <input name="hodname" id="customer_name" class="form-control editable" placeholder="" value="<?php echo $hodname;?> | Status: <?php echo $hod_status;?>" aria-describedby="sizing-addon1" disabled="" type="text">
        <input name="hodname" id="customer_name" class="form-control editable" placeholder="" value="<?php echo $hodname;?>" aria-describedby="sizing-addon1"  type="hidden">
        <input name="hod_status" id="customer_name" class="form-control editable" placeholder="" value="<?php echo $hod_status;?>" aria-describedby="sizing-addon1"  type="hidden">
</div>
    
<div class="input-group" style="width:100%; margin:10px 0">
<input  name="requiredemailz" id="description" class="form-control editable" placeholder="Enter short description" value="<?php echo $_GET['requiredemail'];?>" aria-describedby="sizing-addon1"  type="hidden">
<input  name="leave_id" id="description" class="form-control editable" placeholder="Enter short description" value="<?php echo $_GET['leave_id'];?>" aria-describedby="sizing-addon1"  type="hidden">
<input  name="end_date" id="description" class="form-control editable" placeholder="" value="<?php echo $end_date;?>" aria-describedby="sizing-addon1"  type="hidden">
<input  name="start_date" id="description" class="form-control editable" placeholder="" value="<?php echo $start_date;?>" aria-describedby="sizing-addon1"  type="hidden">
</div>
        
 <div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right">
    <span class="text-right">Reason:</span></span>
    <textarea name="comment"  class="form-control editable" placeholder=""  aria-describedby="sizing-addon1" ></textarea>
</div>
    <div class="input-group" style="width:100%; margin:10px 0">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Click button to Reject:</span></span>
<input name="reject" class="form-control primary"  value="reject" aria-describedby="sizing-addon1"  type="submit">
</div>
    </form> 
</div>


</div>
    </div>

</div>

