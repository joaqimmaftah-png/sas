
<?php
$message = "";
if (isset($_POST['add_appraisal'])) {
    if (!empty($_POST['checkbox'])) {
        $checkBox = $_POST['checkbox'];
        $employ_id = $_POST['employ_id'];
        $reviewer = $_POST['reviewer'];
        $reviewer2 = $_POST['reviewer2'];
        $date_of_birth = $_POST['initiated_date'];
        $emp_file_no = $_SESSION["emp_file_no"];
        $jina = mysql_query("SELECT * FROM tbl_employee WHERE emp_file_no='$employ_id' ")or die(mysql_error());
        $majina = mysql_fetch_array($jina);
        $firstname = $majina['first_name'];
        $sirname = $majina['surname'];
        $fullname = $firstname . " " . $sirname;
        $status = "pending";

        $appraisal = mysql_query("INSERT INTO tbl_appraisal(`emp_file_no`,`reviewer`,reviewer2,initiated_by,`initiated_date`,`status`)"
                . "VALUES('$employ_id','$reviewer','$reviewer2','$fullname','$date_of_birth',' $status')") or die(mysql_error());
        for ($i = 0; $i < sizeof($checkBox); $i++) {
            $insert = mysql_query("INSERT INTO tbl_reviews(emp_file_no,competence_id,manager_reviews,manager_reviewer2,submitted_date)"
                    . "values('$employ_id','$checkBox[$i]','$reviewer','$reviewer2','$date_of_birth')") or die(mysql_error());
            $message = '<div class="shadow" style="height: 30px; margin-bottom: 4px; width: 100%; background-color: #0081CC; color: white;">
        <center> Success initiating appraisal for
            ' . $fullname . '
           <a href="#" id="previews_appraisal" style="color:black">Preview </a>before Submitting data </center>
        </div>';
        }
    }
}
?>
    <script>
    $(function () {
                       $("#previews_appraisal").on('click', function(){
                            $.Dialog({
                                overlay: false,
                                shadow: true,
                                flat: false,
                                icon: '<span class="icon-file-pdf"></span>',
                                title: 'INITIATED  APPRAISAL FOR <span style="text-decoration:uppercase"><?php echo $fullname;?></span>',
                                content: '',
                                 sysButtons: {
                                    btnMin: true,
                                    btnMax: true,
                                    btnClose: true
                                },
                                onShow: function(_dialog){
                                    var html = [
                                        '<iframe width="1050" height="550" data-role="scrollbox"  src="authorized/previews_appraisal.php" frameborder="0" allowfullscreen></iframe>'
                                    ].join("");

                                    $.Dialog.content(html);
                                }
                            });
                        });
    })
</script>
<div class="bg-white shadow" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href="?action=view_appraisal"><i class="icon-home fg-blue"></i>&nbsp;Home</a>
            </li>
                        <li>
                <a class="" href="?action=add_appraisal" class="fg-hover-crimson fg-cobalt"><i class="icon-plus-2 fg-cobalt fg-hover-crimson"></i>&nbsp; Initiate Employee Appraisal</a>
            </li>
             <li id="action">
           <a class="" href="#" class="fg-hover-crimson fg-cobalt" id="btnPrint"><i class="icon-plus-2 fg-cobalt fg-hover-crimson"></i>&nbsp; Preview</a>
            </li>
                        <li>
                <a class="" href="?action=view_appraisal"><i class="icon-reply-2 fg-green"></i></a>                 
            </li>
                        
        </ul>
    </nav>
</div>
<div class="container" >
                       <form action="?action=add_appraisal" method="POST">
                        <fieldset>
                            <legend><center>Employee Performance Appraisal</center></legend>
                            
                                <div class="row">
                                    
                                        <div class="span2 text-right">
                                            <label>Employee ID:</label>
                                        </div>
                                        <div class="span5">                                                             
                                            <div class="input-control text" data-role="input-control">
                                                <input placeholder="" type="text" name="employ_id">
                                                
                                            </div>
                                        </div>
                                     <div class="span2 text-right">
                                            <label>Initiated Date:</label>
                                        </div>
                                        <div class="span5">                                                             
                                            <div class="input-control text" data-role="datepicker" data-week-start="1">
                                                <input readonly="readonly" name="initiated_date" type="text">
                                                <button type="button" class="btn-date"></button>
                                                <div class="calendar calendar-dropdown" style="position: absolute; display: none; max-width: 300px; z-index: 1000; top: 100%; left: 0px;"><table class="bordered"><tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">March 2015</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td><td class="text-center day-of-week">Su</td></tr><tr><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="text-center day"><a href="#">1</a></td></tr><tr><td class="text-center day"><a href="#">2</a></td><td class="text-center day"><a href="#">3</a></td><td class="text-center day today"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td></tr><tr><td class="text-center day"><a href="#">9</a></td><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a href="#">13</a></td><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td></tr><tr><td class="text-center day"><a href="#">16</a></td><td class="text-center day"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td></tr><tr><td class="text-center day"><a href="#">23</a></td><td class="text-center day"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td><td class="text-center day"><a href="#">28</a></td><td class="text-center day"><a href="#">29</a></td></tr><tr><td class="text-center day"><a href="#">30</a></td><td class="text-center day"><a href="#">31</a></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td></tr></tbody></table></div></div>
                                        </div>
                                        
                                                                   
                                </div>
                                <div class="row">                                  
                                        <div class="span2 text-right">
                                            <label>Reviewer1:</label>
                                        </div>
                                        <div class="span5">                                          
                                            <div class="input-control select" data-role="input-control">
                                                <select name="reviewer">
                                                    <option value="">--select---</option>
                                                    <option value="madam Eva">madam Eva</option>
                                                    <option value="mr magesa">mr magesa</option>
                                                    <option value="mr zacharia">mr zacharia</option>
                                                </select>
                                            </div>
                                        </div>
                                                                            <div class="span2 text-right">
                                            <label>Reviewer2:</label>
                                        </div>
                                        <div class="span5">                                          
                                            <div class="input-control select" data-role="input-control">
                                                <select name="reviewer2">
                                                    <option value="">--select---</option>
                                                    <option value="madam Eva">madam Eva</option>
                                                    <option value="mr magesa">mr magesa</option>
                                                    <option value="mr zacharia">mr zacharia</option>


                                                </select>
                                            </div>
                                        </div>
                                </div>                               
                                <legend><center>Employee Competencies&nbsp <button class="primary"><a href="#">Add New Competence</a></button></center></legend>

                                <div class="row" style="height:500px; overflow-y:scroll;border: 1px solid #979797">

                                    <table class="table striped bordered hovered">
                                        <thead class="">
                                            <tr>
                                                <th class="text-left">Competence name</th>
                                                <th class="text-left">Description</th>
                                                <th class="text-left">Remove</th>                                               
                                            </tr>
                                        </thead>

                                        <tbody>
<?php
include 'authorized/db.php';
$compentance = mysql_query("SELECT * FROM tbl_competence") or die(mysql_error());
while ($show = mysql_fetch_array($compentance)) {
    $competence_id = $show['competence_id'];
    $competance_name = $show['competance_name'];
    $description = $show['description'];
    ?>
                                                <tr class=""><td class="text-bold"><?php echo $competance_name; ?></td>
                                                    <td class="right"><?php echo $description; ?></td>
                                                    <td class="right">
                                                        <label class="inline-block">
                                                            <input  checked="" type="checkbox" name="checkbox[]" value="<?php echo $competence_id; ?>">
                                                            <span class="check"></span>
                                                        </label>
                                                    </td>
                                                </tr> 
<?php } ?>


                                        </tbody>
                                    </table>

                                </div>

                                <div class="row" style="margin-top: 10px;">                               
                                            <div class="span4 offset5">
                                                <input class="span4 primary large" value="initiate" name="add_appraisal" type="submit">
                                            </div>
                                       
                                    </div>                                
                                                                               
                        </fieldset>
                    </form>
</div>


<div class="" style="display: none" id="print">

<div style="width: 1000px; height: 113px;">
    <div style="float: left;">
        <address>
            <strong>SINCROSITEWATCH LTD</strong><br />
            P.O Box 1027,<br>
            Dar es Salaam.<br>
            <abbr title="Phone">P:</abbr> (123) 456-7890
        </address>
    </div>
    <div style="float: right;">
        <img src="images/logoo.png" style="width: 120px; height: 110px;">
    </div>
</div>
<div style="width: 1000px; height: 100px; background-color: #61AA50;">
    <img src="images/header1.png" style="width: 100%; height: 90px;">
</div>
<div style="width: 1000px; height: 30px; margin-top: 5px; background-color: #315589;">
<img src="images/header3.png" style="width: 100%; height: 30px;">
</div>
<div style="width: 1000px;">
    <center><h1>(Manager initiated)</h1></center>
    <center><h1><strong>joaqim maftah</strong></h1></center>
    <h1><strong>Employee Competencies</strong></h1>
    <p>
        Rate the employee's capability or knowledge in the following areas in terms of their current role requirement.
        As appropriate, please provide in writing examples to support your assessment.
    </p><hr>
</div>
<div style="width: 1000px;">
    <div style="width: 1000px; background-color: #5B5B5D;background-image:url(images/textheader.png); color: white; padding: 4px;">
    <strong>job knowledge/skills</strong>
</div>
    <div style="width: 688px; float: left; ">
        <p style="float: left;">
            To be able to build up a rapport when needed, to be flexible in negotiations and staff and to show independence and resilience.
        </p>

        <p>Comments:<hr></p>
                <p><hr></p>
                <p><hr></p>
                <p><hr></p>
           
     
    </div>
    <div style="width: 310px; float: right; padding-left: 2px;">
        <p>
        <table>
            <tr>
                <td><input type="checkbox"></td>
                <td>Demostrated exceptional performance</td>
            </tr>
             <tr>
                <td><input type="checkbox"></td>
                <td>Exceeds some requirements</td>
            </tr>
             <tr>
                <td><input type="checkbox"></td>
                <td>Meets the requirements</td>
            </tr>
             <tr>
                <td><input type="checkbox"></td>
                <td>Meets some requirements</td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>Does not meet the reqirements</td>
            </tr>
        </table>
        </p>
    </div>
    <div style="clear: both;"></div>
</div>
<div style="width: 1000px;">
   <div style="width: 1000px; background-color: #5B5B5D;background-image:url(images/textheader.png); color: white; padding: 4px;">
    <strong>job knowledge/skills</strong>
</div>
    <div style="width: 688px; float: left; ">
        <p style="float: left;">
            To be able to build up a rapport when needed, to be flexible in negotiations and staff and to show independence and resilience.
        </p>

        <p>Comments:<hr></p>
                <p><hr></p>
                <p><hr></p>
                <p><hr></p>
           
     
    </div>
    <div style="width: 310px; float: right; padding-left: 2px;">
        <p>
        <table>
            <tr>
                <td><input type="checkbox"></td>
                <td>Demostrated exceptional performance</td>
            </tr>
             <tr>
                <td><input type="checkbox"></td>
                <td>Exceeds some requirements</td>
            </tr>
             <tr>
                <td><input type="checkbox"></td>
                <td>Meets the requirements</td>
            </tr>
             <tr>
                <td><input type="checkbox"></td>
                <td>Meets some requirements</td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>Does not meet the reqirements</td>
            </tr>
        </table>
        </p>
    </div>
    <div style="clear: both;"></div>
</div>
<div style="width: 1000px; height: 120px;">
    <h2>Assigned Goals</h2>
    <div style="float: left; width: 400px;">
        <table>
        <tr>
            <td><strong>Employee Name:</strong></td><td>joaqim maftha</td>         
        </tr>
            <tr>
                <td><strong>Manager's Name:</strong></td><td>nzaro kimbutee</td>
           
        </tr>
        </table>
    </div>
    
    <div style="float: right; width: 600px;">
         <table style="">
        <tr>
             <td><strong>Signature:</strong></td><td>.............................</td>
            <td><strong>Date:</strong></td><td>...........................</td>
        </tr>
            <tr>
           <td><strong>Signature:</strong></td><td>.............................</td>
            <td><strong>Date:</strong></td><td>...........................</td>
           
        </tr>
        </table>
    </div>
    <div style="clear: both;"></div>
</div>
</div>
