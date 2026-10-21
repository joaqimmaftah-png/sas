<?php
require_once __DIR__ . '/../../mysql_compat.php';

$message = '';
if (isset($_POST['approve'])) {
    include_once 'authorized/db.php';
    $items = $_GET['item'];
    $employee_no = $_SESSION['emp_file_no'];
    $update = mysql_query("UPDATE  tbl_purchase_order SET prepared_by='$employee_no' WHERE item='$items'") or die(mysql_error());
    $message = '<div class="alert alert-info fade in error">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Successful Submitted!</strong> 
</div>';
}
?>
<div id="invoice-container" class="invoice-container">
    <?php
    include_once 'authorized/db.php';
    $items = $_GET['item'];
    $purchase = mysql_query("SELECT * FROM tbl_items where item='$items'") or die(mysql_error());
    $sumitem = mysql_query("SELECT SUM(subtotal) FROM  tbl_items where item='$items'") or die(mysql_error());
    $total = mysql_fetch_array($sumitem);
    $subtotal = $total['SUM(subtotal)'];
    $paddedNum = number_format(lpo_num($subtotal), 2);
    $VAT = $subtotal * 0.18;
    $JUMLA = $subtotal - $VAT;
    $date = date('y');
    ?>
    <div class="row">
        <form action="" method="POST">
            <button type="submit" name="approve" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-check"></i>Approve</button>
            <a href="?action=store_lpo" class="btn btn-default" ><i class="glyphicon glyphicon-backward"></i> Home</a>
            <a href="http://localhost/sincro_store/lpo_print.php?item=<?php echo $items; ?>" class="btn btn-default" ><i class="glyphicon glyphicon-print"></i> Print Previews</a>
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
            <h2 class="text-center" >SINCRO SITEWATCH LTD</h2>
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
            <h2 class="text-center" >PURCHASE ORDER</h2>

        </div>
        <div class="col-sm-3">
            <p class="text-right small"><strong>No:<?php echo $date . "." . $items; ?></strong></p>
            <p class="text-right">TIN:106-703-221</p>
        </div>
    </div>
    <p class="small">VAT Reg. No. 40-0017012-E</p>
    <table class="table cart table-bordered">
         <tr>
                <td class="total-quantity"></td>
                <td class="price text-right" colspan="2">SUB TOTAL</td>
                <td class="amount text-right"><?php echo $paddedNum; ?></td>
            </tr>
            <tr>
                <td class="total-quantity"></td>
                <td class="price text-right" colspan="2">VAT(18%)</td>
                <td class="amount text-right"><?php echo number_format(lpo_num($VAT), 2); ?></td>
            </tr>
            <tr>
                <td class="total-quantity" ></td>
                <td class="price text-right" colspan="2">TOTAL</td>
                <td class="amount text-right"><?php echo number_format(lpo_num($JUMLA), 2); ?></td>
            </tr>
        <thead>
            <tr>
                <th>Description </th>
                <th class="text-right">Price </th>
                <th class="text-right">Quantity</th>
                <th class="amount text-right">Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysql_fetch_array($purchase)) {
                $description = $row['description'];
                $quantity = $row['quantity'];
                $unit_price = $row['unit_price'];
                $subtotal = $row['subtotal'];
                ///////////////////////////////////////////////////
                ?>
                <tr>
                    <td class="product"><?php echo $description; ?></td>
                    <td class="price text-right"><?php echo number_format(lpo_num($unit_price), 2); ?></td>
                    <td class="quantity text-right"><?php echo $quantity; ?></td>
                    <td class="amount text-right"><?php echo number_format(lpo_num($subtotal), 2); ?></td>
                </tr>
<?php } ?>

            <tr>
                <td class="total-quantity"></td>
                <td class="price text-right" colspan="2">SUB TOTAL</td>
                <td class="amount text-right"><?php echo $paddedNum; ?></td>
            </tr>
            <tr>
                <td class="total-quantity"></td>
                <td class="price text-right" colspan="2">VAT(18%)</td>
                <td class="amount text-right"><?php echo number_format(lpo_num($VAT), 2); ?></td>
            </tr>
            <tr>
                <td class="total-quantity" ></td>
                <td class="price text-right" colspan="2">TOTAL</td>
                <td class="amount text-right"><?php echo number_format(lpo_num($JUMLA), 2); ?></td>
            </tr>

        </tbody>
    </table>
    <p>
    <div class="col-sm-12">
        <img src="assets/purpose.jpg" alt="logo">

    </div>
</p>
<hr>
</div>


