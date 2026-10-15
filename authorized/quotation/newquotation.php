<?php

if(isset($_POST['updatedata'])){
 $cusname=$_POST['cusname']; 
 $custid=$_POST['custid'];
 $add=$_POST['add'];
 $loca=$_POST['loca']; 
 $Coun=$_POST['Coun'];
 $Ema=$_POST['Ema'];
 $TelNo=$_POST['TelNo'];
 $vvrnt=$_POST['vvrn'];

 $updat=mysql_query("UPDATE `quotation_customer` SET `customer_name`='$cusname',`Address`='$add',`Location`='$loca',`Country`='$Coun',`Email`='$Ema',`TelephoneNo`='$TelNo',`VRN`='$vvrnt' WHERE `customer_id`='$custid'")or die(mysql_error());
 
  if($updat){
     echo '<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> You have successfully updated your data 
</div>';
 }
}

if(isset($_POST['submit'])){
$cid=$_POST['customerid'];
$Qname=$_POST['Quotationname'];   
$Qdate=$_POST['Quotationdate'];   
$Qref=$_POST['Quotationreference'];
$descr=$_POST['description'];
$specif=$_POST['specification'];
$unit=$_POST['unit'];   
$quantity=$_POST['quantity'];   
$unitprice=$_POST['unitprice'];
$vat=$_POST['vat'];
$curr=$_POST['currency'];
$payterm=$_POST['paymentterms'];
$valid=$_POST['validity'];
$deliver=$_POST['delivery'];
$employee = $_SESSION["emp_file_no"];
$reportdate = date('Ymd');
$disco=$_POST['discount'];

$ins= mysql_query("INSERT INTO `tbl_preparedquotation`(`Quotation_name`, `Quotation_number`, `Quotation_date`, `customer_id`,`Vat`,`Currency`,`Payment_terms`,`Validity`,`Delivery`,`User_id`,reportdate,`discount`) VALUES ('$Qname','$Qref','$Qdate','$cid','$vat','$curr','$payterm','$valid','$deliver','$employee','$reportdate','$disco')")or die(mysql_error());
if($ins){
    
   $sele=  mysql_query("SELECT * FROM `tbl_preparedquotation` WHERE `customer_id`='$cid' AND `Quotation_name`='$Qname' AND `Quotation_number`='$Qref' AND `Quotation_date`='$Qdate'")or die(mysql_error());
   $sew=  mysql_fetch_array($sele); 
   $qid=$sew['Quotation_id'];
   for($i=0; $i<sizeof($descr); $i++){
       $total=$quantity[$i]*$unitprice[$i];
   $insert=  mysql_query("INSERT INTO `tbl_quotationitem`(`Description`,`Specification`, `Unit`, `Quantity`, `Unit_Price`, `Net_Price`, `Quotation_id`) "
           . "VALUES ('$descr[$i]', '$specif[$i]', '$unit[$i]', '$quantity[$i]', '$unitprice[$i]', '$total', '$qid')")or die(mysql_error());
   }
}
}

?>


<?php
if(isset($_POST['customerid'])){
$er=$_POST['customerid'];
$dweZ= mysql_query("SELECT * FROM `quotation_customer` WHERE customer_id='$er'")or die(mysql_error());
$dwe=  mysql_fetch_array($dweZ);
$customername=$dwe['customer_name'];
$addres=$dwe['Address'];
$loca=$dwe['Location'];
$count=$dwe['Country'];
$email=$dwe['Email'];
$tel=$dwe['TelephoneNo'];
$vrn=$dwe['VRN'];

}
elseif (isset($_POST['customername'])) {
$customername=$_POST['customername'];
$wqa=mysql_query("SELECT customer_name FROM `quotation_customer` WHERE customer_name='$customername' ")or die(mysql_error());
$row= mysql_numrows($wqa);
if ($row==0){
    
$addres=$_POST['address'];
$loca=$_POST['location'];
$count=$_POST['country'];
$email=$_POST['email'];
$tel=$_POST['telephonenumber'];
$vrn=$_POST['vrn'];  
$ins=  mysql_query("INSERT INTO `quotation_customer`(`customer_name`, `Address`, `Location`, `Country`, `Email`, `TelephoneNo`, `VRN`) VALUES ('$customername','$addres','$loca','$count','$email','$tel','$vrn')")or die(mysql_error());
if($ins){
 $wer=  mysql_query("SELECT * FROM `quotation_customer` WHERE customer_name='$customername' AND Address='$addres' AND Location='$loca' AND Country='$count' AND Email='$email' AND TelephoneNo='$tel' AND VRN='$vrn'")or die(mysql_error());   

 $fre=  mysql_fetch_array($wer);
 $er=$fre['customer_id'];
}

}
 else {
    echo "Customer already exist in the database, select from existing customers";  
}

}
 else {
$er='';
$customername='';
$addres='';
$loca='';
$count='';
$email='';
$tel='';
$vrn='';
}

$sel=  mysql_query("SELECT * FROM `tbl_preparedquotation`")or die(mysql_error());
$seT=  mysql_numrows($sel);
$refnum=1001+($seT-488)+0;
$dat=  date("ym");
$ref="PI"." ".$dat."-".$refnum;


?>






<script type="text/javascript">//<![CDATA[ 
    window.onload = function () {

        $(function () {
            $('table').on('click', 'tr a.cross-delete', function (e) {
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

<!--<---------------------Add New Customer--------------------------->
 <form action="" method="post">
<div class="row">
        
<div class="col-lg-7">
            
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-success btn-small" data-toggle="modal" data-target="#newcustomer"><span class="glyphicon glyphicon-plus"></span>Add New Customer</button>


            
            
<!-------- Existing Customers -------->
<button type="button" class="btn btn-success btn-small" data-toggle="modal" data-target="#existingcustomer">Existing Customer</button>
            

    
<!-------- List Customers -------->
<button type="button" class="btn btn-success btn-small" data-toggle="modal" data-target="#listcustomer">List Customers</button>
</div>         

        
<!--    <-----------Add new Quotation Form--------------->    
 
  <div class="col-lg-5">
      
  <div class="input-group" style="width:100%; margin:2px"> 
      <span class="input-group-addon" style="width:30%" ><span class="text-left">Customer name</span></span>
      <input type="text" name="customername" class="form-control" readonly="" value="<?php echo $customername;?>">
      <input type="hidden" name="customerid" class="form-control" readonly="" value="<?php echo $er;?>">
  </div>
  
  
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Address</span></span>
    <input type="text" name="address" class="form-control" readonly="" value="<?php echo $addres;?>">
  </div>
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Region</span></span>
    <input type="text" name="location" class="form-control" readonly=""value="<?php echo $loca;?>" >
  </div> 
      
      <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Country</span></span>
    <input type="text" name="country" class="form-control" readonly="" value="<?php echo $count;?>" >
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
    <span class="input-group-addon" style="width:30%"><span class="text-left">Quotation name</span></span>
    <input type="text" name="Quotationname" class="form-control">
   </div>
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Quotation date</span></span>
    <input type="text" name="Quotationdate" value="<?php echo date('d-m-Y');?>" readonly="" class="form-control">
  </div>
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Quotation reference</span></span>
    <input type="text" name="Quotationreference" value="<?php echo $ref;?>" readonly="" class="form-control">
  </div>
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Vat</span></span>
    <input type="text" name="vat" class="form-control">
  </div>
<!--      <div class="input-group" style="width:100%; margin:2px">-->
          
 <div class="input-group" style="width:100%; margin:2px">
<!--  <label for="sel1">Select currency:</label>-->
  <select class="form-control" id="sel1" name="currency">
      <option value="select currency">select currency</option>
      <option value="USD">USD</option>
      <option value="TZS">TZS</option>
      <option value="GBP">GBP</option>
  </select>
  </div>


<div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Discount</span></span>
    <input type="text" name="discount" class="form-control">
   </div>

</div>
</div>

<div class="row">   
<div class="col-lg-12">
 <table class="table table-striped table-hover bordered" id="invoice-table">
    <thead><tr>

            <th>No</th>
            <th>Description</th>
            <th>Specification</th>
            <th>Unit</th>
            <th>Quantity</th>
            <th>Unit price</th>
            <th></th>
            
            
            </tr></thead>
             
<tbody  style="font-size:9px">
<tr>

    <td style="width:5%">
    <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
    </td>
    <td style="width:25%">
    <input name="description[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    <td style="width:25%">
    <input name="specification[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    
    <td style="width:15%">
    <input name="unit[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
                                            
    <td style="width:15%">
    <input name="quantity[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    
    <td style="width:15%">
    <input name="unitprice[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    <td style="width:5%">

     <a href="#" class="cross-delete btn btn-success fg-white" >x</a> 
    </td>
    
   </tr>   
        
</tbody> 
</table>
    
<button type="button" id="add-invoice-row" class="btn btn-success">
<span aria-hidden="true"></span>+Add new row&nbsp;</button>
    
<button type="submit"  name="submit" id="add-invoice-row" class="btn btn-success">
<span aria-hidden="true"></span>Submit&nbsp;</button>
</div>   
</div>
     
     
<!-----------Terms and Conditios ----------------------------->
     
<div class="row">
<div class="col-lg-12">
      
  <h5>Terms and Conditions</h5>
  <div class="input-group" style="width:100%; margin:2px"> 
      <span class="input-group-addon" style="width:30%" ><span class="text-left">Payment Terms</span></span>
      <input type="text" name="paymentterms" class="form-control">
  </div>
  
  
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Validity</span></span>
    <input type="text" name="validity" class="form-control">
  </div>
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Delivery</span></span>
    <input type="text" name="delivery" class="form-control">
  </div>
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
    <span class="input-group-addon" style="width:30%"><span class="text-left">Address</span></span>
    <input type="text" name="address" class="form-control">
  </div>
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Region</span></span>
    <input type="text" name="location" class="form-control">
  </div> 
   <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Country</span></span>
    <input type="text" name="country" class="form-control">
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
    $selx=mysql_query("SELECT * FROM quotation_customer")or die(mysql_error());
    while($result= mysql_fetch_array($selx)){
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

<!-----------------------------List Customers--------------------------------->

<!-- Modal -->
<div id="listcustomer" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg"> 

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">LIST CUSTOMERS</h4>
      </div>
      <div class="modal-body">

   <div class="row">
   <div class="col-lg-12">
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Customer_Name</th>
                <th>Address</th>
                <th>Location</th>
                <th>Country</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>VRN</th>
            </tr>
        </thead>
        <tbody>
<?php
           
  $custom= mysql_query("SELECT * FROM quotation_customer") or die(mysql_error());
    while($row = mysql_fetch_array($custom)) {
        $customer_id= $row['customer_id'];
        $customer_name= $row['customer_name'];
        $Address=$row['Address'];
        $Location=$row['Location'];
        $Country= $row['Country'];
        $Email = $row['Email'];
        $TelephoneNo=$row['TelephoneNo'];
        $VRN=$row['VRN'];
?>
                <tr>
                    
                    
                    <td> <a data-toggle="modal" href="#edit_customer" class="editdata"
                            
                            data-a="<?php echo $customer_name; ?>"
                            data-b="<?php echo $Address; ?>"
                            data-c="<?php echo $Location; ?>"
                            data-d="<?php echo $Country; ?>"
                            data-e="<?php echo $Email; ?>"
                            data-f="<?php echo $TelephoneNo; ?>"
                            data-g="<?php echo $VRN; ?>"
                            data-h="<?php echo $customer_id; ?>"
                            
                    >
          <?php echo $customer_name; ?>
                     </a>
                    </td>
                    <td><?php echo $Address;?></td>
                    <td><?php echo $Location;?></td>
                    <td><?php echo $Country;?></td>
                    <td><?php echo $Email;?></td>
                    <td><?php echo $TelephoneNo;?></td>
                    <td><?php echo $VRN;?></td>
                    </tr>
            <?php 
            } 
            ?>
        </tbody>

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


<!-- Modal -->
<div id="edit_customer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Customer</h4>
      </div>
      <div class="modal-body">
        
  <form action="" method="POST">
  <div class="input-group" style="width:100%; margin:2px"> 
      <span class="input-group-addon" style="width:30%" ><span class="text-left">Customer name</span></span>
      <input type="text"  id="a" name="cusname" value="<?php echo $customer_name;?>" class="form-control">
      <input type="hidden"  id="h" name="custid" value="<?php echo $customer_id;?>" class="form-control">
  </div>
  
  
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Address</span></span>
    <input type="text" name="add"  id="b" value="<?php echo $Address;?>" class="form-control">
  </div>
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Region</span></span>
    <input type="text" name="loca"  id="c" value="<?php echo $Location;?>" class="form-control">
 </div> 
   <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Country</span></span>
    <input type="text" name="Coun" id="d" value="<?php echo $Country;?>" class="form-control">
  </div> 
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Email</span></span>
    <input type="text" name="Ema" id="e" value="<?php echo $Email;?>" class="form-control">
  </div>
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Telephone number</span></span>
    <input type="text" name="TelNo" id="f" value="<?php echo $TelephoneNo;?>" class="form-control">
  </div>
  
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">VRN</span></span>
    <input type="text" name="vvrn" id="g" value="<?php echo $VRN;?>" class="form-control">
  </div>
          
     <button type="submit" class="btn btn-success" name="updatedata">Update data</button>     
  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>

</div>
</div>






