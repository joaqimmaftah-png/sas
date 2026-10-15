<div class="row">
    <div class="col-lg-12">                                     
                 <ul class="pagination">
   <li>
                <a href="#" name="approve" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i>&nbsp;New Callout</a>
            </li>         
             <li >
                <a href="?action=rca_report"><i class="glyphicon glyphicon-download-alt"></i>&nbsp;Generate Report</a>
            </li>
</ul>    
            </div>
</div>
            <div class="row">
    <div class="col-lg-4">
        <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd.mm.yyyy">
                    <input class="form-control" placeholder="RCA From Date dd-mm-yyyy" type="text" value="" readonly>
               
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" />
    </div>
    <div class="col-lg-4">
        <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd.mm.yyyy">
                    <input class="form-control" placeholder="RCA To Date dd-mm-yyyy" type="text" value="" readonly>
                    
					<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" />
    </div>
    <div class="col-lg-1">
        
       <button class="btn btn-default" ><i class="glyphicon glyphicon-search"></i> Search</button>
    </div> 
                 <div class="col-lg-3">

    </div> 
                
</div>
<hr>
<div class="row">
    
    <div class="col-lg-12">
<!--                     <button type="button" class="btn btn-default" id='excelExport' ><i class="glyphicon glyphicon-cloud-download"></i>Download Excel</button>-->
        
            <div style='float: left;'>
                <button type="button" value="Export to Excel" id='excelExport'>Exportto excel</button>
                
            </div>
            <div style='margin-left: 10px; float: left;'>
                <input type="button" value="Export to CSV" id='csvExport' />
                
            </div>
            <div style='margin-left: 10px; float: left;'>
                <input type="button" value="Export to HTML" id='htmlExport' />
               
            </div>
            <div style='margin-left: 10px; float: left;'>
                <button type="button" value="Export to PDF" class="btn btn-success" id='pdfExport' >Export Pdf</button>
            </div>
        
                </div>
    <hr>
</div>
<div class="row">
    <div class="col-lg-12">
                   <div id="jqxgrid" >
        </div>
                </div>
</div>