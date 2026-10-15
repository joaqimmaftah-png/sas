<?php
include_once 'authorized/db_project.php';
$proj_id=$_GET['ids']; 

include_once 'authorized/db.php';
                     
?>
<style>
    .disabled {
   pointer-events: none;
   cursor: default;
}
</style>
    
<!--<div class="col-lg-12">
    <br>
    <div class = "well well-sm"><strong>PROJECT NAME:&nbsp;</strong><?php echo $project_name;?></div>    
    
</div>-->
<div class="col-lg-12">
    <table class="table table-striped table-bordered" cellspacing="0"  >
        <thead>
            <tr>
                <th>sn</th>
                <th>Project name</th>
                <th>Project location</th>
                <th>Task name</th>
                <th>Task owner</th>
                <th>Task start date</th>
                <th>Task end date</th> 
                <!--<th>Task status</th>-->
                <th>Task percent complete</th>
                
            </tr>
        </thead>
        <tbody>
           
    <?php
       $i=1;    
    $purchase = mysql_query("SELECT * FROM tasks where task_project='$proj_id'") or die(mysql_error());
    while ($row = mysql_fetch_array($purchase)){ 
    
   $task_project=$row['task_project'];
   $task_name=$row['task_name'];
   $task_owner=$row['task_owner'];
   $task_start_date=$row['task_start_date'];
   $task_end_date=$row['task_end_date'];
//   $task_status=$row['task_status'];
   $task_percent_complete=$row['task_percent_complete'];  
   
   
   $owner=  mysql_query("SELECT * FROM users WHERE user_id='$task_owner'")or die(mysql_error());
                $t_owner= mysql_fetch_array($owner);
                
                $username=$t_owner['user_contact'];
                
                $emplo_name=  mysql_query("SELECT * FROM contacts WHERE contact_id='$username'")or die(mysql_error());
                $e_name=  mysql_fetch_array($emplo_name);
                $f_name=$e_name['contact_first_name'];
                $l_name=$e_name['contact_last_name'];   
                
   $project=  mysql_query("SELECT * FROM projects WHERE project_id=$proj_id")or die(mysql_error());
   $project_name=  mysql_fetch_array($project);
   $p_name=$project_name['project_name'];
   $p_location=$project_name['project_location'];
   

  
//$pro_name=  mysql_query("SELECT * FROM projects where project_id='$task_project'")or die(mysql_error());
////$result=  mysql_fetch_array($project_name);
//$project_name=$result['project_name'];
             
        ?>
                          
                <tr>
                    <td>
                        <a href=""><?php echo $i++; ?></a>
                    </td>
                    
                    <td>
                        <?php echo $p_name; ?>
                    </td>
                    
                    <td>
                        <?php echo $p_location; ?>
                    </td>                    
                    
                    <td>
                        <a href=""><?php echo $task_name; ?></a>
                    </td>
                    <td>
                                               
                        <a href=""><?php echo $f_name.' '.$l_name;?></a>
                    </td>
                    <td>
                        <?php echo $task_start_date; ?>
                    </td>
                    <td>
                        <?php echo $task_end_date; ?>
                    </td>
                    
<!--                    <td>
                        <?php echo $task_status; ?>
                    </td>                    -->
                    <td>
                        <?php echo $task_percent_complete;?>
                    </td>
                    
                </tr>
                
            <?php        
                         
            } 
           
            ?>
                                     
        </tbody>       
        
        <tfoot>
                <th>sn</th>
                <th>Project name</th>
                <th>Project location</th>               
                <th>Task name</th>
                <th>Task owner</th>
                <th>Task start date</th>
                <th>Task end date</th> 
                <!--<th>Task status</th>-->
                <th>Task percent complete</th>
                                
        </tfoot>       
    </table>
</div>