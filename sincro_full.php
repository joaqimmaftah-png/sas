<?php
require_once __DIR__ . '/mysql_compat.php';


if (isset($_GET['full'])) {

    if ($_GET['full'] == 'inventory') {
        include_once 'authorized/stock/inventory.php';
    }
    if ($_GET['full'] == 'tbl_stock_holding') {
        include_once 'authorized/stock/tbl_filter_spare_provisions.php';
    } elseif ($_GET['full'] == 'storeparts') {
        include_once 'authorized/stock/manage_storing.php';
    } elseif ($_GET['full'] == 'sent_spare') {
        include_once 'authorized/stock/check_prts_out.php';
    } elseif ($_GET['full'] == 'view_replaced') {
        include_once 'authorized/stock/view_replaced_part.php';
    }elseif ($_GET['full'] == 'manages_request') {
        include_once 'authorized/stock/add_request.php';
    } 
    elseif ($_GET['full'] == 'reconcilation') {
        include_once 'authorized/stock/reconcilation.php';
    } 
        elseif ($_GET['full'] == 'equipments') {
        include_once 'authorized/stock/equipments.php';
    } 
     elseif ($_GET['full'] == 'spare_report') {
        include_once 'authorized/stock/tbl_spare_report.php';
    } 
}
?>

