<?php
require_once __DIR__ . '/../../mysql_compat.php';
 include('header.php'); ?>
<body>

    <div class="row-fluid">
        <div class="span12">




            <div class="container">


                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Excel Writer</strong>&nbsp;Click The Button to View th e Excel File
                </div>
                <?php
                
                $excel = mysql_query("select  * from member")or die(mysql_error());
                $row = mysql_fetch_array($excel);
                $id_excel = $row['member_id'];
                ?>

                <form method="POST" action="excel.php">
                    <input type="hidden" name="id_excel" value="<?php echo $id_excel; ?>">
                    <button id="save_voter" class="btn btn-success" name="save"> Download Excel File</button>
                </form>

              
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">


                    <thead>
                        <tr>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>MiddleName</th>
                            <th>Address</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysql_query("select * from member") or die(mysql_error());
                        while ($row = mysql_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>  
                                <td><?php echo $row['middlename']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                            </tr>
<?php } ?>

                    </tbody>
                </table>



            </div>
        </div>
    </div>
</div>



</body>
</html>


