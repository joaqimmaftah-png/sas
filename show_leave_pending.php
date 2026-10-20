
<?php
require_once __DIR__ . '/mysql_compat.php';

if($_GET['action']=='hr_pending'){
?>

<div class="shadow" style="height: 38px; width: 100%; background-color: #60A917; border:1px #60A917 solid; color:white;">
    <nav class="breadcrumbs">
        <ul>           
            <li><a href="#" id="excell"><i class="icon-user"></i>&nbsp;home</a></li>
            <li class="active"><a onclick="getPage('sincro.php?action=hr_pending')" href="#"><i class="icon-user"></i>&nbsp;Waiting HR approval</a></li>
            <li><a onclick="getPage('sincro.php?action=hod_pending')" href="#"><i class="icon-user"></i>&nbsp;Waiting  HOD approval</a></li>
            <li><a onclick="getPage('sincro.php?action=fs_pending')" href="#"><i class="icon-user"></i>&nbsp;Waiting  FS approval</a></li>      
            <li><a href="#"><i class=""></i>&nbsp;</a></li>           
        </ul>
    </nav>
</div>
<div class="margin5"> 
    <table id="example" class="display  striped bordered table hovered" width="100%" cellspacing="0">
        <thead>
            <tr class="info">
                <th class="text-left">Emp_ID</th>
                <th class="text-left">Employee Name</th>
                <th class="text-left">Leave type</th>
                <th class="text-left">start date</th>
                <th class="text-left">End date</th>
                <th class="text-left">Days</th>                                                 
                <th class="text-left">HR status</th>
                <th class="text-left">HOD status</th>
                 <th class="text-left">FS</th>
                <th class="text-left">Views</th>


            </tr>
        </thead>

        <tbody>
                        <?php
                        include 'authorized/db.php';
            $leave_request=  mysql_query("SELECT * FROM tbl_leaves WHERE hrm_status='pending'")or die(mysql_error());
            while ($row = mysql_fetch_array($leave_request)) {
                $leave_type=$row['leave_type'];
                $reason=$row['reason'];
$other_reason=$row['other_reason'];
$description=$row['description'];
$start_date=$row['start_date'];
$end_date=$row['end_date'];
$no_of_days=$row['no_of_days'];
$hod_status=$row['hod_status'];
$hrm_status=$row['hrm_status'];
$fs_status=$row['fs_status'];
$emp_file_no=$row['emp_file_no']; 
$jina=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no' ")or die(mysql_error());
$majina=  mysql_fetch_array($jina);
$firstname=$majina['first_name'];
$sirname=$majina['surname'];
$fullname=$firstname." ".$sirname;
            ?>
            <tr class="">
                <td class="right"><?php echo $emp_file_no;?></td>
                <td class="right"><?php echo $fullname;?></td>
                <td class="right"><?php echo $reason;?></td>
                <td class="right"><?php echo $start_date;?></td>
                <td class="right"><?php echo $end_date;?></td>                   
                <td class="right"><?php echo $no_of_days;?></td>
                <td class="right"><?php echo $hrm_status;?></td>
                <td class="right"><?php echo $hod_status;?></td>
                <td class="right"><?php echo $fs_status;?></td>
                
                <td class="right"><a href="#">views</a></td>
            </tr> 
            <?php }?>
  

      
        </tbody>
    </table>
</div>

<?php
}if ($_GET['action']=='hod_pending'){
?>

<div class="shadow" style="height: 38px; width: 100%; background-color: #60A917; border:1px #60A917 solid; color:white;">
    <nav class="breadcrumbs">
        <ul>           
            <li><a href="#" id="excell"><i class="icon-user"></i>&nbsp;home</a></li>
            <li><a onclick="getPage('sincro.php?action=hr_pending')" href="#"><i class="icon-user"></i>&nbsp;Waiting HR approval</a></li>
            <li class="active"><a onclick="getPage('sincro.php?action=hod_pending')" href="#"><i class="icon-user"></i>&nbsp;Waiting  HOD approval</a></li>
            <li><a onclick="getPage('sincro.php?action=fs_pending')" href="#"><i class="icon-user"></i>&nbsp;Waiting  FS approval</a></li>      
            <li><a href="#"><i class=""></i>&nbsp;</a></li>           
        </ul>
    </nav>
</div>
<div class="margin5"> 
    <table id="example" class="display  striped bordered table hovered" width="100%" cellspacing="0">
        <thead>
            <tr class="info">
                <th class="text-left">Emp_ID</th>
                <th class="text-left">Employee Name</th>
                <th class="text-left">Leave type</th>
                <th class="text-left">start date</th>
                <th class="text-left">End date</th>
                <th class="text-left">Days</th>                                                 
                <th class="text-left">HR status</th>
                 <th class="text-left">FS</th>
                <th class="text-left">HOD status</th>
                <th class="text-left">Views</th>


            </tr>
        </thead>

        <tbody>
                        <?php
                        include 'authorized/db.php';
            $leave_request=  mysql_query("SELECT * FROM tbl_leaves WHERE hod_status='pending'")or die(mysql_error());
            while ($row = mysql_fetch_array($leave_request)) {
                $leave_type=$row['leave_type'];
                $reason=$row['reason'];
$other_reason=$row['other_reason'];
$description=$row['description'];
$start_date=$row['start_date'];
$end_date=$row['end_date'];
$no_of_days=$row['no_of_days'];
$hod_status=$row['hod_status'];
$hrm_status=$row['hrm_status'];
$fs_status=$row['fs_status'];
$emp_file_no=$row['emp_file_no']; 
$jina=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no' ")or die(mysql_error());
$majina=  mysql_fetch_array($jina);
$firstname=$majina['first_name'];
$sirname=$majina['surname'];
$fullname=$firstname." ".$sirname;
            ?>
            <tr class="">
                <td class="right"><?php echo $emp_file_no;?></td>
                <td class="right"><?php echo $fullname;?></td>
                <td class="right"><?php echo $reason;?></td>
                <td class="right"><?php echo $start_date;?></td>
                <td class="right"><?php echo $end_date;?></td>                   
                <td class="right"><?php echo $no_of_days;?></td>               
                <td class="right"><?php echo $hrm_status;?></td>
                <td class="right"><?php echo $fs_status;?></td>
                <td class="right"><?php echo $hod_status;?></td>
                
                <td class="right"><a href="#">views</a></td>
            </tr> 
            <?php }?>
  

      
        </tbody>
    </table>
</div>

<?php
}if($_GET['action']=='fs_pending'){
?>

<div class="shadow" style="height: 38px; width: 100%; background-color: #60A917; border:1px #60A917 solid; color:white;">
    <nav class="breadcrumbs">
        <ul>           
            <li><a href="#" id="excell"><i class="icon-user"></i>&nbsp;home</a></li>
            <li><a onclick="getPage('sincro.php?action=hr_pending')" href="#"><i class="icon-user"></i>&nbsp;Waiting HR approval</a></li>
            <li><a onclick="getPage('sincro.php?action=hod_pending')" href="#"><i class="icon-user"></i>&nbsp;Waiting  HOD approval</a></li>
            <li class="active"><a onclick="getPage('sincro.php?action=fs_pending')" href="#"><i class="icon-user"></i>&nbsp;Waiting  FS approval</a></li>      
            <li><a href="#"><i class=""></i>&nbsp;</a></li>           
        </ul>
    </nav>
</div>
<div class="margin5"> 
    <table id="example" class="display  striped bordered table hovered" width="100%" cellspacing="0">
        <thead>
            <tr class="info">
                <th class="text-left">Emp_ID</th>
                <th class="text-left">Employee Name</th>
                <th class="text-left">Leave type</th>
                <th class="text-left">start date</th>
                <th class="text-left">End date</th>
                <th class="text-left">Days</th>                                                 
                <th class="text-left">HR status</th>
                <th class="text-left">HOD status</th>
                <th class="text-left">FS</th>
                <th class="text-left">Views</th>


            </tr>
        </thead>

        <tbody>
                        <?php
             include 'authorized/db.php';
            $leave_request=  mysql_query("SELECT * FROM tbl_leaves WHERE fs_status='pending'")or die(mysql_error());
            while ($row = mysql_fetch_array($leave_request)) {
                $leave_type=$row['leave_type'];
                $reason=$row['reason'];
$other_reason=$row['other_reason'];
$description=$row['description'];
$start_date=$row['start_date'];
$end_date=$row['end_date'];
$no_of_days=$row['no_of_days'];
$hod_status=$row['hod_status'];
$hrm_status=$row['hrm_status'];
$fs_status=$row['fs_status'];
$emp_file_no=$row['emp_file_no']; 
$jina=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no' ")or die(mysql_error());
$majina=  mysql_fetch_array($jina);
$firstname=$majina['first_name'];
$sirname=$majina['surname'];
$fullname=$firstname." ".$sirname;
            ?>
            <tr class="">
                <td class="right"><?php echo $emp_file_no;?></td>
                <td class="right"><?php echo $fullname;?></td>
                <td class="right"><?php echo $reason;?></td>
                <td class="right"><?php echo $start_date;?></td>
                <td class="right"><?php echo $end_date;?></td>                   
                <td class="right"><?php echo $no_of_days;?></td>
                <td class="right"><?php echo $hrm_status;?></td>
                <td class="right"><?php echo $hod_status;?></td>
                <td class="right"><?php echo $fs_status;?></td>
                
                <td class="right"><a href="#">views</a></td>
            </tr> 
            <?php }?>
  

      
        </tbody>
    </table>
</div>
<?php 
} 
?>



