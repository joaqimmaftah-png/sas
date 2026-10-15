                            <form action="authorized/usersystem/page_asset_menagement.php" method="post" id="submitasset">
                                <div class="col-lg-12">
                                    <button type="submit" name="submitasset" class="btn btn-success" style="color:white"><i class="fa fa-arrow-down"></i>&nbsp;Submit data</button>
                                    <button class="btn btn-default" ><i class="fa fa-remove"></i> Cancel</button>
                                    <br />
                                    <br />
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group" style="width:100%; margin:2px 0">
                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Custodian:</span></span>
                                        <select class="form-control"  id="kind_id" name="employeename">
                                            <option value="" >----Custodian---</option>
<?php
$department_id = $positions['department_id'];
$employee_hdd = $_SESSION['hod_system_access'];
if ($employee_hdd == 'YES') {
    $show = '';
} else {

    $show = 'readonly=""';
}
$emplot = mysql_query("SELECT * from tbl_assign_to_department") or die(mysql_error());
while ($joh = mysql_fetch_array($emplot)) {
    $emp_file = $joh['emp_file_no'];
    $emplott = mysql_query("SELECT * from  tbl_employee where emp_file_no='$emp_file'") or die(mysql_error());
    $ljina = mysql_fetch_array($emplott);
    ?>
                                                <option value="<?php echo $emp_file; ?>"><?php echo $ljina['first_name'] . ' ' . $ljina['surname']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input-group" style="width:100%; margin:2px 0">
                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Owner Department:</span></span>
                                        <input  name="contactname"  id="product_name" class="form-control editable" disabled="" value="<?php echo $department_name; ?>" aria-describedby="sizing-addon1" type="text">
                                        <input type="text" name="department_id" value="<?php echo $department_id; ?>" hidden="">
                                        <input type="text" name="registerid" value="<?php echo $_SESSION['emp_file_no']; ?>" hidden="">
                                    </div>
                                    <div class="input-group" style="width:100%; margin:2px 0">
                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Asset Name:</span></span>
                                        <select class="form-control"  id="kind_id" name="assetname">
                                            <option value="" >----Asset Name:---</option>
                                            <?php
                                            $choseasset = mysql_query("SELECT * from tbl_asset_name") or die(mysql_error());
                                            while ($johh = mysql_fetch_array($choseasset)) {
                                                $asset_name = $johh['asset_name'];
                                                $asset_category = $johh['asset_category'];
                                                ?>
                                                <option value="<?php echo $asset_category . '@' . $asset_name; ?>"><?php echo $asset_name; ?></option>
    <?php
}
?>
                                        </select>
                                    </div>
                                    <div class="input-group" style="width:100%; margin:2px 0">
                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Description:</span></span>
                                        <input name="descriptional" <?php echo $show; ?>  id="product_name" class="form-control editable" placeholder="" <?php echo $show; ?> value="" aria-describedby="sizing-addon1" type="text">

                                    </div>
                                    <div class="input-group" style="width:100%; margin:2px 0">
                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Model:</span></span>
                                        <input name="modeli" id="product_name" <?php echo $show; ?>  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                    </div>
                                    
  
                                    <div class="input-group" style="width:100%; margin:2px 0">
                                     <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Vendor:</span></span>
                                        <select class="form-control"  id="kind_id" name="vendor">
                                            <option value="" >----Vendor:---</option>
                                            <?php
                                            $vendorss = mysql_query("SELECT * from tbl_vendors") or die(mysql_error());
                                            while ($johhs = mysql_fetch_array($vendorss)) {
                                                $vendor_name = $johhs['vendor_name'];
                                                $vendor_id = $johhs['vendor_id'];
                                                
                                                ?>
                                                <option value="<?php echo $vendor_id; ?>"><?php echo $vendor_name; ?></option>
<?php
}
?>
                                        </select>
                                     </div>
                                    <div class="input-group" style="width:100%; margin:2px 0">
                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Barcode:</span></span>
                                        <input name="barcode" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                    </div>
                                    <div class="input-group" style="width:100%; margin:2px 0">
                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Serial No:</span></span>
                                        <input name="serialno" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                    </div>


                                </div>
                                <div class="col-lg-6">
                                     <div class="input-group" style="width:100%; margin:2px 0">
                                     <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Status:</span></span>
                                        <select class="form-control"  id="kind_id" name="status">
                                                <option value="Null" >----Status---</option>                                       
                                                <option value="Active">Active</option>
                                                <option value="Disposed">Disposed</option>
                                                <option value="In Stock">In Stock</option>
                                                <option value="Active">Missing</option>
                                                <option value="Reserved">Reserved</option>
                                                <option value="RMA">RMA</option>
                                                <option value="Stolen">Stolen</option>
                                        </select>
                                     </div>
                                    <div class="input-group" style="width:100%; margin:2px 0">
                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Purchase Price:</span></span>
                                        <input name="purchase_price" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                    </div>
                                    
                                      <div class="input-group" style="width:100%; margin:2px 0">
                                     <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Mode of payment:</span></span>
                                        <select class="form-control"  id="kind_id" name="mode_of_payment">
                                            <option value="Null" >----Select---</option>                                       
                                                <option value="Cash">Cash</option>
                                                <option value="Credit">Credit</option>
                                                
                                        </select>
                                     </div>
                                      <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Purchase:</span></span>
                                    <input name="purchase" id="product_name"   class="form-control editable" placeholder="dd/mm/yy"  aria-describedby="sizing-addon1" type="text">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Warranty:</span></span>
                                    <input name="warranty" id="product_name"   class="form-control editable" placeholder="dd/mm/yy" value="" aria-describedby="sizing-addon1" type="text">

                                </div>

                                     <div class="input-group" style="width:100%; margin:2px 0">
                                     <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Location:</span></span>
                                        <select class="form-control"  id="kind_id" name="locations">
                                            <option value="" >----Location---</option>
                                            <?php
                                            $locatin = mysql_query("SELECT * from tbl_assets_locations") or die(mysql_error());
                                            while ($locname = mysql_fetch_array($locatin)) {
                                                $location_name = $locname['location_name'];
                                                $location_id = $locname['location_id'];
                                                ?>
                                                <option value="<?php echo $location_id; ?>"><?php echo $location_name; ?></option>
<?php
}

?>
                                        </select>
                                     </div>

                                    <div class="input-group" style="width:100%; margin:2px 0">
                                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Notes:</span></span>
                                        <textarea name="notes" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text"></textarea>

                                    </div>
                                </div>
                            </form>