<?php
require_once __DIR__ . '/../../mysql_compat.php';

          include_once __DIR__ . '/../db.php';

            
            if(isset($_GET['internal'])){
                            $internal = $_GET['internal'];
            $ss = mysql_query("DELETE FROM tbl_internal_employment WHERE internal_id='$internal'") or die(mysql_error());
            echo '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successfull!</strong>Deleted
</div>';
            }
            if(isset($_GET['history_id'])){
                            $history_id = $_GET['history_id'];
            $ss = mysql_query("DELETE FROM tbl_employment_history WHERE history_id='$history_id'") or die(mysql_error());
            echo '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successfull!</strong>Deleted
</div>';
            }
            


