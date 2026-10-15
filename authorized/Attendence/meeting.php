
<?php
$message="";
if(isset($_POST['data'])){
    $user_id=$_POST['id'];
    $date=date("Y-m-d");
    $time=date("H:i");
    
        for ($i = 0; $i < sizeof($user_id); $i++) {
                        $insert = mysql_query("INSERT INTO meeting(`employee`,`date`,time)"
                                . "values('$user_id[$i]','$date','$time')") or die(mysql_error());
                    }
                    
//                    Redirect('http://daimainfotech.com/sas/meetings.php', false);
                    $message=' <div class="col-lg-12" id="message">
        <div class="alert alert-success">
  <strong>Your information has been successfully submitted</strong>
</div>
    </div>';
}
?>

<div class="row">
   <?php
   echo $message;
   ?>
     <div class="col-lg-4">
         <form action="" method="POST">
         <button type="submit" name="data" class="btn btn-secondary">Submit</button>
         <hr>
           <table id="table2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-left"></th>
                                    <th class="text-left">Full Name</th>
                                
                                   

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $report=date("Ymd");
// $query = "SELECT * FROM tbl_attendence WHERE reportdate='$report'";
//$resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
//$h=1;
                                $qr=mysql_query("SELECT * FROM tbl_attendence where reportdate='$report'") or die(mysql_error());
                                while ($row=mysql_fetch_array($qr)) {
    $tech_no=$row['emp_file_no'];
   

                $tbl_customerr = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$tech_no'") or die(mysql_error());
                $rowss = mysql_fetch_array($tbl_customerr);
                $first_namea = $rowss['first_name'];
                $surnamea = $rowss['surname'];
                $tech_name=$first_namea." ".$surnamea;
                                ?>
                                       <tr>
                                           <td class="right"><input type="checkbox" name="id[]" value="<?php echo $tech_no;?>"></td>
                                        <td class="right"><?php echo $tech_name;?></td>
                                       
           
                                    </tr> 
                                    <?php
}
                                    ?>
                            </tbody>

                            <tfoot></tfoot>
                        </table>
         </form>
    </div>
    <div class="col-lg-8">
         <table id="table3" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-left">No.</th>
                                    <th class="text-left">Full Name</th>
                                    <th class="text-left">Date</th>
                                    <th class="text-left">Time</th> 
                                    
                                   

                                </tr>
                            </thead>

                            <tbody>
                                                                <?php
                              
 $query = "SELECT * FROM meeting ORDER BY meting_id DESC";
$result = mysql_query($query) or die("SQL Error 1: " . mysql_error());
$h=1;
while ($rrowz = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $tech_no=$rrowz['employee'];
    $date=$rrowz['date'];
    $time=$rrowz['time'];
   

                $tbl_customerr = mysql_query("SELECT * FROM tbl_employee where emp_file_no='$tech_no'") or die(mysql_error());
                $rowss = mysql_fetch_array($tbl_customerr);
                $first_namea = $rowss['first_name'];
                $surnamea = $rowss['surname'];
                $tech_name=$first_namea." ".$surnamea;
                                ?>
                                       <tr>
                                        <td class="right"><?php echo $h++?></td>
                                        <td class="right"><?php echo $tech_name?></td>
                                        <td class="right"><?php echo $date;?></td>
                                        <td class="right"><?php echo $time;?></td>
                                      
           
                                    </tr> 
                                    <?php 
}
                                    ?>
                            </tbody>

                            <tfoot></tfoot>
                        </table>
    </div> 
   
</div>