<?php
require_once __DIR__ . '/../../mysql_compat.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include '../db.php';
$asset_iddd = $_GET['asset_id'];

$explore=  explode('_',$asset_iddd);
 $asset_idd=$explore[0];
$assigners='SSW'.' '.$explore[1];

 
$selectasset = mysql_query("SELECT * FROM tbl_fixed_asset WHERE asset_id='$asset_idd'") or die(mysql_error());
$assetss = mysql_fetch_array($selectasset);
$asset_id = $assetss['asset_id'];
$asset_name = $assetss['asset_name'];
$description = $assetss['description'];
$vendor = $assetss['vendor'];
$model = $assetss['model'];
$serial_number = $assetss['serial_number'];
$barcode = $assetss['barcode'];
$note = $assetss['note'];
$purchase = $assetss['purchase'];
$warranty = $assetss['warranty'];
$cat = $assetss['cat'];
$model_of_payment = $assetss['model_of_payment'];
$status = $assetss['status'];
$purchase_price = $assetss['purchase_price'];

$vendorss = mysql_query("SELECT * from tbl_vendors where vendor_id='$vendor'") or die(mysql_error());
$j = mysql_fetch_array($vendorss);
$vendor_name = $j['vendor_name'];

$employt = mysql_query("SELECT * FROM tbl_employee_asset WHERE 	asset_id='$asset_id'") or die(mysql_error());
$jj = mysql_fetch_array($employt);
$employe_no = $jj['employe_no'];
$location_id = $jj['location_id'];
$issue_date = $jj['issue_date'];
$end_date = $jj['end_date'];
$hod_name = $jj['hod_name'];
$department_id = $jj['department_id'];
$registerid = $jj['registerid'];


$emp = mysql_query("SELECT * from tbl_employee WHERE emp_file_no='$employe_no'") or die(mysql_error());
$joh = mysql_fetch_array($emp);
$jina = $joh['first_name'] . ' ' . $joh['surname'];

$empe = mysql_query("SELECT * from tbl_employee WHERE emp_file_no='$registerid'") or die(mysql_error());
$johs = mysql_fetch_array($empe);
$jinas = $johs['first_name'] . ' ' . $johs['surname'];

$locating = mysql_query("SELECT * from tbl_assets_locations where location_id='$location_id'") or die(mysql_error());
$locnamm = mysql_fetch_array($locating);
$location_namee = $locnamm['location_name'];
$location_idd = $locnamm['location_id'];
?>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("#updateasset").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({url: "authorized/usersystem/page_update_asset.php",
                xhr: function ()
                {
                    var xhr = new window.XMLHttpRequest();
                    //Upload progress
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            //Do something with upload progress
                            console.log(percentComplete);
                        }
                    }, false);
                    //Download progress
                    xhr.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            //Do something with download progress
                            console.log(percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $("#updatedatas").html(data);
                },
                error: function () {
                }
            });
        }));
    });
</script>
<div class="col-lg-3">
    <div class="thumbnail">
        <a href="../asset_images/safety.jpg">
            <img src="authorized/usersystem/asset_images/safety.jpg" alt="Fjords" style="width:100%">
            <div class="caption">
                <!--mm-->
            </div>
        </a>
    </div>


</div>  
<!--kkkkkkkkkkkkkkkkkkkk-->

<div class="col-lg-9">

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
$emplott = mysql_query("SELECT * FROM  tbl_employee ORDER BY first_name ASC") or die(mysql_error());
while ($kj = mysql_fetch_array($emplott)) {
    
    ?>
                        <option value="<?php echo $kj['emp_file_no']; ?>"><?php echo $kj['first_name'] . ' ' . $kj['surname']; ?></option>
    <?php
}
?>
                </select>
            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">HOD:</span></span>
                <select class="form-control" id="sel1" name="hod">
                    <option value="<?php echo $hod_name.'@'.$department_id; ?>"><?php echo $jinas; ?></option>
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
                        <option value="<?php echo $emply_ids.'@'.$department_id; ?>"><?php echo $facc . ' ' . $lacc; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Asset Name:</span></span>
                <input name="assetnames"   id="product_name" class="form-control editable" placeholder=""  value="<?php echo $asset_name; ?>"  aria-describedby="sizing-addon1" type="text">
                <input name="assetname"   id="product_name" class="form-control editable" placeholder=""  value="<?php echo $asset_category . '@' . $asset_id; ?>"  aria-describedby="sizing-addon1" type="hidden">
                <input name="assigners"   id="product_name" class="form-control editable" placeholder=""  value="<?php echo $assigners; ?>"  aria-describedby="sizing-addon1" type="hidden">
            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Description:</span></span>
                <input name="descriptional"   id="product_name" class="form-control editable" placeholder=""  value="<?php echo $description; ?>"  aria-describedby="sizing-addon1" type="text">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Model:</span></span>
                <input name="modeli" id="product_name"   class="form-control editable" placeholder="" value="<?php echo $model; ?>"  aria-describedby="sizing-addon1" type="text">

            </div>


            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Vendor:</span></span>
                <select class="form-control"  id="kind_id" name="vendor" >
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
                <input name="barcode" id="product_name" class="form-control editable" placeholder="" value="<?php echo $barcode; ?>"  aria-describedby="sizing-addon1" type="text">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Serial No:</span></span>
                <input name="serialno" id="product_name" class="form-control editable" placeholder="" value="<?php echo $serial_number; ?>"  aria-describedby="sizing-addon1" type="text">

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
                <input name="purchase_price" id="product_name" class="form-control editable" placeholder="" value="<?php echo $purchase_price; ?>" aria-describedby="sizing-addon1"  type="text">

            </div>

            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Mode of payment:</span></span>
                <select class="form-control"  id="kind_id" name="mode_of_payment" >
                    <option value="<?php echo $model_of_payment; ?>" ><?php echo $model_of_payment; ?></option>                                       
                    <option value="Cash">Cash</option>
                    <option value="Credit">Credit</option>

                </select>
            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Purchase:</span></span>
                <input name="purchase" id="product_name"   class="form-control editable" placeholder="dd/mm/yy" value="<?php echo $purchase; ?>"  aria-describedby="sizing-addon1" type="text">
                <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Warranty:</span></span>
                <input name="warranty" id="product_name"   class="form-control editable" placeholder="dd/mm/yy" value="<?php echo $warranty; ?>"  aria-describedby="sizing-addon1" type="text">

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
                <input name="end_date" id="product_name"   class="form-control editable" placeholder="dd/mm/yy" value="<?php echo $end_date; ?>"  aria-describedby="sizing-addon1" type="text">

            </div>
            <div class="input-group" style="width:100%; margin:2px 0">
                <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Notes:</span></span>
                <textarea name="notes" id="product_name" class="form-control editable" placeholder="" value="<?php echo $note; ?>"  aria-describedby="sizing-addon1" type="text"></textarea>

            </div>
        </div>
    </form>
</div>
<!--mmmmmmmmmmmmmmmmmm-->



















