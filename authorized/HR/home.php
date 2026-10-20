<head>
        <script type="text/javascript">
            $(document).ready(function (e) {
                $("#departmentadd"). on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({url: "authorized/HR/dashboard_add_department.php",
                    type: "POST" ,
                    data: new FormData(this),              
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#departmentsms").html(data);
                    },
                    error: function () {
                    }
                });
            }));  
            ////////////////////////                      
                $("#designationform"). on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({url: "authorized/HR/dashboard_add_designation.php",
                    type: "POST" ,
                    data: new FormData(this),              
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#designationsms").html(data);
                    },
                    error: function () {
                    }
                });
            })); 
            ///////////////////////////
                                  
                $("#leavedays"). on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({url: "authorized/HR/dashboard_add_leaveday.php",
                    type: "POST" ,
                    data: new FormData(this),              
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#leavedaysms").html(data);
                    },
                    error: function () {
                    }
                });
            })); 
            //////////////////////// 
             $("#leavecatform"). on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({url: "authorized/HR/dashboard_add_leave_category.php",
                    type: "POST" ,
                    data: new FormData(this),              
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#leavesms").html(data);
                    },
                    error: function () {
                    }
                });
            })); 
            ///////////////benefitform/////////                       
             $("#benefitform"). on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({url: "authorized/HR/dashboard_add_benefit.php",
                    type: "POST" ,
                    data: new FormData(this),              
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#benefitsms").html(data);
                    },
                    error: function () {
                    }
                });
            }));
            ////////////////////////////////////////
             $("#positionform"). on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({url: "authorized/HR/dashboard_add_position.php",
                    type: "POST" ,
                    data: new FormData(this),              
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#positionsms").html(data);
                    },
                    error: function () {
                    }
                });
            }));
            /////////////////////////Attendance/////////////////////
             $("#attendenceform"). on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({url: "authorized/HR/dashboard_add_attendence.php",
                    type: "POST" ,
                    data: new FormData(this),              
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#attendancesms").html(data);
                    },
                    error: function () {
                    }
                });
            }));
            ////////////////////////////////////////////////////
                         $("#taxform"). on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({url: "authorized/HR/dashboard_add_tax_category.php",
                    type: "POST" ,
                    data: new FormData(this),              
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#taxsms").html(data);
                    },
                    error: function () {
                    }
                });
            }));
            /////////////////////////////////////////////////////////////
            $("#attachmentform"). on('submit', (function (e) {
                    e.preventDefault();
                    $.ajax({url: "authorized/HR/dashboard_add_attachment.php",
                    type: "POST" ,
                    data: new FormData(this),              
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#attachmentsms").html(data);
                    },
                    error: function () {
                    }
                });
            }));
            ////////////////////////////////////////////////////////
        });
    </script>
    
    <script>
         function showaction(str) {
            if (str.length == 0) {
                document.getElementById("departmentsms").innerHTML = "";
                document.getElementById("departmentsms").style.border = "0px";
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
                    document.getElementById("departmentsms").innerHTML = xmlhttp.responseText;
                    //      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "authorized/HR/delete_action.php?q=" + str, true);
            xmlhttp.send();
        }
    </script>
</head>
<?php
require_once __DIR__ . '/../../mysql_compat.php';

$query = mysql_query("SELECT department_name,location FROM tbl_department") or die("cannot select");
$username_array = array(); // start an array
$number_array = array();
while ($row = mysql_fetch_array($query)) { // cycle through each record returned
    $username_array[] = "\"" . $row['department_name'] . "\""; // get the username field and add to the array above with surrounding quotes
    $number_array[] = $row['location'];
}
$username_string = implode(",", $username_array); // implode the array to "stick together" all the usernames with a comma inbetween each
$number_arrayshow = implode(",", $number_array);
//echo $username_string; 
// output the string to the display
//echo $number_arrayshow;
?>

 <div class="navbar-header no-desktop">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <a class="" href="?action=employee"><i  class="icon-list fg-blue"></i>&nbsp;Menu</a> 
      </button>
     
    </div>

<div class="bg-white shadow collapse navbar-collapse " id="myNavbar"  style="width: 100%;" >
       
    <nav class="horizontal-menu compact" >
        <ul>
            <li>
                <a class="" href="?#"><span class="fg-blue text-bold">Welcome to Daimahrms Section.</span>Now you are able to track all employees, manage positions, allocate departments in the organization and manage salary grades.Managers are able to allocate salary grades to positions and employees and track general information regarding to salary grades.Employee Self Service is realized by employees being able edit their own data, view leave requests and add expense reports.Goal Management Allows Managers to track Employee, Department and Company Goals.</a>
            </li>

        </ul>
    </nav>
</div>
<div class="container-fluid">

    <div class=" grid fluid">
        <div class="row">
            <div class="span3"> 
                <div class="">
                    <div class="bg-white shadow" style="width: 100%;" >
                        <nav class="horizontal-menu compact">
                            <ul>
                                <li>
                                    <a class="" href=""><i class="icon-dashboard fg-blue"></i>&nbsp;Dashboard</a>
                                </li>                       
                            </ul>
                        </nav>
                    </div>
                    <div class="panel-group shadow" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">


                            

                            <div class="panel-heading" role="tab" id="heading-stock">
                                <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-stock" aria-expanded="false" aria-controls="collapse-stock">
                                    <span class="h5"><span class="icon-share-2"></span></span>&nbsp;System Setting
                                    <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> </a>
                            </div>
                            <div style="height: 0px;" aria-expanded="false" id="collapse-stock" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">
                                <div class="list-group">
                                    <a href="#" class="list-group-item" data-toggle="modal" data-target="#department"><span class="icon-plus-2"></span>&nbsp; Manage Department</a>
                                    <a href="#" class="list-group-item" data-toggle="modal" data-target="#department" ><span class="icon-plus-2"></span>&nbsp; Manage Position</a>
                                    <a href="#" class="list-group-item" data-toggle="modal" data-target="#designation"><span class="icon-plus-2"></span>&nbsp; Manage Designation</a>

                                </div>
                            </div>
                            <div style="height:1px; background-color:rgb(220,220,220)"></div>
                                                        <div class="panel-heading" role="tab" id="heading-people">
                                <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-people" aria-expanded="false" aria-controls="collapse-people">
                                    <span class="h5"><span class=" icon-calendar"></span></span> Manage Employee
                                    <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> </a>
                            </div>

                            <div style="height: 0px;" aria-expanded="true" id="collapse-people" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-people">
                                <div class="list-group">
                                    <a href="employee" class="list-group-item"><span class=" icon-plus-2 fg-brown"></span>&nbsp;Add Employee</a>
                                    <a href="payroll page" class="list-group-item"><span class="icon-plus-2"></span>&nbsp;Manage  Salary</a>
                                </div>
                            </div>
                             <div style="height:1px; background-color:rgb(220,220,220)"></div>

                            <div class="panel-heading" role="tab" id="heading-stock">
                                <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-notes" aria-expanded="false" aria-controls="collapse-stock">
                                    <span class="h5"><span class=" icon-folder"></span></span>&nbsp; Performance Appraisal
                                    <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> </a>
                            </div>
                            <div style="height: 0px;" aria-expanded="false" id="collapse-notes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">
                                <div class="list-group">
                                    <a href="add_appraisal" class="list-group-item"><span class="icon-redo"></span>&nbsp; Initiate Appraisal</a>
                                     <a href="add_appraisal" class="list-group-item"><span class="icon-plus-2"></span>&nbsp; Add Competence</a>
                                </div>
                            </div>
                            <div style="height:1px; background-color:rgb(220,220,220)"></div>

                            <div class="panel-heading" role="tab" id="heading-stock">
                                <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-news" aria-expanded="false" aria-controls="collapse-stock">
                                    <span class="h5"><span class=" icon-newspaper"></span></span>&nbsp;Time and Attendance
                                    <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> </a>
                            </div>
                            <div style="height: 0px;" aria-expanded="false" id="collapse-news" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-stock">
                                <div class="list-group">
                                    <a href="../../pages/categories" class="list-group-item"><span class="icon-plus-2"></span>&nbsp; Setting Time In/Time out</a>

                                </div>
                            </div>
                            <div style="height:1px; background-color:rgb(220,220,220)"></div>

                            <div class="panel-heading" role="tab" id="heading-stock">
                                <a class="sub-menu collapsed" data-toggle="collapse" data-parent="#accordion" href="#" aria-expanded="false" aria-controls="collapse-stock">
                                    <span class="h5"><span class=" icon-comments-4"></span></span>&nbsp;Reminder and Alert
                                    <span class="menu-icon"><span class="glyphicon glyphicon-menu-down"></span></span> 
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="">
                  wek hapa  
                </div>
 

            </div>
            <div class="span6">
                <div class="">
                    <div class="bg-white shadow" style="width: 100%;" >
                        <nav class="horizontal-menu compact">
                            <ul>
                                <li>
                                    <a class="" href=""><i class="icon-dashboard fg-blue"></i>&nbsp;Leave Request</a>
                                </li>                       
                            </ul>
                        </nav>
                    </div>
                    
                    <div id="daily_chart" style="width:100%; margin-bottom:10px">
                        <canvas style="width: 307px; height: 161px;" id="today_canvas" height="161" width="307"></canvas>

                        <script>

                            today_chart_data = {
                                labels: ['00:00', '03:00', '06:00', '09:00', '12:00', '15:00', '18:00', '21:00'],
                                datasets: [
                                    {
                                        label: 'Sales',
                                        fillColor: 'rgba(100,180,100,0.1)',
                                        strokeColor: 'rgba(100,180,100,1)',
                                        pointColor: 'rgba(100,180,100,1)',
                                        pointStrokeColor: '#fff',
                                        pointHighlightFill: '#fff',
                                        pointHighlightStroke: 'rgba(100,180,100,1)',
                                        data: [2750.00, 0, 0, 206500.00, 0, 0, 0, 0]
                                    },
                                    {
                                        label: 'Purchases',
                                        fillColor: 'rgba(100,100,180,0.1)',
                                        strokeColor: 'rgba(100,100,180,1)',
                                        pointColor: 'rgba(100,100,180,1)',
                                        pointStrokeColor: '#fff',
                                        pointHighlightFill: '#fff',
                                        pointHighlightStroke: 'rgba(100,100,180,1)',
                                        data: [169000.00, 0, 0, 0, 0, 0, 0, 0]
                                    },
                                    {
                                        label: 'Expenses',
                                        fillColor: 'rgba(180,100,100,0.1)',
                                        strokeColor: 'rgba(180,100,100,1)',
                                        pointColor: 'rgba(180,100,100,1)',
                                        pointStrokeColor: '#fff',
                                        pointHighlightFill: '#fff',
                                        pointHighlightStroke: 'rgba(180,100,100,1)',
                                        data: [0, 0, 0, 0, 0, 0, 0, 0]
                                    }
                                ]
                            }

                            today_context = document.getElementById('today_canvas').getContext('2d');
                            today_chart = new Chart(today_context).Line(today_chart_data, {responsive: true});

                        </script>
                    </div>
                </div>
                <div class="">
                    <div class="bg-white shadow" style="width: 100%;" >
                        <nav class="horizontal-menu compact">
                            <ul>
                                <li>
                                    <a class="" href=""><i class="icon-dashboard fg-blue"></i>&nbsp;Leave Request Waiting for Your Approve</a>
                                </li>                       
                            </ul>
                        </nav>
                    </div>
                    
                    <table class="table hovered">
                        <thead>
                            <tr>
                                <th class="text-left">Name</th>
                                <th class="text-left">Time CP</th>
                                <th class="text-left">Network</th>
                                <th class="text-left">Traffic</th>
                                <th class="text-left">Tiles update</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr><td>Bing</td><td class="right">0:00:01</td><td class="right">0,1 Mb</td><td class="right">0 Mb</td><td class="right">0,1 Mb</td></tr>
                            <tr><td>Internet Explorer</td><td class="right">0:00:01</td><td class="right">0,1 Mb</td><td class="right">0 Mb</td><td class="right">0,1 Mb</td></tr>
                            <tr><td>Chrome</td><td class="right">0:00:01</td><td class="right">0,1 Mb</td><td class="right">0 Mb</td><td class="right">0,1 Mb</td></tr>
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                </div>
                <div class="">
                     <div class="bg-white shadow" style="width: 100%;" >
                        <nav class="horizontal-menu compact">
                            <ul>
                                <li>
                                    <a class="" href=""><i class="icon-dashboard fg-blue"></i>&nbsp;Number of Employee Join vs Leave Per Year</a>
                                </li>                       
                            </ul>
                        </nav>
                    </div>
                   
                </div>
                <div id="daily_chart" style="width:100%; margin-bottom:10px">
                    <canvas style="width: 307px; height: 161px;" id="numberof_employee" height="161" width="307"></canvas>

                    <script>

                        today_data = {
                            labels: ['00:00', '03:00', '06:00', '09:00', '12:00', '15:00', '18:00', '21:00'],
                            datasets: [
                                {
                                    label: 'Sales',
                                    fillColor: 'rgba(100,180,100,0.1)',
                                    strokeColor: 'rgba(100,180,100,1)',
                                    pointColor: 'rgba(100,180,100,1)',
                                    pointStrokeColor: '#fff',
                                    pointHighlightFill: '#fff',
                                    pointHighlightStroke: 'rgba(100,180,100,1)',
                                    data: [120, 30, 10, 90, 100, 30, 190, 0]
                                },
                                {
                                    label: 'Purchases',
                                    fillColor: 'rgba(100,100,180,0.1)',
                                    strokeColor: 'rgba(100,100,180,1)',
                                    pointColor: 'rgba(100,100,180,1)',
                                    pointStrokeColor: '#fff',
                                    pointHighlightFill: '#fff',
                                    pointHighlightStroke: 'rgba(100,100,180,1)',
                                    data: [0, 70, 100, 90, 30, 10, 20, 120]
                                }
                            ]
                        }

                        employee_context = document.getElementById('numberof_employee').getContext('2d');
                        employee_chart = new Chart(employee_context).Line(today_data, {responsive: true});

                    </script>
                </div>
            </div>
            <div class="span3">

                <div class="">
                    <div class="bg-white shadow" style="width: 100%;" >
                        <nav class="horizontal-menu compact">
                            <ul>
                                <li>
                                    <a class="" href=""><i class="icon-dashboard fg-blue"></i>&nbsp;No of Employee By Departments</a>
                                </li>                       
                            </ul>
                        </nav>
                    </div>
                   
                    <div style="width: 100%">
                        <canvas id="canvas" height="300" width="300"></canvas>
                        <script>
                            barChartData = {
                                labels: [<?php echo $username_string; ?>],
                                datasets: [
                                    {
                                        fillColor: "rgba(151,187,205,0.5)",
                                        strokeColor: "rgba(151,187,205,0.8)",
                                        highlightFill: "rgba(151,187,205,0.75)",
                                        highlightStroke: "rgba(151,187,205,1)",
                                        data: [<?php echo $number_arrayshow; ?>]
                                    }
                                ]

                            }
                            var ctx = document.getElementById("canvas").getContext("2d");
                            window.myBar = new Chart(ctx).Bar(barChartData, {
                                responsive: true
                            });


                        </script>
                    </div>
                </div>
                              <div class="">
                    <div class="bg-white shadow" style="width: 100%;" >
                        <nav class="horizontal-menu compact">
                            <ul>
                                <li>
                                    <a class="" href=""><i class="icon-dashboard fg-blue"></i>&nbsp;Today so far </a>
                                </li>                       
                            </ul>
                        </nav>
                    </div>
                    <div style="width:100%" class="bg-white">
                        <canvas style="width: 313px; height: 313px;" id="cash_distribution_canvas" width="313" height="313"></canvas>
                    </div>
                    <script>

                        cash_distribution_data = [
                            {
                                value: 3928000.00,
                                color: "#008040",
                                highlight: "#008040",
                                label: "CRDB"
                            }
                            ,
                            {
                                value: 2156050.00,
                                color: "#000000",
                                highlight: "#000000",
                                label: "Cash"
                            }
                            ,
                            {
                                value: 1417000.00,
                                color: "#ffff00",
                                highlight: "#ffff00",
                                label: "Tigopesa"
                            }
                            ,
                            {
                                value: 1373500.00,
                                color: "#ff0000",
                                highlight: "#ff0000",
                                label: "Airtel money"
                            }
                            ,
                            {
                                value: 580000.00,
                                color: "#80ff00",
                                highlight: "#80ff00",
                                label: "Vodacom Mpesa"
                            }
                        ];

                        var cash_distribution_context = document.getElementById("cash_distribution_canvas").getContext("2d");
                        cash_distribution_chart = new Chart(cash_distribution_context).Pie(cash_distribution_data, {responsive: true, animationSteps: 240});

                    </script>
                </div>
               

        </div>
    </div>
</div>
    
    
    
    

<!--/////////////////////////ACTION SETTING/////////////////////////////////////////-->
<!-- Modal department -->
<div id="department" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Manage Departments</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                     <div id="notifing">
                        
                    </div>
                        
                        <form id="departmentadd"  method="post">
                            <div class="form-group">
                                <label for="education">Add Department:</label>
                                <input type="text" class="form-control" id="" name="department">
                            </div>
                            <input type="submit"  value="Submit Department" class="button primary"/>    
                            
                        
                        <div id="departmentsms">
                           
                        </div>
                                                <div class="">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">Department ID</th>  
                                        <th class="text-left">Department Name</th>                                      
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    
                                    $select_asset = mysql_query("SELECT * FROM tbl_department") or die(mysql_error());
                                    $i=0;
                                    while ($roww = mysql_fetch_array($select_asset)) {
                                        $i++;
                                        $department_id= $roww['department_id'];
                                        $deparment= $roww['department_name'];
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="selecting" value="<?php echo $department_id; ?>" onchange="showaction(this.value)"></td>
                                            <td class="right"><?php echo $i; ?></td>
                                            <td class="right"><?php echo $deparment; ?></td>                                           
                                        </tr> 
                                        <?php
                                    }
                                    ?>
                                </tbody>

                                <tfoot></tfoot>
                            </table>
                        </div>
                            </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!---------------------////////////////////////////model designation----------------------------------->
<div id="designation" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Manage Designation/Title</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                       <div id="designationsms">
                           
                        </div>
                        
                        <form id="designationform"  method="post">
                            <div class="form-group">
                                <label for="education">Add Title/Designation:</label>
                                <input type="text" class="form-control" id="" name="designation">
                            </div>
                            <input type="submit"  value="Submit Designation" class="button primary"/>    
                                                <div class="">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">Title ID</th>  
                                        <th class="text-left">Title Name</th>                                      
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    
                                    $select_asset = mysql_query("SELECT * FROM tbl_title ORDER BY title_code DESC") or die(mysql_error());
                                    $i=0;
                                    while ($roww = mysql_fetch_array($select_asset)) {
                                        $i++;
                                        $title_code= $roww['title_code'];
                                        $title_name= $roww['title_name'];
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="selecting" value="<?php echo $title_code; ?>" onchange="showaction(this.value)"></td>
                                            <td class="right"><?php echo $i; ?></td>
                                            <td class="right"><?php echo $title_name; ?></td>                                           
                                        </tr> 
                                        <?php
                                    }
                                    ?>
                                </tbody>

                                <tfoot></tfoot>
                            </table>
                        </div>
                            </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>


<!--//////////////////////////////////////////////POSITION////////////////////////////////////////////////////////////-->
<!---------------------////////////////////////////model position----------------------------------->
<div id="position" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Manage Position</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                     <div id="positionsms">
                        
                    </div>
                        
                        <form id="positionform"  method="post">
                            <div class="form-group">
                                <label for="education">Add Position:</label>
                                <input type="text" class="form-control" id="" name="position">
                            </div>
                            <input type="submit"  value="Submit Position" class="button primary"/>    
                            
                        
                        <div id="departmentsms">
                           
                        </div>
                                                <div class="">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">ID</th>  
                                        <th class="text-left">Position</th>                                      
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    
                                    $select_asset = mysql_query("SELECT * FROM tbl_position") or die(mysql_error());
                                    $i=0;
                                    while ($roww = mysql_fetch_array($select_asset)) {
                                        $i++;
                                        $position_id= $roww['position_id'];
                                        $position_name= $roww['position_name'];
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="selecting" value="<?php echo $position_id; ?>" onchange="showaction(this.value)"></td>
                                            <td class="right"><?php echo $i; ?></td>
                                            <td class="right"><?php echo $position_name; ?></td>                                           
                                        </tr> 
                                        <?php
                                    }
                                    ?>
                                </tbody>

                                <tfoot></tfoot>
                            </table>
                        </div>
                            </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>

<!--------------------------------------------modal set time attendence-------------------------------------------------------------->
<div id="attendence" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Manage time in/out</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                     <div id="attendancesms">
                        
                    </div>
                        
                        <form id="attendenceform"  method="post">
                            <?php
                             $select_asset = mysql_query("SELECT * FROM tbl_timeattendence") or die(mysql_error());
                                 $roww = mysql_fetch_array($select_asset);                                       
                                        $time_in= $roww['time_in'];
                                        $time_out= $roww['time_out'];
                                        $time_id=$roww['time_id'];
                            ?>
                            <input type="hidden" class="form-control" id="" value="<?php echo $time_id;?>" name="timeid">
                            <div class="form-group">
                                <label for="education">Time in:</label>
                                <input type="text" class="form-control"  value="<?php echo $time_in;?>" name="timein">
                            </div>
                            <div class="form-group">
                                <label for="education">Time out:</label>
                                <input type="text" class="form-control"  value="<?php echo $time_out;?>" name="timeout">
                            </div>
                            <input type="submit"  value="Update Time" class="button primary"/>    
                            </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!-------------------------------------------no of days------------------------->
<div id="dayss" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Set Total Number Of Days for Leave</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                     <div id="leavedaysms">
                           
                        </div>
                        
                        <form id="leavedays"  method="post">
                              <?php
                                    
                                    $select_asset = mysql_query("SELECT * FROM tbl_leave_days") or die(mysql_error());
                                      $roww = mysql_fetch_array($select_asset);                                      
                                        $no_days= $roww['no_days'];
                                        $days_id=$roww['days_id'];
                                        
                                        ?>
                            <div class="form-group">
                                <input type="hidden" name="days_id" value="<?php echo $days_id;?>">
                                <label for="education">Update No. Days:</label>
                                <input type="text" class="form-control" value="<?php echo $no_days;?>" name="days">
                            </div>
                            <input type="submit"  value="Update" value="" class="button primary"/>    
                            
                        
                       
                            </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>

<!--///////////////////////////////////////leave category////////////////////////////////////////////-->
<!-------------------------------------------------------------------->
<div id="leave_cat" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Leave Category</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                     <div id="leavesms">
                        
                    </div>
                        
                                               <form id="leavecatform"  method="post">
                            <div class="form-group">
                                <label for="education">Add Leave Category:</label>
                                <input type="text" class="form-control" id="" name="category">
                            </div>
                            <input type="submit"  value="Submit Category" class="button primary"/>    
                                                <div class="">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">ID</th>  
                                        <th class="text-left">Leave Category</th>                                      
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    
                                    $select_asset = mysql_query("SELECT * FROM tbl_leave_type") or die(mysql_error());
                                    $i=0;
                                    while ($roww = mysql_fetch_array($select_asset)) {
                                        $i++;
                                        $leave_type_id= $roww['leave_type_id'];
                                        $leave_type= $roww['leave_type'];
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="selecting" value="<?php echo $leave_type_id; ?>" onchange="showaction(this.value)"></td>
                                            <td class="right"><?php echo $i; ?></td>
                                            <td class="right"><?php echo $leave_type; ?></td>                                           
                                        </tr> 
                                        <?php
                                    }
                                    ?>
                                </tbody>

                                <tfoot></tfoot>
                            </table>
                        </div>
                            </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!-----------------------------------Benefit Category--------------------------------->
<div id="Benefit_cat" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Benefit Category</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                     <div id="benefitsms">
                        
                    </div>
                        
                                               <form id="benefitform"  method="post">
                            <div class="form-group">
                                <label for="education">Add Benefit Category:</label>
                                <input type="text" class="form-control" id="" name="benefit">
                            </div>
                            <input type="submit"  value="Submit Category" class="button primary"/>    

                                                <div class="">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">ID</th>  
                                        <th class="text-left">Benefit Category</th>                                      
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    
                                    $select_asset = mysql_query("SELECT * FROM tbl_benefits_category") or die(mysql_error());
                                    $i=0;
                                    while ($roww = mysql_fetch_array($select_asset)) {
                                        $i++;
                                        $benefit_id= $roww['benefit_id'];
                                        $benefit_name= $roww['benefit_name'];
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="selecting" value="<?php echo $benefit_id; ?>" onchange="showaction(this.value)"></td>
                                            <td class="right"><?php echo $i; ?></td>
                                            <td class="right"><?php echo $benefit_name; ?></td>                                           
                                        </tr> 
                                        <?php
                                    }
                                    ?>
                                </tbody>

                                <tfoot></tfoot>
                            </table>
                        </div>
                            </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!-----------------------------------Tax Category--------------------------------->
<div id="Tax_cat" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Tax Category</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                     <div id="taxsms">
                        
                    </div>
                        
                                               <form id="taxform"  method="post">
                            <div class="form-group">
                                <label for="education">Add Tax Category:</label>
                                <input type="text" class="form-control" id="" name="tax">
                            </div>
                            <input type="submit"  value="Submit Category" class="button primary"/>    
                                                <div class="">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">ID</th>  
                                        <th class="text-left">Tax Category</th>                                      
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    
                                    $select_asset = mysql_query("SELECT * FROM tbl_tax_category") or die(mysql_error());
                                    $i=0;
                                    while ($roww = mysql_fetch_array($select_asset)) {
                                        $i++;
                                        $tax_cat_id= $roww['tax_cat_id'];
                                        $taxt_type= $roww['taxt_type'];
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="selecting" value="<?php echo $tax_cat_id; ?>" onchange="showaction(this.value)"></td>
                                            <td class="right"><?php echo $i; ?></td>
                                            <td class="right"><?php echo $taxt_type; ?></td>                                           
                                        </tr> 
                                        <?php
                                    }
                                    ?>
                                </tbody>

                                <tfoot></tfoot>
                            </table>
                        </div>
                            </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>
<!-----------------------------------Attachment Category--------------------------------->
<div id="attach_cat" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: transparent">
            <!-------------------create window's---------------->
            <div class="window">
                <div class="caption">
                    <span class="icon icon-windows"></span> 
                    <div class="title">Attachments</div> 

                    <button class="btn-close close"  data-dismiss="modal"></button>
                </div>
                <div class="content">
                    <div class="margin10">
                     <div id="attachmentsms">
                        
                    </div>
                        
                                               <form id="attachmentform"  method="post">
                            <div class="form-group">
                                <label for="education">Add New Attachment Name:</label>
                                <input type="text" class="form-control" id="" name="attachment">
                            </div>
                            <input type="submit"  value="Submit Category" class="button primary"/>    
                                                <div class="">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left"></th>
                                        <th class="text-left">ID</th>  
                                        <th class="text-left">Attachment Name</th>                                      
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    
                                    $select_asset = mysql_query("SELECT * FROM tbl_attachment_kind") or die(mysql_error());
                                    $i=0;
                                    while ($roww = mysql_fetch_array($select_asset)) {
                                        $i++;
                                        $kind_id= $roww['kind_id'];
                                        $category_name= $roww['category_name'];
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="selecting" value="<?php echo $kind_id;?>" onchange="showaction(this.value)"></td>
                                            <td class="right"><?php echo $i; ?></td>
                                            <td class="right"><?php echo $category_name; ?></td>                                           
                                        </tr> 
                                        <?php
                                    }
                                    ?>
                                </tbody>

                                <tfoot></tfoot>
                            </table>
                        </div>
                            </form>
                    </div>
                </div>
            </div>
            <!---------------------end window------------------>
        </div>
    </div>
</div>

<!--/////////////////////////END ACTION SETTING/////////////////////////////////////////-->
