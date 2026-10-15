                                                            
<?php
$search_id=$_GET['q'];
if(!empty($search_id)){
    include_once '../db.php';
    $k=mysql_query("SELECT * FROM tbl_fuel_vehicles WHERE vehicle_reg_num LIKE '%$search_id%' OR driver_phone_num LIKE '%$search_id%' OR driver LIKE '%$search_id%'") or die(mysql_error());

?>
<table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">Vehicle Registration</th>                                       
                                        <th class="text-left">Driver Name</th>  
                                        <th class="text-left">Driver Contact</th>                                                                                 
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        while ($l = mysql_fetch_array($k)) {
        $vehicle_reg_num=$l['vehicle_reg_num'];
        $driver_phone_num=$l['driver_phone_num'];
        $driver=$l['driver'];
        $vehicle_id=$l['vehicle_id'];
                                    ?>
   
                                        <tr>
                                            <td><input type="checkbox" name="vehicle_id" value="<?php echo $vehicle_id; ?>"></td>
                                            <td class="right"><?php echo $vehicle_reg_num; ?></td>
                                            <td class="right"><?php echo $driver; ?></td>
                                            <td class="right"><?php echo $driver_phone_num; ?></td>
                                            
                                        </tr> 
                                        <?php
    }    
?>
                                </tbody>

                                <tfoot></tfoot>
                            </table>
<?php
    }   
?>