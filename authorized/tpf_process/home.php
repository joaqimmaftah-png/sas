<head>
    
    <script>
            function rejection(url) {
            $('#call_rejection').fadeOut(50, function () {
                $('#call_rejection').load(url);
                $('#call_rejection').fadeIn(50, function () {
                });
            });
        }
         function raise_tpf(url) {
            $('#shown').fadeOut(50, function () {
                $('#shown').load(url);
                $('#shown').fadeIn(50, function () {
                });
            });
        }
        
        function raise_qtn(url) {
            $('#shownqtn').fadeOut(50, function () {
                $('#shownqtn').load(url);
                $('#shownqtn').fadeIn(50, function () {
                });
            });
        }
        
         function aprove_qtn(url) {
            $('#email_notification').fadeOut(50, function () {
                $('#email_notification').load(url);
                $('#email_notification').fadeIn(50, function () {
                });
            });
        }
    </script>
</head>
<?php
include 'authorized/db.php';
$message = "";
$bb = mysql_query("SELECT * FROM  tbl_tpf_qt ORDER BY tpf_qt_id DESC")or die(mysql_error());
$cc=mysql_fetch_array($bb);
$num=$cc['tpf_no'];
$dd=  explode("-",$num);
$get_no=$dd[1];
$tpf_number=$get_no+1;
$tpf_code="TPF-00".$tpf_number;
$qn_code="QN-00".$tpf_number;

?>
<head>



</head>
<div class="bg-white shadow" style="width: 100%; margin-top: 1%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="#" onclick="raise_tpf('authorized/tpf_process/add_raised_tpf.php?tpf_code=<?php echo $tpf_code;?>')" data-toggle="modal" data-target="#manualissue"><i class="icon-pencil fg-red"></i>&nbsp;Raise TPF</a>
            </li> 
           
           

        </ul>
    </nav>
</div>
<div class="container">
    <?php
    echo $message;
    ?>
</div>
<div class="margin5">    
    <table id="example" class="display bordered" style="font-size: 12px;" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th></th>
<th class="text-center">Job</th>
                <th class="text-center">TPF No</th>
             
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
            include 'authorized/db.php';
            $a = mysql_query("SELECT * FROM  tbl_tpf_qt  ORDER BY tpf_qt_id DESC")or die(mysql_error());
            while ($b = mysql_fetch_array($a)) {
                $tpf_no = $b['tpf_no'];
               $qtn_attachment = $b['qtn_attachment'];
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
                $approve_status=$b['aproved_status'];
                 if($approve_status=='Approved'){
                     $notification='bg-yellow';
                 }  elseif ($approve_status=='Closed') {
                     $notification='';
                 }else{
                      $notification='';
                 }
                 
                 

                ?>
                <tr class="<?php echo $notification; ?>">
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
                                        <li><a href=""><i class="icon-enter fg-blue"></i>&nbsp;Reject</a></li>
                                        <?php
                                        }
                                        ?>
                                        <li><a href=""><i class="icon-loop fg-green"></i>&nbsp;Update</a></li>
                                        <li><a href="?action=delete_tpf&tpf_name=<?php echo $tpf_no;?>"><i class="icon-cancel-2 fg-red"></i>&nbsp;Delete</a></li>

                                    </ul>
                                </li>          
                            </ul>
                        </nav>
                    </td>
                     <td class="text-center"><?php echo $tpf_name; ?></td>
                    <td class=" text-center"><?php echo $tpf_no; ?></td>                      
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
</div>

<!--/////////////////////////////////manual/////////////////////////////////////////////-->
<div id="manualissue" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog ">
        <div class="modal-content" id="">
            <div id="shown">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Downloading...</h4>
</div>
<div class="modal-body">
<div style="height:30px">
    <div id="progress" class="progress">
<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
    </div>
    
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class=" icon-cancel-2" aria-hidden="true"></span> Cancel</button>
</div>
            </div>
        </div>
    </div>
</div>
<!--model linces-->

<!--/////////////////////////////////manual/////////////////////////////////////////////-->
<div id="Qtn" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" id="">
            <div id="shownqtn">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Downloading...</h4>
</div>
<div class="modal-body">
<div style="height:30px"><div id="progress" class="progress">
<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
</div></div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class=" icon-cancel-2" aria-hidden="true"></span> Cancel</button>
</div>
            </div>
        </div>
    </div>
</div>
<!--model linces-->


<!--/////////////////////////////////manual/////////////////////////////////////////////-->
<div id="approve" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content" id="">
            <div id="email_notification">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Downloading...</h4>
</div>
<div class="modal-body">
<div style="height:30px"><div id="progress" class="progress">
<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
</div></div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"><span class=" icon-cancel-2" aria-hidden="true"></span> Cancel</button>
</div>
            </div>
        </div>
    </div>
</div>
<!--model linces-->


