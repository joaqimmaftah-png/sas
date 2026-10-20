<head>
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
table, th, td {   
    border: 1px solid #f2f2f2;  
}
</style>       
</head>     
  
    
 <hr>
 
 
    
 <table class="table cart table-bordered">


 <tr>        
  <th>SN</th>
  <th style="background-color: #469BD7;">Issue_description</th>
  <th>Start_date</th>
  <th>End_date</th>
  <th>Issue Category</th>
  <th>Assigned to</th>
  <th>department</th>    
  <th>Status</th>
  <th>Action</th> 
  
 </tr>  

    </thead>
    <tbody>
    <?php
require_once __DIR__ . '/../../mysql_compat.php';

////////////////////////////January//////////////////////////////////////////////////////
    
                         
    $jdata= mysql_query("SELECT * FROM tbl_it_helpdesk") or die(mysql_error());
     
    while ($result=mysql_fetch_array($jdata)){ 
       $assign=$result['assigned_to'];
       $depart=$result['department'];
        
        
          
       $jdata2= mysql_query("SELECT * FROM tbl_employee WHERE assigned_to='$assign'") or die(mysql_error());
       
       $ser=  mysql_fetch_array($jdata2);
       $name=  $ser['first_name'].' '.$ser['surname'];
       
       $sqwee=  mysql_query("SELECT * FROM tbl_department WHERE department_id='$depart'")or die(mysql_error());
       $dep_name=$sqwee['department_name'];
     
    } 
    
    $i=1;
    
////////////////////////////January//////////////////////////////////////////////////////
    ?>     
 <!--///////////////////////////////Jnanuary////////////////////////////////////////////////////////////////////////////////////////////////////-->
<tr>        
    
    <td><?php echo  $i++;?></td> 
    <td><?php echo  $result['issue_description'];?></td>   
    <td><?php  echo $result['start_date'];?></td>
    <td><?php  echo $result['end_date'];?></td>
    <td><?php  echo $result['issue_category'];?></td>
    <td><?php echo  $name;?></td>  
    <td><?php echo  $dep_name;?></td> 
    <td><?php echo  $result['status'] ?></td>  
    <td><a href="">View</a></td> 
      
</tr>              
        
 <!----------------------------end----------------->
  <!--///////////////////////////////Feb////////////////////////////////////////////////////////////////////////////////////////////////////-->

  
  
 <!----------------------------end----------------->     
 </tbody>
 </table>    
    
      
<?php
$monthArray = range(1, 12);  
?>
<select name="month">
    <!--<option value="">Select Month</option>-->
    <?php
    foreach ($monthArray as $month) {   
        // padding the month with extra zero
        $monthPadding = str_pad($month, 2, "0", STR_PAD_LEFT);
        // you can use whatever year you want
        // you can use 'M' or 'F' as per your month formatting preference
        $fdate = date("F", strtotime("2015-$monthPadding-01"));
//      echo '<option value="'.$monthPadding.'">'.$fdate.'</option>';
    }
    ?>
</select>  