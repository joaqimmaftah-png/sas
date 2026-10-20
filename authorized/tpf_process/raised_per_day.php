<head>
           <script>
            $(document).ready(function () {
                $('#example').dataTable();
            });
            $(document).ready(function () {
                $('#example3').dataTable({
                    "scrollY": "200px",
                    "scrollCollapse": true,
                    "paging": false
                });
            });

        </script>
</head>  
    <div class="grid">
    <div class="row margin5">
        <div class="span6">
            <ol class="breadcrumb" style="border:0px solid rgb(200,200,200)">                                
                <li class="active"> WEEK REPORT SUMMARY &nbsp;<span class="icon-arrow-right-5"></span></li>
            </ol>

                         <div id="demo_reporting"><div style="width:100%">
<h3 class="panel-title">
<strong style="color:rgb(100,100,180)">TPF Raised/Day</strong> vs <strong style="color:rgb(100,180,100)">QT Raised/Day</strong> vs <strong style="color:rgb(180,100,100)">Work order approved/Day</strong>
</h3>
<canvas style="width: 653px; height: 244px;" id="demo_weekly_canvas" height="244" width="653"></canvas>
</div>

<script>
var rand = function(fact){ return Math.round(Math.random()*fact*100 + fact*100)};
demo_weekly_chart_data = {
	labels : ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
	datasets : [
		{
			label: 'Purchases',
			fillColor : 'rgba(100,100,180,0.1)',
			strokeColor : 'rgba(100,100,180,1)',
			pointColor : 'rgba(100,100,180,1)',
			pointStrokeColor : '#fff',
			pointHighlightFill : '#fff',
			pointHighlightStroke : 'rgba(100,100,180,1)',
			data : [rand(2), rand(4), rand(6), rand(8), rand(10), rand(12), rand(14)]
		},
		
		{
			label: 'Sales',
			fillColor : 'rgba(100,180,100,0.1)',
			strokeColor : 'rgba(100,180,100,1)',
			pointColor : 'rgba(100,180,100,1)',
			pointStrokeColor : '#fff',
			pointHighlightFill : '#fff',
			pointHighlightStroke : 'rgba(100,180,100,1)',
			data : [rand(4), rand(8), rand(12), rand(16), rand(20), rand(24), rand(28)]
		},
		
		{
			label: 'Expenses',
			fillColor : 'rgba(180,100,100,0.1)',
			strokeColor : 'rgba(180,100,100,1)',
			pointColor : 'rgba(180,100,100,1)',
			pointStrokeColor : '#fff',
			pointHighlightFill : '#fff',
			pointHighlightStroke : 'rgba(180,100,100,1)',
			data : [rand(1), rand(2), rand(2), rand(2), rand(3), rand(4), rand(5)]
		}
	]
}

demo_weekly_context = document.getElementById('demo_weekly_canvas').getContext('2d');
demo_weekly_chart = new Chart(demo_weekly_context).Line(demo_weekly_chart_data, { responsive: true, animationSteps: 120, datasetStrokeWidth: 3});

</script>
</div>

        </div>
        <div class="span6">
            <ol class="breadcrumb" style="border:0px solid rgb(200,200,200)">                                
                <li class="active"> WEEK REPORT SUMMARY &nbsp;<span class="icon-arrow-right-5"></span></li>
            </ol>
 <div class="progress">
  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40"
  aria-valuemin="0" aria-valuemax="100" style="width:40%">
    40% Complete (success)
  </div>
</div>

<div class="progress">
  <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="50"
  aria-valuemin="0" aria-valuemax="100" style="width:50%">
    50% Complete (info)
  </div>
</div>

<div class="progress">
  <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="60"
  aria-valuemin="0" aria-valuemax="100" style="width:60%">
    60% Complete (warning)
  </div>
</div>

<div class="progress">
  <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="70"
  aria-valuemin="0" aria-valuemax="100" style="width:70%">
    70% Complete (danger)
  </div>
</div>

        </div> 
    </div>
    </div>

<!--//////////////////////////////////////-->


<table id="example" class="display bordered" style="font-size: 12px;" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th></th>
                <th class="text-center">TPF No</th>
             <th class="text-center">Job</th>
                <th class="text-center">TPF Date</th>
                <th class="text-center">Quotation No</th>                               
                <th class="text-center">Quotation Date</th>                 
                <th class="text-center">TPF/QT Duration</th> 
                <th class="text-center">Work Order</th> 
                <th class="text-center">Work Order Date</th>
                <th class="text-center">WO/QT Duration</th>
                <th class="text-center">Status</th>


            </tr>
        </thead>

        <tbody>
            <?php
require_once __DIR__ . '/../../mysql_compat.php';

            include '../db.php';
            $a = mysql_query("SELECT * FROM  tbl_tpf_qt")or die(mysql_error());
            while ($b = mysql_fetch_array($a)) {
                $tpf_no = $b['tpf_no'];
               
                $tpf_date= $b['tpf_date'];
                $tpf_name = $b['tpf_name'];
                $tpf_attachment = $b['tpf_attachment'];
                $Quotation_No = $b['Quotation_No'];
                 $Quotation_Date = $b['Quotation_Date'];
                 $TPF_QT_Durations = $b['TPF_QT_Durations'];
                 $Work_Order = $b['Work_Order'];
                 $workorder_date = $b['workorder_date'];
                 $wp_tpf_duration=$b['wp_tpf_duration'];
                 $status = $b['status'];
                 $qtn_attachment=$b['qtn_attachment'];
                 
                 

                ?>
                <tr>
                    <td class="text-center">
                        <nav class="vertical-menu compact">
                            <ul>
                                <li>
                                    <a class="dropdown-toggle" href="#"></a>
                                    <ul class="dropdown-menu" data-role="dropdown">
                                        <li><a href="<?php echo $tpf_attachment;?>" ><i class="icon-attachment"></i>&nbsp;TPF Attachment</a></li>
                                        <li><a class="" href="#" onclick="raise_qtn('authorized/tpf_process/add_qtn_tpf.php?qn_codee=<?php echo $tpf_no;?>')" data-toggle="modal" data-target="#Qtn"><i class="icon-arrow-up-right fg-green"></i>&nbsp;Raise Quotation</a></li>
                                        <?php
                                            if(empty($qtn_attachment)){
                                                
                                            }  else {     
                                            ?>
                                        <li>                                           
                                            <a href="<?php echo $qtn_attachment;?>"><i class="icon-attachment fg-yellow"></i>&nbsp;Quotation Attachment</a>                                       
                                        </li>
                                        <li><a href="#" onclick="aprove_qtn('authorized/tpf_process/approve.php?qn_coding=<?php echo $Quotation_No;?>')" data-toggle="modal" data-target="#approve" ><i class="icon-thumbs-up fg-green"></i>&nbsp;Approval Status</a></li>
                                        <li><a href=""><i class="icon-enter fg-blue"></i>&nbsp;Work Order</a></li>
                                        <?php
                                        }
                                        ?>
                                        <li><a href=""><i class="icon-loop fg-green"></i>&nbsp;Update</a></li>
                                        <li><a href=""><i class="icon-cancel-2 fg-red"></i>&nbsp;Delete</a></li>

                                    </ul>
                                </li>          
                            </ul>
                        </nav>
                    </td>
                    <td class=" text-center"><?php echo $tpf_no; ?></td>  
                    <td class=" text-center"><?php echo $tpf_name; ?></td>
                    <td class=" text-center"><?php echo $tpf_date; ?></td>
                    <td class=" text-center"><?php echo $Quotation_No; ?></td>
                    <td class=" text-center"><?php echo $Quotation_Date; ?></td>  
                    <td class=" text-center"><?php echo $TPF_QT_Durations; ?></td> 
                    <td class=" text-center"><?php echo $Work_Order; ?></td>
                    <td class=" text-center"><?php echo $workorder_date; ?></td>
                    <td class=" text-center"><?php echo $wp_tpf_duration; ?></td>
                    <td class=" text-center"><?php echo $status; ?></td>

                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
