
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
    <form action="Evaluate&responsible_id=<?php echo $_GET['responsible_id']; ?>" method="POST">
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
            $comments=  mysql_query("SELECT * FROM tbl_appraisal_results WHERE competence_id='$competence_id' AND reviewer='".$_GET['responsible_id']."'") or die(mysql_error());
            $j= mysql_fetch_array($comments);
             $showcomment1=$j['comments'];
            $commentss=  mysql_query("SELECT * FROM tbl_appraisal_results WHERE competence_id='$competence_id' AND reviewer2='".$_GET['responsible_id']."'") or die(mysql_error());
            $i= mysql_fetch_array($commentss);
            $showcomment2=$i['comments2'];
            
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

                        <textarea style="width: 650px;"  name="comment[]" disabled="">
                                      <?php
                                      if($showcomment1){
                                          echo $showcomment1;
                                      }  
                                      else {
                                          echo $showcomment2;
                                        }
                                      
                                      ?>  
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
                            $select_result_factor = mysql_query("SELECT * FROM tbl_appraisal_results WHERE  emp_file_no='$employee' AND competence_id='$competence_id' AND submitted_date='' AND reviewer2=''") or die(mysql_error());
                            $B = mysql_fetch_array($select_result_factor);
                            $r2_weight = $B['r2_weight'];
                            $r2_weight = $B['r2_weight'];
                            $competence_idd = $B['competence_id'];
                            if ($weight_reviewer == $weigh_id AND $competence_idd == $competence_id) {
                                $remark = 'checked=""';
                            } else {
                                $remark = '';
                            }
                            if($r2_weight){
                            ?>
                            <tr>
                                <td>                   
                                    <input  type="checkbox" disabled="" name="checkbox[]" <?php echo $remark; ?> value="<?php echo $weigh_id; ?>">
                                    <span class="check"></span>

                                </td>
                                <td><?php echo $weigh_factor; ?></td>
                            </tr> 
                            <?php
                        }}
                        ?>

                    </table>
                    </p>
                </div>
                <div style="clear: both;"></div>
            </div>
            <?php
        }
        ?>
<!--        <input type="submit" name="submit" value="submit Results">-->
    </form>


</div>



