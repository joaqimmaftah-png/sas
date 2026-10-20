
<?php
require_once __DIR__ . '/../../mysql_compat.php';

$message = "";
?>
<head>
    <script>
        function search(str) {
            if (str.length == 0) {
                document.getElementById("search_results").innerHTML = "";
                document.getElementById("search_results").style.border = "0px";
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
                    document.getElementById("search_results").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/vehicle_fuel_management/seach_car.php?q=" + str, true);
            xmlhttp.send();
        }
    </script> 
    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#addmanual").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "authorized/vehicle_fuel_management/usermanual_issues.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#ujumbe").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>

</head>
<div class="bg-white shadow" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="#"><i class="icon-cars fg-blue"></i>&nbsp;List Of Fuel Issued</a>
            </li> 
            <li>
                <a class="" href="#" data-toggle="modal" data-target="#manualissue"><i class="icon-laptop fg-green"></i>&nbsp;Manual Issue</a>
            </li> 
            <li>
                <a class="" href="#" data-toggle="modal" data-target="#choosedate"><i class="icon-file-excel fg-green"></i>&nbsp;Download</a>
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
                <th class="text-left">Reg#</th>                
                
                <th class="text-left">Vehicle Km</th>
                <th class="text-left">Issued Amounts</th>
                <th class="text-left">Issue Date</th>  
                <th class="text-left">Order#</th> 
                <th class="text-left">Fuel Station</th> 
                <th class="text-left">Driver</th>
                <th class="text-left">Contact</th>
                <th class="text-left">Location</th>
                <th class="text-left">Team</th>

            </tr>
        </thead>

        <tbody>
            <?php
            include 'authorized/db.php';
            $a = mysql_query("SELECT * FROM tbl_fuel_vehicle_list")or die(mysql_error());
            while ($b = mysql_fetch_array($a)) {
                $vehicle_id = $b['vehicle_id'];
                $vehicle_reg_num = $b['vehicle_reg_num'];
                $km = $b['km'];
                $issued_amount = $b['issued_amount'];
                $issued_date = $b['issued_date'];
                $driver_phone_num = $b['driver_phone_num'];
                $m = mysql_query("SELECT * FROM tbl_fuel_vehicles WHERE vehicle_id='$vehicle_id'") or die(mysql_error());
                $n = mysql_fetch_array($m);
                $fuel_amounts = $n['fuel_amounts'];
                $vehicle_km = $n['vehicle_km'];
                $vendor = $n['vendor'];
                $vendor_location = $n['vendor_location'];
                $driver = $n['driver'];
                $team = $n['team'];
                $locations = $n['locations'];
                $status = $b['status'];
                $order_number=$b['order_number'];
                ?>
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="" value="<?php echo $vehicle_reg_num; ?>" onchange="showoptionedit(this.value)">
                    </td>
                    <td><?php echo $vehicle_reg_num; ?></td>                                    
                    <td><?php echo $km; ?></td>
                    <td><?php echo $issued_amount . '&nbsp;Litres'; ?></td>
                    <td><?php echo $issued_date; ?></td>  
                    <td><?php echo $order_number; ?></td> 
                    <td><?php echo $vendor_location; ?></td>
                    <td><?php echo $driver; ?></td>
                    <td><?php echo $driver_phone_num; ?></td>
                    <td><?php echo $locations; ?></td>
                    <td><?php echo $team; ?></td>

                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<!--/////////////////////////////////manual/////////////////////////////////////////////-->
<div id="manualissue" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-cars"></span> 
                    <div class="title">Request Fuel Manual</div> 
                    <button class="btn-min"></button> 
                    <button class="btn-max"></button> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content" >

                    <div class="margin10" style="margin-top: 3%;">

                        <form id="addmanual" action="authorized/vehicle_fuel_management/usermanual_issues.php"  method="post">  
                            <input type="hidden" name="req" value="" id="req">
                            <div class="form-group">
                                <div class="input-control text">
                                    <input type="text" onkeyup="search(this.value)" placeholder="Search by Registration Number,Driver Name or Contact"/>
                                    <button class="btn-search"></button>
                                </div>
                            </div>
                            <div id="search_results">

                            </div>
                            <div class="form-group">
                                <label for="request_oil">Fuel Amounts(Litres):</label>
                                <input type="text" class="form-control" value="" name="request_oil" id="fulltank">
                            </div>
                            <div class="form-group">
                                <label for="status">Order Number:</label>
                                <input type="text" class="form-control" value=""  id="orderno" name="orderno">
                            </div>
                              <div class="form-group">
                                <label for="status">Vehicle km:</label>
                                <input type="text" class="form-control" value=""  id="orderno" name="km">
                            </div>

                            <div class="form-group">
                                <label for="status">Vendor:</label>
                                <input type="text" class="form-control" value=""  id="vendors" name="vendors">
                            </div>
                            <div class="form-group">
                                <label for="status">Fuel Station:</label>
                                <input type="text" class="form-control" value=""  id="fstation" name="fstation">
                            </div>
                            <div class="form-group">
                                <label for="status">Remarks:</label>
                                <input type="text" class="form-control" value=""  id="status" name="status">
                            </div> 
                            <div id="ujumbe">

                            </div>
                            <input type="submit" value="Submit Data"/>                                                                     
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!--model linces-->


<!--/////////////////////////////////manual/////////////////////////////////////////////-->
<div id="choosedate" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-file-excel"></span> 
                    <div class="title">Download</div> 
                    <button class="btn-min"></button> 
                    <button class="btn-max"></button> 
                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content" >

                    <div class="margin10" style="margin-top: 3%;">

                        <form role="form" class="form-inline" action="authorized/downloadexcell/excel.php" method="POST">
                            <div class="form-group" >
                                <label for="start">From:</label>
                                <div class="input-control text" data-role="datepicker" data-week-start="1">
                                    <input readonly="readonly" name="sdate" id="sdate"  type="text" class="form-control">
                                    <button type="button" class="btn-date"></button>
                                    <div class="calendar calendar-dropdown" style="position: absolute; max-width: 260px; z-index: 1000; top: 100%; left: 0px; display: none;"><table class="bordered"><tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">February 2015</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td><td class="text-center day-of-week">Su</td></tr><tr><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="text-center day"><a href="#">1</a></td></tr><tr><td class="text-center day"><a href="#">2</a></td><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td></tr><tr><td class="text-center day"><a href="#">9</a></td><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a href="#">13</a></td><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td></tr><tr><td class="text-center day"><a href="#">16</a></td><td class="text-center day"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td></tr><tr><td class="text-center day"><a href="#">23</a></td><td class="text-center day today"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td><td class="text-center day"><a href="#">28</a></td><td class="empty"><small class="other-day"></small></td></tr></tbody></table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ens">To:</label>
                                <div class="input-control text" data-role="datepicker" data-week-start="1">
                                    <input readonly="readonly" name="edate" id="edate"  type="text" class="form-control">
                                    <button type="button" class="btn-date"></button>
                                    <div class="calendar calendar-dropdown" style="position: absolute; max-width: 260px; z-index: 1000; top: 100%; left: 0px; display: none;"><table class="bordered"><tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">February 2015</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td><td class="text-center day-of-week">Su</td></tr><tr><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="text-center day"><a href="#">1</a></td></tr><tr><td class="text-center day"><a href="#">2</a></td><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td></tr><tr><td class="text-center day"><a href="#">9</a></td><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a href="#">13</a></td><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td></tr><tr><td class="text-center day"><a href="#">16</a></td><td class="text-center day"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td></tr><tr><td class="text-center day"><a href="#">23</a></td><td class="text-center day today"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td><td class="text-center day"><a href="#">28</a></td><td class="empty"><small class="other-day"></small></td></tr></tbody></table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">  
                                <label for="ens" style="margin-top: 18px;"></label>
                                <input type="submit" value="download"  class="form-control" id="pwd">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!--model linces-->