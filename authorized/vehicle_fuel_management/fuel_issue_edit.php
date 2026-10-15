

<a class="" href="#" data-toggle="modal" data-target="#modelupdate"><i class="icon-checkmark fg-green"></i>&nbsp;Update</a>
<!--///////////////////////////////////////////////////////////////////////////-->
<!-- Modal -->
<?php
             include '../db.php';
             $vehicle_reg_num=$_GET['q'];          
             $c=mysql_query("SELECT * FROM tbl_fuel_vehicles WHERE vehicle_reg_num='$vehicle_reg_num'") or die(mysql_error());
             $b=mysql_fetch_array($c);
             $fuel_amounts=$b['fuel_amounts'];
             $vehicle_km=$b['vehicle_km'];                                 
             $fuel_balance=$b['fuel_balance'];
             $issued_amount=$b['issued_amount'];            
             $issued_date=$b['issued_date'];
?>
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
                    <a href="?action=vehicle_fuel_list">
                    <button class="btn-close close"  data-dismiss="modal"></button>
                    </a>
                </div>
                <div class="content" >
                   
                    <div class="margin10" style="margin-top: 3%;">
                      <div id="smss">
                            
                        </div>
                         <form name="testForm1" action="" method="">  
                            
                             <div class="form-group">
                                <label for="Drivername">Vehicle Reg#:</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo $_GET['q'];?>" name="vehiclereg" id="vehiclereg">
                            </div>
                            <div class="form-group">
                                <label for="Drivername">Full Tank:</label>
                                <input type="text" class="form-control" value="<?php echo $fuel_amounts;?>" name="fulltank" id="fulltank">
                            </div>
                            <div class="form-group">
                                <label for="drivernamba">Vehicle Km:</label>
                                <input type="text" class="form-control" value="<?php echo $vehicle_km;?>"  name="vehiclekm" id="vehiclekm">
                            </div>
                             <div class="form-group">
                                <label for="locations">Issued Amounts:</label>
                                <input type="text" class="form-control" value="<?php echo $issued_amount;?>"  id="amountsissued" name="amountsissued">
                            </div> 
                            <div class="form-group">
                                <label for="drivernamba">Issued Date:</label>
                                <input type="text" class="form-control" value="<?php echo $issued_date;?>"  id="issued_date" name="issued_date">
                            </div> 
                            <div class="form-group">
                                <label for="drivernamba">Balance:</label>
                                <input type="text" class="form-control" value="<?php echo $fuel_balance;?>"  id="balance" name="balance">
                            </div>  
                                <input type="button" value="Update" onclick="postfueldetail();" />                                                                     
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!--model linces-->



