<!--<head>
    <title id='Description'>jqxChart Pie Series Example</title>
    <link rel="stylesheet" href="jxquery/jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="jxquery/scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxchart.core.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // prepare chart data as an array
            var source =
            {
                datatype: "csv",
                datafields: [
                    { name: 'Browser' },
                    { name: 'Share' }
                ],
                url: 'changanya.php'
            };

            var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                title: "Desktop browsers share",
                description: "(source: wikipedia.org)",
                enableAnimations: true,
                showLegend: false,
                showBorderLine: true,
                legendPosition: { left: 520, top: 140, width: 100, height: 100 },
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
                source: dataAdapter,
                colorScheme: 'scheme02',
                seriesGroups:
                    [
                        {
                            type: 'pie',
                            showLabels: true,
                            series:
                                [
                                    { 
                                        dataField: 'Share',
                                        displayText: 'Browser',
                                        labelRadius: 120,
                                        initialAngle: 15,
                                        radius: 170,
                                        centerOffset: 0,
                                        formatSettings: { sufix: '%', decimalPlaces: 1 }
                                    }
                                ]
                        }
                    ]
            };

            // setup the chart
            $('#chartContainer').jqxChart(settings);
        });
    </script>
</head>
<body class='default'>
	<div id='chartContainer' style="width: 850px; height: 500px;">
	</div>
</body>
</html>-->

<?php
$file = fopen("desktop_browsers_share_dec2011.txt","w");
include_once 'authorized/db.php';
$select=  mysql_query("SELECT DISTINCT part_common_name FROM tbl_store_report") or die(mysql_error()); 
while ($row = mysql_fetch_array($select)) {
    $jina=$row['part_common_name'];
    $a=mysql_query("SELECT SUM(new_quantity),part_common_name FROM tbl_store_report WHERE part_common_name='$jina' ORDER BY storee_id LIMIT 10") or die(mysql_error());
    $result = mysql_query('SELECT SUM(new_quantity) AS value_sum FROM tbl_store_report'); 
$row = mysql_fetch_assoc($result); 
$sum = $row['value_sum'];
$h=mysql_fetch_array($a,MYSQLI_ASSOC);
$g=$h['part_common_name'];
$f=$h['SUM(new_quantity)'];
$p=round(($f/$sum)*100,1);
$weka=$g.','.$p.PHP_EOL;
fwrite($file,$weka);

}
fclose($file);
?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
    <title id='Description'>jqxChart Pie Series Legend Example</title>
    <link rel="stylesheet" href="jxquery/jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="jxquery/scripts/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxchart.core.js"></script>
    <script type="text/javascript" src="jxquery/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // prepare chart data as an array
            var source =
            {
                datatype: "csv",
                datafields: [
                    { name: 'Browser' },
                    { name: 'Share' }
                ],
                url: 'desktop_browsers_share_dec2011.txt'
            };

            var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            // prepare jqxChart settings
            var settings = {
                title: "SPARE PART REPORT",
                description: "(source: sincrositewatch Ltd)",
                enableAnimations: true,
                showLegend: true,
                showBorderLine: true,
                legendLayout: { left: 700, top: 160, width: 350, height: 200, flow: 'vertical' },
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
                source: dataAdapter,
                colorScheme: 'scheme03',
                seriesGroups:
                    [
                        {
                            type: 'pie',
                            showLabels: true,
                            series:
                                [
                                    { 
                                        dataField: 'Share',
                                        displayText: 'Browser',
                                        labelRadius: 170,
                                        initialAngle: 15,
                                        radius: 145,
                                        centerOffset: 0,
                                        formatFunction: function (value) {
                                            if (isNaN(value))
                                                return value;
                                            return parseFloat(value) + '%';
                                        },
                                    }
                                ]
                        }
                    ]
            };

            // setup the chart
            $('#chartContainer').jqxChart(settings);
        });
    </script>
</head>
<body class='default'>
	<div id='chartContainer' style="width: 900px; height: 500px;">
	</div>
</body>
</html>
