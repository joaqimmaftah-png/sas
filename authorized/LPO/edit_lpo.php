<?php
include_once 'authorized/db.php';

if(isset($_POST['add_update'])){
    $items = $_GET['item'];
    $descr=$_POST['descr'];
    $units=$_POST['units'];
    $amount=$a = str_replace(',', '',$_POST['amount']);
    $quantity=$_POST['quantity'];
    $order_no=$_POST['order_no'];
    $vat=$_POST['vat'];
    $cust_id=$_POST['cust_id'];
  
       $tit=$_POST['titles'];
       $currency=$_POST['currency'];
       $discount=$_POST['discount'];
       $discpercent=$_POST['discpercent'];
       $project_number=$_POST['project_number'];
       $invoice_number=$_POST['invoice_number'];
       $company=$_POST['company'];
       $prepairedby = $_SESSION["emp_file_no"];
       $item_id=$_POST['item_id'];
     
     
     
          if(!empty($cust_id)){
          $tareh=date('Y-m-d');
          $treport=date('Ymd');
               ///////////////////////////////////////////////////
          $selectf=  mysql_query("SELECT * FROM `lpo_discount` WHERE `itemid`='$items'") or die(mysql_error());
          $roww=  mysql_num_rows($selectf);
          if($roww>0){
              $discount=  mysql_query("UPDATE `lpo_discount` SET `amount`='$discount',percent='$discpercent' WHERE `itemid`='$items'") or die(mysql_error());
          }
 else {
     $discount=  mysql_query("INSERT INTO `lpo_discount`(`amount`,`itemid`,percent) VALUES ('$discount','$items','$discpercent')") or die(mysql_error());
 }
          
               ///////////////////////////////////////////////////////
//                $insertorder=mysql_query("INSERT INTO tbl_purchase_order(prepared_by,`item`, `order_details`,`customer_id`,date,order_number,VAT,currency)"
//            . "VALUE('$prepairedby','$paddedNum','$tit','$cust_id','$tareh','$order_no','$vat','$currency')") or die(mysql_error());
                    $insertorder=  mysql_query("UPDATE tbl_purchase_order SET prepared_by='$prepairedby',order_details='$tit',"
                            . "customer_id='$cust_id',date='$tareh',order_number='$order_no',VAT='$vat',currency='$currency',"
                            . "open_dreport='$treport',project='$project_number',invoice='$invoice_number',company='$company' WHERE item='$items'") or die(mysql_error());            
                //////////////////////////////////////////////////////////
                         for ($i = 0; $i < sizeof($descr); $i++) {
                             $itemz=$item_id[$i];
                             
                             
                        $subtotal=$quantity[$i]*$amount[$i];
 
                        $selectitemid=mysql_query("SELECT * FROM tbl_items WHERE item_id='$itemz' AND `item`='$items'") or die(mysql_error());
                        $ts= mysql_num_rows($selectitemid);
                       
                        
                        if($ts==0){
                                  $insert = mysql_query("INSERT INTO tbl_items(`description`,`quantity`,units,`unit_price`,`subtotal`,`item`,currency)"
                                . "values('$descr[$i]','$quantity[$i]','$units[$i]','$amount[$i]','$subtotal','$items','$currency')") or die(mysql_error());
                            
                        }
 else {
                      
                        $yu=  mysql_query("UPDATE tbl_items SET `description`='$descr[$i]',`quantity`='$quantity[$i]',units='$units[$i]',`unit_price`='$amount[$i]',"
                                . "`subtotal`='$subtotal',currency='$currency' WHERE `item`='$items' AND item_id='$item_id[$i]'") or die(mysql_error());
                        
 }        
                    }
      }
     
     
}



if(isset($_POST['add_customer'])){
    $namr=$_POST['suppliers'];
    $customerr=  mysql_query("SELECT * FROM tbl_customer WHERE customer_name='$namr'") or die(mysql_error());
    $tu=  mysql_fetch_array($customerr);
    $cust_id=$tu['customer_id'];
    $customer=$tu['customer_name'];
$address=$tu['address'];
$city=$tu['city'];
$phone=$tu['phone_no'];
$contactname=$tu['contact_name'];
$email=$tu['email'];
$linkj='';
}
?>

<head>
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
        background-color: #4CAF50;
        color: white;
    }
</style>
<script type="text/javascript">//<![CDATA[ 
    window.onload = function () {

        $(function () {
            $('table').on('click', 'tr a', function (e) {
                e.preventDefault();
                $(this).parents('tr').remove();
            });

            $("#add-invoice-row").click(function () {
                $("#invoice-table").each(function () {
                    var tds = '<tr>';
                    jQuery.each($('tr:last td', this), function () {
                        tds += '<td>' + $(this).html() + '</td>';
                    });
                    tds += '</tr>';
                    if ($('tbody', this).length > 0) {
                        $('tbody', this).append(tds);
                    } else {
                        $(this).append(tds);
                    }
                });
            });

           


        });
    };
    
    
    

    //]]>  
</script>
</head>


<?php

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
                    $date=$onesha['date'];
                    $order_details=$onesha['order_details'];
                    $order_number=$onesha['order_number'];
                    $contactinfo = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$prepared'")or die(mysql_error());
                 $contact = mysql_fetch_array($contactinfo);
                 $phone = $contact['phone'];
                    
                    $sst=  mysql_query("SELECT * FROM lpo_discount WHERE itemid='$items'") or die(mysql_error());
                    $sa=  mysql_fetch_array($sst);
                    $amountds=$sa['amount'];
                    $percentds=$sa['percent'];
                    
                    
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
                    
                    $date = date('y');
                    
                     $purchases = mysql_query("SELECT * FROM tbl_customer where customer_id='$customer_id'") or die(mysql_error());
                     $supplier=  mysql_fetch_array($purchases);
                     $customer_name=$supplier['customer_name'];
                     $address=$supplier['address'];
                     $city=$supplier['city'];
                     $phone=$supplier['phone_no'];
                     $contact_name=$supplier['contact_name'];
                     $email=$supplier['email'];
                     $customer=$customer_name;
                     $contactname=$contact_name;
                     $cust_id=$supplier['customer_id'];
                     $linkj='disabled=""';
                     
                     $calcdiscount = mysql_query("SELECT * FROM lpo_discount where itemid='$items'") or die(mysql_error());
                     $disc=  mysql_fetch_array($calcdiscount);
                     $amount=$disc['amount'];
                     $percent=$disc['percent'];
                     $discountprcent=$subtotal-$amount;
                     $VAT = $discountprcent * ($vatt/100);
                     $JUMLA = $discountprcent + $VAT;
                    

                    ?>




<form  action=""  method="post">
<div class="row" style="margin-top: 3px;">
<div class="col-lg-3">
    <button type="submit" name="add_update" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-plus"></i>Update PO</button>
       <a href="LPO.php?action=store_lpo" class="btn btn-default"><i class="glyphicon glyphicon-home"></i> Home</a>
        <br />
</div>
    
<div class="col-lg-4">
    <button type="button"  data-toggle="modal" data-target="#new_supplier" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-plus"></i>New Supplier</button>
    <button type="button"  data-toggle="modal" data-target="#exist_supplier" class="btn btn-default" ><i class="glyphicon glyphicon-home"></i> Existing Supplier</button>
       <br />
</div>
<div class="col-lg-5">
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Supplier:</span></span>
                                    <input name="customer" <?php echo $linkj;?>  class="form-control editable" placeholder="" value="<?php echo $customer;?>" aria-describedby="sizing-addon1" type="text">
                                    <input name="cust_id"   class="form-control editable" placeholder="" value="<?php echo $cust_id;?>" aria-describedby="sizing-addon1" type="hidden">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Address:</span></span>
                                    <input name="address" <?php echo $linkj;?> class="form-control editable" placeholder="" value="<?php echo $address;?>" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">city:</span></span>
                                    <input name="city" <?php echo $linkj;?> class="form-control editable" placeholder="" value="<?php echo $city;?>" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Phone Number:</span></span>
                                    <input name="phone" <?php echo $linkj;?> class="form-control editable" placeholder="" value="<?php echo $phone;?>" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Contact Name:</span></span>
                                    <input name="contactname" <?php echo $linkj;?> class="form-control editable" placeholder="" value="<?php echo $contactname;?>" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Email:</span></span>
                                    <input name="email" <?php echo $linkj;?> class="form-control editable" placeholder="" value="<?php echo $email;?>" aria-describedby="sizing-addon1" type="text">

                                </div>
   
                    
    <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Order Number:</span></span>
                                    <input name="order_no" id="product_name" class="form-control editable"  value="<?php echo $order_number;?>" aria-describedby="sizing-addon1" type="text">

                                </div>
    <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">VAT(%):</span></span>
                                    <input name="vat" id="product_name" class="form-control editable" value="<?php echo  $vatt;?>" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Discount:</span></span>
                                    <input name="discount" id="product_name" class="form-control editable" value="<?php echo $amountds;?>" aria-describedby="sizing-addon1" type="text">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Percent(%):</span></span>
<input name="discpercent" id="product_name" class="form-control editable"  value="<?php echo $percentds;?>" aria-describedby="sizing-addon1" type="text">
                                </div>
    <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Currency:</span></span>
                                    <input name="currency" id="product_name" class="form-control editable" placeholder="Tsh or US doller or others" value="<?php echo $currency;?>" aria-describedby="sizing-addon1" type="text">

                                </div>          
    
    <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Project#:</span></span>
                                    <input name="project_number" id="product_name" class="form-control editable" placeholder="" value="<?php echo $onesha['project'];;?>" aria-describedby="sizing-addon1" type="text">

                                </div>
    <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Invoice#:</span></span>
                                    <input name="invoice_number" id="product_name" class="form-control editable" placeholder="" value="<?php echo $onesha['invoice'];;?>" aria-describedby="sizing-addon1" type="text">

                                </div>
    <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Company:</span></span>
                                    <input name="company" id="product_name" class="form-control editable" placeholder="" value="<?php echo $onesha['company'];;?>" aria-describedby="sizing-addon1" type="text">

                                </div>
    
</div>
</div>


<div class="row" >
    <div class="col-lg-12">
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">PO Name:</span></span>
                                    <input name="titles" id="product_name" class="form-control editable" placeholder="" value="<?php echo $order_details;?>" aria-describedby="sizing-addon1" type="text">

                                </div>
    </div>
    <div class="col-lg-12">
       
                                   <table class="table table-striped table-hover bordered" id="invoice-table">
                                    <thead>
                                        <tr>

                                            <th>No</th>
                                            <th>Description of Goods</th>                                            
                                            <th>Quantity</th>                                         
                                            <th>Amount</th>
                                            <th>Units</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody  style="font-size:9px">
                                         <?php
            $jj=1;
            while ($row = mysql_fetch_array($purchase)) {
                $description = $row['description'];
                $quantity = $row['quantity'];
                $units = $row['units'];
                $unit_price = $row['unit_price'];
                $subtotal = $row['subtotal'];
                $item_id = $row['item_id'];
                ///////////////////////////////////////////////////
                ?>
                                        <tr>

                                             <td style="width:10%">
                                                <input name="text" id="buying_price" value="<?php echo $jj++; ?>" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                                <input name="item_id[]" id="buying_price" value="<?php echo $item_id; ?>" class="form-control amount editable"  aria-describedby="sizing-addon1" type="hidden">
                                             </td>
                                            <td style="width:40%">
                                                <input name="descr[]" value="<?php echo $description; ?>" id="buying_price" class="form-control amount editable"   aria-describedby="sizing-addon1" type="text">
                                            </td>                                           
                                            <td style="width:15%">
                                                <input name="quantity[]" value="<?php echo $quantity; ?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            
                                             <td style="width:15%">
                                                <input name="amount[]" value="<?php echo number_format($unit_price, 2); ?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                             <td style="width:15%">
                                                <input name="units[]" value="<?php echo $units; ?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:5%">
                                                <a href="#" class="cross-delete btn btn-success fg-white" >x</a>
                                            </td>
                                        </tr>
                                         <?php
                                         } 
                                         ?>
                                        <tr id="add">
                                              <td style="width:10%">
                                                <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                                <input name="item_id[]" id="buying_price" value="<?php echo ''; ?>" class="form-control amount editable"  aria-describedby="sizing-addon1" type="hidden">
                                              </td>
                                            <td style="width:40%">
                                                <input name="descr[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>                                           
                                            <td style="width:15%">
                                                <input name="quantity[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                             
                                             <td style="width:15%">
                                                <input name="amount[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:15%">
                                                <input name="units[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                           
                                            <td style="width:5%">

                                                <a href="#" class="cross-delete btn btn-success fg-white" >x</a> 
                                            </td>

                                        </tr>
                                        
                                        
                                    </tbody>
                                </table>

            
            
             <button type="button" id="add-invoice-row"  class="btn btn-success" >
                                    <span  aria-hidden="true"></span> + add new row&nbsp;
                                </button>
            <button type="submit" class="btn btn-success" name="add_update" style="color:white"><i class="glyphicon glyphicon-refresh"></i>Update PO</button>
       
    </div>
</div>
</form>


<!-- Modal -->
<div id="exist_supplier" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Choose supplier from list</h4>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class=" col-lg-12">
                  <form action="" method="POST">
                  <div class="form-group">
                                                <select class="form-control"    name="suppliers">
                                                    <option value="" >--Choose Supplier</option>
<?php
$sparenam = mysql_query("SELECT DISTINCT customer_name from  tbl_customer ORDER BY customer_name") or die(mysql_error());
while ($rowing = mysql_fetch_array($sparenam)) {
    $customer_name = $rowing['customer_name'];
//    $customer_id = $rowing['customer_id'];
    ?>
                <option value="<?php echo $customer_name; ?>" ><?php echo $customer_name; ?></option>
<?php
}
?>
                                                </select>
                                            </div>
                  <button type="submit" class="btn btn-success" name="add_customer" style="color:white"><i class="glyphicon glyphicon-plus"></i>&nbsp;Save</button>
              </form>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="new_supplier" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add new supplier</h4>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class=" col-lg-12">
                  <form action="" method="POST">
                          <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Supplier:</span></span>
                                    <input name="customer"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Address:</span></span>
                                    <input name="address"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">city:</span></span>
                                    <input name="city"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Phone Number:</span></span>
                                    <input name="phone"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Contact Name:</span></span>
                                    <input name="contactname"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Email:</span></span>
                                    <input name="email"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                      <button type="submit" class="btn btn-success" name="add_new_custom" style="color:white"><i class="glyphicon glyphicon-plus"></i>&nbsp;Save</button>
              </form>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>