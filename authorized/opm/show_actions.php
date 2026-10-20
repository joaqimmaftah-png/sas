<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once 'authorized/db.php';
$mimi=$_SESSION["emp_file_no"];
$med='';
      
    if(isset($_GET['error'])==1){
           $med= ' <div class="alert alert-warning">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<strong>Warning!</strong> Your Action is depending on other actions.Please Contact with '.$first_name.' '.$surname.'</div>';
       }             
?>

<div class="col-lg-12">
    <?php echo $med;?>
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
            
            $pur=mysql_query("SELECT * FROM tbl_action_list where Responsible='$mimi'") or die(mysql_error());
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
                    $link='<a class="" href="?action=view_action&aids='.$sn.'">View</a>';
                }  else {
                    $link='<a class="" href="?action=view_finding&error=1&opdm='.$opm_id.'">View</a>';
                }
                

                ?>
                <tr>
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
<?php
//}
?>