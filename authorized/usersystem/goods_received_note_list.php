<?php
require_once __DIR__ . '/../../mysql_compat.php';

if (isset($_POST['add_goods_received'])) {
    $ids = $_POST['ids'];
    if (!empty($_POST['supplier'])) {
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
        $date = $_POST['date'];
        $mode_of_payment = $_POST['mode_of_payment'];
        $vat = $_POST['vat'];
        $ewur_levy=$_POST['ewura_levy'];
        $list=$_POST['listid']; 
        $report_date= date("Ymd", strtotime($date));
                
        
        if (empty($item)) {
            echo 'errror';
        } else {
            $sst = mysql_query("INSERT INTO `tbl_goods_received_order`(`Title`,`supplier`, `delivery_number`, `date`, `mode_of_payment`, `VAT`, `delivary_note`, `delivary_date`, `invoice_number`, `invoice_date`,`ewura_levy`,`report_date`) "
                    . "VALUES ('$title','$supplier','$delivery_number','$date','$mode_of_payment','$vat','$delivery_note','$delivery_date','$invoice_no','$invoice_date', '$ewur_levy','$report_date')") or die(mysql_error());  

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
        $update=  mysql_query("UPDATE `tbl_goods_received_order` SET `delivery_number`='$delivery_number',`supplier`='$supplier',`date`='$date',`mode_of_payment`='$mode_of_payment',`VAT`='$vat',`delivary_note`='$delivery_note',`delivary_date`='$delivery_date',`invoice_number`='$invoice_no',`invoice_date`='$invoice_date' WHERE `goods_id`='$ids'")or die(mysql_error());      
                }
                
                
        
            }
        }
    } else {
        echo 'errror';
    }
}

?>

<div class="row">
    <div class="col-lg-12">
    <a href="?action=goods_received_note" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-plus"></i>Add GRN</a>
    <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
    <br />
    <br />
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Supplier</th>
                <th>Delivery number</th>               
                <th>Date</th>
                <th>Delivery note</th>
                <th>Invoice #</th>
                <th>Invoice date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
            include_once 'authorized/db.php';
            
            
            
               
               $list=  mysql_query("SELECT * FROM tbl_goods_received_order ORDER BY goods_id DESC")or die(mysql_error());
               while ($rng= mysql_fetch_array($list)){
               
               $goods_id=$rng['goods_id'];
               $suppl=$rng['supplier'];
               $deliv_no=$rng['delivery_number'];             
               $date=$rng['date'];
               $delivery_note=$rng['delivary_note'];
               $invoice_no=$rng['invoice_number'];
               $invoice_date=$rng['invoice_date'];
               $title=$rng['Title'];
               $reference=$rng['reference'];
               
               
               $grn = mysql_query("SELECT * FROM tbl_goods_received_list WHERE `reference`='$goods_id'") or die(mysql_error());
               $row = mysql_fetch_array($grn);
                
               $descrip=$row['descr'];
               $refe=$row['reference'];
          
                ?>
                <tr>
                     
                    
                    <td><?php echo  $i++;?></td>
                    <td><?php echo  $title;?></td>
                    <td><?php echo  $suppl?></td>
                    <td><?php echo  $deliv_no; ?></td>                  
                    <td><?php echo  $date; ?></td>
                    <td><?php echo  $delivery_note;?></td>
                    <td><?php echo  $invoice_no;?></td>
                    <td><?php echo  $invoice_date;?></td>
                    <td>
                    <a href="?action=grn_edit&goods_id=<?php echo $goods_id;?>">Edit</a>&nbsp;|&nbsp;
                    <a href="?action=view_goods_received_note&ids=<?php echo $goods_id;?>">View</a>&nbsp;|&nbsp;
                    <a href="#">Delete</a>
                    </td>
                </tr>
            <?php 
            
            }
            
            ?>
        </tbody>

        <tfoot>
            <tr>
                <th>SN</th>
                <th>Title</th>
                <th>Supplier</th>
                <th>Delivery number</th>               
                <th>Date</th>
                <th>Delivery note</th>
                <th>Invoice #</th>
                <th>Invoice date</th>
                <th></th>
            </tr>
        </tfoot>   
    </table>
 </div>
</div> 

