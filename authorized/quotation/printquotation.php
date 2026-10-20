
<?php
require_once __DIR__ . '/../../mysql_compat.php';

$qprin=$_GET['Qprint'];

$result = mysql_query("SELECT * FROM tbl_preparedquotation WHERE Quotation_id='$qprin' ")or die(mysql_error());
$erw=  mysql_fetch_array($result);
$rdi=$erw['customer_id'];
$Qname=$erw['Quotation_name'];
$Qdate=$erw['Quotation_date'];
$Qrefe=$erw['Quotation_number'];
$vat=$erw['Vat'];
$paym=$erw['Payment_terms'];
$valid=$erw['Validity'];
$delive=$erw['Delivery'];


$dweZ= mysql_query("SELECT * FROM `quotation_customer` WHERE customer_id='$rdi'")or die(mysql_error());
$dwe=  mysql_fetch_array($dweZ);
$customername=$dwe['customer_name'];
$addres=$dwe['Address'];
$loca=$dwe['Location'];
$countr=$dwe['Country'];
$email=$dwe['Email'];
$tel=$dwe['TelephoneNo'];
$vrn=$dwe['VRN'];
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
            .container-fluid{
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
                text-align: right;
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
        <div class="container-fluid">
            <div class="headerimg">
                <div class="logo">
                    <img src="assets/invoice.jpg">
                </div>
                <div class="headcontent">
                    <ul class="listing">
                        <li><strong>Generator Manufacturers</strong></li>
                        <li><strong>After Sales Support / Maintenance Contracts</strong></li>
                        <li><strong>Security and Monitoring Systems</strong></li>
                        <li><strong>SSWL Monitoring Software</strong></li>
                        <li><strong>Call Center Support</strong></li>
                    </ul>
                </div>
            </div>

            <div class="title">
                <h3>PROFORMA INVOICE</h3>
            </div>
            
            
            <div class="content_center">
                <div class="tin">
                    <p><strong>TIN: 106-703-221</strong></p>
                    <p><?php echo $customername;?></p>
                    <p><?php echo $addres;?></p>
                    <p><?php echo $loca;?></p>
                    <p><?php echo $countr; ?></p>
                </div>
                <div class="vrn">
 <p>Date:&nbsp;&nbsp;&nbsp;<?php echo $Qdate;?></p>
 <p>Ref:&nbsp;&nbsp;&nbsp;<?php echo $Qrefe;?></p>
                    
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="tablediv">
                
<table style="width:100%">
    <caption><?php echo $Qname;?></caption>
  <tr>
    <th>SN</th>
    <th>DESCRIPTION</th>
    <th>UNIT</th>
    <th>QTY</th>
     <th>UNIT PRICE(Tshs)</th>
     <th>NET PRICE</th>
  </tr>
  
 <?php
        
 $resul = mysql_query("SELECT * FROM `tbl_quotationitem` WHERE Quotation_id='$qprin'")or die(mysql_error());
  $resulz = mysql_query("SELECT SUM(Net_Price) FROM `tbl_quotationitem` WHERE Quotation_id='$qprin'")or die(mysql_error());
  $erweTz=  mysql_fetch_array($resulz);
  $vat=$erweTz['SUM(Net_Price)']*($vat/100);
  $gradtotal=$erweTz['SUM(Net_Price)']+$vat;
 $u=1;
 while ($erweT=  mysql_fetch_array($resul)){
$itemid=$erweT['Item_id'];
$Desc=$erweT['Description'];
$unit=$erweT['Unit'];
$Qty=$erweT['Quantity'];
$uprice=$erweT['Unit_Price']; 
$total= $Qty* $uprice;   


?>
  
  <tr>
    <td>1</td>
    <td><?php echo $Desc;?></td>
    <td><?php echo $unit;?></td>
    <td><?php echo $Qty;?></td>
    <td style=" text-align: right"><?php echo $uprice;?></td>
    <td style=" text-align: right"><?php echo $total;?></td>
  </tr>
  
  <tr>
      <td colspan="4"></td> 
      <td style=" text-align: right">Sub total</td> 
      <td style=" text-align: right"><?php echo $erweTz['SUM(Net_Price)'];?></td>
  </tr>
   <tr>
      <td colspan="4"></td> 
      <td style=" text-align: right">Add Vat 18%</td> 
      <td style=" text-align: right"><?php echo $vat;?></td>
  </tr>
  <tr>
      <td colspan="4"></td> 
      <td style=" text-align: right">Grand Total</td> 
      <td style=" text-align: right"><?php echo $gradtotal;?></td>
  </tr>
  
  <?php 
 }
  ?>
</table>
            </div>
            
            <div class="terms_condition">
               <h3>Terms and Conditions</h3>
               <p><strong>Payment Terms:</strong><?php echo $paym;?></p>
               <p><strong>Validity:</strong><?php echo $valid;?></p>
               <p><strong>Delivery:</strong><?php echo $delive;?></p>
               <br>
               <p>We hope you find our quote reasonable and acceptable, don't hesitate to contact us should you require further information</p>
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



