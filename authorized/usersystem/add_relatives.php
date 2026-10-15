<?php
   include_once '../db.php';
    $emp_file_no = $_POST['employee_no'];
    $firstname = $_POST['fname'];
    $middlename = $_POST['mname'];
    $surname = $_POST['lname'];
    $gender = $_POST['sex'];
    $relation = $_POST['Rname'];
    $phone = $_POST['phone'];
    $relatives = "INSERT INTO tbl_relatives(`emp_file_no`,`firstname`,`middlename`,`surname`,`gender`,`relation`,phone) "
            . "VALUES('$emp_file_no','$firstname','$middlename','$surname','$gender','$relation','$phone')";
    $show = mysql_query($relatives) or die(mysql_error());
    if ($relatives && $show) {
        echo'<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successful!..</strong>'."&nbsp;" . "$firstname"."&nbsp;"."$surname" . ' added as your relative
</div>';
    }

?>
                                                 <div id="show_message">
                            <div id="action_delete">
                                
                            </div>
                           <div class="example">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">ID</th>
                                        <th class="text-left">Full Name</th>  
                                        <th class="text-left">Gender</th>
                                        <th class="text-left">Relationship</th>  
                                        <th class="text-left">Phone</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $select_asset = mysql_query("SELECT * FROM tbl_relatives WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
                                    $i=0;
                                    while ($roww = mysql_fetch_array($select_asset)) {
                                        $firstname = $roww['firstname'];
                                        $surname= $roww['surname'];
                                        $gender= $roww['gender'];
                                        $relation= $roww['relation'];
                                        $fullname =$firstname.'&nbsp;'.$surname;
                                        $relative_id=$roww['relative_id'];
                                        $phone=$roww['phone'];
                                        $i++
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="" value="<?php echo $relative_id; ?>" onchange="showaction(this.value)"></td>
                                            <td class="right"><?php  echo $i; ?></td>
                                             <td class="right"><?php echo $fullname; ?></td>
                                            <td class="right"><?php echo $gender; ?></td>
                                            <td class="right"><?php echo $relation; ?></td>
                                            <td class="right"><?php echo $phone; ?></td>
                                        </tr> 
                                        <?php
                                    }
                                    ?>
                                </tbody>

                                <tfoot></tfoot>
                            </table>
                        </div>
                        </div>