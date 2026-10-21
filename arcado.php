<?php
require_once __DIR__ . '/mysql_compat.php';

require_once __DIR__ . '/db.php';
 $query = "SELECT * FROM format_date";
    $resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
    
    while ($rrow = mysql_fetch_array($resultT, MYSQL_ASSOC)) {
    $attendence_id=$rrow['date'];
?>

 <table>
    <td>
        <?php
        echo date('Ymd', strtotime($attendence_id));
        ?>
    </td>
    </table>
    
    
    
    <?php
    }
    ?>

