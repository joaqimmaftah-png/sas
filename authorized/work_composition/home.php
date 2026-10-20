<head>
    <script type="text/javascript">
        $(document).ready(function () {
            var url = "authorized/work_composition/load_completion.php";

            // prepare the data
            var source =
            {
                        datatype: "json",
                        datafields: [
                            {name: 'link'},
                            {name: 'code'},
                            {name: 'customername'},
                            {name: 'siteaddress'},
                            {name: 'jobno'},
                            {name: 'completionno'},
                            {name: 'filledby'},
                            {name: 'filled'}
                        ],
                        id: 'id',
                        url: url,
                        root: 'data'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);

            $("#jqxgrid").jqxGrid(
            {
                width: '100%',
                source: dataAdapter,
                sortable: true,
                filterable: true,
                filtermode: 'excel',
                columnsresize: true,
                autoshowfiltericon: false,
                columns: [
                     { text: 'ACTION', datafield: 'link', width: '5%' },
                     { text: 'CODE', datafield: 'code', width: '5%' },
                  { text: 'CUSTOMER NAME', datafield: 'customername', width: '20%' },
                  { text: 'SITE ADDRESS', datafield: 'siteaddress', width: '20%' },
                  { text: 'JOB NO', datafield: 'jobno', width: '20%' },
                  { text: 'WORK COMPLETION NO', datafield: 'completionno',width: '20%' },
                  { text: 'FILLED BY', datafield: 'filledby', width: '10%' },
                  { text: 'DATE FILLED', datafield: 'filled', width: '10%' }
                ]
            });
        });
    </script>
    
</head>



<div class="row">
    <div class="col-lg-12">                                     
                 <ul class="pagination">
   <li>
                <a href="?action=add_survey_report"  class="btn btn-success"><i class="glyphicon glyphicon-plus"></i>&nbsp;work completion report</a>
            </li>         
    
</ul>    
            </div>
    <div class="col-lg-12" >
        <div id="jqxgrid">
            
          
            
        </div>
    </div>
</div>