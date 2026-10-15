<a class="" href="#" data-toggle="modal" data-target="#approving">Approve</a>
<a class="" href="#" data-toggle="modal" data-target="#declain">Decline</a>
<?php
include_once '../db.php';
$a=  mysql_query("SELECT * FROM tbl_leaves WHERE leave_id='".$_GET['q']."'") or die(mysql_error());
$b=  mysql_fetch_array($a);
$emp_file_no=$b['emp_file_no'];

$personalinfo = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emp_file_no'")or die(mysql_error());
$PERSON = mysql_fetch_array($personalinfo);
$first_name = $PERSON['first_name'];
$surname = $PERSON['surname'];


?>
<!-- Modal -->
<div id="declain" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Decline Reason</div> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                     <div id="notifing">
                        
                    </div>
                        
                        <form  action="?action=decline" method="post">
                            <div class="form-group">
                                <label for="name">Employee Name:</label>
                                <input disabled="" type="text"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden" class="form-control" value="<?php echo $_GET['q']; ?>" id="declineid" name="declineid">
                            </div>
                            <div class="form-group">
                                <label for="education">Reasons</label>
                                <input type="text" class="form-control" id="reasons" name="reason" >
                            </div>                           
                            <input type="submit" name="declane"  value="Submit Data"/>    
                            
                        </form>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
    </div>
<!-------------------------------------------------model approve------------------------------------------------------->
<div id="approving" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Approve Leave Request</div> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                     <div id="notifing">
                        
                    </div>
                        
                        <form  action="?action=approve_leave" method="post">
                            <div class="form-group">
                                <label for="name">Employee Name:</label>
                                <input disabled="" type="text"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden"  class="form-control" value="<?php echo $first_name . ' ' . $surname; ?>" id="name" name="name">
                                <input  type="hidden" class="form-control" value="<?php echo $_GET['q']; ?>" id="declineid" name="declineid">
                            </div>
                            <div class="form-group">
                                <label for="education">Note</label>
                                <input type="text" class="form-control" id="reasons" name="reason" >
                            </div>                           
                            <input type="submit" name="approve_leave"  value="Click to Approve"/>    
                            
                        </form>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
    </div>