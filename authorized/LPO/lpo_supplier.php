
<?php
 include_once 'authorized/db.php';
 $sms='';
if(isset($_POST['add_new_supplier'])){
    $customer=$_POST['customer'];
    if(!empty($customer)){
    
    $namr=$_POST['customer'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $phone=$_POST['phone'];
    $contactname=$_POST['contactname'];
    $email=$_POST['email'];     
    $VRN=$_POST['VRN'];
    $TIN=$_POST['TIN'];        
    $supplierof=$_POST['supplierof'];
    $suppliers_cat=$_POST['suppliers_cat'];
    $country=$_POST['country'];
    $tel=$_POST['tel'];
    $Fax=$_POST['Fax'];
      
      $customerr=  mysql_query("SELECT * FROM tbl_customer WHERE customer_name='$namr'") or die(mysql_error());
    $tu=  mysql_fetch_array($customerr);
    $customed=$tu['customer_name'];
    if($customed!=$customer){
      $customers=mysql_query("INSERT INTO tbl_customer(`customer_name`, `address`, `city`, `phone_no`, `contact_name`, `email`, `phone_no2`, `supplierof`, `category`, `country`, `TIN`, `fax`, `vrn`)"
            . "VALUE('$customer','$address','$city','$phone','$contactname','$email','$tel','$supplierof','$suppliers_cat','$country','$TIN','$Fax','$VRN')") or die(mysql_error());
    }
     else {
        $sms='<div class="alert alert-danger">
  <strong>Danger!</strong> Supplier alredy exist.
</div>';
     }
}
else {
    $sms='<div class="alert alert-danger">
  <strong>Danger!</strong> Please Fill Supplier Name.
</div>';
}
}
if(isset($_POST['update_new_supplier'])){
    
        $customer=$_POST['customer'];       
    $namr=$_POST['customer'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $phone=$_POST['phone'];
    $contactname=$_POST['contactname'];
    $email=$_POST['email'];     
    $VRN=$_POST['VRN'];
    $TIN=$_POST['TIN'];        
    $supplierof=$_POST['supplierof'];
    $suppliers_cat=$_POST['suppliers_cat'];
    $country=$_POST['country'];
    $tel=$_POST['tel'];
    $Fax=$_POST['Fax'];
    $customer_id=$_POST['customer_id'];

      
     
      $customers=mysql_query("UPDATE tbl_customer SET customer_name='$customer', `address`='$address', `city`='$city', `phone_no`='$phone',"
              . " `contact_name`='$contactname', `email`='$email', `phone_no2`='$tel', `supplierof`='$supplierof', `category`='$suppliers_cat',"
              . " `country`='$country', `TIN`='$TIN', `fax`='$Fax', `vrn`='$VRN' WHERE customer_id='1'") or die(mysql_error());
   
     
}
?>

<div class="row">
       <div class="col-lg-4">
 <button type="button"  data-toggle="modal" data-target="#new_supplier" class="btn btn-success" style="color:white"><i class="glyphicon glyphicon-plus"></i>New Supplier</button>
 <br><br>
</div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php echo $sms;?>
    </div>
       <div class="col-lg-12">
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Supplier#</th>
                <th>Supplier Name</th>
                <th>Supplier of</th>
                <th>Category</th>
                <th>Contact Name</th>
                 <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
            $purchase = mysql_query("SELECT * FROM tbl_customer") or die(mysql_error());
            while ($row = mysql_fetch_array($purchase)) {
                $customer_id = $row['customer_id'];
                $customer_name = $row['customer_name'];
                $address=$row['address'];
                $city=$row['city'];
                $phone_no = $row['phone_no'];
                $contact_name= $row['contact_name'];
                $supplierof=$row['supplierof'];
                $phone_no2=$row['phone_no2'];
                $category=$row['category'];
                $email=$row['email'];                
                $country=$row['country'];
                $TIN=$row['TIN'];
                $fax=$row['fax'];
                $vrn=$row['vrn'];
                ?>
                <tr>
                    <td>
                        <a href="#"><?php echo 'SSI'.sprintf("%04d", $customer_id);?></a> 
                    </td> 
                    
                    <td> <a data-toggle="modal" href="#edit_supplier" class="view-admin"  
                            data-a="<?php echo $customer_name; ?>"
                            data-b="<?php echo $address; ?>"
                            data-c="<?php echo $city; ?>"
                            data-d="<?php echo $phone_no; ?>"
                            data-e="<?php echo $contact_name; ?>"
                            data-f="<?php echo $supplierof; ?>"
                            data-g="<?php echo $phone_no2; ?>"
                            data-h="<?php echo $category; ?>"
                            data-i="<?php echo $email; ?>"
                            data-j="<?php echo $country; ?>"
                            data-k="<?php echo  $TIN; ?>"
                            data-l="<?php echo $fax; ?>"
                            data-m="<?php echo $vrn; ?>"
                            data-n="<?php echo $customer_id; ?>"
                            
                            
                            
                            
                            ><?php echo $customer_name;?>
                            
                        </a>
                    </td>
                     <td><?php echo $supplierof;?></td>
                    <td><?php echo $category; ?></td>
                  <td><?php echo $contact_name; ?></td>
                    <td><?php echo $email;?></td>
                </tr>
            <?php } ?>
        </tbody>

        <tfoot>
            <th>Supplier#</th>
                <th>Supplier Name</th>
                <th>Supplier of</th>
                <th>Category</th>
                <th>Contact Name</th>                          
                 <th>Email</th>
        </tfoot>
    </table>
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
                                    <input name="customer"  class="form-control editable"  value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                      <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Supplier of:</span></span>
                                    <input name="supplierof"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                      <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">VRN:</span></span>
                                    <input name="VRN"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                      <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">TIN:</span></span>
                                    <input name="TIN"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                       <div class="input-group" style="width:100%; margin:2px 0">
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Supplier Category:</span></span>
<select class="form-control"    name="suppliers_cat">
                                                    <option value="Null" >--Supplier Category--</option>
                                                        <option value="A" >A</option>                                                    
                                                        <option value="B" >B</option>
                                                        <option value="C" >C</option>
                                                        <option value="D" >D</option>
                                                </select>
                                                    </div>                          
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Address:</span></span>
                                    <input name="address"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                      <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">City:</span></span>
                                    <input name="city"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div> 
                      <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Country:</span></span>
                                    <input name="country"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div> 
                              <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Telephone:</span></span>
                                    <input name="tel"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                              <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Fax:</span></span>
                                    <input name="Fax"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                    
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Contact Name:</span></span>
                                    <input name="contactname"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                       <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Phone Number:</span></span>
                                    <input name="phone"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Email:</span></span>
                                    <input name="email"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                      <button type="submit" class="btn btn-success" name="add_new_supplier" style="color:white"><i class="glyphicon glyphicon-plus"></i>&nbsp;Save</button>
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
<div id="edit_supplier" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Supplier</h4>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class=" col-lg-12">                                                    
                                   <form action="" method="POST">
                          <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Supplier:</span></span>
                                    <input name="customer" id="a" class="form-control editable"  value="" aria-describedby="sizing-addon1" type="text">
                                    <input name="customer_id" id="n" class="form-control editable"  value="" aria-describedby="sizing-addon1" type="hidden">
                                </div>
                      <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Supplier of:</span></span>
                                    <input name="supplierof" id="f" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                      <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">VRN:</span></span>
                                    <input name="VRN" id="m" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                      <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">TIN:</span></span>
                                    <input name="TIN" id="k"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                       <div class="input-group" style="width:100%; margin:2px 0">                    
                                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Supplier Category:</span></span>
<select class="form-control"    name="suppliers_cat">
                                                    <option value="" id="h" class="x"></option>
                                                        <option value="A" >A</option>                                                    
                                                        <option value="B" >B</option>
                                                        <option value="C" >C</option>
                                                        <option value="D" >D</option>
                                                </select>
                                                    </div>                          
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Address:</span></span>
                                    <input name="address"  id="b" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                      <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">City:</span></span>
                                    <input name="city"  id="c" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div> 
                      <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Country:</span></span>
                                    <input name="country" id="j" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div> 
                                                                                           
                          
                              <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Telephone:</span></span>
                                    <input name="tel" id="g" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                              <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Fax:</span></span>
                                    <input name="Fax" id="l"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                    
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Contact Name:</span></span>
                                    <input name="contactname" id="e" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>                                     
                       <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Phone Number:</span></span>
                                    <input name="phone" id="d"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
        <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Email:</span></span>
                                    <input name="email" id="i" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                      <button type="submit" class="btn btn-success" name="update_new_supplier" style="color:white"><i class="glyphicon glyphicon-plus"></i>&nbsp;Save</button>
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
