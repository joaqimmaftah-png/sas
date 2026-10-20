<?php
require_once __DIR__ . '/mysql_compat.php';
 
//include_once 'authorized/db.php';
//$select=  mysql_query("SELECT DISTINCT part_common_name FROM tbl_store_report") or die(mysql_error()); 
//while ($row = mysql_fetch_array($select)) {
//    $jina=$row['part_common_name'];
//    $a=mysql_query("SELECT SUM(new_quantity),part_common_name FROM tbl_store_report WHERE part_common_name='$jina' ORDER BY storee_id LIMIT 10") or die(mysql_error());
//    $result = mysql_query('SELECT SUM(new_quantity) AS value_sum FROM tbl_store_report'); 
//$row = mysql_fetch_assoc($result); 
//$sum = $row['value_sum'];
//$h=mysql_fetch_array($a,MYSQLI_ASSOC);
//$g=$h['part_common_name'];
//$f=$h['SUM(new_quantity)'];
//$p=round(($f/$sum)*100,1);
//echo $g.",".$p;
//    
//}

?>
<?php
$file = fopen("desktop_browsers_share_dec2011.txt","w");
include_once 'authorized/db.php';
$select=  mysql_query("SELECT DISTINCT part_common_name FROM tbl_store_report") or die(mysql_error()); 
while ($row = mysql_fetch_array($select)) {
    $jina=$row['part_common_name'];
    $a=mysql_query("SELECT SUM(new_quantity),part_common_name FROM tbl_store_report WHERE part_common_name='$jina' ORDER BY storee_id LIMIT 10") or die(mysql_error());
    $result = mysql_query('SELECT SUM(new_quantity) AS value_sum FROM tbl_store_report'); 
$row = mysql_fetch_assoc($result); 
$sum = $row['value_sum'];
$h=mysql_fetch_array($a,MYSQLI_ASSOC);
$g=$h['part_common_name'];
$f=$h['SUM(new_quantity)'];
$p=round(($f/$sum)*100,1);
$weka=$g.','.$p.PHP_EOL;
echo fwrite($file,$weka);

}
fclose($file);
?>

