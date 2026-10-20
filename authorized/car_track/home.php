<?php
require_once __DIR__ . '/../../mysql_compat.php';

if(isset($_POST["register_car"])){
$reg_number=$_POST['reg_number'];
$make=$_POST['make'];
$model=$_POST['model'];
$body=$_POST['body'];
$color=$_POST['color'];
$yrs=$_POST['yrs'];
$chess=$_POST['chess']; 
$eng_number=$_POST['eng_number']; 
$eng_capacity=$_POST['eng_capacity'];
$eng_type=$_POST['eng_type']; 
$tare_weight=$_POST['tare_weight']; 
$fuel_used=$_POST['fuel_used']; 

$insert_into_vehicle=  mysql_query("INSERT INTO tbl_car_informations(vehicle_reg_num,make,model,body_type,color,year_of_manufacture,chassis_number,eng_number,eng_capacity,eng_type,tare_weight,fuel_used)"
        . " VALUES ('$reg_number','$make','$model','$body','$color','$yrs','$chess','$eng_number','$eng_capacity','$eng_type','$tare_weight','$fuel_used')") or die(mysql_error());
       
if($insert_into_vehicle){
    $message = "<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#notification').modal('show');
            });
        </script>";
    
   
}
}
if(isset($_POST["Update_car"])){
$reg_id=$_POST['reg_id'];
$make=$_POST['make'];
$model=$_POST['model'];
$body=$_POST['body'];
$color=$_POST['color'];
$yrs=$_POST['yrs'];
$chess=$_POST['chess']; 
$eng_number=$_POST['eng_number']; 
$eng_capacity=$_POST['eng_capacity'];
$eng_type=$_POST['eng_type']; 
$tare_weight=$_POST['tare_weight']; 
$fuel_used=$_POST['fuel_used']; 
$reg_number=$_POST['reg_number'];
$updatedd=  mysql_query("UPDATE tbl_car_informations SET vehicle_reg_num='$reg_number',make='$make',model='$model',body_type='$body',color='$color',"
        . "year_of_manufacture='$yrs',chassis_number='$chess',eng_number='$eng_number',eng_capacity='$eng_capacity',eng_type='$eng_type'"
        . ",tare_weight='$tare_weight',fuel_used='$tare_weight' WHERE car_info_id='$reg_id'") or die(mysql_error());

if($updatedd){
    
     $message = "<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#notification').modal('show');
            });
        </script>";
}
}

if(isset($_POST["delete_car"])){
    $reg_number=$_POST['reg_number'];
    $deletee=  mysql_query("DELETE FROM tbl_car_informations WHERE vehicle_reg_num='$reg_number'") or die(mysql_error());
    $deletee1=  mysql_query("DELETE FROM tbl_car_monitoring WHERE  vehicle_reg_num='$reg_number'") or die(mysql_error());

if($deletee){
     $message="<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#notification1').modal('show');
            });
        </script>"; 
}
   
   
}
if(isset($_POST["Update_driver"])){
      
     $reg_no=$_POST['reg_no'];
       $owner=$_POST['owner'];
        $dname=$_POST['dname'];
         $pnum=$_POST['pnum'];
         $team=$_POST['team'];
         
         $chs=mysql_query("SELECT * FROM tbl_car_monitoring  WHERE vehicle_reg_num='$reg_no'") or die(mysql_error());
         $ac=mysql_num_rows($chs);
         if($ac==0){
                     $reg_no=$_POST['reg_no'];
       $owner=$_POST['owner'];
        $dname=$_POST['dname'];
         $pnum=$_POST['pnum'];
         $team=$_POST['team'];
         $inst=  mysql_query("INSERT INTO tbl_car_monitoring(vehicle_reg_num,owner,driver_name,driver_contact,vehicle_centre) VALUE('$reg_no','$owner','$dname','$pnum','$team')") or die(mysql_error());        
        if($inst){
            $message="<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#notification2').modal('show');
            });
        </script>"; 
        }
         }
 else {
     $insting=  mysql_query("UPDATE tbl_car_monitoring SET owner='$owner',driver_name='$dname'"
                 . ",driver_contact='$pnum',vehicle_centre='$team' WHERE vehicle_reg_num='$reg_no'") or die(mysql_error());
         if($insting){         
            $message="<script>
            var newHTML = document.createElement ('div');
            newHTML.innerHTML =
            newHTML = document.createElement ('div');
            newHTML.innerHTML = ' <div id=\"myModal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\"> <div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\"></div>';
            document.body.appendChild (newHTML);
            $(window).load(function(){
                 $('#notification2').modal('show');
            });
        </script>"; 
 }
         
         
       
}
}

$query = "SELECT * FROM tbl_car_informations ORDER BY car_info_id DESC";
$resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
// get data and store in a json array
while ($rrow = mysql_fetch_array($resultT, MYSQL_ASSOC)) {
    $vehicle_reg_numm=$rrow['vehicle_reg_num'];
    $show_driver=  mysql_query("SELECT * FROM tbl_car_monitoring WHERE vehicle_reg_num='$vehicle_reg_numm'") or die(mysql_error());
    $showing=mysql_fetch_array($show_driver);
    $ownerr=$showing['owner'];
    $driver_namer=$showing['driver_name'];
    $driver_contactr=$showing['driver_contact'];
    $vehicle_centrer=$showing['vehicle_centre'];
    $stock[] = array(  
        'car_info_id'=>$rrow['car_info_id'],
        'vehicle_reg_num'=>$rrow['vehicle_reg_num'],
        'make'=>$rrow['make'],
        'model'=>$rrow['model'],
        'body_type'=>$rrow['body_type'], 
        'color'=>$rrow['color'],
         'owner'=>$ownerr,
         'driver_name'=>$driver_namer,
         'driver_contact'=>$driver_contactr,
         'vehicle_centre'=>$vehicle_centrer,
        'year_of_manufacture'=>$rrow['year_of_manufacture'],       
        'chassis_number'=>$rrow['chassis_number'],        
        'eng_number'=>$rrow['eng_number'],
        'eng_capacity'=>$rrow['eng_capacity'],      
        'eng_type'=>$rrow['eng_type'],
        'tare_weight'=>$rrow['tare_weight'],       
        'fuel_used'=>$rrow['fuel_used']
        
   
    );
}


?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}

    th {
        background-color: #4CAF50;
        color: white;
    }
</style>






<div class="margin5" id="action">
</div>
<div class="col-lg-12">
    <?php
    echo $message;
    ?>
</div>
<div class="row fixed-top" >
    <div class="col-lg-12 col-xs-12">

        <div class="bg-white shadow collapse navbar-collapse" id="myNavbar"  style=" margin: 2px 0px 5px 0px;" >

            <nav class="horizontal-menu compact" >
                <ul>
                    
                    <li >
                        <a class="" style="" href="#" data-toggle="modal" data-target="#add_vehicle">Add New Vehicle</a>
                    </li>
                     <li >
                        <a class="" style="" href="#" >Generate Report</a>
                    </li>
                     <li >
                        <a class="" style="" href="#" >Report Summary</a>
                    </li>


                </ul>
            </nav>
        </div>

    </div>


</div>
<div class="row">
    <div class=" col-lg-12">
        <table id="table" class="table table-striped table-bordered" style="font-size: 12px;" cellspacing="0" width="100%">
        <thead>
            <tr style="background-color: #4CAF50; color: white;">  
                <th class="text-left"></th>
                <th class="text-left">Vehicle Reg#</th>
                <th class="text-left">Make</th>
                <th class="text-left">Model</th>
                <th class="text-left">Body Type</th>
                <th class="text-left">Color</th>
                <th class="text-left">Owner</th>
                <th class="text-left">Driver Name</th>
                <th class="text-left">Vehicle Center</th>
                <th class="text-left">Year of Manufacture</th>

            </tr>
        </thead>
        <tbody>            
            <tr>
               
                
                 <?php foreach($stock as $row):?>
                   
<!--                    <td><input type="checkbox"  onchange="gotoaction(this.value)" value="<?php echo $row['car_info_id'];?>"></td>-->
                
                <td class="right"><a href="#" data-toggle="modal" 
                                     data-a="<?php echo $row['vehicle_reg_num']; ?>"
                                     data-b="<?php echo $row['make']; ?>"
                                     data-c="<?php echo $row['model']; ?>"
                                     data-d="<?php echo $row['body_type']; ?>"
                                     data-e="<?php echo $row['color']; ?>"
                                     data-f="<?php echo $row['year_of_manufacture']; ?>"
                                     data-g="<?php echo $row['chassis_number']; ?>"
                                     data-h="<?php echo $row['eng_number']; ?>"
                                     data-i="<?php echo $row['eng_capacity']; ?>"
                                     data-j="<?php echo $row['eng_type']; ?>"
                                     data-k="<?php echo $row['tare_weight']; ?>"
                                     data-l="<?php echo $row['fuel_used']; ?>"
                                     data-m="<?php echo $row['owner']; ?>"
                                     data-n="<?php echo $row['driver_name']; ?>"
                                     data-o="<?php echo $row['driver_contact']; ?>"
                                     data-p="<?php echo $row['vehicle_centre']; ?>"
                                     data-q="<?php echo $row['car_info_id']; ?>"
 
                                     data-target="#view_car_info" class="view-info">View</a>
                </td>   
                <td class="right"><?php echo $row['vehicle_reg_num']; ?></td>
                    <td class="right"><?php echo $row['make']; ?></td>
                    <td class="right"><?php echo $row['model']; ?></td>
                    <td class="right"><?php echo $row['body_type']; ?></td>
                    <td class="right"><?php echo $row['color']; ?></td>
                    <td class="right"><?php echo $row['owner']; ?></td>
                    <td class="right"><?php echo $row['driver_name']; ?></td>
                    <td class="right"><?php echo $row['vehicle_centre']; ?></td>
                    <td class="right"><?php echo $row['year_of_manufacture']; ?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
    
    
  </div>  
</div>




<div id="add_vehicle" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="">
            <form  action=""  method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Add New Vehicle</h4>
                </div>

                <div class="modal-body ">
                    <div id="kubwa">
                    </div>       
                    <div role="tabpanel">
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Vehicle Registration Number:</span></span>
                            <input name="reg_number" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Make:</span></span>
                            <input name="make" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Model:</span></span>
                            <input name="model" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Body Type:</span></span>
                            <input name="body" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Color:</span></span>
                            <input name="color" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Year Of Manufacture:</span></span>
                            <input name="yrs" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Chassis Number:</span></span>
                            <input name="chess" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Engine Number:</span></span>
                            <input name="eng_number" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Engine Capacity:</span></span>
                            <input name="eng_capacity" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Engine Type:</span></span>
                            <input name="eng_type" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                        </div>
                        <div class="input-group" style="width:100%; margin:2px 0">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Tare Weight:</span></span>
                            <input name="tare_weight" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                            <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Fuel Used:</span></span>
                            <input name="fuel_used" id="product_name" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                        </div>
                        <hr>
                        <div class="input-group" style="width:100%; margin:10px 0">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" name="register_car" class="btn btn-primary">Submit</button>
                        </div>

                    </div>                  
                </div>
            </form>
        </div>
    </div>
</div>
<!--model linces-->


<div id="view_car_info" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">VEHICLE INFORMATION</h4>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-lg-12" >
                 <div id="kubwaa">


                </div>  
                <div class="tabbable">
                    <ul class="nav nav-tabs tabs-flat" id="myTab11">
                        <li class="active">
                            <a aria-expanded="true" data-toggle="tab" href="#maitenance">
                                Vehicle Information
                            </a>
                        </li>
                        <li class="">
                            <a aria-expanded="false" data-toggle="tab" href="#service">
                                Driver Information
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content tabs-flat" style=" margin-top: 3px;">
                        <div id="maitenance" class="tab-pane active">

                            <!--basic maintenance-->
                               <form  action=""  method="POST">
                            <div role="tabpanel">
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <input type="hidden" id="q" value="" name="reg_id">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Vehicle Registration Number:</span></span>
                                    <input name="reg_number" id="a" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Make:</span></span>
                                    <input name="make" id="b" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Model:</span></span>
                                    <input name="model" id="c" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Body Type:</span></span>
                                    <input name="body" id="d" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Color:</span></span>
                                    <input name="color" id="e" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Year Of Manufacture:</span></span>
                                    <input name="yrs" id="f" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Chassis Number:</span></span>
                                    <input name="chess" id="g" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Engine Number:</span></span>
                                    <input name="eng_number" id="h" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Engine Capacity:</span></span>
                                    <input name="eng_capacity" id="i" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Engine Type:</span></span>
                                    <input name="eng_type" id="j" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Tare Weight:</span></span>
                                    <input name="tare_weight" id="k" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:25%; text-align:right"><span class="text-right">Fuel Used:</span></span>
                                    <input name="fuel_used" id="l" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">
                                </div>
                                <hr>
                                <div class="input-group" style="width:100%; margin:10px 0">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                    <button type="submit" name="Update_car" class="btn btn-primary">Update Vehicle</button>
                                    <button type="submit" name="delete_car" class="btn btn-primary">Delete</button>
                                </div>

                            </div> 
                               </form>
                            <!--end of maitennance-->
                        </div>
                        <div id="service" class="tab-pane">
                            <!--basic service-->
                            <form  action=""  method="POST">
                                <div class="input-group" style="width:100%;">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Owner:</span></span>
                                    <input name="owner" id="m" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                                    <input name="reg_no" id="a" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="hidden">
                                </div>                 

                                <div class="input-group" style="width:100%;">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Driver Name:</span></span>
                                    <input name="dname" id="n" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <div class="input-group" style="width:100%;">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Phone Number:</span></span>
                                    <input name="pnum" id="o" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <div class="input-group" style="width:100%;">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Location:</span></span>
                                    <input name="team" id="p" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <hr>
                                <div class="input-group" style="width:100%; margin:10px 0">                                   
                                     <button type="submit" name="Update_driver" id="submit_button" class="btn bg-green shadow"  data-complete-text="Saving..." autocomplete="off">
                                <span class="icon-checkmark " aria-hidden="true"></span> Update Driver </button>
                                    
                                </div>
                           </form>
                            <!--End of service-->
                        </div>
                    </div>
                       
                </div>
               
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<div id="notification2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
      
  <div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
  <strong>Thanks for your updates!&nbsp;</strong> 
     </div>

 </div>
 </div>
 <div id="notification" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
      
          <div class="alert alert-success error">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Your data was successfully submitted!</strong> .
</div>

  </div>
</div>

<div id="notification1" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
      
          <div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Your data was successfully Deleted!</strong>
</div>

  </div>
</div>
