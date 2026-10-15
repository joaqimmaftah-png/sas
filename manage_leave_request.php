<head>
    <script>
        function showoption(str) {
            if (str.length == 0) {
                document.getElementById("action").innerHTML = "";
                document.getElementById("action").style.border = "0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("action").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/HR/leave_action.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>  
    
</head>
<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'approve_leave') {
        $request_id = $_POST['declineid'];
        $reason=$_POST['reason'];
        $Aproved = "Approved";
        $status='<a href="#" data-hint="Reason| '.$reason.'" data-hint-position="bottom">'.$Aproved.'</a>';
        $u = mysql_query("UPDATE tbl_leaves SET hrm_status='$status' WHERE leave_id='$request_id'") or die(mysql_error());
$to = "joaqimmaftah@yahoo.com";
$subject = "WE SHALL SEE AGAIN";
$txt = "Hello world!";
$headers = "From: joaqimmaftah@yahoo.com" . "\r\n" .
"CC: joaqimmaftah@yahoo.com";

mail($to,$subject,$txt,$headers);
    }
}
if(isset($_POST['declane'])){
    $declineid=$_POST['declineid'];
    $reasons=$_POST['reason'];
    $status='<a href="#" data-hint="Reason| '.$reasons.'" data-hint-position="bottom">Decline</a>';
    $u= mysql_query("UPDATE tbl_leaves SET hrm_status='$status',reason='$reasons' WHERE leave_id='$declineid'") or die(mysql_error());  
    if($u){       
$to = "joaqimmaftah@yahoo.com";
$subject = "WE SHALL SEE AGAIN";
$txt = "Hello world!";
$headers = "From: joaqim@sincrositewatch.com" . "\r\n" .
"CC: joaqim@sincrositewatch.com";
mail($to,$subject,$txt,$headers);
 
    }
}
?>

<div class="bg-white shadow" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="#"><i  class="icon-user-2 fg-blue"></i>&nbsp;Home</a>
            </li>
            <li>
                <a class="" href="#">Report</a>
            </li>
            <li id="action">

            </li>
        </ul>
    </nav>
</div>
<div class="margin5"> 
    <table id="example" class="display  striped bordered table hovered" width="100%" cellspacing="0">
        <thead>
            <tr class="info">
                <th class="text-left"></th>
                <th class="text-left">Emp_ID</th>
                <th class="text-left">Employee Name</th>
                <th class="text-left">Leave type</th>
                <th class="text-left">start date</th>
                <th class="text-left">End date</th>
                <th class="text-left">Days</th>                                                                
                <th class="text-left">Fs Status</th>              
                <th class="text-left">HOD status</th>
                 <th class="text-left">HR status</th>


            </tr>
        </thead>

        <tbody>
            <?php
            $leave_request = mysql_query("SELECT * FROM tbl_leaves")or die(mysql_error());
            while ($row = mysql_fetch_array($leave_request)) {
                $leave_id = $row['leave_id'];
                $leave_type = $row['leave_type'];
                $reason = $row['reason'];
                $start_date = $row['start_date'];
                $end_date = $row['end_date'];
                $no_of_days = $row['no_of_days'];
                $hod_status = $row['hod_status'];
                $hrm_status = $row['hrm_status'];
                $emp_file_no = $row['emp_file_no'];
                $a = mysql_query("SELECT * FROM tbl_leave_type WHERE leave_type_id='$leave_type'") or die(mysql_error());
                $b = mysql_fetch_array($a);
                $leave_typee = $b['leave_type'];
                $fs_status = $row['fs_status'];
                $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no' ")or die(mysql_error());
                $majina = mysql_fetch_array($jina);
                $firstname = $majina['first_name'];
                $sirname = $majina['surname'];
                $fullname = $firstname . " " . $sirname;
                ?>
                <tr class="">
                    <td class="text-center"><input type="checkbox" name="" value="<?php echo $leave_id; ?>" onchange="showoption(this.value)"></td>
                    <td class="right"><?php echo $emp_file_no; ?></td>
                    <td class="right"><?php echo $fullname; ?></td>
                    <td class="right"><?php echo $leave_typee; ?></td>
                    <td class="right"><?php echo $start_date; ?></td>
                    <td class="right"><?php echo $end_date; ?></td>                   
                    <td class="right"><?php echo $no_of_days; ?></td>                                      
                    <td class="right"><a href="#"><?php echo $fs_status; ?></a></td>
                    <td class="right"><a href="#"><?php echo $hod_status; ?></a></td>
                    <td class="right"><?php echo $hrm_status; ?></td>
                </tr> 
            <?php } ?> 
        </tbody>
    </table>
</div>

