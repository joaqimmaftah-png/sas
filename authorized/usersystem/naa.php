<?php
if (isset($_POST['add_goods_received'])) {
    $ids = $_POST['ids'];
    if (!empty($_POST['supplier']) AND ! empty($_POST['grn'])) {
        $item = $_POST['item'];
        $desc = $_POST['desc'];
        $unit = $_POST['unit'];
        $quantity = $_POST['quantity'];
        $bad_symbols = array(",");
        $unit_pricer = $_POST['unit_price'];
        $unit_price = str_replace($bad_symbols, "", $unit_pricer);
        $ids = $_POST['ids'];
        $title=$_POST['title'];

         
      
        $supplier = $_POST['supplier'];
        $delivery_number =$_POST['delivery_number'];
        $delivery_note = $_POST['delivery_note'];
        $delivery_date = $_POST['delivery_date'];
        $invoice_no = $_POST['invoice_no'];
        $invoice_date = $_POST['invoice_date'];
        $grn = $_POST['grn'];
        $date = $_POST['date'];
        $mode_of_payment = $_POST['mode_of_payment'];
        $vat = $_POST['vat'];
        $ewur_levy=$_POST['ewura_levy'];
        $list=$_POST['listid'];  
        if (empty($item)) {
            echo 'errror';
        } else {
            $sst = mysql_query("INSERT INTO `tbl_goods_received_order`(`Title`,`supplier`, `delivery_number`, `grn_no`, `date`, `mode_of_payment`, `VAT`, `delivary_note`, `delivary_date`, `invoice_number`, `invoice_date`,`ewura_levy`) "
                    . "VALUES ('$title','$supplier','$delivery_number','$grn','$date','$mode_of_payment','$vat','$delivery_note','$delivery_date','$invoice_no','$invoice_date', '$ewur_levy')") or die(mysql_error());  

            if ($sst) {
                
                
                for ($i = 0; $i < sizeof($item); $i++) {

                    
                    $id=$item[$i];
                    $mj=$quantity[$i];
                    $va=  mysql_query("SELECT * FROM `tbl_spare_parts` WHERE `part_id`='$id'") OR die(mysql_error());
                    $mn= mysql_fetch_array($va);
                    $mm= mysql_num_rows($va);
                    $part_common_name=$mn['part_common_name'];
                    $date2=date('Y-m-d');
                    $report_date=date('Ymd');
                    $user_id=$_SESSION["emp_file_no"];
                       
                    if($mm>0){
                        $qun=$mn['quantity'];
                        $quantit=$mj+$qun;
                         $tbl_spare_parts=mysql_query("UPDATE `tbl_spare_parts` SET `quantity`='$quantit',`entry_date`='$date2', `report_date`='$report_date', `id_user`='$user_id'  WHERE `part_id`='$item[$i]'");
                                        
                    }
                          
                    $subtotal = $quantity[$i] * $unit_price[$i];
                    $insert = mysql_query("INSERT INTO tbl_goods_received_list( `item`, `descr`, `units`, `quantity`, `units_price`, `total`, `reference`,`part_id`)"
                            . "values('$part_common_name','$desc[$i]','$unit[$i]','$quantity[$i]','$unit_price[$i]','$subtotal','$ids','$item[$i]')") or die(mysql_error());         
        
        $upd_list=  mysql_query("UPDATE `tbl_goods_received_list` SET `item`='$item[$i]',`descr`='$desc[$i]',`units`='$unit[$i]',`quantity`='$quantity[$i]',`units_price`='$unit_pricer[$i]' WHERE `list_id`='$list'")or die(mysql_error());
        $update=  mysql_query("UPDATE `tbl_goods_received_order` SET `delivery_number`='$delivery_number',`supplier`='$supplier',`grn_no`='$grn',`date`='$date',`mode_of_payment`='$mode_of_payment',`VAT`='$vat',`delivary_note`='$delivery_note',`delivary_date`='$delivery_date',`invoice_number`='$invoice_no',`invoice_date`='$invoice_date' WHERE `goods_id`='$ids'")or die(mysql_error());      
                }
                
                
        
            }
        }
    } else {
        echo 'errror';
    }
}


//<----------------UPDATE GOODS RECEIVED ORDERS------------------>


if (isset($_POST['update_goods_received'])) {
    $ids = $_POST['ids'];
    if (!empty($_POST['supplier']) AND ! empty($_POST['grn'])) {
        $item = $_POST['item'];
        $desc = $_POST['desc'];
        $unit = $_POST['unit'];
        $quantity = $_POST['quantity'];
        $bad_symbols = array(",");
        $unit_pricer = $_POST['unit_price'];
        $unit_price = str_replace($bad_symbols, "", $unit_pricer);
        $ids = $_POST['ids'];
        $title=$_POST['title'];

        
        
        $supplier = $_POST['supplier'];
        $delivery_number =$_POST['delivery_number'];
        $delivery_note = $_POST['delivery_note'];
        $delivery_date = $_POST['delivery_date'];
        $invoice_no = $_POST['invoice_no'];
        $invoice_date = $_POST['invoice_date'];
        $grn = $_POST['grn'];
        $date = $_POST['date'];
        $mode_of_payment = $_POST['mode_of_payment'];
        $vat = $_POST['vat'];
        $list=$_POST['listid'];  
        if (empty($item)) {
            echo 'errror';
        } else {
            
            $update=  mysql_query("UPDATE `tbl_goods_received_order` SET `Title`='$title',`delivery_number`='$delivery_number',`supplier`='$supplier',`grn_no`='$grn',`date`='$date',`mode_of_payment`='$mode_of_payment',`VAT`='$vat',`delivary_note`='$delivery_note',`delivary_date`='$delivery_date',`invoice_number`='$invoice_no',`invoice_date`='$invoice_date' WHERE `goods_id`='$ids'")or die(mysql_error()); 
            

            if ($update) {
                
                
                for ($i = 0; $i < sizeof($item); $i++) {
               $upd_list=  mysql_query("UPDATE `tbl_goods_received_list` SET `item`='$item[$i]',`descr`='$desc[$i]',`units`='$unit[$i]',`quantity`='$quantity[$i]',`units_price`='$unit_pricer[$i]' WHERE `list_id`='$list[$i]'")or die(mysql_error());     
             
                }
                
                
        
            }
        }
    } else {
        echo 'errror';
    }
}




if(isset($_GET['ids'])){
    $ids = $_GET['ids'];
}

?>
<style type="text/css">

    @media print
    {    
        .noprint, .bottom-menu-wrapper,.menusss *
        {
            display: none !important;
        }
    }


</style>
<div class="container">
    <div class="grid">               
        <div id="invoice-container" class="invoice-container">

            <div class="row noprint">
                <div class="col-sm-12 menusss">
                    <ul class="pagination">
                        <li>
                            <a href="?action=goods_received_note" class="btn btn-default"><i class="fa fa-home"></i>&nbsp;Home </a>
                        </li>
                        <li >
                            <a class="btn btn-default" href="?action=goods_received_note"  ><i class="fa fa-list"></i>&nbsp;Add goods received notes</a>
                        </li>
                        <li >
                            <a class="btn btn-default" href="#" data-toggle="modal" data-target="#grnote"  ><i class="fa fa-list"></i>&nbsp;Show goods received notes</a>
                        </li>
                        <li >
                              
                         
                            <a class="btn btn-default" href="#" data-toggle="modal" data-target="#gredit"  ><i class="fa fa-list"></i>&nbsp;Edit</a>
                        </li>
                        <li >
                            <a class="btn btn-default" href=""  ><i class="fa fa-list"></i>&nbsp;Delete</a>
                        </li>
                        <li >
                            <a href="javascript:window.print()" class="btn btn-default"><i class="fa fa-print"></i>&nbsp;Print</a>
                        </li>
                    </ul>    
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
            <div class="row"></div>
            <div class="row">
<?php
$attts = mysql_query("SELECT * FROM tbl_goods_received_order WHERE goods_id='$ids'") or die(mysql_error());
$tids = mysql_fetch_array($attts);
$vtc = $tids['VAT'] * 0.01;
?>
                <div class="col-sm-5">
                    <p class=""><strong>Supplier:</strong>&nbsp;<?php echo $tids['supplier']; ?></p>
                    <p class="text-left"><strong>Delivery Number:</strong>&nbsp;<?php echo $tids['delivery_number']; ?></p>                  
                    <p class=""><strong>Delivery Date:</strong>&nbsp;<?php echo $tids['delivary_date']; ?></p>
                    <p class=""><strong>GRN Title:</strong>&nbsp;<?php echo $tids['Title']; ?></p>
                </div>
                <div class="col-sm-3">

                    <span><?php echo 'SSWGRN' . sprintf("%04d", $ids); ?></span>

                </div>
                <div class="col-sm-4">                  
                    <p class=""><strong>Date:</strong>&nbsp;<?php echo $tids['date']; ?></p>
                    <p class=""><strong>Mode of Payment:</strong>&nbsp;<?php echo $tids['mode_of_payment']; ?></p>
                    <p class=""><strong>Invoice Number:</strong>&nbsp;<?php echo $tids['invoice_number']; ?></p>
                    <p class=""><strong>Invoice Date:</strong>&nbsp;<?php echo $tids['invoice_date']; ?></p>
                </div>
            </div>
            <p class="small"></p>

            <table class="table cart table-bordered">
                <thead>
                <th>Code</th>
                <th>Item</th>                                            
                <th>Description</th>                                         
                <th>Unit</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
                </thead>
                <tbody>
<?php
$jd = 1;
$att = mysql_query("SELECT * FROM tbl_goods_received_list WHERE reference='$ids'") or die(mysql_error());
$sumitem = mysql_query("SELECT SUM(total) FROM tbl_goods_received_list where reference='$ids'") or die(mysql_error());
$totals = mysql_fetch_array($sumitem);

$jumla1 = $totals['SUM(total)'] * $vtc;
$jumla = $totals['SUM(total)'];
$wekayote = $jumla + $jumla1;
while ($show_item = mysql_fetch_array($att)) {

    $item = $show_item['item'];
    $desc = $show_item['descr'];
    $reference = $show_item['reference'];
    $qq = $show_item['quantity'];
    $units_price = $show_item['units_price'];
    $un = $show_item['units'];
    $total = $show_item['total'];
    ?>
                        <tr>
                            <td class="product"><?php echo $jd++; ?></td>
                            <td class="price"><?php echo $item; ?></td>
                            <td class="price"><?php echo $desc; ?></td>
                            <td class="product"><?php echo $un; ?></td> 
                            <td class="product"><?php echo $qq; ?></td> 
                            <td class="product"><?php echo $units_price; ?></td> 
                            <td class="quantity text-right"><?php echo number_format($total, 2); ?></td>
                        </tr>
<?php } ?>


                    <tr>
                        <td class="total-quantity" ></td>
                        <td class="price text-right" colspan="5">SUBTOTAL</td>
                        <td class="amount text-right"><?php echo number_format($jumla, 2); ?></td>
                    </tr>
                    <tr>
                        <td class="total-quantity" ></td>
                        <td class="price text-right" colspan="5">VAT(18%)</td>
                        <td class="amount text-right"><?php echo number_format($jumla1, 2); ?></td>
                    </tr>
                    <tr>
                        <td class="total-quantity" ></td>
                        <td class="price text-right" colspan="5">TOTAL</td>
                        <td class="amount text-right"><?php echo number_format($wekayote, 2); ?></td>
                    </tr>

                </tbody>
            </table>
            <p>

            <div class="col-sm-12">

            </div>
            <div class="col-sm-4">

                Received by: <?php echo '' ?><br>                   
                Date: <strong><?php echo ''; ?></strong>

            </div>


            </p>
            <hr>
            <hr>

        </div>


    </div>
</div>




<!-- GLN -->
<div id="grnote" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">GRN List</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <table   id="table6" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>                              
                                    <th class="text-left"></th>
                                    <th class="text-left">GRN Title</th>
                                    <th class="text-left">Supplier</th> 
                                    <th class="text-left">Delivery Number</th>
                                    <th class="text-left">Delivery Date</th>
                                    <th class="text-left">Invoice#</th>
                                    <th class="text-left">Invoice Date</th>
                                    <th class="text-left">Current Date</th>
                                
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $cashlist = mysql_query("SELECT * FROM tbl_goods_received_order ORDER BY goods_id DESC") or die(mysql_error());
                                $j = 1;
                                while ($roww = mysql_fetch_array($cashlist)) {
                                    $supplier = $roww['supplier'];
                                    $delivery_number = $roww['delivery_number'];
                                    $grn_no = $roww['grn_no'];
                                    $date = $roww['date'];
                                    $mode_of_payment = $roww['mode_of_payment'];
                                    $delivary_note = $roww['delivary_note'];
                                    $delivary_date = $roww['delivary_date'];
                                    $invoice_number = $roww['invoice_number'];
                                    $invoice_date = $roww['invoice_date'];
                                    $goods_id = $roww['goods_id'];
                                    $vat= $roww['VAT'];
                                    $title=$roww['Title'];


                                    $trcc = mysql_query("SELECT * FROM tbl_goods_received_list WHERE reference='$goods_id' ORDER BY reference LIMIT 1") or die(mysql_error());
                                    $rs = mysql_fetch_array($trcc);
                                    $descr = $rs['descr'];
                                    $item=$rs['item'];
                                    $units=$rs['units'];
                                    $quantity=$rs['quantity'];
                                    $units_price=$rs['units_price'];
                                    $listid=$rs['list_id'];
//                                    $output[0] = substr($descr, 0, 10);
                                    
                                    ?>
                                    <tr>
                                        <td class="right"><?php echo $j++; ?></td>
                                        <td class="right"><a href="?action=view_goods_received_note&ids=<?php echo $goods_id;?>"><?php echo $title; ?></a></td>
                                        <td class="right"><?php echo $supplier; ?></td>
                                        <td class="right"><?php echo $delivery_number; ?></td>
                                        <td class="right"><?php echo $delivary_date; ?></td>
                                        <td class="right"><?php echo $invoice_number; ?></td>
                                        <td class="right"><?php echo $invoice_date; ?></td>
                                        <td class="right"><?php echo $date; ?></td>
                                       
                                         
                                        
                                    </tr> 
                                    <?php
                                }
                                ?>
                            </tbody>

                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- GLN -->
<div id="gredit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">EDIT GRN</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form  action="?action=view_goods_received_note"  method="post" > 
    <div class="row" style="margin-top: 3px;" >


        <div class="col-lg-4">
            <?php
            
            $cashlistzT = mysql_query("SELECT * FROM tbl_goods_received_order WHERE goods_id='$ids'") or die(mysql_error());
                                $j = 1;
                                $rowwxT = mysql_fetch_array($cashlistzT);
                                    $goods_id = $rowwxT['goods_id'];
                                    $supplierT = $rowwxT['supplier'];
                                    $delivery_numberT = $rowwxT['delivery_number'];
                                    $grn_noT = $rowwxT['grn_no'];
                                    $dateT = $rowwxT['date'];
                                    $mode_of_paymentT = $rowwxT['mode_of_payment'];
                                    $delivary_noteT = $rowwxT['delivary_note'];
                                    $delivary_dateT = $rowwxT['delivary_date'];
                                    $invoice_numberT = $rowwxT['invoice_number'];
                                    $invoice_dateT = $rowwxT['invoice_date'];
                                    $vatT= $rowwxT['VAT'];
                                    $titl=$rowwxT['Title'];
            
            ?>

            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Supplier:</span></span>
                <input name="supplier" id="product_name" class="form-control editable" placeholder="" value="<?php echo $supplierT;?>" aria-describedby="sizing-addon1" type="text">
                <input name="ids" id="product_name" class="form-control editable"  value="<?php echo $goods_id;?>" aria-describedby="sizing-addon1" type="hidden">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Delivery Number:</span></span>
                <input name="delivery_number" id="product_name" class="form-control editable" placeholder="" value="<?php echo $delivery_numberT;?>" aria-describedby="sizing-addon1" type="text">

            </div>

            
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Delivery Date:</span></span>
                <input name="delivery_date" id="product_name" class="form-control editable" placeholder="" value="<?php echo $delivary_dateT;?>" aria-describedby="sizing-addon1" type="text">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Invoice Number:</span></span>
                <input name="invoice_no" id="product_name" class="form-control editable" placeholder="" value="<?php echo $invoice_numberT;?>" aria-describedby="sizing-addon1" type="text">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Invoice Date:</span></span>
                <input name="invoice_date" id="product_name" class="form-control editable" placeholder="" value="<?php echo $invoice_dateT;?>" aria-describedby="sizing-addon1" type="text">

            </div>

        </div>
        <div class="col-lg-3">

        </div>
        <div class="col-lg-5">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">GRN No:</span></span>
                <input name="grn" id="product_name" class="form-control editable" placeholder="" value="<?php echo $grn_noT;?>" aria-describedby="sizing-addon1" type="text">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Date:</span></span>
                <input  type="date" name="date" id="product_name" class="form-control editable" placeholder="" value="<?php echo $dateT;?>" aria-describedby="sizing-addon1" type="text">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Mode of Payment:</span></span>
                <input name="mode_of_payment" id="product_name" class="form-control editable" placeholder="" value="<?php echo $mode_of_paymentT;?>" aria-describedby="sizing-addon1" type="text">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">VAT(18%):</span></span>
                <input name="vat" id="product_name" class="form-control editable" placeholder="" value="<?php echo $vatT;?>" aria-describedby="sizing-addon1" type="text">

            </div>


        </div>
    </div>
                            
                                    <div class="row" style="margin-top: 3px;" >
     <div class="col-lg-12">

            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:center"><span class="text-right"> GRN TITLE:</span></span>
                <input name="title" id="product_name" class="form-control editable" placeholder="" value="<?php echo $titl;?>" aria-describedby="sizing-addon1" type="text">
               
            </div>
        </div>
</div>


    <div class="row" >

        <div class="col-lg-12">

            <table class="table table-striped table-hover bordered" id="invoice-table">
                <thead><tr>

                        <th>Code</th>
                        <th>Item</th>                                            
                        <th>Description</th>                                         
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>

                        <th></th>
                    </tr></thead>
                <tbody  style="font-size:9px">
                    
                    
                                                    <?php
                                $cashlistz = mysql_query("SELECT * FROM tbl_goods_received_order WHERE goods_id='$ids'") or die(mysql_error());
                                $j = 1;
                                $rowwx = mysql_fetch_array($cashlistz);
                                    $goods_id = $rowwx['goods_id'];
                                    
                                    $trcc = mysql_query("SELECT * FROM tbl_goods_received_list WHERE reference='$goods_id'") or die(mysql_error());
                                    while($rs = mysql_fetch_array($trcc)){
                                    $descr = $rs['descr'];
                                    $item=$rs['item'];
                                    $units=$rs['units'];
                                    $quantity=$rs['quantity'];
                                    $units_price=$rs['units_price'];
                                    $listid=$rs['list_id'];
                                    
                                    ?>
                    
                    <tr>

                        <td style="width:10%">
                            <input name="text"  value="<?php echo $j++; ?>" id="buying_price" class="form-control amount editable no-border"  aria-describedby="sizing-addon1" type="text">
                            <input name="listid[]"  value="<?php echo $listid;?>" id="buying_price" class="form-control amount editable no-border"  aria-describedby="sizing-addon1" type="hidden">
                        </td>
                        <td style="width:25%">
                            <input name="item[]" value="<?php echo $item; ?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>                                           
                        <td style="width:20%">
                            <input name="desc[]" value="<?php echo $descr; ?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>

                        <td style="width:15%">
                            <input name="unit[]" value="<?php echo $units; ?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>
                        <td style="width:15%">
                            <input name="quantity[]" value="<?php echo $quantity; ?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>
                        <td style="width:15%">
                            <input name="unit_price[]" value="<?php echo $units_price; ?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                        </td>
                       
                    </tr>
                    <?php
                                }
                    ?>


                </tbody>
            </table>



            <button type="button" id="add-invoice-row"  class="btn btn-success"   >
                <span  aria-hidden="true"></span> + add new row&nbsp;
            </button>
            <button type="submit" class="btn btn-success" name="update_goods_received" style="color:white"><i class="fa fa-arrow-up"></i>Submit Data</button>

        </div>
    </div>
</form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div><?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

