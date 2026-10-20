<?php
require_once __DIR__ . '/../../mysql_compat.php';

    $gtu=mysql_query("SELECT DISTINCT(tech_name) FROM tbl_site_db") or die(mysql_error());
            while ($ab = mysql_fetch_array($gtu)) {
                $tech_name=$ab['tech_name'];
                
//                $gtuu=mysql_query("SELECT * FROM tbl_site_db where site_id='$site_id'") or die(mysql_error());
//                $abc = mysql_fetch_array($gtuu);
//                $site_id=$abc['site_id'];
//                              
                $b=  mysql_query("SELECT b.site_id,a.site_id,b.tech_name FROM tbl_rca a,tbl_site_db b WHERE b.site_id=a.site_id AND b.tech_name='$tech_name'") or die(mysql_error());
                $va=  mysql_num_rows($b);
                $bz=  mysql_query("SELECT * FROM tbl_rca") or die(mysql_error());
                $vz=  mysql_num_rows($bz);
                $perct=($va/$vz)*100;
                
                

//                $emplid=$ab['Responsible'];
                $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$tech_name' ")or die(mysql_error());
    $majina = mysql_fetch_array($jina);
    $firstname = $majina['first_name'];
    $sirname = $majina['surname'];
    $fullname = $firstname . " " . $sirname;
   
                 $logs[]='{"Browser":"'.$fullname.'","Share":'.$perct.'}';
            }
            $too = implode(",", $logs);
         //////////////////////////////////GRAPH NUMBER 2///////////////////////////////////////// 
            $rf=mysql_query("SELECT DISTINCT(site_id) FROM tbl_rca") or die(mysql_error());
            $j=1;
            $rff=mysql_query("SELECT * FROM tbl_rca") or die(mysql_error());
                $vatt=  mysql_num_rows($rff);
            while ($gf = mysql_fetch_array($rf)) {
                $site_id=$gf['site_id'];               
                $bx=  mysql_query("SELECT * FROM tbl_rca WHERE site_id='$site_id'") or die(mysql_error());
                $vat=  mysql_num_rows($bx);
                
                
                $gtg=mysql_query("SELECT * FROM tbl_site_db where site_id='$site_id'") or die(mysql_error());
                $vn = mysql_fetch_array($gtg);
                $site_name=$vn['site_name'];
                $logs2[]='{"id":"'.$j++.'","name":"'.$site_name.'","callout":'.$vat.'}';

            }
            $tto = implode(",", $logs2);
?>
<head>
       <script type="text/javascript">
        $(document).ready(function () {
            // prepare chart data as an array
                   var data = [<?php echo $too;?>];

            // prepare chart data as an array
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'Browser' },
                    { name: 'Share' }
                ],
                localdata: data
            };

            var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });

            
            // prepare jqxChart settings
            var settings = {
                title: "TOP CONTRIBUTOR",
                description: "(source: sincro automation system)",
                enableAnimations: true,
                showLegend: true,
                showBorderLine: true,
                legendLayout: { left: 10, top: 10, width: 300, height: 200, flow: 'vertical' },
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
        <script type="text/javascript">
        $(document).ready(function ()
        {
            var data = [<?php echo $tto;?>];
            var source = {
                datatype: "json",
                datafields: [
                    { name: 'name' },
                    { name: 'callout', type: 'int' }
                ],
                id: 'id',
                localdata: data
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxlistbox").jqxListBox({
                width: 230,
                source: dataAdapter,
                displayMember: "name",
                valueMember: "callout",
                checkboxes: true
            });
            $("#jqxlistbox").jqxListBox('checkIndex', 2);
            $("#jqxlistbox").jqxListBox('checkIndex', 5);
            $("#jqxlistbox").jqxListBox('checkIndex', 6);
            var getValues = function ()
            {
                var items = $("#jqxlistbox").jqxListBox('getCheckedItems');
                var array = convertToArray(items);
                return array;
            };
            var convertToArray = function (items)
            {
                var preparedArray = new Array(items.length);
                for (var i = 0; i < items.length; i += 1)
                {
                    preparedArray[i] = items[i].value;
                }
                return preparedArray;
            }
            $('#jqxbargauge').jqxBarGauge({
                width: 600,
                height: 600,
                title: 'Callout Per Site',
                values: getValues(),
                baseValue: 50,
                max: 500,
                barSpacing: 9,
                animationDuration: 0,
                relativeInnerRadius: 0.2,
                startAngle: 0,
                endAngle: 360,
                colorScheme: 'scheme05',
                tooltip: {
                    visible: true,
                    formatFunction: function (value, index)
                    {
                        var items = $("#jqxlistbox").jqxListBox('getCheckedItems');
                        var item = items[index];
                        return item.label + ": " + value + ' callout.';
                    }
                },
                labels: { formatFunction: function (value) { return value + ' callout.'; }, precision: 0, indent: 15, connectorWidth: 1 }
            });
            var getSum = function (array)
            {
                array = array || [];
                var sum = 0;
                if (!!array.length)
                {
                    for (var i = 0; i < array.length; i += 1)
                    {
                        sum += array[i];
                    }
                }
                return sum;
            };
            $('#log').html('<strong>Summary callout: ' + <?php echo $vatt;?> + '</strong>');
            $("#jqxlistbox").on('checkChange', function (event)
            {
                var items = $("#jqxlistbox").jqxListBox('getCheckedItems');
                var arrayOfItems = convertToArray(items);
                $('#log').html('<strong>Summary callout: ' + getSum(arrayOfItems) + '</strong>');
                $('#jqxbargauge').jqxBarGauge('val', arrayOfItems);
            });
        });
    </script>
    
</head>
<div class="row">
    <div class="col-lg-6"> 
        
        <div id='chartContainer' style="width: 100%; height: 570px;">
            
	</div>
       
    </div>
    <div class="col-lg-6">
         <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal" ><i class="glyphicon glyphicon-cloud-download"></i>Select more site</button>
        <div id='log'></div>                            
        <div id='jqxbargauge' style='float: left;'></div>      
        <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <div style="margin-left: 50px; margin-top: 150px; float: left;">
        <div id='jqxlistbox'></div>
        
        
    </div>
  </div>
</div>
    </div>
</div>

