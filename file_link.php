<?php

if (isset($_GET['action'])) { 
    ///////////////////call apage//////////////////////
     if ($_GET['action'] == 'home_file') {
        include_once 'authorized/file_management.php';
    } 
    if ($_GET['action'] == 'home_asset') {
        include_once 'authorized/asset_tracker/asset_tracker.php';
    } 
    elseif ($_GET['action'] == 'asset') {
        include_once 'authorized/asset_tracker/list_site.php';
    } 

}
?>
