
<div class="bg-white shadow" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="?action=view_appraisal"><i class="icon-home fg-blue"></i>&nbsp;Home</a>
            </li>
                        <li>
                <a class="" href="?action=add_appraisal" class="fg-hover-crimson fg-cobalt"><i class="icon-plus-2 fg-cobalt fg-hover-crimson"></i>&nbsp; Initiate Employee Appraisal</a>
            </li>
             <li id="action">
<!--               show data-->
            </li>
                        <li>
                <a class="" href="?action=view_appraisal"><i class="icon-reply-2 fg-green"></i></a>                 
            </li>
                        
        </ul>
    </nav>
</div>
<div class="margin5"> 
    <table id="example" class="display  striped bordered table hovered" width="100%" cellspacing="0">
        <thead>
            <tr class="info">
                <th class="text-left">Employee ID</th>
                <th class="text-left">Employee Name</th>
                <th class="text-left">Reviewer1</th>
                 <th class="text-left">Reviewer2</th>
                <th class="text-left">Initiated date</th>
                <th class="text-left">Initiated by</th>
                <th class="text-left">Status</th>                                                 
            </tr>
        </thead>

        <tbody>
            <?php
            include 'authorized/db.php';
            $tbl_attendence = mysql_query("SELECT * FROM tbl_appraisal")or die(mysql_error());
            while ($row = mysql_fetch_array($tbl_attendence)) {
                $reviewer = $row['reviewer'];
                $reviewer2 = $row['reviewer2'];
                $initiated_date=$row['initiated_date'];
                $initiated_by=$row['initiated_by'];
                $status = $row['status'];
                $emp_file_no = $row['emp_file_no'];
 
                $k =mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'")or die(mysql_error());
                $majina1 = mysql_fetch_array($k);
                $firstname = $majina1['first_name'];
                $sirname = $majina1['surname'];
                $fullname2 = $firstname . " " . $sirname;
                ?>
                <tr class="">
                    <td><?php echo $emp_file_no; ?></td>
                    <td class="right"><?php echo $fullname2; ?></td>
                    <td class="right"><?php echo $reviewer; ?></td>
                    <td class="right"><?php echo $reviewer2; ?></td>
                    <td class="right"><?php echo $initiated_date; ?></td>
                    <td class="right"><?php echo $initiated_by; ?></td>                   
                    <td class="right"><?php echo $status ?></td>
                   
                </tr> 
            <?php } ?>
        </tbody>
    </table>
</div>
