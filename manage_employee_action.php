     
<li><a href="?action=profile&emp_file_no=<?php echo $_GET['q'];?>"><span class="icon-user"></span>&nbsp;Employee Record</a></li>
<li><a href="?action=edit&emp_file_no=<?php echo $_GET['q'];?>" ><span class="icon-checkmark"></span>&nbsp;Edit</a></li>
<li><a href="#" data-toggle="modal" data-target="#myModaldelete"><span class="icon-cancel-2"></span>&nbsp;Delete</a></li>

<!-- Modal -->
<div id="myModaldelete" class="modal fade" style="display: none" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content" style="background-color: transparent">
<!-------------------create window's---------------->
    <div class="window">
        <div class="caption">
            <span class="icon icon-windows"></span> 
            <div class="title">Are You Sure You Want to Delete?</div> 
            <button class="btn-min"></button> 
            <button class="btn-max"></button> 
            <button class="btn-close close"  data-dismiss="modal"></button>
        </div>
        <div class="content" >
            <a href="?action=delete_emloyee&emp_file_no=<?php echo $_GET['q'];?>"  style="margin-top: 10%; margin-left: 7%;" class="button primary">YES! I want to delete it Permanent.</a>
            <a href=""  style="margin-top: 10%; margin-left: 4%;" class="button danger">No!It's not My Attention, please close it..</a>
        </div>
    </div>
<!---------------------end window------------------>
</div>
  </div>
</div>
<!--model linces-->