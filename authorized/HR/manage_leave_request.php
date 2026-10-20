<head>
    <script>
            function rejection(url) {
            $('#call_rejection').fadeOut(50, function () {
                $('#call_rejection').load(url);
                $('#call_rejection').fadeIn(50, function () {
                });
            });
        }
        function approved(url) {
            $('#call_approving').fadeOut(50, function () {
                $('#call_approving').load(url);
                $('#call_approving').fadeIn(50, function () {
                });
            });
        }
    </script>
</head>

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
                <th class="text-left">Approve/Reject</th>
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
require_once __DIR__ . '/../../mysql_compat.php';

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
                $hrm_comment=$row['hrm_comment'];
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
                    <td class="text-center">
                                                                           <nav class="vertical-menu compact">
        <ul>
            <li>
                <a class=" dropdown-toggle" href="#"></a>
                <ul class="dropdown-menu" data-role="dropdown">
                    <li><a href="#" onclick="approved('authorized/HR/approve_leave.php?leave_id=<?php echo $leave_id;?>')"  data-toggle="modal" data-target="#approve"><i class="icon-user-2"></i>&nbsp;Approve</a></li>
                    <li><a href="#" onclick="rejection('authorized/HR/reject_leave.php?leave_id=<?php echo $leave_id;?>')"  data-toggle="modal" data-target="#reject"><i class="icon-user-3 fg-green"></i>&nbsp;Reject</a></li>
     
                </ul>
            </li>          
        </ul>
    </nav>
                        
                    </td>
                    <td class="right"><?php echo $emp_file_no; ?></td>
                    <td class="right"><?php echo $fullname; ?></td>
                    <td class="right"><?php echo $leave_typee; ?></td>
                    <td class="right"><?php echo $start_date; ?></td>
                    <td class="right"><?php echo $end_date; ?></td>                   
                    <td class="right"><?php echo $no_of_days; ?></td>                                      
                    <td class="right"><a href="#"><?php echo $fs_status; ?></a></td>
                    <td class="right"><a href="#"><?php echo $hod_status; ?></a></td>
                    <td class="right">
                         <?php
                                                    if(empty($hrm_comment)){                                                                                                          
                                                    ?>
                                                    <a href="#"><?php echo $hrm_status; ?></a>
                                                    <?php
                                                    }else{
                                                        echo $hrm_comment; 
                                                    }
                                                    ?>
                        
                        
                        </td>
                </tr> 
            <?php } ?> 
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="approve" class="modal fade" role="dialog">
   <div class="modal-dialog">

    <!-- Modal content-->
   <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">Approve Leave Request</h4>
</div>
<div class="modal-body">
    <div id="call_approving">
        
    </div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancel</button>
</div>
</div>
   </div>

  </div>
</div>
<!-- Reject -->
<div id="reject" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
   <div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">Reject Leave Request</h4>
</div>
<div class="modal-body">
    <div id="call_rejection">
        
    </div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancel</button>
</div>
</div>
   </div>

  </div>
</div>


