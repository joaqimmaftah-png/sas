<head>
     <script type="text/javascript">
        $(document).ready(function (e) {
            $("#sub_tpf").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/car_track/add_driver.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#kubwa").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>
   
        
</head> 
<a href="?action=view info&car_info_id=<?php
require_once __DIR__ . '/mysql_compat.php';
 echo $_GET['q'];?>" class="button primary"><span class="icon-fullscreen-alt"></span>&nbsp;View</a>
<a href="?action=edit car info&car_info_id=<?php echo $_GET['q'];?>" class="button info"><span class="icon-pencil"></span>&nbsp;Edit</a>
<a class="button primary" href="#" data-toggle="modal" data-target="#manualissue" class="button info"><span class="icon-plus-2"></span>&nbsp;Add Driver</a>
<a href="?action=homedelete&car_info_id=<?php echo $_GET['q'];?>"  class="button danger"><span class="icon-cancel-2"></span>&nbsp;Delete</a>


<?php
include '../db.php';
$selected_car=  mysql_query("SELECT * FROM tbl_car_informations WHERE car_info_id='".$_GET['q']."'") OR die(mysql_error());
$row=  mysql_fetch_array($selected_car);
$vehicle_reg_num=$row['vehicle_reg_num'];
$make=$row['make'];
$model=$row['model'];

?>



<!--/////////////////////////////////manual/////////////////////////////////////////////-->
<div id="manualissue" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog ">
        <div class="modal-content" id="">
            <form  action="" enctype="multipart/form-data" method="post" id="sub_tpf">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Driver</h4>
    </div>

    <div class="modal-body">
        <div id="kubwa">
        

        </div>       
        <div role="tabpanel">                          
            <div class="tab-content" style="padding:15px 0">
                <div role="tabpanel" class="tab-pane active" id="tab1">        
 <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Vehicle Registration#:</span></span>
                        <input name="" id="buying_price" class="form-control amount editable" placeholder="" value="<?php echo $vehicle_reg_num;?>" readonly="" aria-describedby="sizing-addon1" type="text">                     
                        <input name="reg_no" id="buying_price" class="form-control amount editable" placeholder="" value="<?php echo $vehicle_reg_num;?>"  aria-describedby="sizing-addon1" type="hidden">
                    </div>
                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Makes:</span></span>
                        <input name="make" id="product_code" class="form-control" value="<?php echo $make; ?>" aria-describedby="sizing-addon1" readonly="" type="text">
                    </div>
                                     <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Model:</span></span>
                        <input name="model" id="product_code" class="form-control" value="<?php echo $model; ?>" aria-describedby="sizing-addon1" readonly="" type="text">
                    </div>

                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Owner:</span></span>
                        <input name="owner" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                    </div>                 

                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Driver Name:</span></span>
                         <input name="dname" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                    </div>
                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Phone Number:</span></span>
                        <input name="pnum" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                    </div>
                    <div class="input-group" style="width:100%; margin:10px 0">
                        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Location:</span></span>
                         <input name="team" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                    </div>
                    
                    
                   


            </div>
        </div>
        <div class="modal-footer">

            <button type="button" class="btn btn-default bg-darkBlue shadow fg-white" data-dismiss="modal"><span class="icon-cancel-2" aria-hidden="true"></span> Cancel</button>
            <button type="submit" name="mama" id="submit_button" class="btn bg-green shadow"  data-complete-text="Saving..." autocomplete="off">
                <span class="icon-checkmark " aria-hidden="true"></span> Save </button>
        </div>
    </div>
        </div>
                </form>
    </div>
</div>
    </div>
<!--model linces-->
