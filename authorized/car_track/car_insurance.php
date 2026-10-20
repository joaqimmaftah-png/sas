<?php
require_once __DIR__ . '/../../mysql_compat.php';

if(isset($_POST['insurancee'])){
                    $car_reg_num = $_POST['vregnm'];               
                $policy_type = $_POST['policy_type'];
                $cover_note = $_POST['cover_note'];
                $Insurance_agency=$_POST['Insurance_agency'];
//                $policy_no = $_POST['policy_no'];
                $Amounts = $_POST['Amounts'];
                $policy_date = $_POST['pdate'];
                $policy_expire_date = $_POST['pxdate'];
                $todat=  date('dd/mm/yy');
                if($todat>=$policy_expire_date){
                    $need_reviews='YES';
                }else{
                    $need_reviews='NO';
                }
$car_insurance=mysql_query("INSERT INTO tbl_car_insurance(`vehicle_reg_num`, `policy_type`, `insurance_agency`, `cover_note_number`, `Amounts`, `policy_date`, `policy_expire_date`, `need_reviews`)"
        . "value('$car_reg_num','$policy_type','$Insurance_agency','$cover_note','$Amounts','$policy_date','$policy_expire_date','$need_reviews')") or die(mysql_error());

if($car_insurance){
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
if(isset($_POST['insurance'])){
                    $car_reg_num = $_POST['vregnm'];
                $policy_type = $_POST['policy_type'];
                $insurance_agency = $_POST['Insurance_agency'];
                $policy_no = $_POST['cover_note'];
                $Amounts = $_POST['Amounts'];
                $policy_date = $_POST['pdate'];
                $policy_expire_date = $_POST['pxdate'];
               
                
                $updatee=  mysql_query("UPDATE `tbl_car_insurance` SET `policy_type`='$policy_type',`insurance_agency`='$insurance_agency',"
                        . "`Amounts`='$Amounts',`policy_date`='$policy_date',`policy_expire_date`='$policy_expire_date',`cover_note_number`='$policy_no ' WHERE `vehicle_reg_num`='$car_reg_num'") or die(mysql_error());
                
                if($updatee){
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
}

if(isset($_GET['delete'])){
    $insured=$_GET['delete'];
     $deletee=  mysql_query("DELETE FROM `tbl_car_insurance` WHERE insurance_id='$insured'") or die(mysql_error());
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
                        <a  href="#" ><i class="glyphicon glyphicon-chevron-down"></i>&nbsp;Vehicle Insurance</a>
                    </li>
                   
<!--                     <li>
                        <a href="?action=car_licences"><i class="glyphicon glyphicon-chevron-right"></i>&nbsp;Vehicle Road Licence</a>
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
                                <a href="#" data-toggle="modal" data-target="#view_car_infoo"  class="btn btn-default"><i class="glyphicon glyphicon-plus"></i>&nbsp;Vehicle Insurance</a>
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
                <th class="text-left" style="font-size: 12px;">Policy Type</th>
                <th class="text-left" style="font-size: 12px;">Insurance Agency</th>
                <th class="text-left" style="font-size: 12px;">Cover Note</th>
                <th class="text-left" style="font-size: 12px;">Amount</th>
                <th class="text-left" style="font-size: 12px;">Policy Date</th>
                <th class="text-left" style="font-size: 12px;">Policy Expire Date</th>                               
                <th class="text-left" style="font-size: 12px;">Need Review</th>


            </tr>
        </thead>
        <tbody> 
                        <?php
            $queryy = "SELECT * FROM tbl_car_insurance ORDER BY insurance_id DESC";
            $rows = mysql_query($queryy) or die("SQL Error 1: " . mysql_error());
            while ($row = mysql_fetch_array($rows)) {
                $car_reg_num = $row['vehicle_reg_num'];
                $insurance_id = $row['insurance_id'];
                $policy_type = $row['policy_type'];
                $insurance_agency = $row['insurance_agency'];
                $policy_no = $row['cover_note_number'];
                $Amounts = $row['Amounts'];
                $policy_date = $row['policy_date'];
                $policy_expire_date = $row['policy_expire_date'];
                $need_reviews = $row['need_reviews'];
                 $str = $policy_expire_date;
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
                   
                        <td class="" style="">
                            <ul class="showlist" style=" font-size: 14px;">
                                <li>
                        <a href="#" data-toggle="modal" 
                                     data-a="<?php echo $car_reg_num; ?>"
                                     data-b="<?php echo $policy_type; ?>"
                                     data-c="<?php echo $insurance_agency; ?>"
                                     data-d="<?php echo $policy_no; ?>"
                                     data-e="<?php echo $Amounts; ?>"
                                     data-f="<?php echo $policy_date; ?>"
                                     data-g="<?php echo $policy_expire_date; ?>"
                                     data-h="<?php echo $status; ?>"
                                     data-i="<?php echo $insurance_id; ?>"
                                     data-target="#view_car_info" class="view-info services" style="z-index:0;">View</a>
                                     </li>
                                     <li>
                                         <a  href="?action=vehicle Insurance and Road Services&delete=<?php echo $insurance_id;?>"  class="delete services" data-confirm="Are you sure to delete Insurance for vehicle number <?php echo $car_reg_num;?>?">Delete</a>
                                     </li>
                            </ul>
                            </td>
                    <td style="font-size: 12px;"><?php echo $car_reg_num; ?></td>
                    <td style="font-size: 12px;"><?php echo $policy_type; ?></td>
                    <td style="font-size: 12px;"><?php echo $insurance_agency; ?></td>
                    <td style="font-size: 12px;"><?php echo $policy_no; ?></td>
                    <td style="font-size: 12px;"><?php echo $Amounts; ?></td>
                    <td style="font-size: 12px;"><?php echo $policy_date; ?></td>
                    <td style="font-size: 12px;"><?php echo $policy_expire_date; ?></td>
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
<div id="view_car_info" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">INSURANCE INFORMATION</h5>
            </div>
            <div class="modal-body">
                <div id="kubwa">
                    
                </div>
                <form class="form-inline" role="form"  action=""   method="post" >       
                    <div role="tabpanel">   
                        <div class="tab-content" style="padding:15px 0">
                            <div role="tabpanel" class="tab-pane active" id="tab1">
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Vehicle Reg#:</span></span>

                                    <select class="form-control" id="a" name="vregnm">
                                        
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
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Policy Type:</span></span>
                                    <input name="policy_type" id="b" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Cover Note Number</span></span>
                                    <input name="cover_note" id="d" class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Insurance Agency</span></span>
                                    <input name="Insurance_agency" id="c" class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Amounts</span></span>
                                    <input name="Amounts" id="e" class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>

                                <div class="input-group" style="width:49%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Policy Date</span></span>
                                    <input name="pdate" id="f" placeholder="dd-mm-yy" class="form-control date1" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <div class="input-group" style="width:49%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Policy Expire Date</span></span>
                                    <input name="pxdate" id="g" placeholder="dd-mm-yy" class="form-control date2" value="" aria-describedby="sizing-addon1"   type="text">
                                </div> 
                                 <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Amounts</span></span>
                                    <input name="status" id="h" class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default bg-darkBlue shadow fg-white" data-dismiss="modal"><span class="icon-cancel-2" aria-hidden="true"></span> Cancel</button>
                        <button type="submit" name="insurance" id="submit_button" class="btn bg-green shadow"  data-complete-text="Saving..." autocomplete="off">
                            <span class="icon-checkmark " aria-hidden="true"></span> Save </button>
                            
                    </div>               
                </form>
            </div>

        </div>

    </div>
</div>

<!--model linces-->

<!-- Modal -->
<div id="view_car_infoo" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">INSURANCE INFORMATION</h5>
            </div>
            <div class="modal-body">
                <div id="kubwa">
                    
                </div>
                <form class="form-inline" role="form"  action=""   method="post" >       
                    <div role="tabpanel">   
                        <div class="tab-content" style="padding:15px 0">
                            <div role="tabpanel" class="tab-pane active" id="tab1">
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Vehicle Reg#:</span></span>

                                    <select class="form-control"  name="vregnm">
                                         <option value="">--Choose--</option>
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
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Policy Type:</span></span>
                                    <input name="policy_type"  class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">

                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Cover Note Number</span></span>
                                    <input name="cover_note"  class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Insurance Agency</span></span>
                                    <input name="Insurance_agency"  class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <div class="input-group" style="width:100%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Amounts</span></span>
                                    <input name="Amounts"  class="form-control" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>

                                <div class="input-group" style="width:49%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Policy Date</span></span>
                                    <input name="pdate"  placeholder="dd-mm-yy" class="form-control date1" value="" aria-describedby="sizing-addon1"  type="text">
                                </div>
                                <div class="input-group" style="width:49%; margin:2px 0">
                                    <span class="input-group-addon" id="sizing-addon1" style="width:30%; text-align:right"><span class="text-right">Policy Expire Date</span></span>
                                    <input name="pxdate"  placeholder="dd-mm-yy" class="form-control date2" value="" aria-describedby="sizing-addon1"   type="text">
                                </div> 
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default bg-darkBlue shadow fg-white" data-dismiss="modal"><span class="icon-cancel-2" aria-hidden="true"></span> Cancel</button>
                        <button type="submit" name="insurancee" id="submit_button" class="btn bg-green shadow"  data-complete-text="Saving..." autocomplete="off">
                            <span class="icon-checkmark " aria-hidden="true"></span> Save </button>
                    </div>               
                </form>
            </div>

        </div>

    </div>
</div>

<!--model linces-->


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
    
      
          <div class="alert alert-success error">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Your data was successfully submitted!</strong> .
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
