<?php
include_once 'authorized/db.php';
$opm_id=$_GET['opdm']; 
$message='';
$purchase = mysql_query("SELECT * FROM tbl_operational_monitor where opm_id='$opm_id'") or die(mysql_error());
$row = mysql_fetch_array($purchase);
        $Description_of_Finding = $row['Description_of_Finding'];
                $key_owner = $row['key_owner'];
                $opm_id = $row['opm_id'];
                
                $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$key_owner'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_name = $rows['first_name'];
                $surname = $rows['surname'];
  $gtt=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_id' AND Updatee!='Closed'") or die(mysql_error());
  $ko=  mysql_num_rows($gtt);
  if($ko>0){
      $makestatus='On Progress';
  }
  else {
     $makestatus='Complete'; 
}
 $gtt2=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_id' AND Updatee='Suspended'") or die(mysql_error());
 $koo=  mysql_num_rows($gtt2);

                
       if(isset($_GET['error'])==1){
           $message= ' <div class="alert alert-warning">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<strong>Warning!</strong> Your Action is depending on other actions.Check start date for your action</div>';
       }         
?>
<style>
    .disabled {
   pointer-events: none;
   cursor: default;
}
    </style>
    <div class="col-lg-12">
        <?php echo $message;?>
    </div>
<div class="col-lg-12">
    <br>
    <div class = "well well-sm"><strong>Description of Finding:&nbsp;</strong><?php echo $Description_of_Finding;?></div>
    <div class = "well well-sm"><strong>Key Owner:&nbsp;</strong><?php echo $first_name.' '.$surname; ?></div>
    <div class = "well well-sm"><strong>Status:&nbsp;</strong><?php echo $makestatus; ?></div>
    
</div>
<div class="col-lg-12">
    <table class="table table-striped table-bordered" cellspacing="0"  >
        <thead>
            <tr>
                <th>sn</th>
                <th>Action</th>
                <th>Requirements</th>
                <th>Responsible</th>
                <th>Start Date</th> 
                <th>End Date</th>
                <th>Update</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once 'authorized/db.php';
            $mimi=$_SESSION["emp_file_no"];
            
//            $pur=mysql_query("SELECT * FROM tbl_action_list where Responsible='$mimi' AND opm_id='$opm_id'") or die(mysql_error());
            
             $pur=mysql_query("SELECT * FROM tbl_action_list where opm_id='$opm_id'") or die(mysql_error());
            $j=1;
            while ($row = mysql_fetch_array($pur)) {
                $Action = $row['Action'];
                $Requirements = $row['Requirements'];
                $sn= $row['sn'];
                $Execution_date= $row['Execution_date'];
                $End_Date= $row['End_Date'];
                $Start_Date= $row['Start_Date'];
                $Updatee= $row['Updatee'];
                $Responsible= $row['Responsible'];
                $tbl_customer = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$Responsible'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_customer);
                $first_namee = $rows['first_name'];
                $surnamee = $rows['surname'];
                $today=date("Ymd");               
                $checkdate = date("Ymd", strtotime($Start_Date));
                $leo = date("Ymd", strtotime($today));
                if($checkdate<=$leo){
                    $link='<a class="" href="?action=view_action&aids='.$sn.'">Update</a>';
                }  else {
                    $link='<a class="" href="?action=view_finding&error=1&opdm='.$opm_id.'">Update</a>';
                }
                
               

                
                ?>
                <tr class="">
                    <td>
                        <a href=""><?php echo $j++; ?></a>
                    </td>
                    <td>
                        <a href=""><?php echo $Action; ?></a>
                    </td>
                    <td>
                        <a href=""><?php echo $Requirements; ?></a>
                    </td>
                    <td>
                        <?php echo $first_namee.' '.$surnamee; ?>
                    </td>
                    <td>
                        <?php echo $Start_Date; ?>
                    </td>
                    <td>
                        <?php echo $End_Date; ?>
                    </td>
                    
                    <td>
                        <?php echo $Updatee;?>
                    </td>
                    <td>
                       <?php echo $link;?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

        
    </table>
</div>