 <?php
require_once __DIR__ . '/../../mysql_compat.php';

 include_once 'authorized/db.php';                   
                    
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

                    
                    $purchase = mysql_query("SELECT * FROM tbl_items where item='$items'") or die(mysql_error());
                    $sumitem = mysql_query("SELECT SUM(subtotal) FROM  tbl_items where item='$items'") or die(mysql_error());
                    $total = mysql_fetch_array($sumitem);
                    
                    $order_number=$onesha['order_number'];
                    $vatt=$onesha['VAT'];
                    $subtotal = $total['SUM(subtotal)'];
                    $paddedNum = number_format(lpo_num($subtotal), 2);
                    
                    $date = date('y');                  
                     
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
<div class="row">
                       <div class="col-sm-3">
                        <img src="assets/invoice.jpg" alt="logo">

                    </div>
                    <div class="col-sm-5">
                        <h2 class="text-center" ><strong>SINCRO SITEWATCH LTD</strong></h2>
                        <p class="text-center small">Plot No. 1337 Msonge Street, Mikocheni A,PO Box 80407,DSM<br>
                            Tel: +255 22 2700971 , Fax: +255 22 2700970,<br>
                            wwww.sincrositewatch.com</p> 
                    </div>
                    <div class="col-sm-4">
                        <strong>Company Name:</strong><?php echo $onesha['company'];?><br>
                        <strong>Project Number</strong><?php echo $onesha['project'];?><br>                       
                        <strong>Invoice Number:</strong><?php echo $onesha['invoice'];?><br>

                    </div>
                </div> 
    <!--////////////////////-->
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
                <th class="amount text-right">Person/Site</th>
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
                $person=$row['Person/Site'];
                ///////////////////////////////////////////////////
                ?>
                <tr>
                     <td class="product"><?php echo $jj++; ?></td>
                    <td class="product"><?php echo $description; ?></td>
                     <td class="quantity"><?php echo $units; ?></td>
                     <td class="quantity"><?php echo $quantity; ?></td> 
                    <td class="price text-right"><?php echo number_format(lpo_num($unit_price), 2); ?></td>                                      
                    <td class="amount text-right"><?php echo number_format(lpo_num($subtotal), 2); ?></td>
                    <td class="quantity"><?php echo $person; ?></td>
                </tr>
<?php } ?>

            <tr>
<!--                <td class="total-quantity"></td>-->
                <td class="price text-right" colspan="5">Subtotal Excl Tax</td>
                <td class="amount text-right"><?php echo $paddedNum; ?></td>
            </tr>
           
                                 <tr>                    
<!--                <td class="total-quantity"></td>-->
                     <td class="price text-right" colspan="5">Discount(<?php echo $percent.'%';?>)</td>
                <td class="amount text-right"><?php echo number_format(lpo_num($amount), 2); ?></td>
            </tr>
            <tr>
<!--                <td class="total-quantity"></td>-->
                <td class="price text-right" colspan="5">Add Tax (18%VAT)</td>
                <td class="amount text-right"><?php echo number_format(lpo_num($VAT), 2); ?></td>
            </tr>

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
</div>
</div>