<div class="row">    
    <div class="col-lg-12">  
    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
    <br />
    <br />
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Project Name</th>
                <th>Project short name</th>
                <th>Project owner</th>
                <th>Project start date</th>
                <th>Project end date</th>
                <th>Project actual end date</th>
                <!--<th>Project status</th>-->
                <th>Project percent complete</th>
                <th>Project location</th> 
                <th>Action</th>
                
               
            </tr>
        </thead>
        <tbody>
            <?php
            
            $i=1;
            include_once 'authorized/db_project.php';  
            
            $project = mysql_query("SELECT * FROM projects") or die(mysql_error());
            while ($row = mysql_fetch_array($project)) {
                
                $project_id= $row['project_id'];
                $project_name = $row['project_name'];
                $short_name = $row['project_short_name'];
                $project_owner=$row['project_owner'];
                $project_startdate=$row['project_start_date'];
                $project_enddate=$row['project_end_date'];
                $actual_enddate=$row['project_actual_end_date'];
//                $project_status=$row['project_status'];
                $percent_complete=$row['project_percent_complete'];
                $project_location=$row['project_location'];
                
                
                $owner=  mysql_query("SELECT * FROM users WHERE user_id=$project_owner")or die(mysql_error());
                $project_owner= mysql_fetch_array($owner);
                
                $username=$project_owner['user_username'];
                
                ?>
                <tr>
                    
                    <td><?php echo $i++;?></td>                 
                    <td><?php echo $project_name?></td>
                    <td><?php echo $short_name?></td>
                    <td><?php echo $username;?></td>
                    <td><?php echo $project_startdate;?></td>
                    <td><?php echo $project_enddate;?></td>
                    <td><?php echo $actual_enddate;?></td>
                    <!--<td><?php // echo $project_status;?></td>-->
                    <td><?php echo $percent_complete;?></td>
                    <td><?php echo $project_location;?></td>
                    <td><a href="?action=view_project_tasks&ids=<?php echo $project_id;?>">View Project tasks</a></td>  
                    
                    
                </tr> 
            <?php   
            
            }
            
            ?>
        </tbody>

        <tfoot>
            <tr>
                <th>No</th>
                <th>Project Name</th>
                <th>Project short name</th>
                <th>Project owner</th>
                <th>Project start date</th>
                <th>Project end date</th>
                <th>Project actual end date</th>
                <!--<th>Project status</th>-->
                <th>Project percent complete</th>
                <th>Project location</th>
                <th>Action</th> 
            </tr>        
        </tfoot>
    </table>
</div>
</div>


