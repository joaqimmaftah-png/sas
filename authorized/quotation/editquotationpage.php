<?php

if(isset($_GET['delete_id'])){
    $item_idd=$_GET['delete_id'];
   $dwee= mysql_query("delete from `tbl_quotationitem` WHERE Item_id='$item_idd'")or die(mysql_error()); 
}


$Qid=$_GET['quid'];
$result = mysql_query("SELECT * FROM tbl_preparedquotation WHERE Quotation_id='$Qid' ")or die(mysql_error());
$erw=  mysql_fetch_array($result);
$rdi=$erw['customer_id'];
$Qname=$erw['Quotation_name'];
$Qdate=$erw['Quotation_date'];
$Qrefe=$erw['Quotation_number'];
$discount=$erw['discount'];
$project_id=$erw['project_id'];




$dweZ= mysql_query("SELECT * FROM `quotation_customer` WHERE customer_id='$rdi'")or die(mysql_error());
$dwe=  mysql_fetch_array($dweZ);
$customername=$dwe['customer_name'];
$addres=$dwe['Address'];
$loca=$dwe['Location'];
$email=$dwe['Email'];
$tel=$dwe['TelephoneNo'];
$vrn=$dwe['VRN'];

if(isset($_POST['submit'])){
$quoid=$Qid;
$Qname=$_POST['Quotationname'];   
$Qdate=$_POST['Quotationdate'];   
$Qref=$_POST['Quotationreference'];
$discou=$_POST['discount'];
$descr=$_POST['description'];
$specif=$_POST['specification'];
$unit=$_POST['unit'];   
$quantity=$_POST['quantity'];   
$unitprice=$_POST['unitprice'];
$itemid=$_POST['itemid'];
$new=$_POST['new'];
$project=$_POST['project_id'];

$ins= mysql_query("UPDATE `tbl_preparedquotation` SET `Quotation_name`='$Qname',`Quotation_date`='$Qdate',`Quotation_number`='$Qref', `discount`='$discou' WHERE Quotation_id='$quoid'")or die(mysql_error());

   for($i=0; $i<sizeof($descr); $i++){
       $total=$quantity[$i]*$unitprice[$i];
   $insert = mysql_query("UPDATE `tbl_quotationitem` SET `Description`='$descr[$i]',`Unit`='$unit[$i]',`Quantity`='$quantity[$i]',`Unit_Price`='$unitprice[$i]',Net_Price ='$total',`Specification`='$specif[$i]' WHERE Item_id='$itemid[$i]'")or die(mysql_error());
   }
   
   if(!empty($_POST['description1'])){
       
$quoid=$Qid;   
$descr1=$_POST['description1'];
$specif1=$_POST['specification1'];
$unit1=$_POST['unit1'];   
$quantity1=$_POST['quantity1'];   
$unitprice1=$_POST['unitprice1'];

  for($i=0; $i<sizeof($descr1); $i++){
       $total1=$quantity[$i]*$unitprice1[$i];
   $insert=  mysql_query("INSERT INTO `tbl_quotationitem`(`Description`,`Specification`, `Unit`, `Quantity`, `Unit_Price`, `Net_Price`, `Quotation_id`) "
           . "VALUES ('$descr1[$i]', '$specif1[$i]', '$unit1[$i]', '$quantity1[$i]', '$unitprice1[$i]', '$total1', '$quoid')")or die(mysql_error());
   }


   }
   
  echo '<div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> You have successfully updated your data 
</div>';
 
}

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
 <form action="" method="POST">
<div class="row">
        
<div class="col-lg-7">
           
</div>
        
<!--    <-----------Add new Quotation Form--------------->    
 
  <div class="col-lg-5">
      
  <div class="input-group" style="width:100%; margin:2px"> 
      <span class="input-group-addon" style="width:30%" ><span class="text-left">Customer name</span></span>
      <input type="text" name="customername" class="form-control" readonly="" value="<?php echo $customername;?>">
      <input type="hidden" name="quotationid" class="form-control" readonly="" value="<?php echo $er;?>">
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
    <span class="input-group-addon" style="width:30%"><span class="text-left">Quotation name</span></span>
    <input type="text" name="Quotationname" value="<?php echo $Qname;?>" class="form-control">
  </div>
    <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Quotation date</span></span>
    <input type="text" name="Quotationdate"  value="<?php echo $Qdate;?> "class="form-control">
  </div>
      
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Quotation reference</span></span>
    <input type="text" name="Quotationreference" value="<?php echo $Qrefe;?>" class="form-control">
  </div>
      
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Discount</span></span>
    <input type="text" name="discount" value="<?php echo $discount;?>" class="form-control">
  </div> 
      
  <div class="input-group" style="width:100%; margin:2px"> 
    <span class="input-group-addon" style="width:30%"><span class="text-left">Project_Id</span></span>
    <input type="text" name="project_id" value="<?php echo $project_id;?>" class="form-control">
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
            
            
            </tr></thead>
             
         <tbody  style="font-size:9px">
                                        
                                        
                                        
    <?php
        
 $resultT = mysql_query("SELECT * FROM `tbl_quotationitem` WHERE Quotation_id='$Qid'")or die(mysql_error());
 $u=1;
 while ($erwe=  mysql_fetch_array($resultT)){
$itemid=$erwe['Item_id'];
$Desc=$erwe['Description'];
$unit=$erwe['Unit'];
$Qty=$erwe['Quantity'];
$uprice=$erwe['Unit_Price']; 
$Specification=$erwe['Specification']; 
        
        
        
        
     ?>                                
       
                                        <tr>
                                            
                                            

    <td style="width:5%">
        <input name="text" value="<?php echo $u++; ?>" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
        <input name="itemid[]" value="<?php echo $itemid;?>" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="hidden">
    </td>
    
    
    <td style="width:30%">
        <input name="description[]" value="<?php echo $Desc; ?>"  id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    <td style="width:30%">
        <input name="specification[]" value="<?php echo $Specification; ?>"  id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    
    <td style="width:11%">
    <input name="unit[]"  value="<?php echo $unit; ?>"  id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
                                            
    <td style="width:11%">
    <input name="quantity[]" value="<?php echo $Qty; ?>" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    
    <td style="width:28%">
    <input name="unitprice[]" value="<?php echo $uprice; ?>"  id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
     <td style="width:5%">

         <a href="?action=editquotation&quid=<?php echo $Qid;?>&delete_id=<?php echo $itemid;?>" class=" btn btn-success fg-white" >x</a> 
    </td>
    
   </tr> 
   <?php
   
   }
   
   ?>
   <tr>

    <td style="width:5%">
    <input name="mpya" id="buying_price" class="form-control amount editable"  aria-describedby="sizing-addon1" type="text">
    </td>
    <td style="width:30%">
    <input name="description1[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    <td style="width:30%">
    <input name="specification1[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    
    <td style="width:11%">
    <input name="unit1[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
                                            
    <td style="width:11%">
    <input name="quantity1[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
    </td>
    
    <td style="width:28%">
    <input name="unitprice1[]" id="buying_price" class="form-control amount editable" placeholder=""  aria-describedby="sizing-addon1" type="text">
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
<span aria-hidden="true"></span>Update&nbsp;</button>
</div>   
</div>

</form>

