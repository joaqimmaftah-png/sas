                                                                            



<head>

    <script>
        $(document).ready(function (e) {
            /////////////////
            $("#pastemployeedit").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "view/add_employment_history.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#showeditings").html(data);
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
include '../model/db.php';
$select_asset = mysql_query("SELECT * FROM tbl_employment_history WHERE history_id='".$_GET['history_id']."'") or die(mysql_error());
$roww = mysql_fetch_array($select_asset);
$history_id = $roww['history_id'];
$company_name = $roww['company_name'];
$department = $roww['department'];
$position = $roww['position'];
$start_date = $roww['start_date'];
$end_date = $roww['end_date'];
$role = $roww['role'];
?>                                


<div id="showeditings">

</div>
<form role="form" id="pastemployeedit" method="Post">
    <input  type="hidden" class="form-control" value="<?php echo $history_id; ?>"  name="history_update">

    <div class="form-group">
        <label for="email">Company*:</label>
        <input type="text" class="form-control" name="comname" value="<?php echo $company_name; ?>">
    </div>
    <div class="form-group">
        <label for="pwd">Start Date:</label>
        <input type="text" class="form-control" name="sdatee" value="<?php echo $start_date; ?>">
    </div>
    <div class="form-group">
        <label for="pwd">End Date:</label>
        <input type="text" class="form-control" name="enddate" value="<?php echo $end_date; ?>">
    </div>
    <div class="form-group">
        <label for="pwd">Department:</label>
        <input type="text" class="form-control" name="department" value="<?php echo $department; ?>">
    </div>
    <div class="form-group">
        <label for="pwd">Position:</label>
        <input type="text" class="form-control" name="position" value="<?php echo $position; ?>">
    </div>
    <div class="form-group">
        <label for="pwd">Role:</label>
        <input type="text" class="form-control" name="role" value="<?php echo $role; ?>">
    </div>
    <input type="submit"  class="btn btn-default" value="Submit Data">
</form>