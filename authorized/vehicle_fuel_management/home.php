
<?php
if (isset($_GET['action'])) {
    if($_GET['action'] == 'deletecar'){  
        $vehicle_id = $_GET['delete'];
       $h=  mysql_query("DELETE FROM tbl_fuel_vehicles WHERE vehicle_id='$vehicle_id'") or die(mysql_error()); 
       $message='<div class="alert alert-success">
<a href="?action=vehicle_fuel_list" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successfull Deleted</strong>
</div>';
       
    }
}
?>
<head>
    <script>
        function showoption(str) {
            if (str.length == 0) {
                document.getElementById("action").innerHTML = "";
                document.getElementById("action").style.border = "0px";
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("action").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/vehicle_fuel_management/vehicle_update_page.php?q=" + str, true);
            xmlhttp.send();
        }
    </script> 
        <script>
function postvehicle(){
// Create our XMLHttpRequest object
var hr = new XMLHttpRequest();
// Create some variables we need to send to our PHP file
var url = "authorized/vehicle_fuel_management/add_vehicle_fuel_management.php";
var vehiclereg = document.getElementById("vehiclereg").value;
var drivername = document.getElementById("drivername").value;
var drivernamber = document.getElementById("drivernamber").value;
var team = document.getElementById("team").value;
var vendor = document.getElementById("vendor").value;
var status = document.getElementById("status").value;
var locations = document.getElementById("locations").value;


var vars = "vehiclereg="+vehiclereg+"&drivername="+drivername+"&drivernamber="+drivernamber+"&team="+team+"&vendor="+vendor+"&status="+status+"&locations="+locations;
hr.open("POST", url, true);
hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// Access the onreadystatechange event for the XMLHttpRequest object
hr.onreadystatechange = function() {
    console.log(hr);

    if(hr.readyState == 4 && hr.status == 200) {
        var return_data = hr.responseText;
        document.getElementById("successfull").innerHTML = return_data;
    }
}
// Send the data to PHP now... and wait for response to update the status div
hr.send(vars); // Actually execute the request
document.getElementById("successfull").innerHTML = "processing...";
}
</script>
     <script>
function postvehicleupdate(){
// Create our XMLHttpRequest object
var hra = new XMLHttpRequest();
// Create some variables we need to send to our PHP file
var url = "authorized/vehicle_fuel_management/update_car_info.php";
var vehiclereg = document.getElementById("vehiclereg").value;
var drivername = document.getElementById("drivername").value;
var drivernamber = document.getElementById("drivernamber").value;
var team = document.getElementById("team").value;
var vendor = document.getElementById("vendor").value;
var status = document.getElementById("status").value;
var locations = document.getElementById("locations").value;
var req = document.getElementById("req").value;
var balance=document.getElementById("balance").value;
var fulltank=document.getElementById("fulltank").value;

var varsq = "vehiclereg="+vehiclereg+"&drivername="+drivername+"&drivernamber="+drivernamber+"&team="+team+"&vendor="+vendor+"&status="+status+"&locations="+locations+"&status="+status+"&req="+req+"&balance="+balance+"&fulltank="+fulltank;
hra.open("POST", url, true);
hra.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// Access the onreadystatechange event for the XMLHttpRequest object
hra.onreadystatechange = function() {
    console.log(hra);

    if(hra.readyState == 4 && hra.status == 200) {
        var return_data = hra.responseText;
        document.getElementById("smss").innerHTML = return_data;
    }
}
// Send the data to PHP now... and wait for response to update the status div
hra.send(varsq); // Actually execute the request
document.getElementById("smss").innerHTML = "processing...";
}
</script>
        
</head>
<?php
$message = "";
?>
<div class="bg-white shadow" style="width: 100%;">
 <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="?action=vehicle_fuel_list"><i class="icon-cars fg-blue"></i>&nbsp;Home</a>
            </li>
             <li>
               <a class="" href="#" data-toggle="modal" data-target="#modelAdd" style="font-weight: bold;">Add Vehicle</a>                                                 
              </li>
            <li id="action">
                <!--               show data-->
            </li>
        </ul>
    </nav>
</div>
<div class="container">
    <?php
    echo $message;
    ?>
</div>
<div class="margin5">    
    <table id="example" class="display bordered" style="font-size: 12px;" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th></th>
                <th class="text-left">Vehicle Reg#</th>
                <th class="text-left">Vehicle Fuel Capacity(Litres)</th>
                <th class="text-left">Vehicle Fuel Balance(Litres)</th>
                <th class="text-left">Driver Name</th>
                <th class="text-left">Location</th>
                <th class="text-left">Team</th>
                <th class="text-left">Driver Phone Number</th>
                <th class="text-left">Vendor</th>
                <th class="text-left">Remarks</th>
                
            </tr>
        </thead>

        <tbody>
            <?php
            include 'authorized/db.php';
            $a=mysql_query("SELECT * FROM tbl_fuel_vehicles")or die(mysql_error());
            while ($b = mysql_fetch_array($a)) {
             $vehicle_reg_num=$b['vehicle_reg_num'];          
              $driver=$b['driver'];
              $locations=$b['locations'];
              $team=$b['team'];
              $driver_phone_num=$b['driver_phone_num'];
              $vendor=$b['vendor'];
              $status=$b['status'];
              $fuel_amounts=$b['fuel_amounts'];
              $fuel_balance=$b['fuel_balance'];
              $vehicle_id=$b['vehicle_id'];


                ?>
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="" value="<?php echo $vehicle_id;?>" onchange="showoption(this.value)">
                    </td>
                   
                    <td><?php echo $vehicle_reg_num;?></td>
                     <td><?php echo $fuel_amounts;?></td>
                     <td><?php echo $fuel_balance;?></td>
                    <td><?php echo $driver;?></td>
                    <td><?php echo $locations;?></td>
                    <td><?php echo $team;?></td>
                    <td><?php echo $driver_phone_num;?></td>
                    <td><?php echo $vendor;?></td>
                    <td><?php echo $status;?></td>

                </tr>
                <?php
             }
            ?>
        </tbody>
    </table>
</div>
<div id="modelAdd" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-cars"></span> 
                    <div class="title">Add Car Information</div> 
                    <button class="btn-min"></button> 
                    <button class="btn-max"></button> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content" >
                   
                    <div class="margin10" style="margin-top: 3%;">
                      <div id="successfull">
                            
                        </div>
                        <form name="testForm" action="" method="">                          
                             <div class="form-group">
                                <label for="Drivername">Vehicle Reg#:</label>
                                <input type="text" class="form-control" value="" name="vehiclereg" id="vehiclereg">
                            </div>
                            <div class="form-group">
                                <label for="Drivername">Driver Name:</label>
                                <input type="text" class="form-control" value="" name="drivername" id="drivername">
                            </div>
                            <div class="form-group">
                                <label for="drivernamba">Driver Number:</label>
                                <input type="text" class="form-control" value=""  name="drivernamber" id="drivernamber">
                            </div>
                             <div class="form-group">
                                <label for="locations">Driver Location:</label>
                                <input type="text" class="form-control" value=""  id="locations" name="locations">
                            </div> 
                            <div class="form-group">
                                <label for="drivernamba">Driver Team:</label>
                                <input type="text" class="form-control" value=""  id="team" name="team">
                            </div> 
                            <div class="form-group">
                                <label for="drivernamba">Vendor:</label>
                                <input type="text" class="form-control" value=""  id="vendor" name="vendor">
                            </div> 
                            <div class="form-group">
                                <label for="drivernamba">Remarks:</label>
                                <input type="text" class="form-control" value=""  id="status" name="status">
                            </div> 
                                <input type="button" value="Submit Form" onclick="postvehicle();" />                                                                     
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!--model linces-->


