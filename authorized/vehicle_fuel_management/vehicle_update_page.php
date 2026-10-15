
<?php
include '../db.php';
$vehicle_id = $_GET['q'];
$c = mysql_query("SELECT * FROM tbl_fuel_vehicles WHERE vehicle_id='$vehicle_id'") or die(mysql_error());
$d = mysql_fetch_array($c);
$driver = $d['driver'];
$locations = $d['locations'];
$team = $d['team'];
$driver_phone_num = $d['driver_phone_num'];
$vendor = $d['vendor'];
$status = $d['status'];
$fuel_amounts = $d['fuel_amounts'];
$vehicle_reg_num=$d['vehicle_reg_num'];
$fuel_balance=$d['fuel_balance'];

?>



<a class="" href="#" data-toggle="modal" data-target="#modelupdate"><i class="icon-checkmark fg-green"></i>&nbsp;Update</a>
<a class="" href="?action=deletecar&delete=<?php echo $vehicle_id; ?>" ><i class="icon-cancel-2 fg-red"></i>&nbsp;Delete</a>
<!--------------------------------------------------------joaqim--------------------------------------------------------------------------->
<!-- Modal -->
<div id="modelupdate" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-cars"></span> 
                    <div class="title">Update Car Information</div> 
                    <button class="btn-min"></button> 
                    <button class="btn-max"></button> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content" >

                    <div class="margin10" style="margin-top: 3%;">

                        <form name="testForm1" action="" method="">  
                            <input type="hidden" name="req" value="<?php echo $_GET['q']; ?>" id="req">
                            <div class="form-group">
                                <label for="Drivername">Vehicle Reg#:</label>
                                <input type="text" class="form-control" value="<?php echo $vehicle_reg_num; ?>" name="vehiclereg" id="vehiclereg">
                            </div>
                            <div class="form-group">
                                <label for="Drivername">Full Tank:</label>
                                <input type="text" class="form-control" value="<?php echo $fuel_amounts; ?>" name="fulltank" id="fulltank">
                            </div>
                            <div class="form-group">
                                <label for="Drivername">Update Balance:</label>
                                <input type="text" class="form-control" value="<?php echo $fuel_balance;?>" name="balance" id="balance">
                            </div>
                            <div class="form-group">
                                <label for="Drivername">Driver Name:</label>
                                <input type="text" class="form-control" value="<?php echo $driver; ?>" name="drivername" id="drivername">
                            </div>
                            <div class="form-group">
                                <label for="drivernamba">Driver Number:</label>
                                <input type="text" class="form-control" value="<?php echo $driver_phone_num; ?>"  name="drivernamber" id="drivernamber">
                            </div>
                            <div class="form-group">
                                <label for="locations">Driver Location:</label>
                                <input type="text" class="form-control" value="<?php echo $locations; ?>"  id="locations" name="locations">
                            </div> 
                            <div class="form-group">
                                <label for="drivernamba">Driver Team:</label>
                                <input type="text" class="form-control" value="<?php echo $team; ?>"  id="team" name="team">
                            </div> 
                            <div class="form-group">
                                <label for="drivernamba">Vendor:</label>
                                <input type="text" class="form-control" value="<?php echo $vendor; ?>"  id="vendor" name="vendor">
                            </div> 
                            <div class="form-group">
                                <label for="drivernamba">Remarks:</label>
                                <input type="text" class="form-control" value="<?php echo $status; ?>"  id="status" name="status">
                            </div> 
                            <div id="smss">

                            </div>
                            <input type="button" value="Submit Form" onclick="postvehicleupdate();" />                                                                     
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!---------------------------------------------------------model linces------------------------------------------------>



