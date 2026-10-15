<?php

include_once 'authorized/db.php';
$items = $_GET['item'];

if(isset($_POST['add_update'])){  
    
    $emp_name=$_POST['employee_name'];
    $leave_type=$_POST['leave_type'];
    $start_dat=$_POST['start_date'];
    $end_dat=$_POST['end_date'];
    $days=$_POST['days'];
    $superv_status=$_POST['supervisor_status'];
    $hod_status=$_POST['hod_status'];
 
   $startfmt=date('Ymd',strtotime($start_dat));
   $endfmt=date('Ymd',strtotime($end_dat));
   $format=date('Y',strtotime($end_dat));
$date1=  strtotime($startfmt);
$date2=  strtotime($endfmt);
$n=($date2-$date1)/(60*60*24);  
   
   if($endfmt>=$startfmt){
        $leave_update=  mysql_query("UPDATE `tbl_leaves` SET `emp_file_no`='$emp_name',`leave_type`='$leave_type',`start_date`='$start_dat', `end_date`='$end_dat', `no_of_days`='$days',`fs_status`='$superv_status', `hod_status`='$hod_status',startdate ='$startfmt',enddate ='$endfmt',report_date='$format',no_of_days='$n' WHERE `leave_id`='$items'") or die(mysql_error());
          
   }  else {
       
   }
   
      
    
}  



$leave= mysql_query("SELECT * FROM tbl_leaves WHERE leave_id='$items'") or die(mysql_error());
    $result=  mysql_fetch_array($leave);
                    
                    $emp_namex=$result['emp_file_no'];
                    $leav_type=$result['leave_type'];
                    $start_date= date('Y-m-d',strtotime($result['start_date']));
                    $end_date=date('Y-m-d', strtotime($result['end_date']));
                    $days=$result['no_of_days'];
                    $supervisor=$result['fs_status'];
                    $hod=$result['hod_status'];
                    
            $emp_name= mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_namex'") or die(mysql_error());
                    $result1=  mysql_fetch_array($emp_name);                    
                    $firstname=$result1['first_name'];
                    $surname=$result1['surname'];
                    
                    $leav_typ=mysql_query("SELECT * FROM tbl_leave_type WHERE leave_type_id='$leav_type'") or die(mysql_error());
                      $leave1=  mysql_fetch_array($leav_typ);                     
                      $leav_id=$leave1['leave_type_id'];
                      $lea_name=$leave1['leave_type'];
?>

<form  action=""  method="post">
<div class="row" style="margin-top: 3px;">

<div class="col-lg-6">
       
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Employee name:</span></span>
                                    <input name="" class="form-control editable" placeholder="" value="<?php echo $firstname.' '.$surname;?>" aria-describedby="sizing-addon1" type="text">
                                    <input name="employee_name" class="form-control editable" placeholder="" value="<?php echo $emp_namex;?>" aria-describedby="sizing-addon1" type="hidden">
                                    </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Leave type:</span></span>
                                    <select name="leave_type" class="form-control editable" placeholder="" aria-describedby="sizing-addon1" type="text">
                            
                                    <option value="<?php echo $leav_id; ?>"><?php echo $lea_name;?></option>
                                        <?php
                                    $selectsd = mysql_query("SELECT * FROM tbl_leave_type") or die(mysql_error());
                                    while ($cla = mysql_fetch_array($selectsd)) {
                                    $names = $cla['leave_type'];
                                    $l_id = $cla['leave_type_id'];
                                     ?>
                                    <option value="<?php echo $l_id; ?>"><?php echo $names;?></option>
                                               
                                                <?php
                                                }
                                                ?>
                                                                         
                                    </select>                                   
                                </div>
        <div class="input-group" style="width:100%; margin:2px 0"> 
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Start date:</span></span>
                                    <input name="start_date" class="form-control editable" value="<?php echo date($start_date);?>" aria-describedby="sizing-addon1" type="date">
  
                                </div>    
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">End date:</span></span>
                                    <input name="end_date"  class="form-control editable" value="<?php echo date($end_date);?>"  type="date">

                                </div>         
    
</div>
    
    <div class="col-lg-6">   
        <div class="input-group" style="width:100%; margin:2px 0">  
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Days:</span></span>
                                    <input name="days"  class="form-control editable" placeholder="" value="<?php echo $days;?>" aria-describedby="sizing-addon1" type="text">

                                </div>
                    
        <div class="input-group" style="width:100%; margin:2px 0"> 
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Supervisor Status:</span></span>
                                    <select name="supervisor_status" id="product_name" class="form-control editable"  value="<?php echo $supervisor;?>" aria-describedby="sizing-addon1" type="text">
                                      
                                        <option value="<?php echo $supervisor;?>"><?php echo $supervisor;?></option>
                                        <option value="Approved">Approved</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Reject">Reject</option>
                                        
                                    </select>
                                </div>   
    
        <div class="input-group" style="width:100%; margin:2px 0"> 
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">HOD Status:</span></span>
                                    <select name="hod_status" id="product_name" class="form-control editable" value="<?php echo  $hod;?>" aria-describedby="sizing-addon1" type="text">                                    
                                    <option value="<?php echo $hod;?>"><?php echo $hod;?></option>
                                    <option value="Approved">Approved</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Reject">Reject</option>
                                    </select>
                                </div>         
    
</div>
</div>

<div class="row">
    <div class="col-lg-12">
         
    <button type="submit" class="btn btn-success" name="add_update" style="color:white"><i class="glyphicon glyphicon-refresh"></i>Update Leave</button> 
       
    </div> 
    </div>
      
</form>

