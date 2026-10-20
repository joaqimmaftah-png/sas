                         




<table class="table table-striped table-hover bordered" id="asset-table">
                                <thead><tr>

                                        <th>Item Name</th>
                                        <th>Specification</th>
                                        <th>Model</th>
                                        <th>Part Number</th>
                                        <th>Manufacturer</th>
                                        <th>Select</th>
                                    </tr></thead>
                                <tbody  style="font-size:12px">
                                      <?php
require_once __DIR__ . '/../../mysql_compat.php';

                                      include '../db.php';
                                      $n=$_GET['q'];
                                      $toaa=  explode("@",$n);
                                      $name=$toaa[0];
                                      $ident=$toaa[1];
                                      
                                      $sparenamn = mysql_query("SELECT * from tbl_spare_parts where part_common_name LIKE '$name' ") or die(mysql_error());
while ($rowing = mysql_fetch_array($sparenamn)) {
    $sparename = $rowing['part_common_name'];
    $specification = $rowing['specification'];
    $model = $rowing['model'];
    $part_number = $rowing['part_number'];
    $manufacturer=$rowing['manufacturer'];
    $part_id=$rowing['part_id'];
      if(empty($specification)){
       $specification="NULL"; 
    }
    if(empty($model)){
       $model="NULL"; 
    }  
    if(empty($manufacturer)){
       $manufacturer="NULL"; 
    }
     if(empty($part_number)){
       $part_number="NULL"; 
    }
    
    
                                      
                                      ?>
                                   
                                    <tr>
                                        
                                        <td><?php echo $sparename;?></td>
                                        <td><?php echo $specification ;?></td>
                                        <td><?php echo $model;?></td>
                                        <td><?php echo $part_number;?></td>
                                        <td><?php echo $manufacturer;?></td>
                                        
                                         <td>
<input type="checkbox" name="data" value="<?php echo $part_id.'@'.$ident;?>" onclick="showsrequest(this.value)">
                                         </td>
                                           
                                    </tr>
                                  
                              <?php
                               }
                              ?>
                                        
                                </tbody>
                            </table>