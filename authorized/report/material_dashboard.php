<?php
require_once __DIR__ . '/../../mysql_compat.php';

if (isset($_POST['m'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $url = 'report/load_report_material.php?from=' . $from . '&to=' . $to;
} else {
    $url = "authorized/report/load_report_material.php";
}



if (isset($_POST['procurement'])) {
    $derivary_no = $_POST['derivary_no'];
    $derivary_date = $_POST['derivary_date'];
    $derivary = 'Closed';
    $item_id = $_POST['item_id'];
    $a = mysql_query("UPDATE  request_item_list SET delivery='$derivary',delivery_no='$derivary_no',delivery_date='$derivary_date' WHERE list_id='$item_id'") or die(mysql_error());

    if ($a) {
        $ref = $sincrorefn;
        $message = "Updated successful";
    }
}


if (isset($noc)) {

    $fixing_ref = $_POST['fixing_ref'];
    $fixing_date = $_POST['fixing_date'];
    $fixing_status = 'Closed';
    $item_id = $_POST['item_id'];
    $a = mysql_query("UPDATE  request_item_list SET fixing_status='$fixing_status',delivery_no='$fixing_ref',delivery_date='$fixing_date' WHERE list_id='$item_id'") or die(mysql_error());

    if ($a) {
        $ref = $sincrorefn;
        $message = "Updated successful";
    }
}
?>









<head>
    <script type="text/javascript">
        $(document).ready(function () {
//  var url = "authorized/car_track/load_vehicle_info.php";
            var url = "<?php echo $url; ?>";

            // prepare the data
            var source =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'link'},
                            {name: 'request_date'},
                            {name: 'item'},
                            {name: 'store_status'},
                            {name: 'hod_status'},
                            {name: 'ttnumber'},
                            {name: 'remarks'},
                            {name: 'client_status'},
                            {name: 'ref'},
                            {name: 'requester', type: 'string'},
                            {name: 'store_date'},
                            {name: 'approve_date'},
                            {name: 'delivery_no'},
                            {name: 'delivery_dt'},
                            {name: 'delivery_st'},
                            {name: 'specification'},
                            {name: 'quantity'},
                            {name: 'unit'}
                        ],
                        id: 'id',
                        url: url,
                        root: 'data'
                    };
            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#mj").jqxGrid(
                    {
                        width: '100%',
                        height: '1200',
                        source: dataAdapter,
                        sortable: true,
                        filterable: true,
                        filtermode: 'excel',
                        columnsresize: true,
                        autoshowfiltericon: false,
                        theme: '',
                        columns: [
                            {text: 'No', datafield: 'link', width: 70},
                            {text: 'Material/Spare Request', datafield: 'item', width: 200},
                            {text: 'Specification', datafield: 'specification', width: 100},
                            {text: 'Quantity', datafield: 'quantity', width: 100},
                            {text: 'Unit', datafield: 'unit', width: 100},
                            {text: 'Requester', datafield: 'requester', width: 100},
                            {text: 'Date', datafield: 'request_date', width: 100},
                            {text: 'Referrence', datafield: 'ref', width: 100},
                            {text: 'TT Number', datafield: 'ttnumber', width: 100},
                            {text: 'CLIENT APPROVE', datafield: 'client_status', width: 100},
                            {text: 'HOD APPROVE', datafield: 'hod_status', width: 100},
                            {text: 'DATE', datafield: 'approve_date', width: 100},
                            {text: 'ISSUE STATUS', datafield: 'store_status', width: 100},
                            {text: 'ISSUED DATE', datafield: 'store_date', width: 100},
                            {text: 'DELIVERY NO', datafield: 'delivery_no', width: 100},
                            {text: 'DELIVERY DATE', datafield: 'delivery_dt', width: 100},
                            {text: 'DELIVERY STATUS', datafield: 'delivery_st', width: 100},
                            {text: 'FIXING STATUS', datafield: 'alarm_date', width: 100},
                            {text: 'FIXING REF', datafield: 'alarm_time', width: 100},
                            {text: 'FIXING DATE', datafield: 'oos_date', width: 100}
                        ],
                    });

            $("#excelExport").jqxButton();
            $("#csvExport").jqxButton();
            $("#pdfExport").jqxButton();
            $("#excelExport").click(function () {
                $("#mj").jqxGrid('exportdata', 'xls', 'RCA_Excelsheet');
            });

            $("#csvExport").click(function () {
                $("#mj").jqxGrid('exportdata', 'csv', 'RCA_Excelsheet');
            });

            $("#pdfExport").click(function () {
                $("#mj").jqxGrid('exportdata', 'pdf', 'RCA_Excelsheet');
            });



        });
    </script>


</head>

<div class="row">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-database"></i>&nbsp;Home</a></li>
        <li class=""><a data-toggle="tab" href="#menu1"><i class="fa fa-bar-chart"></i>&nbsp;Dasboard2</a></li>
<!--                                    <li class=""><a data-toggle="tab" href="#menu2"><i class="fa fa-plus"></i>&nbsp;Category</a></li>-->

    </ul>
    <div class="col-lg-12">
        <div class="tab-content">          
            <div id="home" class="tab-pane fade in active" > 
                <div class="row" style="margin-top: 1%;">
<!--                    <form action="" method="POST" id="search_date">
                        <div class="col-lg-4">
                            <div class="input-group date ">
                                <input class="form-control" id="date1" name="from" placeholder="Request From Date dd-mm-yyyy" type="text" value="" >

                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                            <input type="hidden" id="dtp_input2" value="" />
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group date " >
                                <input class="form-control" id="date2" name="to" placeholder="Request To Date dd-mm-yyyy" type="text" value="" >

                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                            <input type="hidden" id="dtp_input2" value="" />
                        </div>
                        <div class="col-lg-1">

                            <button class="btn btn-default" type="submit" name="m" ><i class="glyphicon glyphicon-search"></i> Search</button>
                        </div> 
                        <div class="col-lg-3">

                        </div> 
                    </form>-->
                </div>
                <hr>
                <div class="row">

                    <div class="col-lg-12">
                <!--                     <button type="button" class="btn btn-default" id='excelExport' ><i class="glyphicon glyphicon-cloud-download"></i>Download Excel</button>-->

                        <div style='float: left;'>
                            <button type="button" class="btn btn-success" value="Export to Excel" id='excelExport'>Exportto excel</button>

                        </div>
                        <div style='margin-left: 10px; float: left;'>
                            <input type="button" value="Export to CSV" id='csvExport' />

                        </div>

                        <div style='margin-left: 10px; float: left;'>
                            <button type="button" value="Export to PDF" class="btn btn-success" id='pdfExport' >Export Pdf</button>
                        </div>

                    </div>
                    <hr>
                </div>

                <div class="row">
                    <div class="col-lg-12" id="mud">
                        <div id="mj" >
                        </div>

                    </div>
                </div>



            </div>
            <!--------------------------------End home data-->

        </div> 
    </div>



</div>

<!-- Modal -->
<div id="procure" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">PROCUREMENT UPDATES</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form  action="" method="POST">
                        <!--////////////////////////////////////////////////////////////////////////////////////////-->
                        <div class="col-lg-12">
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Item:</span></span>
                                <input name="item_id" id="a" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="hidden">
                                <input name="item" id="b" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text" disabled="">

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Delivery#:</span></span>
                                <input name="derivary_no" id="c" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">


                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Delivery Date:</span></span>
                                <input name="derivary_date" id="d" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">


                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" name="procurement" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            </div>
        </div>

    </div>
</div>





<!-- Modal -->
<div id="noc" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">NOC UPDATES</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form  action="" method="POST">
                        <!--////////////////////////////////////////////////////////////////////////////////////////-->
                        <div class="col-lg-12">
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Item:</span></span>
                                <input name="item_id" id="a" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="hidden">
                                <input name="item" id="b" class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text" disabled="">

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="input-group" style="width:100%; margin:2px 0">
                                <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">Reference:</span></span>
                                <input name="fixing_ref"   class="form-control editable" placeholder="" value="" aria-describedby="sizing-addon1" type="text">


                            </div>
                        </div>
                        <div class="col-lg-12">
                            
                                    <div class="input-group date " style="width:100%; margin:2px 0">
                                        <span class="input-group-addon" id="sizing-addon1" style="width:32%; text-align:right"><span class="text-right">fixing Date:</span></span>
                                
                    <input class="form-control" id="date1" name="from" placeholder="Request From Date dd-mm-yyyy" type="text" value="" >
               
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" />
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" name="noc" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            </div>
        </div>

    </div>
</div>