<?php
require_once __DIR__ . '/mysql_compat.php';

require __DIR__ . '/db_config.php';
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("No database selected");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
date_default_timezone_set("Africa/Nairobi");
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

