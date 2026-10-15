<?php
if(isset($_POST['add_licence'])){
$prevdate=$_POST['prevdate'];
    $nextprevdate=$_POST['nextdate'];
    $regnumber=$_POST['vregnm'];
 

    $insert=mysql_query("INSERT INTO tbl_car_licence(`issue_date`, `expire_date`,`vehicle_reg_num`)"
            . "VALUES('$prevdate','$nextprevdate','$regnumber')") or die(mysql_error());
               
if($insert){
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
if(isset($_POST['update_licence'])){
 $prevdate=$_POST['prevdate'];
    $nextprevdate=$_POST['nextdate'];
    $regnumber=$_POST['vregnm'];
    $date=date("d.m.Y");
    $licence=$_POST['licence'];


    $insert=mysql_query("UPDATE tbl_car_licence SET issue_date='$prevdate',expire_date='$nextprevdate' WHERE licence_id='$licence'") or die(mysql_error());
    
            $message = "<script>
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

if(isset($_GET['delete'])){
    $licence_id=$_GET['delete'];
     $deletee=  mysql_query("DELETE FROM tbl_car_licence WHERE licence_id='$licence_id'") or die(mysql_error());
}
?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
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
<div class="row" >
    <div class="col-lg-12 col-xs-12">

        <div class="bg-white shadow collapse navbar-collapse" id="myNavbar"  >

            <nav class="horizontal-menu compact" >
                <ul>
                    
                    <li>
                        <a  href="?action=vehicle Insurance and Road Services" ><i class="glyphicon glyphicon-chevron-right"></i>&nbsp;Vehicle Insurance</a>
                    </li>
                   
<!--                     <li>
                        <a href="?action=car_licences"><i class="glyphicon glyphicon-chevron-down"></i>&nbsp;Vehicle Road Licence</a>
                    </li>-->
                     <li>
                        <a  href="#" ><i class="glyphicon glyphicon-chevron-right"></i>&nbsp; Safety Sticker</a>
                    </li>
                    <li>
                        <a  href="#" ><i class="glyphicon glyphicon-chevron-right"></i>&nbsp; Corporate Revenue</a>
                    </li>


                </ul>
            </nav>
        </div>
       

    </div>
</div>
<div class="row" style=" margin-top: 4px;">
                    <div class="col-lg-12 menusss " >
                        <ul class="pagination">
                            <li>
                                <a href="#" data-toggle="modal" data-target="#myModallinces"  class="btn btn-default"><i class="glyphicon glyphicon-plus"></i>&nbsp;Vehicle Licence</a>
                            </li>
                           
                            <li>
                                <a href="#"><i class="glyphicon glyphicon-download"></i>&nbsp;Generate Report</a>
                            </li>
                            <li >
                                <a href="" class="btn btn-default"><i class="glyphicon glyphicon-envelope"></i>&nbsp;Report Summary </a>
                            </li>
                           
                          
                        </ul>


                    </div>



                </div>
<div class="row">
    <div class=" col-lg-12">
        <table id="table" class="table table-striped table-bordered" style="font-size: 12px;" cellspacing="0" width="100%">
        <thead>
           <tr style="background-color: #4CAF50; color: white;">
                <th class="text-left" style="font-size: 12px;">Action</th>
                <th class="text-left" style="font-size: 12px;">Vehicle Reg#</th>
                <th class="text-left" style="font-size: 12px;">Make</th>
                <th class="text-left" style="font-size: 12px;">Model</th>
                <th class="text-left" style="font-size: 12px;">Body Type</th>
                <th class="text-left" style="font-size: 12px;">Color</th>
                <th class="text-left" style="font-size: 12px;">Issue Date</th>
                <th class="text-left" style="font-size: 12px;">Expire Date</th>                               
                <th class="text-left" style="font-size: 12px;">Need Review</th>


            </tr>
        </thead>
        <tbody> 
                                   <?php
            $select_from_service=mysql_query("SELECT * FROM tbl_car_licence ORDER BY licence_id DESC") or die(mysql_error());
            while ($rows=  mysql_fetch_array($select_from_service)) {
    $vehicle_reg_numm=$rows['vehicle_reg_num'];
    $query = "SELECT * FROM tbl_car_informations WHERE vehicle_reg_num='$vehicle_reg_numm'";
    $resultT = mysql_query($query) or die("SQL Error 1: " . mysql_error());
    $rrow=  mysql_fetch_array($resultT);
        $vehicle_reg_num=$rrow['vehicle_reg_num'];
        $make=$rrow['make'];
        $model=$rrow['model'];
        $body_type=$rrow['body_type']; 
        $color=$rrow['color'];       
        $issue_date=$rows['issue_date'];       
        $expire_date=$rows['expire_date'];
        $need_reviews=$rows['need_reviews'];
        $licence_id=$rows['licence_id'];
//         $date=date("d.m.Y");
         $str = $expire_date;
$str = strtotime(date("d-m-Y")) - (strtotime($str));
$mimi= floor($str/3600/24);
if($mimi>7){
   $status="Yes";
   $bg='bg-red'; 
}  else {
               $status="No";
               $bg='';
               }
                
                
                ?>
            <tr class="<?php echo $bg;?>">
                    <td>
 <ul class="showlist" style=" font-size: 14px;">
                                <li>
                        <a href="#" data-toggle="modal" 
                                     data-a="<?php echo $vehicle_reg_num; ?>"
                                     data-b="<?php echo $licence_id; ?>"
                                     data-c="<?php echo $make; ?>"
                                     data-d="<?php echo $model; ?>"
                                      data-e="<?php echo $body_type; ?>"
                                     data-f="<?php echo $color; ?>"
                                     data-g="<?php echo $issue_date; ?>"
                                     data-h="<?php echo $expire_date; ?>"
                                     data-i="<?php echo $need_reviews; ?>"
                                     
                                     data-target="#view_car_info" class="view-info services" style="z-index:0;">View</a>
                                     </li>
                                     <li>
                                         <a  href="?action=car_licences&delete=<?php echo $licence_id;?>"  class="delete services" data-confirm="Are you sure to delete Licence for vehicle number <?php echo $vehicle_reg_num;?>?">Delete</a>
                                     </li>
                            </ul>
     </td>
                    <td style="font-size: 12px;"><?php echo $vehicle_reg_num; ?></td>
                    <td style="font-size: 12px;"><?php echo $make; ?></td>
                    <td style="font-size: 12px;"><?php echo $model; ?></td>
                    <td style="font-size: 12px;"><?php echo $body_type; ?></td>
                    <td style="font-size: 12px;"><?php echo $color; ?></td>
                    <td style="font-size: 12px;"><?php echo $issue_date; ?></td>
                    <td style="font-size: 12px;"><?php echo $expire_date; ?></td>
                    <td style="font-size: 12px;"><?php echo $status; ?></td>


                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    
    
  </div>  
</div>




<!-- Modal -->
<!-- Modal -->
<div id="view_car_info" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">LICENCE INFORMATION</h5>
      </div>
      <div class="modal-body">
          <div id="kubwa">
              
          </div>
<form class="form-inline" role="form"  action=""   method="post" >              
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Vehicle Reg#:</span></span>
        <input name="vregnm" id="a" class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
        <input name="licence" id="b" class="form-control" value="" aria-describedby="sizing-addon1"  type="hidden">
    </div>
 <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Make:</span></span>
        <input name="make" id="c" class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
        
    </div>
     <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Model:</span></span>
        <input name="vregnm" id="d" class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
        
    </div>
     <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Body Type:</span></span>
        <input name="vregnm" id="e" class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
       
    </div>
     <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Color:</span></span>
        <input name="vregnm" id="f" class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
    
    </div>
     
     
    <div class="input-group" style="width:100%; margin:2px 0">
        <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Issue Date</span></span>
        <input name="prevdate" id="g" placeholder="dd-mm-yy" class="form-control date1" value="" aria-describedby="sizing-addon1"  type="text">
    <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Expire Date</span></span>
        <input name="nextdate" id="h" placeholder="dd-mm-yy" class="form-control date2" value="" aria-describedby="sizing-addon1"   type="text">
    </div>
          
    <button type="submit" name="update_licence" class="btn bg-blue shadow margin10"  data-complete-text="Saving..." autocomplete="off">
        <span class="icon-checkmark " aria-hidden="true"></span> Make Changes </button>    
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--end linces-->
>

<!-- Modal -->
<!-- Modal -->
<div id="myModallinces" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Add New Licence</h5>
      </div>
      <div class="modal-body">
          <div id="kubwa">
              
          </div>
          <form class="form-inline" role="form"  action=""   method="post" >              
              <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Vehicle Reg#:</span></span>

                                    <select class="form-control" id="reg" name="vregnm">
                                        <?php
                                        $select_car = mysql_query("SELECT * from tbl_car_informations") or die(mysql_error());
                                        while ($row = mysql_fetch_array($select_car)) {
                                            $vehicle_reg_num = $row['vehicle_reg_num'];
                                            ?>
                                            <option value="<?php echo $vehicle_reg_num; ?>"><?php echo $vehicle_reg_num; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
              
              <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Issue Date</span></span>
                                    <input name="prevdate" id="date1" placeholder="dd.mm.yy" class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Expire Date</span></span>
                                    <input name="nextdate" id="date2" placeholder="dd.mm.yy" class="form-control" value="" aria-describedby="sizing-addon1"   type="text">
                                </div>      
              <button type="submit" name="add_licence" class="btn bg-blue shadow margin10"  data-complete-text="Saving..." autocomplete="off">
                            <span class="icon-checkmark " aria-hidden="true"></span> Save Data </button>    
  </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!--end linces-->



<div id="notification1" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
      
          <div class="alert alert-success alert-dismissable">
  <a href="#" class="close" data-dismiss="modal" aria-label="close">&times;</a>
  <strong>Thanks for your updates!&nbsp;</strong> 
</div>

  </div>
</div>

<div id="notification" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
      
          <div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Your data was successfully submitted!</strong>
</div>

  </div>
</div>

<div id="notification2" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
      
          <div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Your data was successfully Deleted!</strong>
</div>

  </div>
</div>
