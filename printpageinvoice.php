<?php
require_once __DIR__ . '/mysql_compat.php';

include 'authorized/db.php';
$Iprin=$_GET['Iprint'];

$sel= mysql_query("SELECT * FROM `tblinvoice` WHERE Invoice_id='$Iprin'")or die(mysql_error());
$seT=  mysql_fetch_array($sel);
$quoid=$seT['Quotation_id'];
$idate=$seT['Invoice_date'];
$inumber=$seT['Invoice_number'];
$idescr=$seT['Invoice_description'];
$vat=$seT['Vat'];
$curr=$seT['Currency'];
$po_refe=$seT['Po_reference'];
$pi_refe=$seT['PFI_reference'];


$selQ= mysql_query("SELECT * FROM `tbl_preparedquotation` WHERE Quotation_id='$quoid'")or die(mysql_error());
$selT= mysql_fetch_array($selQ);
$Quotation_name=$selT['Quotation_name'];
$Quotation_number=$selT['Quotation_number'];
$Quotation_date=$selT['Quotation_date'];
$customid=$selT['customer_id'];
$paymT=$selT['Payment_terms'];
$validT=$selT['Validity'];
$deliveT=$selT['Delivery'];



$naaT=mysql_query("SELECT * FROM `quotation_customer` WHERE customer_id='$customid'")or die(mysql_error());
$nad=  mysql_fetch_array($naaT);
$cusnam=$nad['customer_name'];
$add=$nad['Address'];
$loc=$nad['Location'];
$coun=$nad['Country'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="product" content="Metro UI CSS Framework">
        <meta name="description" content="Simple responsive css framework">
        <meta name="author" content="Sergey S. Pimenov, Ukraine, Kiev">
        <meta name="keywords" content="js, css, metro, framework, windows 8, metro ui ">

        <style type="text/css">

            @media print
            {    
                .noprint, .bottom-menu-wrapper,.menusss *
                {
                    display: none !important;
                    
                }
                
   .footer{
   margin-top: 40px;
   line-height: 4.4px;
   width: 80%;
   margin-left: 50px;
   text-align: center;
} 

.vertical_banner {
    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;              
                line-height: 17.4px;
/*                font-weight: bold;*/
/*    text-align: center;*/
   width: 80%;
    position:relative;
    margin-left: 50px;
    text-align: center;
    
}

                
                
            }
            

            
              td.dataheight{
                height: 150px;
                border-bottom:none;
                border-bottom: 1px solid #FFFFFF;
                
                
            }
            
             td.dataheight3{
                height: 30px;
                border-bottom: 1px solid #FFFFFF;
                
            }
    
            .headerimg{
                width: 100%;
                height:  142px;
                position: relative;

            }
            .logo{
                float: left;
                width: 19%;
                min-height: 140px;

            }
            .logo img{

                width: 60%;
                height: 110px;

            }
            .headcontent{
                float: right;
                width: 79%;
                min-height: 140px;
                 position: relative;
                /*              clear: left;*/
            }
            .listing {
                padding-left: 60%;
                font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;
                font-weight: bold;
                line-height: 20.4px;
            }
            .title{
                padding-left: 40%;
                color: #E2E2E2;
            }
            .tin{
             
             float: left;
             width: 35%;
            
            }
            .tin p{
             font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;              
                line-height: 8.4px;
            }
            .vrn{
             text-align: right;
             float: right;
             width: 40%;
                       
            }
            .clear{
                clear: both;
            }
            .tablediv{
                width: 100%;
                margin-top: 20px;
               min-height: 200px; 
            }
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}


.terms_condition p{
   font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;              
                line-height: 8.4px;
                margin-bottom: 30px;
}
.terms_condition h3{
    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;              
                line-height: 8.4px;
}

.footer{
   margin-top: 200px;
   line-height: 4.4px;
    width: 80%;
    margin-left: 50px;
    text-align: center;
}
.vertical_banner {
    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;              
                line-height: 17.4px;
/*                font-weight: bold;*/
/*    text-align: center;*/
   width: 80%;
    position:relative;
    margin-left: 50px;
    text-align: center;
    
}



        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="headerimg">
                <div class="logo">
                    <img src="assets/invoice.jpg">
                </div>
                <div class="headcontent">
                    <ul class="listing">
                        <li>Generator Manufacturers</li>
                        <li>After Sales Support / Maintenance Contracts</li>
                        <li>Security and Monitoring Systems</li>
                        <li>SSWL Monitoring Software</li>
                        <li>Call Center Support</li>
                    </ul>
                </div>
            </div>

            <div class="title">
                <h3>TAX INVOICE</h3>
            </div>
            <div class="content_center">
                <div class="tin">
                  <p><strong>TIN: 106-703-221</strong></p>
                  <p><?php echo $cusnam;?></p>
                  <p><?php echo $add;?></p>
                  <p><?php echo $loc;?></p>
                  <p><?php echo $coun;?></p>
                </div>
                <div class="vrn">
 <p>Date:&nbsp;&nbsp;&nbsp;<?php echo $idate;?></p>
 <p>Ref:&nbsp;&nbsp;&nbsp;<?php echo $inumber;?></p>
                    
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="tablediv">
                
<table style="width:100%">
    <caption><strong><?php echo $Quotation_name;?></strong></caption>
  <tr>
    <th>SN</th>
    <th>DESCRIPTION</th>
    <th>UNIT</th>
    <th>QTY</th>
     <th>UNIT PRICE(<?php echo $curr;?>)</th>
     <th>NET PRICE(<?php echo $curr;?>)</th>
  </tr>
  
  <?php
  $na= mysql_query("SELECT * FROM `tblinvoice_item` WHERE Invoice_id='$Iprin'")or die(mysql_error());
  $naT= mysql_query("SELECT SUM(Total_Price) FROM `tblinvoice_item` WHERE Invoice_id='$Iprin'")or die(mysql_error());
  $naa= mysql_fetch_array($naT);
  $tnumber= mysql_numrows($na);
  $vat=$naa['SUM(Total_Price)']*($vat/100);
  $grandtotal=$naa['SUM(Total_Price)']+$vat;
  
    if($tnumber<2){
      $height="dataheight";
  }
  else {
      $height="dataheight3";
}
  $u=1;
  while ($maft= mysql_fetch_array($na)){
      
      $invitemid=$maft['invoice_item_id'];
      $descr=$maft['Description'];
      $unit=$maft['Unit'];
      $qty=$maft['Quantity'];
      $unitprice=$maft['Unit_Price'];
      $total=$qty*$unitprice;

  
  ?>
  
  <tr class="databorder" style="min-height: 100px;">
    <td class="<?php echo $height;?>" valign="top"><?php echo $u++;?></td> 
    <td class="<?php echo $height;?>" valign="top"><?php echo $descr;?></td>
    <td class="<?php echo $height;?>" valign="top"><?php echo $unit;?></td>
    <td  class="<?php echo $height;?>" valign="top"><?php echo $qty;?></td>
    <td class="<?php echo $height;?>" valign="top" style=" text-align: right"><?php echo number_format($unitprice,2);?></td>
    <td class="<?php echo $height;?>" valign="top" style=" text-align: right"><?php echo number_format($total,2);?></td>
  </tr>
  
  <?php  
  }
  
  if(!empty($po_refe)){
  ?>
  
   <tr class="databorder" style="min-height: 30px;">
    <td class="dataheight3" valign="top"></td> 
    <td class="dataheight3" valign="top"><?php echo $po_refe;?></td>
    <td class="dataheight3" valign="top"></td>
    <td  class="dataheight3" valign="top"></td>
    <td class="dataheight3" valign="top" style=" text-align: right"></td>
    <td class="dataheight3" valign="top" style=" text-align: right"></td>
  </tr>
  <?php
  }
   if(!empty($pi_refe)){
  ?>
  <tr class="databorder" style="min-height: 30px;">
    <td class="dataheight3" valign="top"></td> 
    <td class="dataheight3" valign="top"><?php echo $pi_refe;?></td>
    <td class="dataheight3" valign="top"></td>
    <td  class="dataheight3" valign="top"></td>
    <td class="dataheight3" valign="top" style=" text-align: right"></td>
    <td class="dataheight3" valign="top" style=" text-align: right"></td>
  </tr>
  <?php
   }
  ?>
  <tr>
      
  </tr>
  <tr>
      <td colspan="4"></td> 
      <td>Sub total</td> 
      <td style=" text-align: right"><?php echo number_format($naa['SUM(Total_Price)'],2); ?></td>
  </tr>
  <tr>
      <td colspan="4"></td> 
      <td>Add Vat 18%</td> 
      <td style=" text-align: right"><?php echo number_format($vat,2);?></td>
  </tr>
  <tr>
      <td colspan="4"></td> 
      <td>Grand Total</td> 
      <td style=" text-align: right"><?php echo number_format($grandtotal,2);?></td>
  </tr>
  
 
</table>
            </div>
            


 <div class="clear"></div>
 <div class="footer">
     <p><strong>Note:</strong>Please pay this invoice to sincro Sitewatch Limited, Account number 001001038973270001</p>
     Azania Bank Limited, Masdo House Branch. 

 </div>
 <hr>
<div class="vertical_banner">
<strong>Sincro Sitewatch Limited</strong><br>
P.O.BOX 80407,Dar es salaam.Head office: Plot No. 1337 Msonge Street, Mikocheni 'A'<br>
Tel: +255 222 700971; Fax: +255 222 700970 Sales: +255 714 500900; Operations: +255 713 500904; Technical:<br>
Email: sales@sincrositewatch.com; operations@sincrositewatch.com; Website: www.sincrositewatch.com

</div>
        </div>
        
    </body>
</html>





