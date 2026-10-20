<?php
require_once __DIR__ . '/../../mysql_compat.php';

  include_once 'authorized/db.php';
?>
<table class="table table-hover table-bordered" id="leave">
                            <thead>
                                <tr>
                                    
                                    <th class="text-left">Employee Name</th>
                                    <th class="text-left">Leave Type</th> 
                                    <th class="text-left">Start Date</th>
                                    <th class="text-left">End Date</th> 
                                    <th class="text-left">Days</th>
                                    <th class="text-left">Supervisor Status</th> 
                                    <th class="text-left">HOD Status</th> 
                                  
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $select_asset = mysql_query("SELECT * FROM tbl_leaves ORDER BY leave_id DESC") or die(mysql_error());
                                while ($roww = mysql_fetch_array($select_asset)) {
                                    $leave_id = $roww['leave_id'];
                                    $leave_type = $roww['leave_type'];
                                    $start_date = $roww['start_date'];
                                    $end_date = $roww['end_date'];
                                    $hod_comment = $roww['hod_comment'];
                                    $supervisor_comm = $roww['supervisor_comm'];
                                    $no_of_days = $roww['no_of_days'];
                                    $hod_status = $roww['hod_status'];
                                    $hrm_status = $roww['hrm_status'];
                                    $emp_file_noo = $roww['emp_file_no'];
                                    $a = mysql_query("SELECT * FROM tbl_leave_type WHERE leave_type_id='$leave_type'") or die(mysql_error());
                                    $b = mysql_fetch_array($a);
                                    $leave_typee = $b['leave_type'];
                                    $fs_status = $roww['fs_status'];
                                    $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_noo' ")or die(mysql_error());
                                    $majina = mysql_fetch_array($jina);
                                    $firstname = $majina['first_name'];
                                    $sirname = $majina['surname'];
                                    $fullname = $firstname . " " . $sirname;
                                    ?>
                                    <tr>
                                    
                                        <td class="right"><?php echo $fullname; ?></td>
                                        <td class="right"><?php echo $leave_typee; ?></td>
                                        <td class="right"><?php echo $start_date; ?></td>
                                        <td class="right"><?php echo $end_date; ?></td>  
                                        <td class="right"><?php echo $no_of_days; ?></td> 
                                        <td class="right"> 
                                            <?php
                                            if (empty($supervisor_comm)) {
                                                ?>
                                                <a href="#"><?php echo $fs_status; ?></a>
                                                <?php
                                            } else {
                                                echo $supervisor_comm;
                                            }
                                            ?>

                                        </td>
                                        <td class="">
                                            <?php
                                            if (empty($hod_comment)) {
                                                ?>
                                                <a href="#"><?php echo $hod_status; ?></a>
                                                <?php
                                            } else {
                                                echo $hod_comment;
                                            }
                                            ?>

                                        </td>                                                              
                                        
                                  
                                        

                                    </tr> 
                                <?php
                                }
                                ?>
                            </tbody>

                            <tfoot></tfoot>
                        </table>



