<table class="table striped bordered hovered">
    <thead>
        <tr>
            <th class="text-left">Vehicle Reg No.</th>
            <th class="text-left">Vehicle Type</th>
            <th class="text-left">Owner</th>
            <th class="text-left">Driver Name</th>
            <th class="text-left">Driver Contact</th> 
            <th class="text-left">Vehicle Centre</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $q =$_GET['q'];
        include_once '../db.php';
        $show_site=  mysql_query("SELECT * from  tbl_car_monitoring where vehicle_reg_num LIKE  '$q%'") or die(mysql_error());
        while($row = mysql_fetch_array($show_site)) {
        $vehicle_reg_num=$row['vehicle_reg_num'];
        $vehicle_type =$row['vehicle_type'];
        $owner= $row['owner'];
        $driver_name = $row['driver_name'];
        $driver_contact =$row['driver_contact'];   
        $vehicle_centre =$row['vehicle_centre']; 
        $car_id=$row['car_id'];
        ?>
        <tr class="">                   
            <td class="right"><?php echo $vehicle_reg_num;?></td>
            <td class="right"><?php echo $vehicle_type ;?> </td>
            <td class="right"><?php echo $owner;?></td>
            <td class="right"><?php echo $driver_name;?></td>
            <td class="right"><?php echo $driver_contact;?></td>
            <td class="right"><?php echo $vehicle_centre;?></td>
            <td class="right">
                <input type="checkbox"  name="caid" onchange="shoform(this.value)" value="<?php echo $vehicle_reg_num;?>">
            </td>
        </tr> 
        <?php
        }
        ?>

    </tbody>
</table>

