
<head>
    
        <?php
require_once __DIR__ . '/../../mysql_compat.php';

        
$selet=  mysql_query("SELECT * FROM tbl_asset_category") or die(mysql_error());
$re=mysql_num_rows($selet);


while ($ree=mysql_fetch_array($selet)){
           $rdi=$ree['cat_id'];
           $catt=mysql_query("SELECT * FROM tbl_asset_category WHERE cat_id='$rdi'") or die(mysql_error());
           $ng=mysql_fetch_array($catt);
           $category=$ng['category_name'];
           $cid=$ng['cat_id'];
           $selet2=  mysql_query("SELECT * FROM tbl_fixed_asset WHERE cat='$cid'") or die(mysql_error());
           $number=  mysql_num_rows($selet2);
                $logs[]='{"y":'.$number.',"indexLabel":"'.$category.'"}'; 
                

}
  
$too = implode(",", $logs);   

        
            
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
//  var url = "authorized/car_track/load_vehicle_info.php";
            var url = "authorized/report/load_asset.php";
              var rowsToColor = [];
            // prepare the data
            var source =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'Action'},
                            {name: 'asset_name'},
                            {name: 'asset_cat'},
                            {name: 'description'},
                            {name: 'model'},
                            {name: 'serial_number'},
                            {name: 'purchase_price'},
                            {name: 'purchase'},
                            {name: 'status'}
                                                    
                        ],
                        id: 'id',
                        url: url,
                        root: 'data' 
                    };
            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#jqxgrid").jqxGrid(
                    {
                        width: '100%',
                        height: 551,
                        source: dataAdapter,
                        sortable: true,
                        filterable: true,
                        filtermode: 'excel',
                        columnsresize: true,
                        autoshowfiltericon: false,
                        theme: '',
               
                        columns: [                                                       
                            {text: 'ID', datafield: 'Action', width: '3%'},
                            {text: 'ASSET NAME', datafield: 'asset_name', width: '10%'},
                            {text: 'ASSET CATEGORY', datafield: 'asset_cat', width: '15%'},
                            {text: 'DESCRIPTION', datafield: 'description', width: '15%'},
                            {text: 'MODEL', datafield: 'model', width: '10%'},
                            {text: 'SERIAL NUMBER', datafield: 'serial_number', width: '10%'},
                            {text: 'PURCHASE PRICE(Tsh)', datafield: 'purchase_price', width: '10%'},
                            {text: 'PURCHASE DATE', datafield: 'purchase', width: '15%'},
                            {text: 'STATUS', datafield: 'status', width: '15%'}
                            
                           
                        ],
                        
                    });  
                    
                     $("#excelExport").jqxButton();
            $("#csvExport").jqxButton();
            $("#pdfExport").jqxButton();
            $("#excelExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'xls', 'Asset Tracker');
            });

            $("#csvExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'csv', 'Asset Tracker');
            });

            $("#pdfExport").click(function () {
                $("#jqxgrid").jqxGrid('exportdata', 'pdf', 'Asset Tracker');
            });
                    
                    
                    
        });
        
        
        
    </script>

</head>
<div class="row">
    <div class="col-lg-12 col-xs-12">

        <div class="bg-white shadow collapse navbar-collapse " id="myNavbar"  style=" margin: 5px 0px 5px 0px;" >

            <nav class="horizontal-menu compact">
                <ul>
                    
                    <li >
                        <a class="" style="" href="#" >Home</a>
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
<div class="row">
    	<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{
		theme: "theme2",
		title:{
			text: "ASSET TRACKER 2017"
		},
		data: [
		{
			type: "pie",
			showInLegend: true,
			toolTipContent: "{y} - #percent %",
			yValueFormatString: "",
			legendText: "{indexLabel}",
			dataPoints: [<?php echo $too;?>]
		}
		]
	});
	chart.render();
}
	</script>
</div>


<div class="row">
    <div class="col-lg-12">
        <div id="chartContainer" style="height: 400px; width: 100%;"></div>
    </div>
</div>
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
<div class="row" >
    <div class="col-lg-12">
        <div id="jqxgrid" >
        </div>
    </div>
</div>



