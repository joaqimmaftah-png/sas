
<?php
require_once __DIR__ . '/../../mysql_compat.php';


if(isset($_POST['submit'])){
$invid=$_POST['invoiceid'];
$invdate=$_POST['invoicedate'];  
$invnumber=$_POST['invoicenumber'];   
$vat=$_POST['vat'];
$curr=$_POST['currency'];
$invdesc=$_POST['invoicedescription'];
$invitemid=$_POST['invoiceitemid'];
$descr=$_POST['description'];
$unit=$_POST['unit'];   
$qty=$_POST['quantity'];
$unitprice=$_POST['unitprice'];
echo $invid;

$ins= mysql_query("UPDATE `tblinvoice` SET `Invoice_date`='$invdate',`Invoice_number`='$invnumber',`Vat`='$vat',`Currency`='$curr', `Invoice_description`='$invdesc' WHERE `Invoice_id`='$invid'")or die(mysql_error());
//
//   for($i=0; $i<sizeof($descr); $i++){
//       $total=$qty[$i]*$unitprice[$i];
//   $insert= mysql_query("UPDATE `tblinvoice_item` SET `Description`='$descr[$i]',`Unit`='$unit[$i]',`Quantity`='$qty[$i]',`Unit_Price`='$unitprice[$i]',`Total_Price`='$total' WHERE `invoice_item_id`='$invitemid[$i]'")or die(mysql_error());
//   }
//   
  echo '<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> You have successfully updated your data 
</div>';
 
}


$invid=$_GET['invid'];
$result = mysql_query("SELECT * FROM `tblinvoice` WHERE Invoice_id='$invid' ")or die(mysql_error());
$naa=  mysql_fetch_array($result);
$qid=$naa['Quotation_id'];
$invda=$naa['Invoice_date'];
$invnu=$naa['Invoice_number'];
$invdes=$naa['Invoice_description'];
$vat=$naa['Vat'];
$Currency=$naa['Currency'];

$resultT = mysql_query("SELECT * FROM tbl_preparedquotation WHERE Quotation_id='$qid' ")or die(mysql_error());
$erw= mysql_fetch_array($resultT);
$rdi=$erw['customer_id'];

$dweZ= mysql_query("SELECT * FROM `quotation_customer` WHERE customer_id='$rdi'")or die(mysql_error());
$dwe=  mysql_fetch_array($dweZ);
$customername=$dwe['customer_name'];
$addres=$dwe['Address'];
$loca=$dwe['Location'];
$email=$dwe['Email'];
$tel=$dwe['TelephoneNo'];
$vrn=$dwe['VRN'];

?>




<!--<---------------------Add New Customer--------------------------->
 <form action="" method="post">
<div class="row">
        
<div class="col-lg-7">
            
<!-- Trigger the modal with a button -->
<!--<button type="button" class="btn btn-success btn-small" data-toggle="modal" data-target="#newcustomer"><span class="glyphicon glyphicon-plus"></span>Add New Customer</button>-->


            
            
<!-------- Existing Customers -------->
<!--<button type="button" class="btn btn-success btn-small" data-toggle="modal" data-target="#existingcustomer">Existing Customer</button>-->
            
</div>
        
<!--    <-----------Add new Quotation Form--------------->    
 
  <div class="col-lg-5">
      
  <div class="input-group" style="width:100%; margin:2px"> 
      <span class="input-group-addon" style="width:30%" ><span class="text-left">Customer name</span></span>
      <input type="text" name="customername" class="form-control" readonly="" value="<?php echo $customername;?>">
      <input type="hidden" name="invoiceid" class="form-control" value="<?php echo $invid;?>">
  </div>
  
  
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Adress</span></span>
    <input type="text" name="address" class="form-control" readonly="" value="<?php echo $addres;?>">
  </div>
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Location</span></span>
    <input type="text" name="location" class="form-control" readonly="" value="<?php echo $loca;?>" >
  </div> 
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Email</span></span>
    <input type="text" name="email" class="form-control" readonly="" value="<?php echo $email;?>">
  </div>
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Telephone number</span></span>
    <input type="text" name="telephonenumber" class="form-control" readonly="" value="<?php echo $tel;?>">
  </div>
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">VRN</span></span>
    <input type="text" name="vrn" class="form-control" readonly="" value="<?php echo $vrn;?>">
  </div>
    
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Invoice date</span></span>
    <input type="text" name="invoicedate" value="<?Php echo $invda;?>" class="form-control">
  </div>
      
   <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Invoice number</span></span>
    <input type="text" name="invoicenumber" value="<?Php echo $invnu;?>" class="form-control">
  </div>
           
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Vat</span></span>
    <input type="text" name="vat" value="<?php echo $vat;?>" class="form-control">
  </div>    
      
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Currency</span></span>
    <input type="text" name="currency" value="<?php echo $Currency;?>" class="form-control">
  </div>   
                  
</div>
</div>
     
     
<div class="row" style="margin-top: 4px; margin-bottom: 4px;">
<div class="col-lg-12">
   <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Invoice Description</span></span>
    <input type="text" name="invoicedescription" value="<?php echo $invdes;?>" class="form-control">
  </div>
    
    
</div>
         <hr>
     </div>
     

<div class="row">
<div class="col-lg-12">
 <table class="table table-striped table-hover bordered" id="invoice-table">
    <thead><tr>

            <th>No</th>
            <th>Description</th>
            <th>Unit</th>
            <th>Quantity</th>
            <th>Unit price</th>
            
            
            </tr></thead>
             
                                    <tbody  style="font-size:9px">
                                        
                                        
         <?php
        
 $resultT = mysql_query("SELECT * FROM `tblinvoice_item` WHERE Invoice_id='$invid'")or die(mysql_error());
 $u=1;
 while ($erweT=  mysql_fetch_array($resultT)){
$invitemid=$erweT['invoice_item_id'];
$Desc=$erweT['Description'];
$unit=$erweT['Unit'];
$Qty=$erweT['Quantity'];
$uprice=$erweT['Unit_Price']; 
        
        
?>                              
                                        <tr>
    <td style="width:5%">
        <input name="text"  value="<?php echo $u++; ?>" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
        <input name="invoiceitemid[]"  value="<?php echo $invitemid; ?>" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="hidden">
    </td>
    <td style="width:30%">
        <input name="description[]" value="<?php echo $Desc;?>"id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    
    <td style="width:17%">
        <input name="unit[]"  value="<?php echo $unit;?>"id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
                                            
    <td style="width:18%">
        <input name="quantity[]"  value="<?php echo $Qty;?>"id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    
    <td style="width:15%">
        <input name="unitprice[]" value="<?php echo $uprice;?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    
   </tr>
   <?php
   
   }
   ?>   
        
</tbody> 
</table>

    
<button type="submit"  name="submit" id="add-invoice-row" class="btn btn-success">
<span aria-hidden="true"></span>update&nbsp;</button>
</div>   
</div>

</form>




<!------Add new Customer--------->

<!-- Modal -->
<div id="newcustomer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <form action="" method="post">
  <div class="input-group" style="width:100%; margin:2px"> 
      <span class="input-group-addon" style="width:30%" ><span class="text-left">Customer name</span></span>
      <input type="text" name="customername" class="form-control">
  </div>
  
  
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Adress</span></span>
    <input type="text" name="address" class="form-control">
  </div>
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Location</span></span>
    <input type="text" name="location" class="form-control">
  </div> 
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Email</span></span>
    <input type="text" name="email" class="form-control">
  </div>
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Telephone number</span></span>
    <input type="text" name="telephonenumber" class="form-control">
  </div>
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">VRN</span></span>
    <input type="text" name="vrn" class="form-control">
  </div>
          
          <button type="submit" class="btn btn-success">Submit</button>      
  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
   

<!---------------Select existing Customers------------------>

<!----- Modal ------>
<div id="existingcustomer" class="modal fade" role="dialog">
<div class="modal-dialog">

<!----- Modal content------->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Choose the Customer</h4>
</div>
<div class="modal-body">
  <form action="" method="POST">
  <div class="input-group" style="width:100%; margin:2px"> 
  <span class="input-group-addon" style="width:30%" ><span class="text-left">Select Customer</span></span>
  <select name="customerid" class="form-control">
      
  <option> <--select customer--> </option>
    <?php
    $sel=mysql_query("SELECT * FROM `quotation_customer`")or die(mysql_error());
    While($result= mysql_fetch_array($sel)){
    ?>
    <option value="<?php echo $result['customer_id'];?>"><?php echo $result['customer_name'];?></option>
<?php
    }
?>
  </select>
  
  </div>
      
      <button type="submit" class="btn btn-success">Submit</button>
     
  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 

