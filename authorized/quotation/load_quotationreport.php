<?php
include_once '../db.php';
$result = mysql_query("SELECT * FROM tbl_preparedquotation ORDER BY Quotation_id DESC")or die(mysql_error());

//get data and store in a json array
$u=1;
while ($rrow = mysql_fetch_array($result)) {
    $vta1=$rrow['Vat'];
    $rdi=$rrow['customer_id'];
           $customer=mysql_query("SELECT * FROM quotation_customer WHERE customer_id='$rdi'") or die(mysql_error());
           $ng=mysql_fetch_array($customer);
           
           $quot=$rrow['Quotation_id'];
           $ser=mysql_query("SELECT * FROM `tblinvoice` WHERE Quotation_id='$quot'")or die(mysql_error());
           $serw=  mysql_fetch_array($ser);
           
           $invid=$serw['Invoice_id'];
           $res=  mysql_query("SELECT * FROM `tblinvoice_item` WHERE Invoice_id='$invid'")or die(mysql_error());
           $resT=  mysql_fetch_array($res);
           
            $resul = mysql_query("SELECT * FROM `tbl_quotationitem` WHERE Quotation_id='$quot'")or die(mysql_error());
  $resulz = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$quot'")or die(mysql_error());
  $erweTz=  mysql_fetch_array($resulz);
  $tnumber= mysql_numrows($resul);
   if($tnumber>0){
        $vat=$erweTz['SUM(Net_Price)']*($vta1/100);
  $gradtotal=$erweTz['SUM(Net_Price)']+$vat;
  $totalvatexcl=$erweTz['SUM(Net_Price)'];
   }
 else {
        
  $gradtotal=$rrow['Amount_vat_inc'];
  $totalvatexcl=$rrow['Amount_vat_exc'];
  $vat=$gradtotal-$totalvatexcl;
   }
           
           
          
    $stock[] = array( 
       
        'Quote_name'=>$rrow['Quotation_name'],
        'SN'=>$u++,
        'customer_name'=>$ng['customer_name'],
        'Quote_number'=>$rrow['Quotation_number'],
        'Quote_date'=>$rrow['Quotation_date'],
        'Invoice_date'=>$serw['Invoice_date'],
        'Invoice_number'=>$serw['Invoice_number'],
        'PO/Approval'=>$rrow['PO/Approval'],
        'Work_status'=>$rrow['Work_status'],
        'Sign off'=>$rrow['Sign_off'],
        'Invoice_description'=>$serw['Invoice_description'],
        'Category'=>$rrow['Category'],
        'Currency'=>$rrow['Currency'],
        'Qt_amount'=>  number_format($gradtotal,2),
        'Amount_Vat_exc'=>  number_format($totalvatexcl,2),
        'Vat'=>number_format($vat,2),
        'Amount_Vat_inc'=>  number_format($gradtotal,2),
        'Tally'=>$rrow['Tally'],
        'EFD_date'=>$rrow['Efd_date'],
        'Payment'=>$rrow['Payment'],
        'WHT'=>$rrow['WHT'],
        'Deduction'=>$rrow['Deduction'],
        'PYT_date'=>$rrow['PYT_date'],
        'Lump_sum'=>$rrow['Lump_sum']
        
    );
}

echo json_encode($stock);

?>

