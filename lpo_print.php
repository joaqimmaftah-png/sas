<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="product" content="Metro UI CSS Framework">
        <meta name="description" content="Simple responsive css framework">
        <meta name="author" content="Sergey S. Pimenov, Ukraine, Kiev">
        <meta name="keywords" content="js, css, metro, framework, windows 8, metro ui ">

        <script type="text/javascript" src="jxquery/jquery.min1.js"></script> 


        <script src="js/jquery.min.js"></script>         
        <link href="css/metro-bootstrap.css" rel="stylesheet">
        <link href="css/metro-bootstrap-responsive.css" rel="stylesheet">
        <!--        <link href="css/iconFont.css" rel="stylesheet">
                <link href="css/docs.css" rel="stylesheet">
                <link href="js/prettify/prettify.css" rel="stylesheet">
                <link href="js/prettify/prettify.css" rel="stylesheet">-->

        <!-- Load JavaScript Libraries -->
        <script src="js/jquery/jquery.min.js"></script>                    
        <script src="js/jquery/jquery.widget.min.js"></script>
        <script src="js/jquery/jquery.mousewheel.js"></script>
        <script src="js/metro/metro-input-control.js"></script>
        <script src="js/prettify/prettify.js"></script>       

        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/datatables/css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">

        <title>Local Purchase Order</title>

        <script>
            $(document).ready(function () {
                $('#table').DataTable();
            });
        </script>

    </head>

    <body class="metro" style="background-color: #fff;">

 <div class="container-fluid">
  
                    <?php
                    
                    
                    include_once 'authorized/db.php';                  
                   
                    $items = $_GET['item'];
                               
                    $TBL_PURCHASE = mysql_query("SELECT * FROM tbl_purchase_order WHERE item='$items'") or die(mysql_error());
                    $onesha=  mysql_fetch_array($TBL_PURCHASE);
                    $prepared=$onesha['prepared_by'];
                    $checked=$onesha['checked_by'];
                    $approved=$onesha['approved_by'];
                    $datee=$onesha['date'];
                    $customer_id=$onesha['customer_id'];
                    $currency=$onesha['currency'];
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
                    $paddedNum = number_format($subtotal, 2);
                    
                    $date = date('y');
                    
                     $purchases = mysql_query("SELECT * FROM tbl_customer where customer_id='$customer_id'") or die(mysql_error());
                     $supplier=  mysql_fetch_array($purchases);
                     $customer_name=$supplier['customer_name'];
                     $address=$supplier['address'];
                     $city=$supplier['city'];
                     $phone_no=$supplier['phone_no'];
                     $contact_name=$supplier['contact_name'];
                     $email=$supplier['email'];
                     $customer_id=$supplier['customer_id'];
                     
                     $calcdiscount = mysql_query("SELECT * FROM lpo_discount where itemid='$items'") or die(mysql_error());
                     $disc=  mysql_fetch_array($calcdiscount);
                     $amount=$disc['amount'];
                     $percent=$disc['percent'];
                     $discountprcent=$subtotal-$amount;
                      $VAT = $discountprcent * ($vatt/100);
                    $JUMLA = $discountprcent + $VAT;
                    
                     
                    ?>
<div class="container">
    <div class="grid">
        
        <div class="row">
        <div class="col-lg-1">
            
        </div>
            <div class="col-lg-9">
                <br><br><br><br>
            <h2 class="text-center" ><strong>PURCHASE ORDER</strong></h2>
        </div>
        <div class="col-lg-2">
             <img src="assets/invoice.jpg" alt="logo" class="pull-right img-responsive">
        </div>
            </div>
         <div class="row">
<!--            <div class="col-lg-6">mmmm</div>
            <div class="col-lg-6">mmmm</div>-->
            <br>
        </div>
        
        <div class="row">
            <div class="col-lg-6" >
                <p><strong>Supplier :&nbsp;<span>ID SSI<?php echo sprintf("%04d", $customer_id);?></strong></span></p>
               <div class="col-lg-12" style="border:1px solid #000000;">
                  <p>
                     <span><?php echo $customer_name;?></span><br>
                     <span><?php echo $address;?></span><br>
                     <span><?php echo $city;?>,</span><br> 
                      
       <span>TIN :</span><br>
       <span>VRN :</span><br>
</p>

               </div>
            </div>
            <div class="col-lg-6">
                <p><strong>Purchase Order ID:&nbsp;<span> <?php echo $date . "." . $items; ?></span></strong>&nbsp;&nbsp;<strong>Order No:&nbsp;<span> <?php echo $order_number; ?></span></strong></p>
                   <div class="col-lg-12" style="border:1px solid #000000;">
                  <p> 
                      <span><strong>Created On:</strong> <?php echo $datee;?> </span><br>
                      <span><strong>Contact Person:</strong> <?php echo $low1['first_name'].' '.$low1['surname'];?></span><br>
<span><strong>Phone :</strong> <?php echo $phone;?></span><br> 
<span><strong>E-Mail:</strong>  procurement@sincrositewatch.com</span> 

<p><strong>Supply Term:</strong> Apon receive of Valid PO</p> 

</p>

               </div>
            </div>
        </div>
          <div class="row"></div>
        <div class="row">
            <div class="col-lg-6" >
               <p><strong>Deliverd- Ship to</strong></p>
               <div class="col-lg-12" style="border:1px solid #000000;">
                  <p> 
                     <span>SINCRO SITE WATCH LIMITED </span><br>
<span>Plot No.1337 Msonge street,</span><br> 
<span>P.O.BOX  80407 </span><br>
<span>Dar es Salaam</span><br>
<span>Tanzania</span><br>
</p>


<p>E-mail: procurement@sincrositewatch.com  </p>

               </div>
            </div>
          
            <div class="col-lg-6">
                <p><strong>Bill-to Address:</strong></p>
                   <div class="col-lg-12" style="border:1px solid #000000;">
                  <p> 
<span>SINCRO SITE WATCH LIMITED </span><br>
<span>No.1337 Msonge street</span><br> 
<span>P.O.BOX  80407   DSM</span><br>
</p>
<p>
   <span>TIN :106-703-221</span><br>
<span>VRN :40-0017012-E</span><br> 
</p>
<p>Term: 30 days apon receive of Valid Invoice </p>

               </div>
            </div>
        </div>
          
          <div class="row">
              <br>
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
                    <td class="price text-right"><?php echo number_format($unit_price, 2); ?></td>                                      
                    <td class="amount text-right"><?php echo number_format($subtotal, 2); ?></td>
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
                <td class="amount text-right"><?php echo number_format($amount, 2); ?></td>
            </tr>
<!--                <td class="total-quantity"></td>-->
                <td class="price text-right" colspan="5">Add Tax (18%VAT)</td>
                <td class="amount text-right"><?php echo number_format($VAT, 2); ?></td>
            </tr>
            <tr>

            <tr>
<!--                <td class="total-quantity" ></td>-->
                <td class="price text-right" colspan="5">Total Amount</td>
                <td class="amount text-right"><?php echo number_format($JUMLA, 2); ?></td>
            </tr>

        </tbody>
    </table>
                  <br>
              </div>
          </div>
          
          <div class="row">
               <div class="col-lg-12">
<!--                        <img src="assets/purpose.jpg" alt="logo">-->
                        PREPARED BY: <strong><?php echo $low1['first_name'].' '.$low1['surname'];?></strong> Signature--------------------------<br>
                        CHECKED  BY: <strong><?php echo $low2['first_name'].' '.$low2['surname'];?></strong> Signature--------------------------<br>
                        APPROVED BY: <strong><?php echo $low3['first_name'].' '.$low3['surname'];?></strong> Signature--------------------------

                    </div>
              
          </div>
          
          <div class="row">
              <br>
              <div class="col-lg-12">
                  <p>Materials or Services offered has to comply with the specification and terms instructed to this order, (Supllier is advsied to contact us if you did not receive Specification prior to any supplies).</p>
                  <p>Order Number (PO ID) must appear on all invoices, shipping papers, packages and correspondence referring to this order. A <strong>Delivery Note</strong> or <strong>Certificate of Service</strong> must accompany for goods or service offered.</p>
              </div>
          </div>
          
          
        
    </div>
    </div>
           
        </div>


        <script src="assets/jquery/jquery-2.1.4.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/datatables/js/dataTables.bootstrap.js"></script>



    </body>
</html>



