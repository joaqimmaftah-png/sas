<?php 
$pid=$_GET['id'];
$survey=  mysql_query("SELECT * FROM site_survey WHERE site_id='$pid'") OR die(mysql_error());
$dg=  mysql_fetch_array($survey);
$employee_code=$dg['employee_code'];
    $selectv= mysql_query("SELECT * FROM tbl_employee where emp_file_no='$employee_code'") or die(mysql_error());
    $row=mysql_fetch_array($selectv);
    $fullname=$row['first_name'].' '.$row['surname'];
?>
<head>
    <style type="text/css">

            @media print
            {    
                .ignore,.btn, .navigation-bar,.horizontal-menu *
                {
                    display: none !important;
                }
            }
            @media print{
                caption{
    background-color: #CDCDCD !important;
/*    text-align: center;*/
    border: 0px !important;
    padding-left: 1%;
    -webkit-print-color-adjust: exact; 
    
}
@media print{
                th{
    background-color: #CDCDCD !important;
    -webkit-print-color-adjust: exact; 
    
}
@media print{
                td.mc{
    background-color: #CDCDCD !important;
    -webkit-print-color-adjust: exact; 
    
}

            }

  
        </style>
        
    <style>
        .head-date{
           position: relative;
           float: left;
             padding-left: 8%;
           width: 50%;
           padding-top: 3px;
            -webkit-print-color-adjust: exact; 
        }
        .code-text{
            position: relative;
           float: right;
           padding-top: 3px;
           padding-left: 28%;
           width: 50%;
            -webkit-print-color-adjust: exact; 
        }
    </style>
    <style>
    table {
        
/*    border-collapse: collapse;*/
    width: 100%;
/*    border: 1px solid black;*/
}
td{
   height:25px;
   padding-left: 1%;
}
caption,th{
    background-color: #CDCDCD;
/*    text-align: center;*/
    border: 1px solid black;
    padding-left: 1%;
    
}



</style>
    </head>
<div class="container">
    <div class="row" id="btn">
        <div class="col-lg-12">
            <form action="" method="POST">
                <a href="javascript:window.print()" class="btn btn-default" ><i class="glyphicon glyphicon-backward"></i>Print</a>
            </form>
        </div>

    </div>

 
        
    <div class="row" style="border-bottom: 1px solid black;padding-bottom: 7px;margin-top: 2px;">
                <div class="col-lg-12">
                    <img src="assets/heade.png" alt="logo" class="pull-left img-responsive">
                </div>
                <hr>
            </div>
    <div class="row" style="border-bottom: 1px solid black;">
                <div class="head-date">
                    <strong>Date:<?php echo $dg['created_date'];?></strong>
                </div>
        <div class="code-text">
                  <strong>NO. <?php echo $dg['completion_no'];?></strong>
                </div>
        
                
            </div>
    <div class="row" style=" margin-top: 3px;" >
                <div class="head-date">
                    <strong>Prepared By:</strong><?php echo $fullname;?>
                </div>
        <div class="code-text">
                  <strong>Prepared Date:</strong> <?php echo $dg['Date'];?>
                </div>
        
                
            </div>
   
     
     <div class="row" style=" margin-top: 1%;">
         <div class="col-lg-12">
             <table border="1"> <caption><strong>WORK COMPLETION REPORT</strong></caption> 
                 <tr> 
                     <td style="background: #CDCDCD; width: 20%" class="mc">Site Address</td> <td style="width: 20%"><?php echo $dg['site_address'];?></td>
                <td style="background: #CDCDCD; width: 20%" class="mc">Customer Name</td><td style="width: 20%"><?php echo $dg['custeomer_name'];?></td> 
                 <td style="background: #CDCDCD; width: 10%" class="mc">Work Area</td><td style="width: 10%"><?php echo $dg['work_area'];?></td>
             </tr>
              <tr> 
                     <td style="background: #CDCDCD; width: 20%" class="mc">Call Received Time</td> <td style="width: 20%"><?php echo $dg['call_received_time'];?></td>
                <td style="background: #CDCDCD; width: 20%" class="mc">Date</td><td style="width: 20%"><?php echo $dg['Date'];?></td> 
                 <td style="background: #CDCDCD; width: 10%" class="mc">Project</td><td style="width: 10%"><?php echo $dg['project'];?></td>
             </tr>
              <tr> 
                     <td style="background: #CDCDCD; width: 20%" class="mc">JOB No</td> <td style="width: 20%"><?php echo $dg['job_no'];?></td>
                <td style="background: #CDCDCD; width: 20%" class="mc">Equip Running Time</td><td style="width: 20%"><?php echo $dg['equipment_remain_time'];?></td> 
                 <td style="background: #CDCDCD; width: 10%" class="mc">Repair</td><td style="width: 10%"><?php echo $dg['repair'];?></td>
             </tr>
              <tr> 
                  <td style="background: #CDCDCD; width: 20%" class="mc">Control Contact In</td> <td style="width: 20%"><?php echo $dg['control_contact_in'];?></td>
                <td style="background: #CDCDCD; width: 20%" class="mc">Control Contact Out</td><td style="width: 20%"><?php echo $dg['control_contact_in'];?></td> 
                 <td style="background: #CDCDCD; width: 10%" class="mc">Service/Routine</td><td style="width: 10%"><?php echo $dg['service_route'];?></td>
             </tr>
              <tr> 
                     <td style="background: #CDCDCD; width: 20%" class="mc">Time In</td> <td style="width: 20%"><?php echo $dg['time_in'];?></td>
                <td style="background: #CDCDCD; width: 20%" class="mc">Time Out</td><td style="width: 20%"><?php echo $dg['timeout'];?></td> 
                 <td style="background: #CDCDCD; width: 10%" class="mc">Refuel</td><td style="width: 10%"><?php echo $dg['refuel'];?></td>
             </tr>
              
              <tr> 
                     <td style="background: #CDCDCD; width: 20%" class="mc">Equipment Ref#</td> <td style="width: 20%"><?php echo $dg['equipment_ref_no'];?></td>
                <td style="background: #CDCDCD; width: 20%" class="mc">Serial No.</td><td style="width: 20%"><?php echo $dg['serial_no'];?></td> 
                 <td style="background: #CDCDCD; width: 10%" class="mc">Inspection</td><td style="width: 10%"><?php echo $dg['inspection'];?></td>
             </tr>
              <tr> 
                     <td style="background: #CDCDCD; width: 20%" class="mc">Model</td> <td style="width: 20%"><?php echo $dg['model'];?></td>
                <td style="background: #CDCDCD; width: 20%" class="mc">Make/Type.</td><td style="width: 20%"><?php echo $dg['make_type'];?></td> 
                 <td style="background: #CDCDCD; width: 10%" class="mc">Site Cleaning</td><td style="width: 10%"><?php echo $dg['site_clearing'];?></td>
             </tr>
             
         </table>

             </div>
     </div>
     
        <div class="row" style=" margin-top: 1%;">
         <div class="col-lg-12">
             <table border="1"> <caption><strong>DESCRIPTION OF WORK DONE</strong></caption> 
                 <?php
                 $descq=mysql_query("SELECT * FROM survey_description WHERE site_id='$pid'") OR die(mysql_error());
while($dgxq=mysql_fetch_array($descq)){
    ?>
                 <tr> 
                     <td><?php echo $dgxq['item'];?></td>
             </tr>
          
          <?php
          }
          ?>
             
       
             
         </table>

             </div>
     </div>
     <div class="row" style=" margin-top: 1%;">
         <div class="col-lg-12">
             <table border="1"> <caption><strong>ADDITIONAL WORK REQUIRED</strong></caption> 
        <?php
                 $descz=mysql_query("SELECT * FROM survey_addition_work_required WHERE site_id='$pid'") OR die(mysql_error());
while($dgxz=mysql_fetch_array($descz)){
    ?>
                 <tr> 
                     <td><?php echo $dgxz['addition_work'];?></td>
             </tr>
          
          <?php
          }
          ?>
             
         </table>

             </div>
     </div>
     <div class="row" style=" margin-top: 1%;">
         <div class="col-lg-12">
             <table border="1"> <caption><strong>REMARK(RECOMMENDATION)</strong></caption> 
                  <?php
                 $descu=mysql_query("SELECT * FROM survey_remarks WHERE site_id='$pid'") OR die(mysql_error());
while($dgxu=mysql_fetch_array($descu)){
    ?>
                 <tr> 
                     <td><?php echo $dgxu['ramarks'];?></td>
             </tr>
          
          <?php
          }
          ?>
         </table>

             </div>
     </div>
      <div class="row" style=" margin-top: 1%;">
         <div class="col-lg-12">
             <table border="1"> <caption><strong>INVOICE INSTRUCTIONS</strong></caption> 
                 
                 <tr> <th>Id</th> <th>Description</th> <th>Part Number</th> <th>Unit</th> <th>Quantity</th></tr>
                              <?php
                              $bd=1;
                 $descup=mysql_query("SELECT * FROM survey_invoice_instruction WHERE site_id='$pid'") OR die(mysql_error());
while($dgxup=mysql_fetch_array($descup)){
    ?>
                 <tr> 
                 <td><?php echo $bd++;?></td> 
                     <td><?php echo $dgxup['item'];?></td>                                         
                     <td><?php echo $dgxup['partnumber'];?></td> 
                     <td><?php echo $dgxup['unit'];?></td> 
                     <td><?php echo $dgxup['quantity'];?></td>  
                 
                 </tr>
<?php
          }
          ?>
         </table>

             </div>
     </div>
     <div class="row" style=" margin-top: 1%;">
         <div class="col-lg-12">
             <table border="1"> <caption><strong>Declarations</strong></caption> 
                 
                 <tr> 
                     <th colspan="2">SITE ENGINEER/PROJECT MANAGER</th> 
                     <th colspan="2">CLIENTS</th> 
                     
                 </tr>
                 <tr>
                     <td style=" width: 25%"><strong>Engineer Name</strong></td> <td></td>
                     <td style=" width: 25%"><strong>Authorized By</strong></td> <td></td>
                 </tr>
                  <tr>
                     <td style=" width: 25%"><strong>Signature</strong></td> <td></td>
                     <td style=" width: 25%"><strong>Signature</strong></td> <td></td>
                 </tr>

         </table>

             </div>
     </div>
 </div>  



