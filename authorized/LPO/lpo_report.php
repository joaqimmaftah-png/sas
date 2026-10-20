<div class="row">
    <div class="col-lg-5">
        <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd.mm.yyyy">
                    <input class="form-control" placeholder="From" type="text" value="" readonly>
               
	                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
		        <input type="hidden" id="dtp_input2" value="" /><br/>
                </div>
    
                <div class="col-lg-5">
                <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd.mm.yyyy">
                    <input class="form-control" placeholder="From" type="text" value="" readonly>
                    
			        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" /><br/>
                </div>
    
    <div class="col-lg-1">
       <button class="btn btn-default" ><i class="glyphicon glyphicon-search"></i> Search</button>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
     <form action="<?php
require_once __DIR__ . '/../../mysql_compat.php';
 echo $_SERVER["PHP_SELF"]; ?>" method="post" id="export-form">
						<input type="hidden" value='' id='hidden-type' name='ExportType'/>
                                                <button class="btn btn-default" ><i class="glyphicon glyphicon-cloud-download"></i>Download Excel</button>
					  </form> 
       </div>
       <div class="col-lg-12">
       <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>P.O No#</th>
                <th>Title</th>
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
            $purchase = mysql_query("SELECT * FROM tbl_purchase_order") or die(mysql_error());
            while ($row = mysql_fetch_array($purchase)) {
                $purchase_id = $row['purchase_id'];
                $ordered_by = $row['ordered_by'];
                $checked_status=$row['checked_status'];
                $Approved_status=$row['Approved_status'];
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
                ?>
                <tr>
                    <td>
                    <a href="?action=po_form&item=<?php echo $item;?>"><?php echo $item; ?></a></td>                  
                    <td><a href="?action=po_form&item=<?php echo $item;?>"><?php echo $order_details; ?></a></td>
                    <td><a href="?action=po_form&item=<?php echo $item;?>"><?php echo $customer_name; ?></a></td>
                    <td><?php echo $date; ?></td>
                    <td><a href="?action=po_form&item=<?php echo $item;?>"><?php echo number_format($subtotal, 2); ?></a></td>
                    <td><a href="?action=po_form&item=<?php echo $item;?>"><?php echo $currency; ?></a></td>
                    <td><?php echo $checked_status;?></td>
                    <td><?php echo $Approved_status;?></td>
                </tr>
            <?php
            
            
            }
            
            ?>
        </tbody>

        <tfoot>
            <tr>
                <th>P.O No#</th>
                <th>Title</th>
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
