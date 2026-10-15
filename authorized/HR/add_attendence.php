<?php
include_once '../../db.php';
if(!empty($_POST['timein']) AND !empty($_POST['timeout']) AND !empty($_POST['emp_file_no']) AND !empty($_POST['emp_file_no'])  ){
include_once '../../db.php';
    $emp_file_no = $_POST['emp_file_no'];
    $current_date = $_POST['cdate'];
    $time_cof = "09";
    $timein = $_POST['timein'];
    $timeout = $_POST['timeout'];
    $timedefault = '00:00';
    $time_of_entry = '07:59';
    $kawaida = '08:30';
    $time1 = new DateTime($timein);
    $time2 = new DateTime($timeout);
    $timeof_entry = new DateTime($time_of_entry);
    $time_zero = new DateTime($timedefault);
    $kawaidamuda = new DateTime($kawaida);
    $yupokawaida = $kawaidamuda->diff($time_zero);
    $ontime = (int) $yupokawaida->format('%H%i');
    $entry_time = $timeof_entry->diff($time_zero);
    $mudauliopangwa = (int) $entry_time->format('%H%i');
    $badilimudaalioingia = $time1->diff($time_zero);
    $mudaaliongia = (int) $badilimudaalioingia->format('%H%i');
    $time_spent = $time2->diff($time1);
    $timespent = $time_spent->format('%H:%i');
    $ss=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
    $row= mysql_num_rows($ss);
    if($row!=0){

    if ($mudauliopangwa > $mudaaliongia) {
        $class = "bg-green";
        $status = "Good";
    }  else {
        $class = "bg-red";
        $status = "Bad";
    }

    $upload = "INSERT INTO tbl_attendence(emp_file_no,time_in,time_out,time_set,date1,time_spend,remark,notification) values('$emp_file_no','$timein','$timeout','$time_cof','$current_date','$timespent','$status','$class')";
    $updatee = mysql_query($upload) or die(mysql_error());
    echo '<div class="alert alert-success success fade in" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successfully!</strong>
</div>';
    }
//}  else {
//    echo '<div class="alert alert-danger fade in error">
//    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
//    <strong>Error!Employee ID,Time in and Time Out Must Be Filled Out</strong> 
//</div>'; 
//}
    else {
    echo '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Error!No Employee With Employee Id:'.$emp_file_no .'</strong> 
</div>';
}
}
else {
    echo '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Error!Employee ID,Time in and Time Out Must Be Filled Out</strong> 
</div>'; 
}
?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">Employee ID</th>                                     
                                        <th class="text-left">Time In</th>  
                                        <th class="text-left">Time Out</th>
                                        <th class="text-left">Total Hours</th>
                                        <th class="text-left">Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    include_once 'db.php';
                                    $select_asset = mysql_query("SELECT * FROM tbl_attendence") or die(mysql_error());
                                    while ($roww = mysql_fetch_array($select_asset)) {
                                        $emp_file_no = $roww['emp_file_no'];
                                        $time_in= $roww['time_in'];
                                        $time_out= $roww['time_out'];
                                        $date1= $roww['date1'];
                                        $time_spend=$roww['time_spend'];
                                        
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="" value="<?php echo $edu_id; ?>" onchange="showaction(this.value)"></td>
                                            <td class="right"><?php echo $emp_file_no; ?></td>
                                            <td class="right"><?php echo $time_in; ?></td>
                                            <td class="right"><?php echo $time_out; ?></td>
                                            <td class="right"><?php echo $time_spend; ?></td>
                                            <td class="right"><?php echo $date1; ?></td>
                                        </tr> 
                                        <?php
                                    }
                                    ?>
                                </tbody>

                                <tfoot></tfoot>
                            </table>


