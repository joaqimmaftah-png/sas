

<head>
    <style>
        tr td input{
            width: 40px;
        }
    </style>
             <script>
        function inventory(str) {
            if (str.length == 0) {
                document.getElementById("actioninventory").innerHTML = "";
                document.getElementById("actioninventory").style.border = "0px";
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
                    document.getElementById("actioninventory").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/stock/inventory_action.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>


</head>
<!--<div class="bg-white" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="?full=inventory"><i class="icon-home fg-blue"></i>&nbsp;Stock Holding</a>
            </li>
                        <li>
                <a class="" href="#" onclick="getPage('sincro_full.php?full=tbl_stock_holding')"><i class="icon-tools fg-cobalt"></i>&nbsp;Spare Provisioning</a>
            </li>
            <li>
                <a class="" href="#"><i class="icon-file-excel fg-green"></i>&nbsp;Download</a>                 
            </li>

             <li id="actioninventory">
               show data
            </li>
                         <li>
                <a class="" href="?"><i class="icon-reply-2 fg-green"></i>&nbsp;Home</a>                 
            </li>
        </ul>
    </nav>
</div>  -->
<div id="full" class="">
    <table id="example" class="display bordered" style="font-size: 12px;" width="100%" cellspacing="0">
        <thead>

            <tr class="info">
                <th class="text-left"></th>
                <th class="text-left">Vehicle Registration #</th>
                <th class="text-left">Vehicle Type</th>                                                 
                <th class="text-left">Vehicle Centre</th>
                <th class="text-left">Faults Description</th>               
                <th class="text-left">Faults Reported Date</th>
                <th class="text-left">Date Reported Accounts</th>
                <th class="text-left">Overlapped Days</th>
                <th class="text-left">Operation Conditions</th>
                <th class="text-left">Planned Resolution Date</th>
                <th class="text-left">Actual Resolution Date</th>
                 <th class="text-left">Reasons/Remark</th>
            </tr>
        </thead>

        <tbody>
            <?php
$query = "SELECT * FROM tbl_car_monitoring  ORDER BY car_id DESC";
$resultT = mysql_query($query) or die(mysql_error());
// get data and store in a json array
while ($rrow = mysql_fetch_array($resultT)) {
      $vehicle_reg_num=$rrow['vehicle_reg_num'];
    $queryy = "SELECT * FROM tbl_car_faults where vehicle_reg_num='$vehicle_reg_num'";
    $rows= mysql_query($queryy) or die("SQL Error 1: " . mysql_error());
    $row=mysql_fetch_array($rows);
     $date_reported_accounts=$row['date_reported_accounts'];
    $today=date("d.m.Y");
    $date1 = new DateTime($date_reported_accounts);
    $date2 = new DateTime($today);
    $diff = $date2->diff($date1)->format("%a"); 
        $check='<input type="checkbox" name="" onchange="gotoaction(this.value)" value="'.$rrow['car_id'].'">';
         $vehicle_reg_num=$rrow['vehicle_reg_num'];
         $vehicle_type=$rrow['vehicle_type'];      
         $vehicle_centre=$rrow['vehicle_centre'];       
         $fault_description=$row['fault_description'];       
         $fault_reported_date=$row['fault_reported_date'];
         $date_reported_accounts=$row['date_reported_accounts'];      
         $overlapped_days=$diff;
         $operation_conditions=$row['operation_conditions'];      
         $planned_resolution_date=$row['planned_resolution_date'];
         $actual_resolution_date=$row['actual_resolution_date'];      
         $reasons_remark=$row['reasons_remark'];
         $status=$row['status'];

                ?>

                <tr class="">
                    <td><?php echo $check;?></td>
                    <td><?php echo $vehicle_reg_num; ?></td>
                    <td class="right"><?php echo $vehicle_type; ?></td>                  
                    <td class="right"><?php echo $vehicle_centre; ?></td>
                    <td class="right"><?php echo $fault_description; ?></td>
                    <td class="right"><?php echo $fault_reported_date; ?></td>
                    <td class="right"><?php echo $date_reported_accounts; ?></td>
                    <td class="right"><?php echo $overlapped_days; ?></td>
                    <td class="right"><?php echo $operation_conditions; ?></td>                   
                    <td class="right"><?php echo $planned_resolution_date; ?></td>
                    <td class="right"><?php echo $actual_resolution_date; ?></td>
                    <td class="right"><?php echo $reasons_remark; ?></td>
                    <td class="right"><?php echo $status; ?></td>



                </tr>

            <?php } ?>
        </tbody>
    </table>
</div>
