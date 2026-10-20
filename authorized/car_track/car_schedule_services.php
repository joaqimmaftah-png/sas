
<?php
require_once __DIR__ . '/../../mysql_compat.php';

if(isset($_POST['add_km'])){
    $reg=$_POST['car_reg_num'];
    $current_date=$_POST['current_date'];
    $current_km=$_POST['current_km'];
    $q=mysql_query("SELECT * FROM tbl_car_services_history WHERE  vehicle_reg_num='$reg'") or die(mysql_error());
    $re=mysql_fetch_array($q);
    $we=mysql_num_rows($q);
     $last_km=$re['current_km'];
     
     
//     $fr= mysql_query("SELECT * FROM tbl_car_services WHERE `status`='0' AND `services`='NO' AND `vehicle_reg_num`='T 139 CPT'") or die(mysql_error());
//        $trs=mysql_num_rows($fr);
//        $tdd=  mysql_fetch_array($fr);
//        $T=$tdd['total_km'];
//        $serviceT=$T+$total;
        
    
    if($we>0){
        
         $total=$current_km-$last_km;
        $ww=  mysql_query("UPDATE `tbl_car_services_history` SET `last_served_date`='$current_date',`last_km`='$last_km',`current_km`='$current_km' WHERE `vehicle_reg_num`='$reg'") or die(mysql_error());
        
        $fr= mysql_query("SELECT * FROM tbl_car_services WHERE `status`='0' AND `vehicle_reg_num`='$reg'") or die(mysql_error());
        $trs=mysql_num_rows($fr);
        $tdd=  mysql_fetch_array($fr);
        $T=$tdd['total_km'];
        $serviceT=$T+$total;
        if($trs>0){
          $serv=5000;
          
            if($T>=$serv){              
               
        $qw=  mysql_query("UPDATE `tbl_car_services` SET `total_km`='$serviceT',`services`='YES' WHERE `vehicle_reg_num`='$reg' AND status='0'") or die(mysql_error());
            }
            else{
                $qw=  mysql_query("UPDATE `tbl_car_services` SET `total_km`='$serviceT' WHERE `vehicle_reg_num`='$reg' AND status='0'") or die(mysql_error());
            }
        }
        else
        {
          $wq=  mysql_query("INSERT INTO `tbl_car_services`(`vehicle_reg_num`, `total_km`, `status`, `services`) VALUES ('$reg','$serviceT','0','NO')") or die();  
        }
    }
 else {
     $last_km=$re['last_km'];
         $total=$current_km-$last_km;
        $by=  mysql_query("INSERT INTO `tbl_car_services_history`(`last_served_date`, `last_km`, `current_km`, `vehicle_reg_num`) VALUES ('$current_date','$current_km','$current_km','$reg')") or die(mysql_error());
        
        if($by){
             $wq=  mysql_query("INSERT INTO `tbl_car_services`(`vehicle_reg_num`, `total_km`, `status`, `services`) VALUES ('$reg','0','0','NO')") or die();  
        }
        
    }
    
    
  
}

?>



<head>
            <script>
        function showoption(str) {
            if (str.length == 0) {
                document.getElementById("action").innerHTML = "";
                document.getElementById("action").style.border = "0px";
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
                    document.getElementById("action").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/Car_track/schedule_services_action.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
</head>

<script type="text/javascript">
                   $(document).ready(function () {
            var url = "authorized/car_track/load_schedual_services.php";

            // prepare the data
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'check' },
                    { name: 'vehicle_reg_num' },
                    { name: 'make' },
                    { name: 'model' },
                    { name: 'Drivername' },
                    { name: 'location' },
                    { name: 'current_km'},
                    { name: 'last_km'},
                    { name: 'last_served_date'},                  
                    { name: 'due_services'},   
                    { name: 'replaced_parts'} 
                 
                ],
                id: 'id',
                url: url,
                root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                width: '100%',
                height:530,
                source: dataAdapter,
                sortable: true,
                filterable: true,
                filtermode: 'excel',
                columnsresize: true,
                autoshowfiltericon: false,
                columns: [
                    { text: 'Action', datafield: 'check', width:'5%'},
                    { text: 'Vehicle Registration #', datafield: 'vehicle_reg_num', width:'10%'},
                     { text: 'Make', datafield: 'make', width:'10%'},
                  { text: 'Model', datafield: 'model', width:'10%'},  
                  { text: 'Driver Name', datafield: 'Drivername', width:'10%'}, 
                  { text: 'Centre', datafield: 'location', width:'9%'},
                  { text: 'Current Km', datafield: 'current_km',width:'8%'},
                  { text: 'Last Km', datafield: 'last_km', width:'8%'},
                  { text: 'Last Service Date', datafield: 'last_served_date', width:'10%'},
                  { text: 'Due Services', datafield: 'due_services', width:'10%'},
                  { text: 'Replacement Parts', datafield: 'replaced_parts', width:'10%'}
                  

                 
   
                  
                ]
            });
            
                      
            
            
        });
    </script>
    <div class="row fixed-top" >
    <div class="col-lg-12 col-xs-12">

        <div class="bg-white shadow collapse navbar-collapse" id="myNavbar"  style=" margin: 2px 0px 5px 0px;" >

            <nav class="horizontal-menu compact" >
                <ul>
                    
                    <li >
                        <a class="" style="" href="?action=vehicle schedule services">Home</a>
                    </li>
                     <li >
                        <a  style="" href="#" onclick="load_record_page('authorized/car_track/record_km.php')">Record Kilometers</a>
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
    <div class="row" id="load_page">
        <div class="col-lg-12">
    <div id="jqxgrid">
    </div>
   
    </div>
        </div>