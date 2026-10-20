<div class="navbar-header no-desktop">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <a class="" href="?action=employee"><i  class="icon-list fg-blue"></i>&nbsp;Goals Nav Menu</a>
    </button>

</div>

<div class="bg-white shadow collapse navbar-collapse " id="myNavbar"  style="width: 100%;" >

    <nav class="horizontal-menu compact" >
        <ul>

            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModalbenefits"><i  class="icon-user-3 fg-blue"></i>&nbsp;Personal Goals</a>
            </li>
          
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModaltax" ><i  class="icon-screen fg-blue"></i>&nbsp;Department Goals</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModaltax" ><i  class="icon-comments-4 fg-blue"></i>&nbsp;Project Goals</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModaltax" ><i  class="icon-stats fg-blue"></i>&nbsp;Business Goals</a>
            </li>
            <li>
                <a class="" href="#" class="fg-hover-crimson fg-cobalt" data-toggle="modal" data-target="#myModaltax" ><i  class="icon-copy fg-blue"></i>&nbsp;Company Goals</a>
            </li>

            


        </ul>
    </nav>
</div>
<div class="well well-sm">
    <nav class="breadcrumbs" style="">
                <ul>
                    <li><a href="#"><i class="icon-home"></i></a></li>
                    <li><a href="#">Personal Goals</a></li>
                    <li><a href="#" class="fg-red"><i class="icon-plus-2"></i>&nbsp;Add</a></li>
                </ul>
            </nav>
</div>
<div>
     <table id="example3" class="display bordered" style="font-size: 12px;" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-left">Award Name*</th>
                                    <th class="text-left">Description</th>
                                    <th class="text-left">Issue Date</th>                                   
                                    <th class="text-left">City</th>
                                    <th class="text-left">Country</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                <?php
require_once __DIR__ . '/../../mysql_compat.php';


                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <nav class="vertical-menu compact">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-toggle" href="#"></a>
                                                        <ul class="dropdown-menu" data-role="dropdown">
                                                            <li>
                                                                <a href="#" onclick="attachment('authorized/HR/add_incident_attachment.php?incident_id=<?php echo $incident_id; ?>')" data-toggle="modal" data-target="#ongezaattachment"><i class=" icon-plus-2 fg-blue"></i>&nbsp;Add Attachment</a>
                                                            </li>
                                                            <li><a href="#" onclick="delete_incident('authorized/HR/add_incident.php?incident_delete=<?php echo $incident_id; ?>')"><i class=" icon-cancel-2 fg-red"></i>&nbsp;Delete</a></li>
                                                        </ul>

                                                    </li>

                                                </ul>
                                            </nav>
                                        </td>
                                        <td><?php echo 'j'; ?></td>
                                        <td><?php echo 'k'; ?></td>
                                        <td><?php echo 'm'; ?></td>
                                        <td><?php echo 'b'; ?></td>
                                        <td><?php echo 'w'; ?></td>
                                        
                                    </tr>
                                    <?php
//                                }
                                ?>
                            </tbody>
                        </table>
</div>