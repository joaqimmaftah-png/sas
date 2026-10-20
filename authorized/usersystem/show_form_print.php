        <div class="container">
            <div class="grid">               
                <div id="invoice-container" class="invoice-container">
                    <?php
require_once __DIR__ . '/../../mysql_compat.php';


                    ?>
                    <div class="row">
                       maelezooooo

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
                                        <th>Quantity</th>                                                                                     
                                        <th>Units</th>
                                        <th>Amount</th>
                                        <th>Department</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $request_id=$_POST['mafath'];
                             $att = mysql_query("SELECT * FROM request_item_list where request_id='$request_id'") or die(mysql_error());
                                    while ($show_item = mysql_fetch_array($att)) {
                                        $list_id=$show_item['list_id'];
                                     $item=$show_item['item'];
                                     $specification=$show_item['specification'];
                                     $description=$show_item['description'];
                                     $unit_price=$show_item['unit_price'];
                                     $quantity=$show_item['quantity'];
                                     $unit=$show_item['unit'];
                                     $request_id=$show_item['request_id'];
 
                                    ?>
                                ?>
                                <tr>
                                    <td class="product"><?php echo $description; ?></td>
                                    <td class="price text-right"><?php echo number_format($unit_price, 2); ?></td>
                                    <td class="quantity text-right"><?php echo $quantity; ?></td>
                                    <td class="amount text-right"><?php echo number_format($subtotal, 2); ?></td>
                                </tr>
<?php } ?>

                            <tr>
                                <td class="total-quantity"></td>
                                <td class="price text-right" colspan="2">SUB TOTAL</td>
                                <td class="amount text-right"><?php echo ''; ?></td>
                            </tr>
                            <tr>
                                <td class="total-quantity"></td>
                                <td class="price text-right" colspan="2">VAT(18%)</td>
                                <td class="amount text-right"><?php echo ''; ?></td>
                            </tr>
                            <tr>
                                <td class="total-quantity" ></td>
                                <td class="price text-right" colspan="2">TOTAL</td>
                                <td class="amount text-right"><?php echo ''; ?></td>
                            </tr>

                        </tbody>
                    </table>
                    <p>
                        <div class="col-sm-12">

<p><strong>Enter this order in accordance with the prices, terms, delivery method, and specifications listed above.</strong></p>
                    </div>
                    <div class="col-sm-4">
                        REQUISITION OFFICER<br>
                        NAME: <strong>............................</strong> Signature--------------------------<br>
                        SIGNATURE: <strong>............................</strong> Signature--------------------------<br>
                        DATE: <strong>............................</strong> Signature--------------------------

                    </div>
                    <div class="col-sm-4">
                        HEAD OF DEPARTMENT<br>
                        NAME: <strong>............................</strong> Signature--------------------------<br>
                        SIGNATURE: <strong>............................</strong> Signature--------------------------<br>
                        DATE: <strong>............................</strong> Signature--------------------------

                    </div>
                    <div class="col-sm-4">
                        STORE DEPARTMENT<br>
                        NAME: <strong>............................</strong> Signature--------------------------<br>
                        SIGNATURE: <strong>............................</strong> Signature--------------------------<br>
                        DATE: <strong>............................</strong> Signature--------------------------

                    </div>
                    </p>
                    <hr>
                </div>


            </div>
        </div>