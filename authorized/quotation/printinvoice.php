<?php
require_once __DIR__ . '/../../mysql_compat.php';
 
$Iprin=$_GET['Iprint'];

$sel= mysql_query("SELECT * FROM `tblinvoice` WHERE Invoice_id='$Iprin'")or die(mysql_error());
$seT=  mysql_fetch_array($sel);
$quoid=$seT['Quotation_id'];
$idate=$seT['Invoice_date'];
$inumber=$seT['Invoice_number'];
$idescr=$seT['Invoice_description'];
$vat=$seT['Vat'];
$curr=$seT['Currency'];


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
            }                      
            .container{
                width: 980px;
                margin: 20px 8%;
                font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;

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
             width: 30%;
            
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
               min-height: 600px; 
            }
            table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}

.terms_condition{
    margin-top: 40px;
     position: relative;
}
.terms_condition p{
   font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;              
                line-height: 8.4px;
}
.terms_condition h3{
    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;              
                line-height: 8.4px;
}
.vertical_banner {
    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                font-size: 14px;
                font-style: normal;
                font-variant: normal;              
                line-height: 17.4px;
                font-weight: bold;
    text-align: center;
    width: 100%;
    position:relative;
    margin-top: 40px;
}



        </style>
    </head>
    <body>
        <div class="container">
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
    <caption><?php echo $Quotation_name;?></caption>
  <tr>
    <th>SN</th>
    <th>DESCRIPTION</th>
    <th>UNIT</th>
    <th>QTY</th>
     <th>UNIT PRICE(Tshs)</th>
     <th>NET PRICE</th>
  </tr>
  
  <?php
  $na= mysql_query("SELECT * FROM `tblinvoice_item` WHERE Invoice_id='$Iprin'")or die(mysql_error());
  $naT= mysql_query("SELECT SUM(Total_Price) FROM `tblinvoice_item` WHERE Invoice_id='$Iprin'")or die(mysql_error());
  $naa= mysql_fetch_array($naT);
  $vat=$naa['SUM(Total_Price)']*($vat/100);
  $grandtotal=$naa['SUM(Total_Price)']+$vat;
  
  $u=1;
  while ($maft= mysql_fetch_array($na)){
      
      $invitemid=$maft['invoice_item_id'];
      $descr=$maft['Description'];
      $unit=$maft['Unit'];
      $qty=$maft['Quantity'];
      $unitprice=$maft['Unit_Price'];
      $total=$qty*$unitprice;

  
  ?>
  <tr>
    <td><?php echo $u++;?></td>
    <td><?php echo $descr;?></td>
    <td style=" text-align: left"><?php echo $unit;?></td>
    <td style= " text-align: left"><?php echo $qty;?></td>
    <td style= " text-align: right"><?php echo $unitprice;?></td>
    <td style=" text-align: right"><?php echo $total;?></td>
  </tr>
  <tr>
      <td colspan="4"></td> 
      <td>Sub total</td> 
      <td style=" text-align: right"><?php echo $naa['SUM(Total_Price)']; ?></td>
  </tr>
  <tr>
      <td colspan="4"></td> 
      <td>Add Vat 18%</td> 
      <td style=" text-align: right"><?php echo $vat;?></td>
  </tr>
  <tr>
      <td colspan="4"></td> 
      <td>Grand Total</td> 
      <td style=" text-align: right"><?php echo $grandtotal;?></td>
  </tr>
  
  <?php
  }
  ?>
</table>
            </div>
            
            <div class="terms_condition">
               <h3>Terms and Conditions</h3>
               <p><strong>Payment Terms:</strong><?php echo $paymT;?></p>
               <p><strong>Validity:</strong><?php echo $validT;?></p>
               <p><strong>Delivery:</strong><?php echo $deliveT;?></p>
               <br>
               <p>we hope you find our quote reasonable and acceptable, don't hesitate to contact us should you require further information</p>
               <br>
               <p>Regards</p>
               <p>Sales Representative</p>
            </div>
            <div class="clear"></div>
<div class="vertical_banner">
Sincro Sitewatch Limited<br>
P.O.BOX 80407,Dar es salaam.Head office: Plot No. 1337 Msonge Street, Mikocheni 'A'<br>
Tel: +255 222 700971; Fax: +255 222 700970 Sales: +255 714 500900; Operations: +255 713 500904; Technical:<br>
Email: sales@sincrositewatch.com; operations@sincrositewatch.com; Website: www.sincrositewatch.com

</div>
        </div>
        
    </body>
</html>



