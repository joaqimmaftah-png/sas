<?php
require_once __DIR__ . '/../../mysql_compat.php';

$message='';
if(isset($_POST['approve'])){
    include_once 'authorized/db.php';
    $items=$_GET['item'];
    $employee_no=$_SESSION['emp_file_no'];
    $update=  mysql_query("UPDATE  tbl_purchase_order SET approved_by='$employee_no',Approved_status='Approved' WHERE item='$items'") or die(mysql_error());
    $message = '<div class="alert alert-info fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successful Approved!</strong> 
</div>';
}
if(isset($_POST['reject'])){
    include_once 'authorized/db.php';
    $items=$_GET['item'];
    $employee_no=$_SESSION['emp_file_no'];
    $update=  mysql_query("UPDATE  tbl_purchase_order SET approved_by='$employee_no',Approved_status='Reject' WHERE item='$items'") or die(mysql_error());
    $message = '<div class="alert alert-danger fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successful Rejected!</strong> 
</div>';
}
?>
                <div id="invoice-container" class="invoice-container">
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
                    $VAT = $subtotal * ($vatt/100);
                    $JUMLA = $subtotal + $VAT;
                    $date = date('y');
                    
                     $purchases = mysql_query("SELECT * FROM tbl_customer where customer_id='$customer_id'") or die(mysql_error());
                     $supplier=  mysql_fetch_array($purchases);
                     $customer_name=$supplier['customer_name'];
                    ?>
                    <div class="row">
        <form action="" method="POST">
        <button type="submit" name="approve" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-check"></i>Approve</button>
    <button type="submit" name="reject" class="btn btn-default" ><i class="glyphicon glyphicon-paste"></i> Reject</button>
    <a href="LPO.php?action=account_lpo" class="btn btn-default" ><i class="glyphicon glyphicon-backward"></i> Home</a>
    </form>
        <?php
            echo $message;
        ?>
    
    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="assets/invoice.jpg" alt="logo">

                        </div>
                        <div class="col-sm-6">
                            <h2 class="text-center" ><strong>SINCRO SITEWATCH LTD</strong></h2>
                            <p class="text-center small">Plot No. 1337 Msonge Street, Mikocheni A,PO Box 80407,DSM<br>
                                Tel: +255 22 2700971 , Fax: +255 22 2700970,<br>
                                wwww.sincrositewatch.com</p> 
                        </div>
                        <div class="col-sm-3">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">


                        </div>
                        <div class="col-sm-6">
                            <h2 class="text-center" ><strong>PURCHASE ORDER</strong></h2>

                        </div>
                        <div class="col-sm-3">
                            <p class="text-right small"><strong>No:<?php echo $date . "." . $items; ?></strong></p>
                            <p class="text-right">TIN:106-703-221</p>
                        </div>
                    </div>
                    <p class="small">VAT Reg. No. 40-0017012-E</p>
                        <table class="table cart table-bordered">
        
        <tbody>
        <tr>
            <td class="total-quantity"><strong>SUPPLIER</strong></td>
            <td class="price text-left"><strong>Order No.</strong></td>
            <td class="total-quantity text-left"><strong>Date</strong></td>
        </tr>
        <tr>
            <td class="total-quantity" rowspan="3"><?php echo $customer_name;?></td>
            <td class="price text-left"><?php echo $order_number;?></td>
            <td class="amount text-left"><?php echo $datee;?></td>
        </tr>
        <tr>
<!--            <td class="total-quantity" rowspan="2">mamama</td>-->
            <td class="price text-left"><strong>Terms of payment</strong></td>
            <td class="amount text-left"></td>
        </tr>
        <tr>
<!--            <td class="total-quantity" rowspan="2">mamama</td>-->
            <td class="price text-left"><strong>Other</strong></td>
            <td class="amount text-left"></td>
        </tr>
        </tbody>
    </table>
                 <table class="table cart table-bordered">

        <thead>
            <tr>
                <th>Description </th>
                <th class="text-right">Price (<?php echo "Tshs.";?>)</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Unit</th>
                <th class="amount text-right">Total Price(<?php echo "Tshs.";?>)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysql_fetch_array($purchase)) {
                $description = $row['description'];
                $quantity = $row['quantity'];
                $units = $row['units'];
                $unit_price = $row['unit_price'];
                $subtotal = $row['subtotal'];
                ///////////////////////////////////////////////////
                ?>
                <tr>
                    <td class="product"><?php echo $description; ?></td>
                    <td class="price text-right"><?php echo number_format($unit_price, 2); ?></td>
                    <td class="quantity text-right"><?php echo $quantity; ?></td>
                    <td class="quantity text-right"><?php echo $units; ?></td>
                    <td class="amount text-right"><?php echo number_format($subtotal, 2); ?></td>
                </tr>
<?php } ?>

            <tr>
<!--                <td class="total-quantity"></td>-->
                <td class="price text-right" colspan="4">SUB TOTAL</td>
                <td class="amount text-right"><?php echo "Tshs.".$paddedNum; ?></td>
            </tr>
            <tr>
<!--                <td class="total-quantity"></td>-->
                <td class="price text-right" colspan="4">VAT(18%)</td>
                <td class="amount text-right"><?php echo "Tshs.".number_format($VAT, 2); ?></td>
            </tr>
            <tr>
<!--                <td class="total-quantity" ></td>-->
                <td class="price text-right" colspan="4">TOTAL</td>
                <td class="amount text-right"><?php echo "Tshs.".number_format($JUMLA, 2); ?></td>
            </tr>

        </tbody>
    </table>
                    <p>
                        <div class="col-sm-12">

<p><strong>Enter this order in accordance with the prices, terms, delivery method, and specifications listed above.</strong></p>
                    </div>
                    <div class="col-sm-12">
<!--                        <img src="assets/purpose.jpg" alt="logo">-->
                        PREPARED BY: <strong><?php echo $low1['first_name'].' '.$low1['surname'];?></strong> Signature--------------------------<br>
                        CHECKED  BY: <strong><?php echo $low2['first_name'].' '.$low2['surname'];?></strong> Signature--------------------------<br>
                        APPROVED BY: <strong><?php echo $low3['first_name'].' '.$low3['surname'];?></strong> Signature--------------------------

                    </div>
                    </p>
                    <hr>
                </div>


