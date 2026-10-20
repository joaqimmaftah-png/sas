<?php
require_once __DIR__ . '/../../mysql_compat.php';

include '../db.php';

$data=$_GET['q'];
$mee=  mysql_query("SELECT * FROM  tbl_site_db WHERE site_id LIKE '%$data%'") or die(mysql_error());
while ($roww = mysql_fetch_array($mee)) {
    $site_id=$roww['site_id'];

?>



<li><a href="#" onclick="search_site('sincro.php?action=sitedb&siteid=<?php echo $site_id; ?>')"><?php echo $site_id;?></a></li>
<?php
}
?>

