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
                <a class="" href=""><i class="icon-grid-view"></i>&nbsp;SMS To All Employees</a>                 
            </li>

        </ul>
    </nav>
</div>
          <form action="" method="POST">
              
               <div class="form-group">
  <label for="reg">Receiver's:</label>
  <select class="form-control" id="reg" name="vregnm">
    <?php
require_once __DIR__ . '/mysql_compat.php';

                        $select_car=mysql_query("SELECT * from tbl_title") or die(mysql_error());
                        while ($row = mysql_fetch_array($select_car)) {
                        $vehicle_reg_num=$row['title_name'];
                        ?>
                        <option value="<?php echo $vehicle_reg_num;?>"><?php echo $vehicle_reg_num;?></option>
                        <?php
                        }
                        ?>
  </select>
</div>
 <div class="form-group">
  <label for="comment">Message Body:</label>
  <textarea class="form-control" rows="5" id="comment"></textarea>
</div>

     <input type="submit" name="submit" value="Send Sms">    
  </form>
    </div>


