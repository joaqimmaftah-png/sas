<head>


</head>
<div class="row" >
   <div class="col-lg-12">
    <br />
    <br />
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>P.O No#</th>
                <th>Service</th>
                <th>Supplier</th>
                <th>PO Date</th>
                <th>PO Amount</th>
                <th>Currency</th>
                <th>Op Status</th>
                 <th>Acc Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once 'authorized/db.php';
            $purchase = mysql_query("SELECT * FROM tbl_purchase_order where checked_status='Approved'") or die(mysql_error());
            while ($row = mysql_fetch_array($purchase)) {
                 $purchase_id = $row['purchase_id'];
                $ordered_by = $row['ordered_by'];
//                $checked_status=$row['checked_status'];
//                $Approved_status=$row['Approved_status'];
                $showcolor=$row['Approved_status'];
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

                ///////////////////////////////////////////
                $rowss = mysql_fetch_array($tbl_customer);
                $customer_name = $rowss['customer_name'];
                 $checked_status=$row['checked_status'];
                $Approved_status=$row['Approved_status'];
                
                 if ($showcolor=='Approved') {

                    $notification = "";
                } else {
                   
                    $notification = "bg-red";
                }
                ?>

             <tr class="<?php echo $notification; ?>">
                    <td>
                        <a href="?action=po_form_acc&item=<?php echo $item;?>"><?php echo $item; ?></a></td>                  
                    <td><a href="?action=po_form_acc&item=<?php echo $item;?>"><?php echo $order_details; ?></a></td>
                     <td><a href="?action=po_form_acc&item=<?php echo $item;?>"><?php echo $customer_name; ?></a></td>
                    <td><?php echo $date; ?></td>
                    <td><a href="?action=po_form_acc&item=<?php echo $item;?>"><?php echo number_format($subtotal, 2); ?></a></td>
                    <td><a href="?action=po_form_acc&item=<?php echo $item;?>"><?php echo $currency; ?></a></td>
                    <td><?php echo $checked_status;?></td>
                    <td><?php echo $Approved_status;?></td>
                </tr>
            
            <?php } ?>
        </tbody>

        <tfoot>
           <tr>
                <th>P.O No#</th>
                <th>Service</th>
                <th>Supplier</th>
                <th>PO Date</th>
                <th>PO Amount</th>
                <th>Currency</th>
                <th>Op Status</th>
                 <th>Acc Status</th>
            </tr>
        </tfoot>
    </table>
    </div>
</div>