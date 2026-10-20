<?php
require_once __DIR__ . '/../../mysql_compat.php';

include_once 'authorized/db.php';
$customer='';
$address='';
$city='';
$phone='';
$contactname='';
$email='';
$linkj='disabled=""';


////////////////////////////////////
 $selecx=  mysql_query("SELECT * FROM tbl_purchase_order ORDER BY purchase_id DESC") or die(mysql_error());
  $rowtt= mysql_fetch_array($selecx);
  $vby=$rowtt['order_id_gen']+1;
  $qtvc='SSW-PO-'.$vby;
  
  

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
if(isset($_POST['add_new_custom'])){
    $customer=$_POST['customer'];
    $namr=$_POST['customer'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $phone=$_POST['phone'];
     $contactname=$_POST['contactname'];
      $email=$_POST['email'];
      $customerr=  mysql_query("SELECT * FROM tbl_customer WHERE customer_name='$namr'") or die(mysql_error());
    $tu=  mysql_fetch_array($customerr);
    $customed=$tu['customer_name'];
    if($customed!=$customer){
      $customers=mysql_query("INSERT INTO tbl_customer(`customer_name`,`address`,`city`,`phone_no`,`contact_name`,`email`)"
            . "VALUE('$customer','$address','$city','$phone','$contactname','$email')") or die(mysql_error());
    }
 else {
        $sms='<div class="alert alert-danger">
  <strong>Danger!</strong> Supplier alredy exist.
</div>';
        
         $customerr=  mysql_query("SELECT * FROM tbl_customer WHERE customer_name='$namr'") or die(mysql_error());
    $tu=  mysql_fetch_array($customerr);
    $customer=$tu['customer_name'];
    $cust_id=$tu['customer_id'];
$address=$tu['address'];
$city=$tu['city'];
$phone=$tu['phone_no'];
$contactname=$tu['contact_name'];
$email=$tu['email'];
$linkj='';
    }
    
}

if(isset($_POST['add_data'])){
    include_once 'authorized/db.php';
     $descr=$_POST['descr'];
    $units=$_POST['units'];
    $amount=$_POST['amount'];
    $quantity=$_POST['quantity'];
      $order_no=$_POST['order_no'];
      $vat=$_POST['vat'];
       $cust_id=$_POST['cust_id'];
       $customer=$_POST['customer'];
       $tit=$_POST['titles'];
       $currency=$_POST['currency'];
       $discount=$_POST['discount'];
       $discpercent=$_POST['discpercent'];
     $prepairedby = $_SESSION["emp_file_no"];
     $person=$_POST['person/site'];
     $project_number=$_POST['project_number'];
      $invoice_number=$_POST['invoice_number'];
      $company=$_POST['company'];
//    $select_faultid=mysql_query("SELECT * FROM tbl_car_faults ORDER BY fault_id DESC") or die(mysql_error());
//    $Q=mysql_fetch_array($select_faultid);
//    $idd=$Q['fault_id']+1;
      
       
      if(!empty($customer) AND !empty($cust_id)){
         
               ////////////////////////////////////
//               $select_custid=mysql_query("SELECT * FROM tbl_customer ORDER BY customer_id DESC") or die(mysql_error());
//               $Q=mysql_fetch_array($select_custid);
//               $cust_id=$Q['customer_id'];
               
               ///////////////////////////////////////
               $selectid=  mysql_query("SELECT * FROM tbl_purchase_order ORDER BY purchase_id DESC") or die(mysql_error());
               $row= mysql_fetch_array($selectid);
          $rows=$row['purchase_id']+2;
          $order_id_gen=$row['order_id_gen']+1;
          $paddedNum = sprintf("%04d", $rows);
          $tareh=date('Y-m-d');
               ///////////////////////////////////////////////////
               $discount=  mysql_query("INSERT INTO `lpo_discount`(`amount`,`itemid`,percent) VALUES ('$discount','$paddedNum','$discpercent')") or die(mysql_error());
               ///////////////////////////////////////////////////////
                $insertorder=mysql_query("INSERT INTO tbl_purchase_order(prepared_by,`item`, `order_details`,`customer_id`,date,order_number,VAT,currency,company,invoice,project,order_id_gen)"
            . "VALUE('$prepairedby','$paddedNum','$tit','$cust_id','$tareh','$order_no','$vat','$currency','$company','$invoice_number','$project_number','$order_id_gen')") or die(mysql_error());
                //////////////////////////////////////////////////////////
                         for ($i = 0; $i < sizeof($descr); $i++) {
                             $subtotal=$quantity[$i]*$amount[$i];
                        $insert = mysql_query("INSERT INTO tbl_items(`description`,`quantity`,units,`unit_price`,`subtotal`,`item`,`currency`,`Person/Site`)"
                                . "values('$descr[$i]','$quantity[$i]','$units[$i]','$amount[$i]','$subtotal','$paddedNum','$currency','$person[$i]')") or die(mysql_error());
                    }
                    
                   // header("location:?action=po_form&item=".$paddedNum);
                
                
                
          
           
           
           
      }
     
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
 <form  action=""  method="post" >
<div class="row" style="margin-top: 3px;" >
<div class="col-lg-3">
    <button type="submit" name="add_data" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-plus"></i>Process PO</button>
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
                                    <input name="order_no" id="product_name" class="form-control editable" placeholder="" value="<?php echo $qtvc?>" aria-describedby="sizing-addon1" type="text">

                                </div>
    <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">VAT(%):</span></span>
                                    <input name="vat" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Discount:</span></span>
                                    <input name="discount" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
<span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Percent(%):</span></span>
                                    <input name="discpercent" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                </div>
    <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Currency:</span></span>
                                    <input name="currency" id="product_name" class="form-control editable" placeholder="Tsh or US doller or others" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                                
                                
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Project#:</span></span>
                <!--<input name="project_number" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">-->
                <select class="form-control"    name="project_number" required="">
                    <option value="" >--Choose project number</option>
<?php
$quotationnum = mysql_query("SELECT * FROM `tbl_preparedquotation`") or die(mysql_error());
while ($rowing = mysql_fetch_array($quotationnum)) {
    ?>

                        <option value="<?php echo $rowing['Quotation_number']; ?>" ><?php echo $rowing['Quotation_number'].'-'.$rowing['Quotation_name']; ?></option>
    <?php
}
?>
                </select>
            </div>
                                
                                
    <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Invoice#:</span></span>
                                    <input name="invoice_number" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
     <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Company:</span></span>
                                    <input name="company" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
</div>
</div>


<div class="row" >
    <div class="col-lg-12">
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">PO Name:</span></span>
                                    <input name="titles" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
    </div>
    <div class="col-lg-12">
       
                                            <table class="table table-striped table-hover bordered" id="invoice-table">
                                    <thead><tr>

                                            <th>No</th>
                                            <th>Description of Goods</th>
                                            <th>Quantity</th>                                         
                                            <th>Amount</th>
                                            <th>Units</th>
                                            <th>Person/Site</th>
                                            <th></th>
                                        </tr></thead>
                                    <tbody  style="font-size:9px">
                                        <tr>

                                             <td style="width:10%">
                                                <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:35%">
                                                <input name="descr[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>                                           
                                            <td style="width:10%">
                                                <input name="quantity[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            
                                             <td style="width:15%">
                                                <input name="amount[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                             <td style="width:10%">
                                                <input name="units[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:15%">
                                                <input name="person/site[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:5%">
 
                                            </td>
                                        </tr>
                                        <tr id="add">
                                              <td style="width:10%">
                                                <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:35%">
                                                <input name="descr[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>                                           
                                            <td style="width:10%">
                                                <input name="quantity[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                             
                                             <td style="width:15%">
                                                <input name="amount[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:10%">
                                                <input name="units[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                            <td style="width:15%">
                                                <input name="person/site[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
                                            </td>
                                           
                                            <td style="width:5%">

                                                <a href="#" class="cross-delete btn btn-success fg-white" >x</a> 
                                            </td>

                                        </tr>
                                        
                                        
                                    </tbody>
                                </table>

            
            
             <button type="button" id="add-invoice-row"  class="btn btn-success"   >
                                    <span  aria-hidden="true"></span> + add new row&nbsp;
                                </button>
            <button type="submit" class="btn btn-success" name="add_data" style="color:white"><i class="glyphicon glyphicon-plus"></i>Process PO</button>
       
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