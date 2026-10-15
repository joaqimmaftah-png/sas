<head>
    
    <script>
                  
        function workorder(url) {
            $('#show_form_workorder').fadeOut(50, function () {
                $('#show_form_workorder').load(url);
                $('#show_form_workorder').fadeIn(50, function () {
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
<div class="" style="margin-top: 1%;">
                            <ol class="breadcrumb" style="border:0px solid rgb(200,200,200)"> 
<li class="active"> APPROVED TPF AND QUOTATIONS  &nbsp;<span class="icon-arrow-right-5"></span></li>

</ol>
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
                <th class="text-center">TPF No</th>
                <th class="text-center">JOB</th>
                <th class="text-center">TPF Date</th>
                <th class="text-center">Quotation No</th>                               
                <th class="text-center">Quotation Date</th>               
                <th class="text-center">TPF/QT Duration</th> 
                <th class="text-center">Status</th>


            </tr>
        </thead>

        <tbody>
            <?php
            include 'authorized/db.php';
            $a = mysql_query("SELECT * FROM  tbl_tpf_qt WHERE Quotation_No<>'Empty' AND aproved_status='Approved'  ORDER BY tpf_qt_id DESC")or die(mysql_error());
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
                 $approve_status = $b['aproved_status'];
                if ($approve_status == 'Approved') {
                    $notification = 'bg-yellow';
                } elseif ($approve_status == 'Waiting for closing reference#') {
                    $notification = '';
                } else {
                    $notification = '';
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
                                        <li>                                           
                                            <a href="#" onclick="workorder('authorized/tpf_process/store_closed_issue.php?qn_coding=<?php echo $Quotation_No;?>')" data-toggle="modal" data-target="#closing_tpf"><i class="icon-plus-2 fg-yellow"></i>&nbsp;Update</a>                                       
                                        </li>
                                        <li>                                           
                                            <a href="#"><i class="icon-cancel-2 fg-red"></i>&nbsp;Delete</a>                                       
                                        </li>
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
                    <td class=" text-center"><?php echo $status; ?></td>

                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<!--/////////////////////////////////manual/////////////////////////////////////////////-->
<div id="closing_tpf" class="modal fade" role="dialog" style="display:none;">
    <div class="modal-dialog ">
        <div class="modal-content" id="">
            <div id="show_form_workorder">
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






