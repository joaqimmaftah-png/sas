<div class="row">    
    <div class="col-lg-12">
    <a href="?action=new_order" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-plus"></i>Add Purchase Order</a>
    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
    <br />
    <br />
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>P.O No#</th>
                <th>Title</th>
                <th>Project</th>
                <th>Supplier</th>
                <th>PO Date</th>
                <th>PO Amount</th>
                <th>Currency</th>
                <th>Op Status</th>
                <th>Acc Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
require_once __DIR__ . '/../../mysql_compat.php';

            include_once 'authorized/db.php';
            $purchase = mysql_query("SELECT * FROM tbl_purchase_order") or die(mysql_error());
            while ($row = mysql_fetch_array($purchase)) {
                $purchase_id = $row['purchase_id'];
                $ordered_by = $row['ordered_by'];
                $checked_status=$row['checked_status'];
                $Approved_status=$row['Approved_status'];
                $project=$row['project'];
                $tbl_preparedquotation=mysql_query("SELECT * FROM tbl_preparedquotation where Quotation_number='$project'") or die(mysql_error());
                $quota=mysql_fetch_array($tbl_preparedquotation);
                $Quotation_name=$quota['Quotation_name'];
                
                $item = $row['item'];
                $date = $row['date'];
                $currency = $row['currency'];
                $customer_id = $row['customer_id'];
                $order_details = $row['order_details'];
                $tbl_customer = mysql_query("SELECT * FROM tbl_customer where customer_id='$customer_id'") or die(mysql_error());
                $tbl_items = mysql_query("SELECT * FROM tbl_items where item_id='$item'") or die(mysql_error());
                $rows = mysql_fetch_array($tbl_items);
                

                $sumitem = mysql_query("SELECT SUM(subtotal) FROM  tbl_items where item='$item'") or die(mysql_error());
                $total = mysql_fetch_array($sumitem);
                $subtotal = $total['SUM(subtotal)'];              
                $paddedNum = sprintf("%04d", $subtotal);
                
                
                    $vatt=$row['VAT'];
                    
                    $JUMLA = lpo_num($subtotal) +(lpo_num($subtotal) * (lpo_num($vatt)/100));
                

                ///////////////////////////////////////////
                $rowss = mysql_fetch_array($tbl_customer);
                $customer_name = $rowss['customer_name'];
                $checked_status=$row['checked_status'];
                $Approved_status=$row['Approved_status'];
                ?>
                <tr>
                    <td>
                        <a href="?action=po_form&item=<?php echo $item;?>"><?php echo $item; ?></a>
                    </td>  
                    
                    <td><a href="?action=po_form&item=<?php echo $item;?>"><?php echo $order_details; ?></a></td>
                    <td><?php echo $Quotation_name?></td>
                    <td><a href="?action=po_form&item=<?php echo $item;?>"><?php echo $customer_name; ?></a></td>
                    <td><?php echo $date; ?></td>
                    <td><a href="?action=po_form&item=<?php echo $item;?>"><?php echo number_format(lpo_num($JUMLA), 2); ?></a></td>
                    <td><a href="?action=po_form&item=<?php echo $item;?>"><?php echo $currency; ?></a></td>
                    <td><?php echo $checked_status;?></td>
                    <td><?php echo $Approved_status;?></td>
                    <td><a href="?action=lpo_edit&item=<?php echo $item;?>">Edit</a>&nbsp;|&nbsp;<a href="#">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>

        <tfoot>
            <tr>
                <th>P.O No#</th>
                <th>Title</th>
                <th>Project</th>
                <th>Supplier</th>                               
                <th>PO Date</th>
                <th>PO Amount</th>
                <th>Currency</th>
                <th>Op Status</th>
                <th>Acc Status</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>
</div>


