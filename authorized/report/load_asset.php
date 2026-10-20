<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once '../db.php';

$query = "SELECT * FROM tbl_fixed_asset ORDER BY asset_id DESC";
$resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
//get data and store in a json array
$u=1;
while ($rrow = mysql_fetch_array($resultT, MYSQL_ASSOC)) {
    $rdi=$rrow['cat'];
           $catt=mysql_query("SELECT * FROM tbl_asset_category WHERE cat_id='$rdi'") or die(mysql_error());
           $ng=mysql_fetch_array($catt);
           $category=$ng['category_name'];
    $stock[] = array( 
        'Action'=>$u++,
        'asset_name'=>$rrow['asset_name'],
        'asset_cat'=>$category,       
        'description'=>$rrow['description'],
        'model'=>$rrow['model'],
        'serial_number'=>$rrow['serial_number'],
        'purchase_price'=>$rrow['purchase_price'], 
        'purchase'=>$rrow['purchase'],
        'status'=>$rrow['status']
    );
}
echo json_encode($stock);
?>