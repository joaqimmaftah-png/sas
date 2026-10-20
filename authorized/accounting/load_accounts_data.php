<?php
require_once __DIR__ . '/../../mysql_compat.php';


include_once '../db.php';
$query = "SELECT * FROM tbl_accounts_sheets ORDER BY sheet_id DESC";
$resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($rrow = mysql_fetch_array($resultT, MYSQL_ASSOC)) {
    $stock[] = array(  
        'check'=>'<input type="checkbox" name="" onchange="gotoaction(this.value)" value="'.$rrow['sheet_id'].'">',
        'sn'=>$rrow['sn'],
        'date'=>$rrow['date'],
        'clients'=>$rrow['clients'],
        'site_name'=>$rrow['site_name'], 
        'site_id'=>$rrow['site_id'],
         'spare_rwork'=>$rrow['spare_rwork'],
         'specification'=>$rrow['specification'],
         'uom'=>$rrow['uom'],
         'qty'=>$rrow['qty'],
        'unit_price_vat_ex'=>$rrow['unit_price_vat_ex'],       
        'total_price_vat_ex'=>$rrow['total_price_vat_ex'],        
        'rq_no'=>$rrow['rq_no'],
        'qt_no'=>$rrow['qt_no'],      
        'tpf_no'=>$rrow['tpf_no'],
        'acc_no'=>$rrow['acc_no'],       
        'po_no'=>$rrow['po_no'],
        'invoice_no'=>$rrow['invoice_no'],
        'pyt_status'=>$rrow['pyt_status'],       
        'recon_batch'=>$rrow['recon_batch']
        
   
    );
}
echo json_encode($stock);
?>
