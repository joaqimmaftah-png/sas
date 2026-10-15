<div class="bg-white" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="dropdown-toggle" href="#"><i class="icon-comments-2 fg-blue "></i>&nbsp;SMS</a>
                 <ul class="dropdown-menu" data-role="dropdown">
                    <li><a href="?action=smsgroup">Group Of Employee's</a></li>
                    <li class="divider"></li>
                    <li><a href="?action=sms">All Employee's</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#"><i class="icon-mail"></i>&nbsp;E-Mail</a>  
                <ul class="dropdown-menu" data-role="dropdown">
                    <li><a href="?action=emailgroup">Group Of Employee's</a></li>
                    <li class="divider"></li>
                    <li><a href="?action=email">All Employee's</a></li>
                </ul>
            </li>

        </ul>
    </nav>
</div>
<div class="container">
    <div class="bg-white" style="width: 100%;" >
    <nav class="horizontal-menu compact">
        <ul>
            <li>
                <a class="" href=""><i class="icon-grid-view"></i>&nbsp;Send Email To All Employees</a>                 
            </li>

        </ul>
    </nav>
</div>
          <form action="" method="POST">
           <div class="form-group">
      <label for="from">From:</label>
      <?php
      $emp_file_no=$_SESSION["emp_file_no"];
$access_lever=$_SESSION["access_lever"];
$jina=mysql_query("SELECT *  from tbl_user_accounts where emp_file_no='$emp_file_no'") or die(mysql_error());
$show=  mysql_fetch_array($jina);
$name=$show['hints'];
      ?>
      <input type="text" class="form-control" placeholder="<?php echo $name;?>" id="nextdate" name="from" readonly="">
    </div>       
    <div class="form-group">
      <label for="receiver">Receiver:</label>
      <input type="text" class="form-control" placeholder="All Employees" id="nextdate" name="receiver" readonly="">
    </div>
       <div class="form-group">
      <label for="subject">Email Subject:</label>
      <input type="text" class="form-control"  id="subject" name="subject">
    </div>
 <div class="form-group">
  <label for="body">Email Body:</label>
  <textarea class="form-control" rows="5" id="body" name="body"></textarea>
</div>

              <input type="submit"  name="submit" value="Send Sms">    
  </form>
    </div>


