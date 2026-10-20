
<?php
require_once __DIR__ . '/../../mysql_compat.php';


if(isset($_POST['submit'])){
$cuid=$_POST['customerid'];
$Qnid=$_POST['quotationid'];   
$Idate=$_POST['invoicedate'];   
$Inum=$_POST['invoicenumber'];
$vat=$_POST['vat'];
$curr=$_POST['currency'];
$Idescr=$_POST['invoicedescription'];
$po_reference=$_POST['po_reference'];
$pi_reference=$_POST['pi_reference'];
$report_dats=date('Ymd');
$descr=$_POST['description'];
$unit=$_POST['unit'];   
$quantity=$_POST['quantity'];   
$unitprice=$_POST['unitprice'];

$inse= mysql_query("INSERT INTO `tblinvoice`(`Quotation_id`, `Invoice_date`, `Invoice_number`, `Invoice_description`, `Vat`, `Currency`, `Po_reference`, `PFI_reference`,reportdate) "
        . "VALUES ('$Qnid', '$Idate','$Inum', '$Idescr', '$vat','$curr','$po_reference','$pi_reference','$report_dats')")or die(mysql_error());
if($inse){
    
   $seleT=  mysql_query("SELECT * FROM `tblinvoice` WHERE `Quotation_id`='$Qnid' AND `Invoice_date`='$Idate' AND `Invoice_number`='$Inum' AND `Invoice_description`='$Idescr' AND `Vat`='$vat' AND `Currency`='$curr'")or die(mysql_error());
   $sew=  mysql_fetch_array($seleT); 
   $Invid=$sew['Invoice_id'];
   
   for($i=0; $i<sizeof($descr); $i++){
       $total=$quantity[$i]*$unitprice[$i];
   $insert= mysql_query("INSERT INTO `tblinvoice_item`(`Description`,`Unit`, `Quantity`, `Unit_Price`, `Total_Price`,`Invoice_id`)"
           . " VALUES ('$descr[$i]','$unit[$i]','$quantity[$i]','$unitprice[$i]','$total','$Invid')")or die(mysql_error());
   
   }
   echo 'successfully inserted';
  
   }

}
if(isset($_GET['Qid'])){
$Quatation_id=$_GET['Qid'];

$ies= mysql_query("SELECT * FROM `tbl_preparedquotation` WHERE Quotation_id='$Quatation_id'")or die(mysql_error());
$rew=  mysql_fetch_array($ies);
$cidt=$rew['customer_id'];

$dweZ= mysql_query("SELECT * FROM `quotation_customer` WHERE customer_id='$cidt'")or die(mysql_error());
$dwe=  mysql_fetch_array($dweZ);
$customername=$dwe['customer_name'];
$addres=$dwe['Address'];
$loca=$dwe['Location'];
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
$email=$_POST['email'];
$tel=$_POST['telephonenumber'];
$vrn=$_POST['vrn'];  
$ins=  mysql_query("INSERT INTO `quotation_customer`(`customer_name`, `Address`, `Location`, `Email`, `TelephoneNo`, `VRN`) VALUES ('$customername','$addres','$loca','$email','$tel','$vrn')")or die(mysql_error());
if($ins){
 $wer=  mysql_query("SELECT * FROM `quotation_customer` WHERE customer_name='$customername' AND Address='$addres' AND Location='$loca' AND Email='$email' AND TelephoneNo='$tel' AND VRN='$vrn'")or die(mysql_error());   

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
$email='';
$tel='';
$vrn='';
}
?>






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
      <input type="hidden" name="customerid" class="form-control" value="<?php echo $er;?>">
      <input type="hidden" name="quotationid" class="form-control" value="<?php echo $_GET['Qid']?>">
  </div>
  
  
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Adress</span></span>
    <input type="text" name="address" class="form-control" readonly="" value="<?php echo $addres;?>">
  </div>
  
 <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Location</span></span>
    <input type="text" name="location" class="form-control" readonly=""value="<?php echo $loca;?>" >
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
    <input type="date" name="invoicedate" class="form-control">
  </div>
      
   <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Invoice number</span></span>
    <input type="text" name="invoicenumber" class="form-control">
  </div>
           
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Vat</span></span>
    <input type="text" name="vat" class="form-control">
  </div>    
      
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Currency</span></span>
    <input type="text" name="currency" class="form-control">
  </div>   
                  
</div>
</div>
     
     
<div class="row" style="margin-top: 4px; margin-bottom: 4px;">
<div class="col-lg-12">
   <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Invoice Description</span></span>
    <input type="text" name="invoicedescription" class="form-control">
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
                                        <tr>

    <td style="width:5%">
    <input name="text" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
    </td>
    <td style="width:30%">
    <input name="description[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    
    <td style="width:17%">
    <input name="unit[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
                                            
    <td style="width:18%">
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
     
<div class="row">
<div class="col-lg-12">
      
  <h5>PO and PI Reference</h5>
  <div class="input-group" style="width:100%; margin:2px"> 
      <span class="input-group-addon" style="width:30%" ><span class="text-left">PO Reference</span></span>
      <input type="text" name="po_reference" class="form-control">
  </div>
  
  
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">PI Reference</span></span>
    <input type="text" name="pi_reference" class="form-control">
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
    


