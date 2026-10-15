
<?php
$message = "";
if (isset($_POST['add_appraisal'])) {
    if (!empty($_POST['checkbox'])) {
        $checkBox = $_POST['checkbox'];
//        $employ_ids = $_POST['employ_id'];
        $employeeid = $_POST['employeeid'];
        $reviewer1 = $_POST['reviewer1'];
        $reviewer2 = $_POST['reviewer2'];
        $date_of_date = $_POST['initiated_date'];
        $emp_file_no2 = $_GET["initiatedby"];

        $status = "Open";
        $reviewer1_status="Pending";
        $reviewer2_status="Pending";
        ////////////////////////////////////////////////
        $f = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$employeeid'") or die(mysql_error());
        $v = mysql_fetch_array($f);
        $emailh = $v['email'];

        //////////////////////////////////////////////
        $h = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$reviewer1'") or die(mysql_error());
        $i = mysql_fetch_array($h);
        $j = $i['email'];
        //////////////////////////////////////////////
        $k = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$reviewer2'") or die(mysql_error());
        $l = mysql_fetch_array($k);
        $m = $l['email'];
////////////////////////////////////////////////////

        $appraisal = mysql_query("INSERT INTO tbl_appraisal(`emp_file_no`,`reviewer`,reviewer2,initiated_by,`initiated_date`,`status`,employee_email,reviewer1_email,reviewer2_email,reviewer1_status,reviewer2_status)"
                . "VALUES('$employeeid','$reviewer1','$reviewer2','$emp_file_no2','$date_of_date','$status','$emailh','$j','$m','$reviewer1_status','$reviewer2_status')") or die(mysql_error());
        for ($i = 0; $i < sizeof($checkBox); $i++) {
            $insert = mysql_query("INSERT INTO tbl_reviews(emp_file_no,competence_id,submitted_date)"
                    . "values('$employeeid','$checkBox[$i]','$date_of_date')") or die(mysql_error());
            
            $insertt = mysql_query("INSERT INTO tbl_appraisal_results(emp_file_no,competence_id,submitted_date)"
                    . "values('$employeeid','$checkBox[$i]','$date_of_date')") or die(mysql_error());
        }
        if ($appraisal) {
            /////////////////////Employee reviewer 1//////////////////
            if (!empty($reviewer1)) {
                $employeename = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employeeid'") or die(mysql_error());
                $t = mysql_fetch_array($employeename);
                $attachname = $t['first_name'] . ' ' . $t['surname'];
                $rselect = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$reviewer1'") or die(mysql_error());
                $rn = mysql_fetch_array($rselect);
                $revname = $t['first_name'];
//                $subjecting = 'Assessment initiate notification';
                $links = '<a href="www.daimainfotech.com/index.php" target="_blank">here</a>';
                $content = 'Please be advised that an employee appraisal has been initiated for ' . $attachname . ' on ' . $date_of_date . ' and an email notification has also been sent to the employee informing them about the appraisal.'
                        . 'The employee will need to review the appraisal and return it to you. Once your employee completes the self review you will receive a review notification and can review and rate the employee.';
                $to = $j;
                $subject = 'Assessment initiate notification';
                $from = 'joaqim@sincrositewatch.com';

                // To send HTML mail, the Content-type header must be set
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                // Create email headers

                $headers .= 'From: ' . $from . "\r\n" .
                        'Reply-To: ' . $from . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                // Compose a simple HTML email message
                $message = '<html><body>';
                $message .= '<p>Hi, ' . $revname . '</p>';
                $message .= '<p>' . $content . '</p>';
                $message .= '<p>* If you are not able to click on the link, you can copy and paste the following address into your web browser:</p>';
                $message .= '<p>http://www.daimainfotech.com/index.php</p>';
                $message .= '</body></html>';
                mail($to, $subject, $message, $headers);
            }
            if ($reviewer2) {
                $employeename = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employeeid'") or die(mysql_error());
                $t = mysql_fetch_array($employeename);
                $attachname = $t['first_name'] . ' ' . $t['surname'];
//                $subjecting = 'Assessment initiate notification';
                $links = '<a href="www.daimainfotech.com/index.php" target="_blank">here</a>';
                $content = 'Please be advised that an employee appraisal has been initiated for ' . $attachname . ' on ' . $date_of_date . ' and an email notification has also been sent to the employee informing them about the appraisal.'
                .'The employee will need to review the appraisal and return it to you. Once your employee completes the self review you will receive a review notification and can review and rate the employee.';
                $rselectt = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$reviewer1'") or die(mysql_error());
                $rn = mysql_fetch_array($rselectt);
                $revnamee = $t['first_name'];

                $to = $m;
                $subject = 'Assessment initiate notification';
                $from = 'joaqim@sincrositewatch.com';

                // To send HTML mail, the Content-type header must be set
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                // Create email headers

                $headers .= 'From: ' . $from . "\r\n" .
                        'Reply-To: ' . $from . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                // Compose a simple HTML email message
                $message = '<html><body>';
                $message .= '<p>Hi, ' . $revnamee . '</p>';
                $message .= '<p>' . $content . '</p>';
                $message .= '<p>* If you are not able to click on the link, you can copy and paste the following address into your web browser:</p>';
                $message .= '<p>www.daimainfotech.com/index.php</p>';
                $message .= '</body></html>';
                mail($to, $subject, $message, $headers);
            }
            /////////////////////////////////////////////////////////////
            if ($employeeid) {
                $employe = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employeeid'") or die(mysql_error());
                $tt = mysql_fetch_array($employe);
                $attachnames = $tt['first_name'].' '.$tt['surname'];;
                
                
                $employeename = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no2'") or die(mysql_error());
                $t = mysql_fetch_array($employeename);
                $attachname = $t['first_name'] . ' ' . $t['surname'];
//                $subjecting = 'Assessment initiate notification';
                $links = '<a href="http://www.daimainfotech.com/index.php" target="_blank">here</a>';
                $content = 'Please be advised that ' . $attachname . ' has initiated an employee appraisal for you on ' . $date_of_date . '.
                You will need to review the appraisal and return it to your Initiator. Once you have completed the self review, your Initiator will receive review notification and can then review and rate your appraisal.
                The PDF version of the employee appraisal is attached for your attention.
                Click ' . $links . ' to review the appraisal.';
                $to = $emailh;
                $subject = 'Assessment initiate notification';
                $from = 'joaqim@sincrositewatch.com';

                // To send HTML mail, the Content-type header must be set
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                // Create email headers

                $headers .= 'From: ' . $from . "\r\n" .
                        'Reply-To: ' . $from . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                // Compose a simple HTML email message
                $message = '<html><body>';
                $message .= '<p>Hi, ' . $attachnames . '</p>';
                $message .= '<p>' . $content . '</p>';
                $message .= '<p>* If you are not able to click on the link, you can copy and paste the following address into your web browser:</p>';
                $message .= '<p>http://www.daimainfotech.com/index.php</p>';
                $message .= '</body></html>';
                mail($to, $subject, $message, $headers);
            }
            //////////////////////////////////////////////////////////////
            ///////////////////////////////////////////////////////////////
        }
        echo '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Thank You! Your information will be send to the Management</strong>
</div>';
    }
}
?>

<div class="bg-white shadow" style="width: 100%;">
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="view_appraisal"><i class="icon-home fg-blue"></i>&nbsp;Home</a>
            </li>
            <li>
                <a class="" href="add_appraisal" class="fg-hover-crimson fg-cobalt">
                    <i class="icon-plus-2 fg-cobalt fg-hover-crimson"></i>&nbsp; Add New Appraisal</a>
            </li>
            <li id="action">
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" id="btnPrint"><i class="icon-plus-2 fg-cobalt fg-hover-crimson"></i>&nbsp; Preview</a>
            </li>
            <li>
                <a class="" href="?action=view_appraisal"><i class="icon-reply-2 fg-green"></i></a>                 
            </li>

        </ul>
    </nav>
</div>
<div class="container" >
    <form action="add_appraisal&initiatedby=<?php echo $_SESSION['emp_file_no']; ?>" method="POST">
        <fieldset>
            <legend><center>Employee Performance Appraisal</center></legend>

            <div class="row">

                <div class="span2 text-right">
                    <label>Employee Name:</label>
                </div>
                <div class="span5">                                                             
                    <div class="input-control select" data-role="input-control">
                        <select  name="employeeid">
                            <option value="">--select---</option>
                            <?php
                            $a = mysql_query("SELECT * FROM tbl_employee") or die(mysql_error());
                            while ($b = mysql_fetch_array($a)) {
                                $first_name = $b['first_name'];
                                $surname = $b['surname'];
                                $employeeid = $b['emp_file_no'];
                                ?>
                                <option  value="<?php echo $employeeid; ?>"><?php echo $first_name . '&nbsp;' . $surname; ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="span2 text-right">
                    <label>Initiated Date:</label>
                </div>
                <div class="span5">                                                             
                    <div class="input-control text" data-role="datepicker" data-week-start="1">
                        <input readonly="readonly" name="initiated_date" type="text">
                        <button type="button" class="btn-date"></button>
                        <div class="calendar calendar-dropdown" style="position: absolute; display: none; max-width: 300px; z-index: 1000; top: 100%; left: 0px;"><table class="bordered"><tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">March 2015</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td><td class="text-center day-of-week">Su</td></tr><tr><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="text-center day"><a href="#">1</a></td></tr><tr><td class="text-center day"><a href="#">2</a></td><td class="text-center day"><a href="#">3</a></td><td class="text-center day today"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td></tr><tr><td class="text-center day"><a href="#">9</a></td><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a href="#">13</a></td><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td></tr><tr><td class="text-center day"><a href="#">16</a></td><td class="text-center day"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td></tr><tr><td class="text-center day"><a href="#">23</a></td><td class="text-center day"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td><td class="text-center day"><a href="#">28</a></td><td class="text-center day"><a href="#">29</a></td></tr><tr><td class="text-center day"><a href="#">30</a></td><td class="text-center day"><a href="#">31</a></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td></tr></tbody></table></div></div>
                </div>


            </div>
            <div class="row">                                  
                <div class="span2 text-right">
                    <label>Reviewer1:</label>
                </div>
                <div class="span5">                                          
                    <div class="input-control select" data-role="input-control">
                        <select name="reviewer1">
                            <option value="">--select---</option>
                            <?php
                            $a = mysql_query("SELECT * FROM tbl_employee") or die(mysql_error());
                            while ($b = mysql_fetch_array($a)) {
                                $first_name = $b['first_name'];
                                $surname = $b['surname'];
                                $emp_file_no1 = $b['emp_file_no'];
                                ?>
                                <option  value="<?php echo $emp_file_no1; ?>"><?php echo $first_name . '&nbsp;' . $surname; ?></option>

                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="span2 text-right">
                    <label>Reviewer2:</label>
                </div>
                <div class="span5">                                          
                    <div class="input-control select" data-role="input-control">
                        <select name="reviewer2">
                            <option value="">--select---</option>
                            <?php
                            $a = mysql_query("SELECT * FROM tbl_employee") or die(mysql_error());
                            while ($b = mysql_fetch_array($a)) {
                                $first_name = $b['first_name'];
                                $surname = $b['surname'];
                                $emp_file_no2 = $b['emp_file_no'];
                                ?>
                                <option  value="<?php echo $emp_file_no2; ?>"><?php echo $first_name . '&nbsp;' . $surname; ?></option>

                            <?php } ?>


                        </select>
                    </div>
                </div>
            </div>                               
            <legend><center>Employee Competencies&nbsp <button class="primary"><a href="#">Add New Competence</a></button></center></legend>

            <div class="row" style="height:500px; overflow-y:scroll;border: 1px solid #979797">

                <table class="table striped bordered hovered">
                    <thead class="">
                        <tr>
                            <th class="text-left">Competence name</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Remove</th>                                               
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        include 'db.php';
                        $compentance = mysql_query("SELECT * FROM tbl_competence") or die(mysql_error());
                        while ($show = mysql_fetch_array($compentance)) {
                            $competence_id = $show['competence_id'];
                            $competance_name = $show['competance_name'];
                            $description = $show['description'];
                            ?>
                            <tr class=""><td class="text-bold"><?php echo $competance_name; ?></td>
                                <td class="right"><?php echo $description; ?></td>
                                <td class="right">
                                    <label class="inline-block">
                                        <input  checked="" type="checkbox" name="checkbox[]" value="<?php echo $competence_id; ?>">
                                        <span class="check"></span>
                                    </label>
                                </td>
                            </tr> 
                        <?php } ?>


                    </tbody>
                </table>

            </div>

            <div class="row" style="margin-top: 10px;">                               
                <div class="span4 offset5">
                    <input class="span4 primary large" value="Initiate" name="add_appraisal" type="submit">
                </div>

            </div>                                

        </fieldset>
    </form>
</div>


