<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once 'db.php';
$messag = "";
if (!empty($_GET['responsible_id'])) {
    include_once 'db.php';
    if (!empty($_POST['competence'])) {
        $competence = $_POST['competence'];
        $initiatedate = $_POST['initiatedate'];
        $employee_number = $_POST['employee_number'];
        $reviewerr = $_POST['reviewer'];
        $reviewerrr = $_POST['reviewer2'];
        $comment = $_POST['comment'];
        $submit = date("D m, Y");

        ////////////////////////////////////////////////
        $f = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$employee_number'") or die(mysql_error());
        $v = mysql_fetch_array($f);
        $emailh = $v['email'];

        //////////////////////////////////////////////
        $h = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$reviewerr'") or die(mysql_error());
        $i = mysql_fetch_array($h);
        $j = $i['email'];
        //////////////////////////////////////////////
        $k = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$reviewerrr'") or die(mysql_error());
        $l = mysql_fetch_array($k);
        $m = $l['email'];
////////////////////////////////////////////////////
        if ($_GET['responsible_id'] == $_POST['reviewer']) {
            for ($i = 0; $i < sizeof($competence); $i++) {
                $insert = mysql_query("UPDATE tbl_appraisal_results SET comments='$comment[$i]' WHERE competence_id='$competence[$i]' AND reviewer='$reviewerr'");
            }
        }
        if ($_GET['responsible_id'] == $_POST['reviewer2']) {
            for ($i = 0; $i < sizeof($competence); $i++) {
                $insert = mysql_query("UPDATE tbl_appraisal_results SET comments2='$comment[$i]' WHERE competence_id='$competence[$i]' AND reviewer2='$reviewerrr'");
            }
        }
                        if ($insert) {
                    if ($employee_number) {
                        $employe = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employee_number'") or die(mysql_error());
                        $tt = mysql_fetch_array($employe);
                        $attachnames = $tt['first_name'] . ' ' . $tt['surname'];

                        $content = 'Please be advised that now you have completed the review of the appraisal on ' . $submit . ' an email notification has been sent to your initiator informing him/her about the appraisal. '
                                . 'The Initiator can now review and rate your appraisal.';
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
                        $message .= '<p>Link goes hire</p>';
                        $message .= '</body></html>';
                        mail($to, $subject, $message, $headers);
//                          
//                          
//                        $message='<div class="alert alert-success">
//<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
//<strong> Thank You! Your information will be send to the Management</strong>
//</div>';
                    } if ($reviewerr) {
                        $employ = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employee_number'") or die(mysql_error());
                        $z = mysql_fetch_array($employ);
                        $kamunya = $z['first_name'] . ' ' . $z['surname'];

                        $content = 'Please be advised that ' . $kamunya . ' has completed the review of the employee appraisal on ' . $submit . '.'
                                . '<p>Click here to review and rate the appraisal.</p>';
                        $to = $j;
                        $subject = 'Assessment review notification';
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
                        $message .= '<p>Link goes hire</p>';
                        $message .= '</body></html>';
                        mail($to, $subject, $message, $headers);


//                        $message='<div class="alert alert-success">
//<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
//<strong> Thank You! Your information will be send to the Management</strong>
//</div>';  
                    }
                    if ($reviewerrr) {
                        $employ = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employee_number'") or die(mysql_error());
                        $z = mysql_fetch_array($employ);
                        $kamunya = $z['first_name'] . ' ' . $z['surname'];
                        $content = 'Please be advised that ' . $kamunya . ' has completed the review of the employee appraisal on ' . $submit . '.'
                                . '<p>Click here to review and rate the appraisal.</p>';
                        $to = $m;
                        $subject = 'Assessment review notification';
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
                        $message .= '</body></html>';
                        mail($to, $subject, $message, $headers);
                    }
           $messag='<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Thank You! Your information Saved</strong>
</div>'; 
        
        
        
                        }   
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="product" content="Metro UI CSS Framework">
        <meta name="description" content="Simple responsive css framework">
        <meta name="author" content="Sergey S. Pimenov, Ukraine, Kiev">
        <meta name="keywords" content="js, css, metro, framework, windows 8, metro ui">

        <script type="text/javascript" src="jxquery/jquery.min1.js"></script>

        <script type="text/javascript">
            $("#print").live("click", function () {
                var divContents = $("#show").html();
                var printWindow = window.open('', '', 'height=600,width=900');
                printWindow.document.write('<html><head><title>Payslip|sincrositewatch Ltd</title>');
                printWindow.document.write('</head><body >');
                printWindow.document.write(divContents);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            });



        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('.error').delay(5000).fadeOut('normal');
                $('.success').delay(4000).fadeOut('normal');
            });
        </script>
        <link href="../css/metro-bootstrap.css" rel="stylesheet">
        <link href="../css/metro-bootstrap-responsive.css" rel="stylesheet">
        <link href="../css/iconFont.css" rel="stylesheet">
        <link href="../css/docs.css" rel="stylesheet">       
        <link href="../js/prettify/prettify.css" rel="stylesheet">
        <!-- Load JavaScript Libraries -->
        <script src="../js/jquery/jquery.min.js"></script>                    
        <script src="../js/jquery/jquery.widget.min.js"></script>
        <script src="../js/jquery/jquery.mousewheel.js"></script>
        <script src="../js/metro/metro-input-control.js"></script>
        <script src="../js/prettify/prettify.js"></script>       
        <!-- Metro UI CSS JavaScript plugins -->
        <script src="../js/load-metro.js"></script>



        <!-- Local JavaScript -->
        <script src="../js/docs.js"></script>
        <script src="../js/script1.js"></script>
        <script src="../js/github.info.js"></script>
        <link href="../datable/jquery.dataTables.css" rel="stylesheet">
        <script src="../datable/jquery.dataTables.js"></script>

        <title>HRMIS | Sincro Automation System</title>

    </head>
    <body class="metro" style="background-color: #efeae3;">

        <div class="navigation-bar shadow fixed-top">
            <div class="navigation-bar-content">
                <a href="/" class="element fg-black"><span class="icon-grid-view"></span>&nbsp;SINCRO AUTOMATION SYSTEM<sup>HR V1.0</sup></a>


            </div>
        </div>

        <div class="container-desktop" style=" margin-top: 4%;">
            <div class="container">
<?php
echo $messag;
?>
            </div>
            <div class="grid">

                <div class="row" style="margin-left:8px; margin-right: 6px;" >
                    <div class="container" style="margin-left: 10%;margin-top:9px;" >
                        <div style="width: 1000px; height: 113px;">
                            <div style="float: left;">
                                <address>
                                    <strong>SINCROSITEWATCH LTD</strong><br />
                                    P.O Box 1027,<br>
                                    Dar es Salaam.<br>
                                    <abbr title="Phone">P:</abbr> (123) 456-7890
                                </address>
                            </div>
                            <div style="float: right;">
                                <img src="images/logoo.png" style="width: 120px; height: 110px;">
                            </div>
                        </div>
                        <div style="width: 1000px; height: 100px; background-color: #61AA50;">
                            <img src="images/header1.png" style="width: 100%; height: 100px;">
                        </div>
                        <div style="width: 1000px; height: 30px; margin-top: 5px; background-color: #315589;">

                        </div>
<?php
$w = mysql_query("SELECT * FROM tbl_appraisal WHERE Appraisal_id=" . $_GET['Appraisal_id'] . "") or die(mysql_error());
$h = mysql_fetch_array($w);
$emp_file_no = $h['emp_file_no'];
$i = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
$j = mysql_fetch_array($i);
$jna = $j['first_name'] . ',' . $j['surname'];
?>
                        <div style="width: 1000px;">
                            <center><h2>(Manager initiated)</h2></center>
                            <center><h2><strong><?php echo $jna; ?></strong></h2></center>
                            <h3><strong>Employee Competencies</strong></h3>
                            <p>
                                Rate the employee's capability or knowledge in the following areas in terms of their current role requirement.
                                As appropriate, please provide in writing examples to support your assessment.
                            </p><hr>
                        </div>
                        <form action="previews_appraisal.php?responsible_id=<?php echo $_GET['responsible_id']; ?>&Appraisal_id=<?php echo $_GET['Appraisal_id']; ?>" method="POST">
<?php
$A = mysql_query("SELECT * FROM tbl_reviews WHERE emp_file_no='$emp_file_no'") or die(mysql_error());
while ($row = mysql_fetch_array($A)) {
    $review_id = $row['review_id'];
    $competence_id = $row['competence_id'];
    $submitted_date = $row['submitted_date'];
    $emp_file_no = $row['emp_file_no'];

    $q = mysql_query("SELECT * FROM tbl_appraisal WHERE initiated_date='$submitted_date' AND emp_file_no='$emp_file_no'") or die(mysql_error());
    $w = mysql_fetch_array($q);
    $employee = $w['emp_file_no'];
    $reviewer = $w['reviewer'];
    $reviewer2 = $w['reviewer2'];
    $B = mysql_query("SELECT * FROM tbl_competence WHERE competence_id='$competence_id'") or die(mysql_error());
    $r = mysql_fetch_array($B);
    $competance_name = $r['competance_name'];
    $description = $r['description'];
    ?>
                                <div style="width: 1000px;">
                                    <div style="width: 1000px; background-color: #5B5B5D; color: white; padding: 4px;">
                                        <strong><?php echo $competance_name; ?></strong>
                                    </div>
                                    <div style="width: 688px; float: left; ">
                                        <p style="float: left;">
    <?php echo $description; ?>
                                        </p>

                                        <p>Comments:</p>
                                        <p>
                                            <input type="hidden" name="reviewer" value="<?php echo $reviewer; ?>">
                                            <input type="hidden" name="reviewer2" value="<?php echo $reviewer2; ?>">
                                            <input type="hidden" name="employee_number" value="<?php echo $employee; ?>">
                                            <input type="hidden" name="initiatedate" value="<?php echo $submitted_date; ?>">
                                            <input type="hidden" name="competence[]" value="<?php echo $competence_id; ?>">

                                            <textarea style="width: 650px;"  name="comment[]">                                  
                                            </textarea>
                                        <hr>
                                        </p>   
                                    </div>
                                    <div style="width: 310px; float: right; padding-left: 2px;">
                                        <p>
                                        <table style="background-color: transparent">
    <?php
    $p = mysql_query("SELECT * FROM tbl_appraisal_weight_factor") or die(mysql_error());
    while ($g = mysql_fetch_array($p)) {
        $weigh_factor = $g['weigh_factor'];
        $weigh_id = $g['weigh_id'];
        $select_result_factor = mysql_query("SELECT * FROM tbl_appraisal_results WHERE weight_reviewer='$weigh_id' AND emp_file_no='$employee' AND competence_id='$competence_id'") or die(mysql_error());
        $B = mysql_fetch_array($select_result_factor);
        $weight_reviewer = $B['weight_reviewer'];
        $competence_idd = $B['competence_id'];
        if ($weight_reviewer ==$weigh_id AND $competence_idd ==$competence_id) {
            $remark = 'checked=""';
        } else {
            $remark = '';
        }
        ?>
                                                <tr>
                                                    <td>                   
                                                        <input  type="checkbox" disabled="" name="checkbox[]" <?php echo $remark; ?> value="<?php echo $weigh_id; ?>">
                                                        <span class="check"></span>

                                                    </td>
                                                    <td><?php echo $weigh_factor; ?></td>
                                                </tr> 
        <?php
    }
    ?>
                                        </table>
                                        </p>
                                    </div>
                                    <div style="clear: both;"></div>
                                </div>
    <?php
}
?>
                            <input type="submit" name="submit" value="submit Results">
                        </form>


                    </div>
                </div>
            </div>
        </div>
       
        <link href="../js/bootstrap.min.css" rel="stylesheet">  
        <script src="../js/bootstrap.min.js"></script>
        <!-- <link href="js/modalkubwa.css" rel="stylesheet">-->

    </body>
</html>