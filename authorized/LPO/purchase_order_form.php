 <style type="text/css">

            @media print
            {    
                .ignore, .navigation-bar,.horizontal-menu *
                {
                    display: none !important;
                }
                
                .bottom-align-text {
    position: absolute;
    bottom: 0;
    right: 0;
  }
                
            }

  
        </style>
                   


 <?php
require_once __DIR__ . '/../../mysql_compat.php';

                    
                    
                    include_once 'authorized/db.php';
///////////////////////////////////////////Approve form/////////////////////////////////////////////////////////                    
                    
                    $message = '';
if (isset($_POST['approve'])) {
    $items = $_GET['item'];
    $date=date("Ymd");
    $date1=date("d-m-Y");
    $employee_no = $_SESSION['emp_file_no'];
    $update = mysql_query("UPDATE  tbl_purchase_order SET prepared_by='$employee_no',open_dreport='$date',date='$date1' WHERE item='$items'") or die(mysql_error());
    
    
    
 $to = "joaqimmaftah@yahoo.com";
$subject = "";
$txt ="Kindly be advised the LPO No. 07M0916P508 has been Prepared.You are required to act on this approved immediatly.";
$headers = "From: joaqimmaftah@yahoo.com" . "\r\n" .
"CC: joaqimmaftah@yahoo.com";
mail($to,$subject,$txt,$headers);

    
    $message = '<div class="alert alert-info fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successful Submitted!</strong> 
</div>';
    
    
}
                    
 ////////////////////////////////////////////////////////////////////////////////////////////////////                   
                   
                    $items = $_GET['item'];
                               
                    $TBL_PURCHASE = mysql_query("SELECT * FROM tbl_purchase_order WHERE item='$items'") or die(mysql_error());
                    $onesha=  mysql_fetch_array($TBL_PURCHASE);
                    $prepared=$onesha['prepared_by'];
                    $checked=$onesha['checked_by'];
                    $approved=$onesha['approved_by'];
                    $datee=$onesha['date'];
                    $customer_id=$onesha['customer_id'];
                    $currency=$onesha['currency'];
                    $order_details=$onesha['order_details'];
                    $contactinfo = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$prepared'")or die(mysql_error());
$contact = mysql_fetch_array($contactinfo);
$phone = $contact['phone'];
                    
                    
                    
                    
                    $select_jina1=mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$prepared'") or die(mysql_error());
                    $low1=mysql_fetch_array($select_jina1);
                    
                    $select_jina2=mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$checked'") or die(mysql_error());
                    $low2=mysql_fetch_array($select_jina2);
                    
                    $select_jina3=mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$approved'") or die(mysql_error());
                    $low3=mysql_fetch_array($select_jina3);
                    
                    
                    
                    
                    $purchase = mysql_query("SELECT * FROM tbl_items where item='$items'") or die(mysql_error());
                    $sumitem = mysql_query("SELECT SUM(subtotal) FROM  tbl_items where item='$items'") or die(mysql_error());
                    $total = mysql_fetch_array($sumitem);
                    
                    $order_number=$onesha['order_number'];
                    $vatt=$onesha['VAT'];
                    $subtotal = $total['SUM(subtotal)'];
                    $paddedNum = number_format(lpo_num($subtotal), 2);
                    
                    $date = date('y');
                    
                     $purchases = mysql_query("SELECT * FROM tbl_customer where customer_id='$customer_id'") or die(mysql_error());
                     $supplier=  mysql_fetch_array($purchases);
                     $customer_name=$supplier['customer_name'];
                     $address=$supplier['address'];
                     $city=$supplier['city'];
                     $phone_no=$supplier['phone_no'];
                     $contact_name=$supplier['contact_name'];
                     $email=$supplier['email'];
                     
                     
                     $calcdiscount = mysql_query("SELECT * FROM lpo_discount where itemid='$items'") or die(mysql_error());
                     $disc=  mysql_fetch_array($calcdiscount);
                     $amount=$disc['amount'];
                     $percent=$disc['percent'];
                     $discountprcent=lpo_num($subtotal)-lpo_num($amount);
                      $VAT = $discountprcent * (lpo_num($vatt)/100);
                    $JUMLA = $discountprcent + $VAT;
                    
                     
                    ?>
<div class="container">
    <div class="grid">
         <div class="row ignore" id="">
        <form action="" method="POST">
            <button type="submit" name="approve" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-check"></i>Approve</button>
            <a href="?action=store_lpo" class="btn btn-default" ><i class="glyphicon glyphicon-backward"></i> Home</a>         
             <a href="javascript:window.print()" class="btn btn-default"><i class="fa fa-print"></i>&nbsp;Print PDF</a>
             <a href="?action=po_form2&item=<?php echo $_GET['item'];?>" class="btn btn-default">&nbsp;Second Purchase Form</a>
        </form>
        <?php
        echo $message;
        ?>
    </div>
        <div class="row">
        <div class="col-lg-12">
             <img src="assets/po.png" alt="logo" class="img-responsive">
        </div>
            <br>
            </div>
         <div class="row">
             <table style="width:100%">
                 <tr>
                     <td style="width:50%" class="col-lg-6">              
                         <p><strong>Supplier :&nbsp;<span>ID SSI<?php echo sprintf("%04d", $customer_id);?></strong></span></p>
               <div class="col-lg-12" style="border:1px solid #000000;">
                  <p>
                     <span><?php echo $customer_name;?></span><br>
                     <span><?php echo $address;?></span><br>
                     <span><?php echo $city;?>,</span><br> 
                      
            <span>TIN :<?php echo $supplier['TIN'];?></span><br>
       <span>VRN :<?php echo $supplier['vrn'];?></span><br>
</p>

               </div>
                         </td>
                     <td style="width:50%" class="col-lg-6">          <p><strong>Purchase Order ID:&nbsp;<span> <?php echo $date . "." . $items; ?></span></strong>&nbsp;&nbsp;<strong>Order No:&nbsp;<span> <?php echo $order_number; ?></span></strong></p>
                   <div class="col-lg-12" style="border:1px solid #000000;">
                  <p> 
                      <span><strong>Created On:</strong> <?php echo $datee;?> </span><br>
                      <span><strong>Contact Person:</strong> <?php echo $low1['first_name'].' '.$low1['surname'];?></span><br>
<span><strong>Phone :</strong> <?php echo $phone;?></span><br> 
<span><strong>E-Mail:</strong>  procurement@sincrositewatch.com</span> 

<p><strong>Supply Terms:</strong> Upon receipt of valid PO</p> 

</p>

               </div>
                     </td>
                 </tr>
             </table>
            <br>
        </div>
 
          
        <div class="row">
            
            <table style="width:100%">
                 <tr>
                     <td style="width:50%" class="col-lg-6">
               <p><strong>Delivery: Ship to</strong></p>
               <div class="col-lg-12" style="border:1px solid #000000;">
                  <p> 
                     <span>SINCRO SITEWATCH LIMITED </span><br>
<span>Plot No.1337 Msonge street,</span><br> 
<span>P.O.BOX  80407 </span><br>
<span>Dar es Salaam</span><br>
<span>Tanzania</span><br>
</p>


<p>E-mail: procurement@sincrositewatch.com  </p>

               </div>
            </td>
          
            <td style="width:50%" class="col-lg-6">
                <p><strong>Bill-to Address:</strong></p>
                   <div class="col-lg-12" style="border:1px solid #000000;">
                  <p> 
<span>SINCRO SITEWATCH LIMITED </span><br>
<span>No.1337 Msonge street</span><br> 
<span>P.O.BOX  80407   DSM</span><br>
</p>
<p>
   <span>TIN :106-703-221</span><br>
<span>VRN :40-001712-E</span><br> 
</p>
<p>Term: 30 days upon receipt of valid Invoice</p>

               </div>
            </td>
            <tr>
            </table>
       
           
          </div>
          
          <div class="row">
          <div class="col-lg-12 centered-text">
         <h3 class=""><?php echo $order_details;?></h3>
         </div>
         </div>
         
          <div class="row">
              <br> <br>
              <div class="col-lg-12">
                                   <table class="table cart table-bordered">

        <thead>
            <tr>
                <th class="">Item</th>
                <th>Description of Service or Goods</th>
                 <th class="">Unit</th>
                  <th class="">Qty</th>
                  <th class="text-right">Unit Price(<?php echo $currency;?>)</th>
                <th class="amount text-right">Net Price(<?php echo $currency;?>)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $jj=1;
            while ($row = mysql_fetch_array($purchase)) {
                $description = $row['description'];
                $quantity = $row['quantity'];
                $units = $row['units'];
                $unit_price = $row['unit_price'];
                $subtotal = $row['subtotal'];
                ///////////////////////////////////////////////////
                ?>
                <tr>
                     <td class="product"><?php echo $jj++; ?></td>
                    <td class="product"><?php echo $description; ?></td>
                     <td class="quantity"><?php echo $units; ?></td>
                     <td class="quantity"><?php echo $quantity; ?></td> 
                    <td class="price text-right"><?php echo number_format(lpo_num($unit_price), 2); ?></td>                                      
                    <td class="amount text-right"><?php echo number_format(lpo_num($subtotal), 2); ?></td>
                </tr>
<?php } ?>

            <tr>
<!--                <td class="total-quantity"></td>-->
                <td class="price text-right" colspan="5">Subtotal Excl Tax</td>
                <td class="amount text-right"><?php echo $paddedNum; ?></td>
            </tr>
            <tr>
                                 <tr>                    
<!--                <td class="total-quantity"></td>-->
                     <td class="price text-right" colspan="5">Discount(<?php echo $percent.'%';?>)</td>
                <td class="amount text-right"><?php echo number_format(lpo_num($amount), 2); ?></td>
            </tr>
<!--                <td class="total-quantity"></td>-->
                <td class="price text-right" colspan="5">Add Tax (18%VAT)</td>
                <td class="amount text-right"><?php echo number_format(lpo_num($VAT), 2); ?></td>
            </tr>
            <tr>

            <tr>
<!--                <td class="total-quantity" ></td>-->
                <td class="price text-right" colspan="5">Total Amount</td>
                <td class="amount text-right"><?php echo number_format(lpo_num($JUMLA), 2); ?></td>
            </tr>

        </tbody>
    </table>
                  <br>
              </div>
          </div>
        
        
        
        
        
        
        
        
        
        
          
          <div class="row">
               <br> <br>
               <div class="col-lg-12">
<!--                        <img src="assets/purpose.jpg" alt="logo">-->
                        PREPARED BY: <strong><?php echo $low1['first_name'].' '.$low1['surname'];?></strong> Signature--------------------------<br>
                        CHECKED  BY: <strong><?php echo $low2['first_name'].' '.$low2['surname'];?></strong> Signature--------------------------<br>
                        APPROVED BY: <strong><?php echo $low3['first_name'].' '.$low3['surname'];?></strong> Signature--------------------------

                    </div>
              
          </div>
          
          <div class="row">
              <br><br>
              <div class="col-lg-12">
                  <p>Materials or Services offered has to comply with the specifications and terms instructed to this order, (Supplier is advised to contact us if you did not receive Specifications prior to any supplies).</p><br>
                  <p>Order Number (PO ID) must appear on all invoices, shipping papers, packages and correspondence referring to this order. A <strong>Delivery Note</strong> or <strong>Certificate of Service</strong> must accompany goods or service offered.</p>
                  
              </div>
          </div>
          
          
        
    </div>
    </div>