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
            xmlhttp.open("GET", "view/appraisal_action.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>     
</head>
<div class="bg-white shadow" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="view_appraisal"><i class="icon-home fg-blue"></i>&nbsp;Home</a>
            </li>
                        <li>
                <a class="" href="add_appraisal" class="fg-hover-crimson fg-cobalt"><i class="icon-plus-2 fg-cobalt fg-hover-crimson"></i>&nbsp; Add New Appraisal</a>
            </li>
             <li id="action">
<!--               show data-->
            </li>                      
        </ul>
    </nav>
</div>
<div class="margin5"> 
    <table id="table"  class="table table-striped table-hover bordered" width="100%" cellspacing="0">
        <thead>
            <tr class="info">
                 <th class="text-left">Action</th>
                <th class="text-left">Employee ID</th>
                <th class="text-left">Employee Name</th>                              
                <th class="text-left">Initiated date</th>
                <th class="text-left">Initiated by</th>
                <th class="text-left">Reviewer</th> 
                <th class="text-left">Status</th> 
                <th class="text-left">Export/Print</th>
               
               
            </tr>
        </thead>

        <tbody>
            <?php
require_once __DIR__ . '/../../mysql_compat.php';

          
            $tbl_attendence = mysql_query("SELECT * FROM tbl_appraisal where reviewer='" . $_SESSION["emp_file_no"] . "' or reviewer2='" . $_SESSION["emp_file_no"] . "'")or die(mysql_error());
            while ($row = mysql_fetch_array($tbl_attendence)) {
                $reviewer = $row['reviewer'];
                $reviewer2 = $row['reviewer2'];
                $initiated_date=$row['initiated_date'];
                $initiated_by=$row['initiated_by'];
                $nameof_initiator=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$initiated_by'") or die(mysql_error());
                $a=mysql_fetch_array($nameof_initiator);
                $initiator=$a['first_name'].''.$a['surname'];
                
                $rev1=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$reviewer'") or die(mysql_error());
                $b=mysql_fetch_array($rev1);
                $revie1=$b['first_name'].' '.$b['surname'];
                
                $rev2=  mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$reviewer2'") or die(mysql_error());
                $c=mysql_fetch_array($rev2);
                $revie2=$c['first_name'].' '.$c['surname'];
                
                $status =$row['status'];
                $status1=$row['reviewer1_status'];
                $status2=$row['reviewer2_status'];
                $emp_file_no = $row['emp_file_no'];
                $Appraisal_id=$row['Appraisal_id'];
 
                $k =mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'")or die(mysql_error());
                $majina1 = mysql_fetch_array($k);
                $firstname = $majina1['first_name'];
                $sirname = $majina1['surname'];
                $fullname2 = $firstname . "  " . $sirname;
                ?>
                <tr class="">
                     <td class="text-center">
                         <nav class="vertical-menu compact">
        <ul>
            <li>
                <a class="dropdown-toggle" href="#"></a>
                <ul class="dropdown-menu" data-role="dropdown">
                    <li><a href="?action=fill_review&Appraisal_id=<?php echo $Appraisal_id;?>&responsible_id=<?php echo $reviewer;?>"><i class="icon-user-2"></i>&nbsp;Evaluation</a></li>
                    <li><a href="Evaluate&Appraisal_id=<?php echo $Appraisal_id;?>&responsible_id=<?php echo $reviewer;?>"><i class="icon-user-3 fg-green"></i>&nbsp;View</a></li>                                                        
                    <li><a href="#"><i class="icon-file-pdf fg-red"></i>&nbsp;Export to Pdf</a></li>
                </ul>
            </li>          
        </ul>
    </nav>
                    </td>
                    <td><?php echo $emp_file_no; ?></td>
                    <td class="right"><?php echo $fullname2; ?></td>                  
                    <td class="right"><?php echo $initiated_date; ?></td>
                    <td class="right"><?php echo $initiated_by; ?></td> 
                     <?php
                    if($reviewer==$_SESSION["emp_file_no"]){                     
                    
                    ?>
                    <td class="right"><a href="Evaluate&Appraisal_id=<?php echo $Appraisal_id;?>&responsible_id=<?php echo $reviewer;?>"><?php echo $revie1; ?></a></td>
                    <td class="right"><?php echo $status1 ?></td> 
                    <?php
                    }elseif ($reviewer2==$_SESSION["emp_file_no"]) {  
                    ?>
                    <td class="right"><a href="Evaluate&Appraisal_id=<?php echo $Appraisal_id;?>&responsible_id=<?php echo $reviewer2;?>"><?php echo $revie2; ?></a></td>
                    <td class="right"><?php echo $status2 ?></td> 
                        <?php
                    }
                    ?>
                     
                    <td class="right"><i class="icon-file-pdf fg-red"></i></td> 
                </tr> 
            <?php } ?>
        </tbody>
    </table>
</div>
