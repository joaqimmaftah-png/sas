<?php
require_once __DIR__ . '/../../mysql_compat.php';

if (isset($_POST['mafath'])) {
    ?>
    <form  id="requestform" action=""  method="post">

        <div class="row" >
            <div class="col-lg-12">
 

            </div>
            <div class="col-lg-12">

                <table class="table table-striped table-hover bordered" id="invoice-table">
                    <thead><tr>

                            <th>No</th>
                            <th>Item</th>
                            <th>Specification</th>
                            <th>Description</th>                                            
                            <th>Quantity</th>                                                                                     
                            <th>Units</th>


                            <th></th>
                        </tr></thead>
                    <tbody  style="font-size:9px">
                        <?php
                        $j = 1;
                        $request_id = $_POST['mafath'];
                        $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
                        while ($show_item = mysql_fetch_array($att)) {
                            $list_id = $show_item['list_id'];
                            $item = $show_item['item'];
                            $specification = $show_item['specification'];
                            $description = $show_item['description'];
                            $unit_price = $show_item['unit_price'];
                            $quantity = $show_item['quantity'];
                            $unit = $show_item['unit'];
                            $request_id = $show_item['request_id'];
                            ?>
                            <tr>

                                <td style="width:5%">
                                    <input name="text"  id="buying_price" class="form-control amount editable" value="<?php echo $j++; ?>"  aria-describedby="sizing-addon1" type="text">
                                    <input   name="list_id[]"   value="<?php echo $list_id; ?>"  type="text" hidden="">
                                    <input   name="request_id"   value="<?php echo $request_id; ?>"  type="text" hidden="">
                                </td>
                                <td style="width:28%">
                                    <input name="item[]" id="buying_price" class="form-control amount editable" value="<?php echo $item; ?>" aria-describedby="sizing-addon1" type="text">
                                </td>                                           
                                <td style="width:27%">
                                    <input name="spec[]" id="buying_price" class="form-control amount editable" value="<?php echo $specification; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>

                                <td style="width:26%">
                                    <input name="desc[]" id="buying_price" class="form-control amount editable" value="<?php echo $description; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>
                                <td style="width:7%">
                                    <input name="quant[]" id="buying_price" class="form-control amount editable" value="<?php echo $quantity; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>
                                <td style="width:7%">
                                    <input name="units[]" id="buying_price" class="form-control amount editable" value="<?php echo $unit; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>


                            </tr>
                        <?php } ?>


                    </tbody>
                </table>
                <button type="submit"  name="accountant" class="btn btn-success" style="color:white">Submit Request</button>
                <button type="submit"  name="hod_reject" class="btn btn-success" style="color:white">Reject</button>
            </div>
        </div>
    </form>
    <?php
} else {
    if (isset($_POST['accountant'])) {
        $list_id = $_POST['list_id'];
        $request_id = $_POST['request_id'];
        $item = $_POST['item'];
        $quant = $_POST['quant'];
        $units = $_POST['units'];
        $spec = $_POST['spec'];
        $desc = $_POST['desc'];

        $updatestatus = mysql_query("UPDATE tbl_request_spare SET hod_status='Approved' where request_id='$request_id'");
        for ($i = 0; $i < sizeof($item); $i++) {

            $insert = mysql_query("UPDATE request_item_list SET item='$item[$i]',specification='$spec[$i]',description='$desc[$i]',quantity='$quant[$i]',unit='$units[$i]' WHERE  list_id='$list_id[$i]'");
        }
        header("Location:http://sas.sincrositewatch.com/user_accounts.php?success=1");
    }
    elseif (isset($_POST['hod_reject'])) {
        
    }
}
if (isset($_POST['print'])) {
    ?>
    <div class="container">
        <div class="grid">               
            <div id="invoice-container" class="invoice-container">
    <?php
    ?>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="http://sas.sincrositewatch.com/user_accounts.php" class="btn btn-default" ><i class="glyphicon glyphicon-backward"></i> Home</a>
                        <a href="" class="btn btn-default" ><i class="glyphicon glyphicon-print"></i> Print Previews</a>


                    </div>



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
                        <h2 class="text-center" ><strong>MATERIAL REQUISITION FORM</strong></h2>

                    </div>
                    <div class="col-sm-3">
                        <p class="text-right small"><strong></strong></p>
                        <p class="text-right"></p>
                    </div>
                </div>
                <p class="small"></p>

                <table class="table cart table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Specification</th>
                            <th>Description</th> 
                            <th>Department</th>
                            <th>Quantity</th>                                                                                     
                            <th>Units</th>
                            <th class="text-right">Unit Price</th>
                            <th class="text-right">Total</th>


                        </tr>
                    </thead>
                    <tbody>
    <?php
    $request_id = $_POST['print'];
    $jd = 1;
    $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
    while ($show_item = mysql_fetch_array($att)) {
        $list_id = $show_item['list_id'];
        $item = $show_item['item'];
        $specification = $show_item['specification'];
        $description = $show_item['description'];
        $unit_price = $show_item['unit_price'];
        $quantity = $show_item['quantity'];
        $unit = $show_item['unit'];
        $request_id = $show_item['request_id'];
        $subtotal = $show_item['subtotal'];
        $department = $show_item['department'];
        $sumitem = mysql_query("SELECT SUM(subtotal) FROM request_item_list where request_id='$request_id'") or die(mysql_error());
        $totals = mysql_fetch_array($sumitem);
        $jumla = $totals['SUM(subtotal)'];
        $VAT = 0;
        ?>
                            <tr>
                                <td class="product"><?php echo $jd++; ?></td>
                                <td class="price"><?php echo $item; ?></td>
                                <td class="product"><?php echo $description; ?></td>  
                                <td class="amount"><?php echo $specification; ?></td>
                                <td class="quantity"><?php echo $department; ?></td>                                   
                                <td class="price text-center"><?php echo $quantity; ?></td>
                                <td class="quantity text-center"><?php echo $unit; ?></td>
                                <td class="quantity text-right"><?php echo number_format($unit_price, 2); ?></td>
                                <td class="amount text-right"><?php echo number_format($subtotal, 2); ?></td>
                            </tr>
    <?php } ?>

                        <tr>
                            <td class="total-quantity"></td>
                            <td class="price text-right" colspan="7">SUB TOTAL</td>
                            <td class="amount text-right"><?php echo number_format($jumla, 2); ?></td>
                        </tr>
                        <tr>
                            <td class="total-quantity"></td>
                            <td class="price text-right" colspan="7">VAT(18%)</td>
                            <td class="amount text-right"><?php echo $VAT; ?></td>
                        </tr>
                        <tr>
                            <td class="total-quantity" ></td>
                            <td class="price text-right" colspan="7">TOTAL</td>
                            <td class="amount text-right"><?php echo number_format($jumla, 2); ?></td>
                        </tr>

                    </tbody>
                </table>
                <p>
                <div class="col-sm-12">


                </div>
                <div class="col-sm-4">
                    REQUISITION OFFICER<br>
                    NAME: <strong>--------------------------</strong><br>
                    SIGNATURE: <strong>--------------------------</strong><br>
                    DATE: <strong>--------------------------</strong>

                </div>
                <div class="col-sm-4">
                    HEAD OF DEPARTMENT<br>
                    NAME: <strong>--------------------------</strong><br>
                    SIGNATURE: <strong>--------------------------</strong><br>
                    DATE: <strong>--------------------------</strong> 

                </div>
                <div class="col-sm-4">
                    STORE DEPARTMENT<br>
                    NAME: <strong>--------------------------</strong><br>
                    SIGNATURE: <strong>--------------------------</strong><br>
                    DATE: <strong>--------------------------</strong>

                </div>
                </p>
                <hr>
            </div>


        </div>
    </div>



    <?php
}
if (isset($_POST['print_view'])) {
    ?>
    <div class="container">
        <div class="grid">               
            <div id="invoice-container" class="invoice-container">

                <div class="row">
                    <div class="col-sm-6">
                        <form action="?action=process_request" method="POST">
                            <a href="http://sas.sincrositewatch.com/user_accounts.php" class="btn btn-default" ><i class="glyphicon glyphicon-backward"></i> Home</a>
                            <button type="submit" name="op_approve" value="<?php echo $request_id = $_POST['print_view']; ?>" class="btn btn-default" ><i class="glyphicon glyphicon-print"></i>Approve</button>
                        </form>

                    </div>



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
                        <h2 class="text-center" ><strong>MATERIAL REQUISITION FORM</strong></h2>

                    </div>
                    <div class="col-sm-3">
                        <p class="text-right small"><strong></strong></p>
                        <p class="text-right"></p>
                    </div>
                </div>
                <p class="small"></p>

                <table class="table cart table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Specification</th>
                            <th>Description</th> 
                            <th>Department</th>
                            <th>Quantity</th>                                                                                     
                            <th>Units</th>
                            <th class="text-right">Unit Price</th>
                            <th class="text-right">Total</th>


                        </tr>
                    </thead>
                    <tbody>
    <?php
    $request_id = $_POST['print_view'];
    $jd = 1;
    $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
    while ($show_item = mysql_fetch_array($att)) {
        $list_id = $show_item['list_id'];
        $item = $show_item['item'];
        $specification = $show_item['specification'];
        $description = $show_item['description'];
        $unit_price = $show_item['unit_price'];
        $quantity = $show_item['quantity'];
        $unit = $show_item['unit'];
        $request_id = $show_item['request_id'];
        $subtotal = $show_item['subtotal'];
        $department = $show_item['department'];
        $sumitem = mysql_query("SELECT SUM(subtotal) FROM request_item_list where request_id='$request_id'") or die(mysql_error());
        $totals = mysql_fetch_array($sumitem);
        $jumla = $totals['SUM(subtotal)'];
        $VAT = 0;
        ?>
                            <tr>
                                <td class="product"><?php echo $jd++; ?></td>
                                <td class="price"><?php echo $item; ?></td>
                                <td class="product"><?php echo $description; ?></td>  
                                <td class="amount"><?php echo $specification; ?></td>
                                <td class="quantity"><?php echo $department; ?></td>                                   
                                <td class="price text-center"><?php echo $quantity; ?></td>
                                <td class="quantity text-center"><?php echo $unit; ?></td>
                                <td class="quantity text-right"><?php echo number_format($unit_price, 2); ?></td>
                                <td class="amount text-right"><?php echo number_format($subtotal, 2); ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td class="total-quantity"></td>
                            <td class="price text-right" colspan="7">SUB TOTAL</td>
                            <td class="amount text-right"><?php echo number_format($jumla, 2); ?></td>
                        </tr>
                        <tr>
                            <td class="total-quantity"></td>
                            <td class="price text-right" colspan="7">VAT(18%)</td>
                            <td class="amount text-right"><?php echo $VAT; ?></td>
                        </tr>
                        <tr>
                            <td class="total-quantity" ></td>
                            <td class="price text-right" colspan="7">TOTAL</td>
                            <td class="amount text-right"><?php echo number_format($jumla, 2); ?></td>
                        </tr>

                    </tbody>
                </table>
                <p>
                <div class="col-sm-12">


                </div>
                <div class="col-sm-4">
                    REQUISITION OFFICER<br>
                    NAME: <strong>--------------------------</strong> Signature...................<br>
                    SIGNATURE: <strong>--------------------------</strong> Signature................<br>
                    DATE: <strong>--------------------------</strong> Signature..................

                </div>
                <div class="col-sm-4">
                    HEAD OF DEPARTMENT<br>
                    NAME: <strong>--------------------------</strong> Signature...................<br>
                    SIGNATURE: <strong>--------------------------</strong> Signature................<br>
                    DATE: <strong>--------------------------</strong> Signature..................

                </div>
                <div class="col-sm-4">
                    STORE DEPARTMENT<br>
                    NAME: <strong>--------------------------</strong> Signature...................<br>
                    SIGNATURE: <strong>--------------------------</strong> Signature................<br>
                    DATE: <strong>--------------------------</strong> Signature..................

                </div>
                </p>
                <hr>
            </div>


        </div>
    </div>



    <?php
}
if (isset($_POST['store_approve'])) {
    $request_id = $_POST['store_approve'];
    $updatestatus = mysql_query("UPDATE tbl_request_spare SET store_status='Approved' where request_id='$request_id'");
    if ($updatestatus) {
        header("Location:http://sas.sincrositewatch.com/user_accounts.php?success=1");
    }
} if (isset($_POST['requester_action'])) {
    ?>
    <form  id="" action=""  method="post">

        <div class="row" >
            <div class="col-lg-12">
                 <a href="sas.sincrositewatch.com/user_accounts.php" class="btn btn-default" ><i class="glyphicon glyphicon-home"></i> Home</a>
                 <br>
            </div>
            <div class="col-lg-12">
                 
            </div>
            <div class="col-lg-12">

                <table class="table table-striped table-hover bordered" id="invoice-table">
                    <thead><tr>

                            <th>No</th>
                            <th>Item</th>
                            <th>Specification</th>
                            <th>Description</th>                                            
                            <th>Quantity</th>                                                                                     
                            <th>Units</th>
                            <th></th>
                        </tr></thead>
                    <tbody  style="font-size:9px">
    <?php
    $j = 1;
    $request_id = $_POST['requester_action'];
    $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
    while ($show_item = mysql_fetch_array($att)) {
        $list_id = $show_item['list_id'];
        $item = $show_item['item'];
        $specification = $show_item['specification'];
        $description = $show_item['description'];
        $unit_price = $show_item['unit_price'];
        $quantity = $show_item['quantity'];
        $unit = $show_item['unit'];
        $request_id = $show_item['request_id'];
        ?>
                            <tr>

                                <td style="width:5%">
                                    <input name="text"  id="buying_price" class="form-control amount editable" value="<?php echo $j++; ?>"  aria-describedby="sizing-addon1" type="text">
                                    <input   name="list_id[]"   value="<?php echo $list_id; ?>"  type="text" hidden="">
                                    <input   name="request_id"   value="<?php echo $request_id; ?>"  type="text" hidden="">
                                </td>
                                <td style="width:28%">
                                    <input name="item[]" id="buying_price" class="form-control amount editable" value="<?php echo $item; ?>" aria-describedby="sizing-addon1" type="text">
                                </td>                                           
                                <td style="width:27%">
                                    <input name="spec[]" id="buying_price" class="form-control amount editable" value="<?php echo $specification; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>

                                <td style="width:26%">
                                    <input name="desc[]" id="buying_price" class="form-control amount editable" value="<?php echo $description; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>
                                <td style="width:7%">
                                    <input name="quant[]" id="buying_price" class="form-control amount editable" value="<?php echo $quantity; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>
                                <td style="width:7%">
                                    <input name="units[]" id="buying_price" class="form-control amount editable" value="<?php echo $unit; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>
                                <td style="width:5%">

                                    <a href="?action=process_request&items_id=<?php echo $list_id; ?>&request_id=<?php echo $request_id; ?>" data-confirm="Are you sure to delete this item?" id="delete" class="cross-delete btn btn-success fg-white" >x</a> 
                                </td>

                            </tr>
    <?php } ?>


                    </tbody>
                </table>
                <button type="submit"  name="accountant" class="btn btn-success" style="color:white">Submit Request</button>
                <button type="submit"  name="hod_reject" class="btn btn-success" style="color:white">Reject</button>
            </div>
        </div>
    </form>

    <?php
}
if (isset($_GET['items_id'])) {
    $items_id = $_GET['items_id'];
    $str = mysql_query("delete  from request_item_list where list_id='$items_id'") or die(mysql_error());
    ?>

    <form  id="" action=""  method="post">

        <div class="row" >
            <div class="col-lg-12">
                               
<!--    <a href="" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-plus"></i>Process PO</a>-->
        <a href="http://sas.sincrositewatch.com/user_accounts.php" class="btn btn-default" ><i class="glyphicon glyphicon-home"></i> Home</a>
        <br />
            </div>
             <div class="col-lg-12">
                 <a href="http://sas.sincrositewatch.com/user_accounts.php" class="btn btn-default" ><i class="glyphicon glyphicon-home"></i> Home</a>
                 <br>
            </div>
            <div class="col-lg-12">

                <table class="table table-striped table-hover bordered" id="invoice-table">
                    <thead><tr>

                            <th>No</th>
                            <th>Item</th>
                            <th>Specification</th>
                            <th>Description</th>                                            
                            <th>Quantity</th>                                                                                     
                            <th>Units</th>
                            <th></th>
                        </tr></thead>
                    <tbody  style="font-size:9px">
    <?php
    $j = 1;
    $request_id = $_GET['request_id'];
    $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
    while ($show_item = mysql_fetch_array($att)) {
        $list_id = $show_item['list_id'];
        $item = $show_item['item'];
        $specification = $show_item['specification'];
        $description = $show_item['description'];
        $unit_price = $show_item['unit_price'];
        $quantity = $show_item['quantity'];
        $unit = $show_item['unit'];
        $request_id = $show_item['request_id'];
        ?>
                            <tr>

                                <td style="width:5%">
                                    <input name="text"  id="buying_price" class="form-control amount editable" value="<?php echo $j++; ?>"  aria-describedby="sizing-addon1" type="text">
                                    <input   name="list_id[]"   value="<?php echo $list_id; ?>"  type="text" hidden="">
                                    <input   name="request_id"   value="<?php echo $request_id; ?>"  type="text" hidden="">
                                </td>
                                <td style="width:28%">
                                    <input name="item[]" id="buying_price" class="form-control amount editable" value="<?php echo $item; ?>" aria-describedby="sizing-addon1" type="text">
                                </td>                                           
                                <td style="width:27%">
                                    <input name="spec[]" id="buying_price" class="form-control amount editable" value="<?php echo $specification; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>

                                <td style="width:26%">
                                    <input name="desc[]" id="buying_price" class="form-control amount editable" value="<?php echo $description; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>
                                <td style="width:7%">
                                    <input name="quant[]" id="buying_price" class="form-control amount editable" value="<?php echo $quantity; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>
                                <td style="width:7%">
                                    <input name="units[]" id="buying_price" class="form-control amount editable" value="<?php echo $unit; ?>"  aria-describedby="sizing-addon1" type="text">
                                </td>
                                <td style="width:5%">

                                    <a href="joaqim.php" data-confirm="Are you sure to delete this item?" id="delete" class="cross-delete btn btn-success fg-white" >x</a> 
                                </td>

                            </tr>
    <?php } ?>


                    </tbody>
                </table>
                <button type="submit"  name="accountant" class="btn btn-success" style="color:white">Submit Request</button>
                <button type="submit"  name="hod_reject" class="btn btn-success" style="color:white">Reject</button>
            </div>
        </div>
    </form>


    <?php
}
?>


