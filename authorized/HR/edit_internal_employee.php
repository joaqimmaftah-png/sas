<!--<div class="bg-white shadow" style="width: 100%;" >
                            <nav class="horizontal-menu compact">
                                <ul>
                                    <li>
                                        <a  href="#" onclick="getdelete('authorized/HR/delete_education.php?deleteit=<?php
require_once __DIR__ . '/../../mysql_compat.php';
 echo $_GET['q'];?>')"><i class="icon-cancel  fg-blue"></i>&nbsp;Delete</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>-->

<head>
    
        <script>
        $(document).ready(function (e) {
                  /////////////////
            $("#editinternalemployee").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/HR/internal_employment.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#showmessages").html(data);
                    },
                    error: function () {
                    }
                });
            }));

    ////////////////////////
                });
    </script>
</head>

<?php
include_once __DIR__ . '/../db.php';
 $internal = mysql_query("SELECT * FROM tbl_internal_employment WHERE internal_id='".$_GET['internal']."'") or die(mysql_error());
                                              $ee = mysql_fetch_array($internal);
//                                                    $internal_id = $ee['internal_id'];
                                                    $company_loc = $ee['company_loc'];
                                                    $department = $ee['department'];
                                                    $position = $ee['position'];
                                                    $start_date = $ee['start_date'];
                                                    $end_start = $ee['end_start'];
?>

                                          <form role="form" id="editinternalemployee" method="Post">
                                        <input  type="hidden" class="form-control" value="<?php echo $_GET['internal']; ?>"  name="internal">
                                        <input  type="hidden" class="form-control" value="<?php echo $_GET['internal']; ?>"  name="editing">
                                        <div class="form-group">
                                            <label for="email">Company Location:</label>
                                            <input type="text" class="form-control" name="comname" value="<?php echo $company_loc;?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Department:</label>
                                            <input type="text" class="form-control" name="department" value="<?php echo $department;?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Position:</label>
                                            <input type="text" class="form-control" name="position" value="<?php echo $position;?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">Start Date:</label>
                                            <input type="text" class="form-control" name="sdatee" value="<?php echo $start_date;?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="pwd">End Date:</label>
                                            <input type="text" class="form-control" name="enddate" value="<?php echo $end_start;?>">
                                            
                                        </div>

                                        <input type="submit"  class="btn btn-default" name="editing" value="Submit Data">
                                    </form>