  <form action="authorized/usersystem/page_update_asset.php" method="post" id="updateasset">
        <div class="col-lg-12">
            <button type="submit" name="updateasset" class="btn btn-success" style="color:white"><i class="fa fa-arrow-down"></i>&nbsp;Save data</button>
            <button class="btn btn-default" ><i class="fa fa-remove"></i> Cancel</button>
            <br />
            <br />
        </div>
        <div class="col-lg-12" id="updatedatas">

        </div>
        <div class="col-lg-6">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Custodian:</span></span>
                <select class="form-control"  id="kind_id" name="employeename">
                    <option value="<?php echo $employe_no; ?>" ><?php echo $jina; ?></option>
<?php
$emplott = mysql_query("SELECT * from  tbl_employee") or die(mysql_error());
while ($joh = mysql_fetch_array($emplott)) {
    $ljina = mysql_fetch_array($emplott);
    ?>
                        <option value="<?php echo $ljina['emp_file_no']; ?>"><?php echo $ljina['first_name'] . ' ' . $ljina['surname']; ?></option>
    <?php
}
?>
                </select>
            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">HOD:</span></span>
                <select class="form-control" id="sel1" name="registerid">
                    <option value="<?php echo $registerid; ?>"><?php echo $jinas; ?></option>
                    <?php
                    $selc_hod = mysql_query("SELECT DISTINCT emp_file_no,department_id FROM tbl_assign_to_department WHERE position_id=1") or die(mysql_error());
                    while ($wote = mysql_fetch_array($selc_hod)) {
                        $emply_ids = $wote['emp_file_no'];
                        $department_id = $wote['department_id'];


                        $show_contacts = mysql_query("SELECT * FROM tbl_contact WHERE emp_file_no='$emply_ids'") or die(mysql_error());
                        $show_email = mysql_fetch_array($show_contacts);
                        $hod_email = $show_email['email'];

                        $accinfo = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$emply_ids'")or die(mysql_error());
                        $acc = mysql_fetch_array($accinfo);
                        $facc = $acc['first_name'];
                        $lacc = $acc['surname'];
                        ?>
                        <option value="<?php echo $emply_ids . '@' . $department_id; ?>"><?php echo $facc . ' ' . $lacc; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Asset Name:</span></span>
                <select class="form-control"  id="kind_id" name="assetname" disabled="">
                    <option value="" ><?php echo $asset_name; ?></option>
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
                <input name="descriptional"   id="product_name" class="form-control editable" placeholder=""  value="<?php echo $description; ?>" disabled="" aria-describedby="sizing-addon1" type="text">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Model:</span></span>
                <input name="modeli" id="product_name"   class="form-control editable" placeholder="" value="<?php echo $model; ?>" disabled="" aria-describedby="sizing-addon1" type="text">

            </div>


            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Vendor:</span></span>
                <select class="form-control"  id="kind_id" name="vendor" disabled="">
                    <option value="<?php echo $vendor; ?>" ><?php echo $vendor_name; ?></option>
<?php
$vendo = mysql_query("SELECT * from tbl_vendors") or die(mysql_error());
while ($johhs = mysql_fetch_array($vendo)) {
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
                <input name="barcode" id="product_name" class="form-control editable" placeholder="" value="<?php echo $barcode; ?>" disabled="" aria-describedby="sizing-addon1" type="text">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Serial No:</span></span>
                <input name="serialno" id="product_name" class="form-control editable" placeholder="" value="<?php echo $serial_number; ?>" disabled="" aria-describedby="sizing-addon1" type="text">

            </div>



        </div>
        <div class="col-lg-6">
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Status:</span></span>
                <select class="form-control"  id="kind_id" name="status">
                    <option value="<?php echo $status; ?>" ><?php echo $status; ?></option>                                       
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
                <input name="purchase_price" id="product_name" class="form-control editable" placeholder="" value="<?php echo $purchase_price; ?>" aria-describedby="sizing-addon1" disabled="" type="text">

            </div>

            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Mode of payment:</span></span>
                <select class="form-control"  id="kind_id" name="mode_of_payment" disabled="">
                    <option value="<?php echo $model_of_payment; ?>" ><?php echo $model_of_payment; ?></option>                                       
                    <option value="Cash">Cash</option>
                    <option value="Credit">Credit</option>

                </select>
            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Purchase:</span></span>
                <input name="purchase" id="product_name"   class="form-control editable" placeholder="dd/mm/yy" value="<?php echo $purchase; ?>" disabled="" aria-describedby="sizing-addon1" type="text">
                <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Warranty:</span></span>
                <input name="warranty" id="product_name"   class="form-control editable" placeholder="dd/mm/yy" value="<?php echo $warranty; ?>" disabled="" aria-describedby="sizing-addon1" type="text">

            </div>

            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Location:</span></span>
                <select class="form-control"  id="kind_id" name="locations">
                    <option value="<?php echo $location_idd; ?>" ><?php echo $location_namee; ?></option>
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
                <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Issue Date:</span></span>
                <input name="issue_date" id="product_name"   class="form-control editable" placeholder="dd/mm/yy" value="<?php echo $issue_date; ?>"  aria-describedby="sizing-addon1" type="text">
                <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">End Date:</span></span>
                <input name="end_date" id="product_name"   class="form-control editable" placeholder="dd/mm/yy" value="<?php echo $end_date; ?>" disabled="" aria-describedby="sizing-addon1" type="text">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Notes:</span></span>
                <textarea name="notes" id="product_name" class="form-control editable" placeholder="" value="<?php echo $note; ?>" disabled="" aria-describedby="sizing-addon1" type="text"></textarea>

            </div>
        </div>
    </form>