<head>
    <script>
    $(document).ready(function (e) {
 //////////////////////////////////
         $("#awardsform").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "view/add_awards.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#onyeshaawardsmessage").html(data);
                    },
                    error: function () {
                    }
                });
            }));
 ///////////////////////////////////
        });
</script>
</head>




<?php
if (isset($_GET['awardno'])) {
    ?> 
<div id="onyeshaawardsmessage">
                </div>

<form role="form" class="form-inline" id="awardsform" method="POST">
  <input  type="hidden" class="form-control" value="<?php echo $_GET['awardno']; ?>"  name="ingizaawards">
  <input  type="hidden" class="form-control" value="<?php echo $_GET['awardno']; ?>"  name="awardno">
 
        <div class="form-group">
            <label for="inputlg">Awards Name*</label>
            <input class="form-control" size="36"  type="text" name="awardsname">
        </div>

        <div class="form-group">
            <label for="inputsm">Country</label>
            <input class="form-control" size="36"  type="text" name="country">
        </div>
        <div class="form-group">
            <label for="inputsm">City</label>
            <input class="form-control" size="40"  type="text" name="city">
        </div>
  <div class="form-group">
      <label for="inputsm">Attachment</label>
  <div class="input-control file">
      <input type="file" class="form-control" name="file"  />
        <button class="btn-file"></button>
    </div>
  </div>
        <div class="form-group">
            <label for="comment">Description:</label>
            <textarea class="form-control" cols="78"  name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="inputsm">Issue Date</label>
            <div class="input-control text" data-role="datepicker" data-week-start="1" >
                <input type="text" size="38" class="form-control" id="education" name="issues">
                <button type="button" class="btn-date"></button>
                <div class="calendar calendar-dropdown" style="position: absolute; max-width: 260px; z-index: 1000; top: 100%; left: 0px; display: block;">
                    <table class="bordered">
                        <tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">September 2015</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td><td class="text-center day-of-week">Su</td></tr><tr><td class="empty"><small class="other-day"></small></td><td class="text-center day"><a href="#">1</a></td><td class="text-center day"><a href="#">2</a></td><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td></tr><tr><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td><td class="text-center day"><a href="#">9</a></td><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a href="#">13</a></td></tr><tr><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td><td class="text-center day"><a href="#">16</a></td><td class="text-center day today"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td></tr><tr><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td><td class="text-center day"><a href="#">23</a></td><td class="text-center day"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td></tr><tr><td class="text-center day"><a href="#">28</a></td><td class="text-center day"><a href="#">29</a></td><td class="text-center day"><a href="#">30</a></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td></tr></tbody></table>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputsm">Expiration Date</label>
            <div class="input-control text" data-role="datepicker" data-week-start="1" >
                <input type="text" size="38" class="form-control" id="education" name="expire">
                <button type="button" class="btn-date"></button>
                <div class="calendar calendar-dropdown" style="position: absolute; max-width: 260px; z-index: 1000; top: 100%; left: 0px; display: block;">
                    <table class="bordered">
                        <tbody><tr class="calendar-header"><td class="text-center"><a class="btn-previous-year" href="#"><i class="icon-previous"></i></a></td><td class="text-center"><a class="btn-previous-month" href="#"><i class="icon-arrow-left-4"></i></a></td><td class="text-center" colspan="3"><a class="btn-select-month" href="#">September 2015</a></td><td class="text-center"><a class="btn-next-month" href="#"><i class="icon-arrow-right-4"></i></a></td><td class="text-center"><a class="btn-next-year" href="#"><i class="icon-next"></i></a></td></tr><tr class="calendar-subheader"><td class="text-center day-of-week">Mo</td><td class="text-center day-of-week">Tu</td><td class="text-center day-of-week">We</td><td class="text-center day-of-week">Th</td><td class="text-center day-of-week">Fr</td><td class="text-center day-of-week">Sa</td><td class="text-center day-of-week">Su</td></tr><tr><td class="empty"><small class="other-day"></small></td><td class="text-center day"><a href="#">1</a></td><td class="text-center day"><a href="#">2</a></td><td class="text-center day"><a href="#">3</a></td><td class="text-center day"><a href="#">4</a></td><td class="text-center day"><a href="#">5</a></td><td class="text-center day"><a href="#">6</a></td></tr><tr><td class="text-center day"><a href="#">7</a></td><td class="text-center day"><a href="#">8</a></td><td class="text-center day"><a href="#">9</a></td><td class="text-center day"><a href="#">10</a></td><td class="text-center day"><a href="#">11</a></td><td class="text-center day"><a href="#">12</a></td><td class="text-center day"><a href="#">13</a></td></tr><tr><td class="text-center day"><a href="#">14</a></td><td class="text-center day"><a href="#">15</a></td><td class="text-center day"><a href="#">16</a></td><td class="text-center day today"><a href="#">17</a></td><td class="text-center day"><a href="#">18</a></td><td class="text-center day"><a href="#">19</a></td><td class="text-center day"><a href="#">20</a></td></tr><tr><td class="text-center day"><a href="#">21</a></td><td class="text-center day"><a href="#">22</a></td><td class="text-center day"><a href="#">23</a></td><td class="text-center day"><a href="#">24</a></td><td class="text-center day"><a href="#">25</a></td><td class="text-center day"><a href="#">26</a></td><td class="text-center day"><a href="#">27</a></td></tr><tr><td class="text-center day"><a href="#">28</a></td><td class="text-center day"><a href="#">29</a></td><td class="text-center day"><a href="#">30</a></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td><td class="empty"><small class="other-day"></small></td></tr></tbody></table>
                </div>
            </div>
        </div>
   <button type="submit" class="btn btn-default" name="tax">Submit</button>
    </form>

    <?php
}if(isset($_POST['ingizaawards'])){
    include '../model/db.php';
    $employee_no=$_POST['ingizaawards'];
    $expire=$_POST['expire'];
    $issues=$_POST['issues'];
    $description=$_POST['description'];
    $city=$_POST['city'];
    $country=$_POST['country'];
    $awardsname=$_POST['awardsname'];
    
    $insertaward=  mysql_query("INSERT INTO `tbl_award`(`awards_name`, `description`, `issue_date`, `expiration_date`, `city`, `country`,employee_no) "
            . "VALUES ('$awardsname','$description','$issues','$expire','$city','$country','$employee_no')") or die(mysql_error());
    
    echo '<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong> Successfull!</strong>
</div>';
}

?>









