<?php
if(isset($_POST['register_car_issue'])){
    include_once 'db.php';
    $faultsdescr=$_POST['faultsdescr'];
    $datefaults=$_POST['datefaults'];
    $operationcond=$_POST['operationcond'];
    $planresolution=$_POST['planresolution'];
    $reasons=$_POST['reasons'];
    $car_reg_num=$_POST['car_reg_num'];
    $status="Open";
    $reportdate = date("Ymd", strtotime($datefaults));
    $reportplanresoln = date("Ymd", strtotime($planresolution));
    
    $insert_faults=mysql_query("INSERT INTO tbl_car_faults(vehicle_reg_num,Reported_issue,fault_reported_date,operation_conditions,planned_resolution_date,reasons_remark,status,reportdate,planresolndate)"
            . " VALUES('$car_reg_num','$faultsdescr','$datefaults','$operationcond','$planresolution','$reasons','$status','$reportdate','$reportplanresoln')") or die(mysql_error());
    
    if($insert_faults){
        echo "<script>
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

?> 



<script>
        function showResult(str) {
            if (str.length == 0) {
                document.getElementById("show_data").innerHTML = "";
                document.getElementById("show_data").style.border = "0px";
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
                    document.getElementById("show_data").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/car_track/search_car.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>

     <script>
        function shoform(str) {
            if (str.length == 0) {
                document.getElementById("show_form").innerHTML = "";
                document.getElementById("show_form").style.border = "0px";
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
                    document.getElementById("show_form").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/car_track/car_reg_form.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
</head>
<div class="row fixed-top" >
    <div class="col-lg-12 col-xs-12">

        <div class="bg-white shadow collapse navbar-collapse" id="myNavbar"  style=" margin: 2px 0px 5px 0px;" >

            <nav class="horizontal-menu compact" >
                <ul>
                    
                    <li >
                        <a class="" style="" href="#" data-toggle="modal" data-target="#add_issue">Add New Issue</a>
                    </li>
                     <li >
                        <a class="" style="" href="?action=vehicle_report" >Generate Report</a>
                    </li>
                    


                </ul>
            </nav>
        </div>

    </div>


</div>