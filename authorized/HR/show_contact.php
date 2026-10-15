<head>
    <link href="datable/jquery.dataTables.css" rel="stylesheet">
    <script src="datable/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').dataTable();
        });
    </script>
</head>
<div class="margin5">    
    <table id="example" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>                             
                <th>Phone#1</th>
                <th>Phone#2</th>
                <th>Email1</th>
                <th>E-mail2</th>
                
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th>Name</th>                             
                <th>Phone#1</th>
                <th>Phone#2</th>
                <th>Email1</th>
                <th>E-mail2</th>
                
            </tr>
        </tfoot>

        <tbody>
            <?php
            include 'authorized/db.php';
            $show = "SELECT * FROM tbl_employee";
            $display = mysql_query($show) or die(mysql_error());
            while ($row = mysql_fetch_array($display)) {
                $emp_file_no = $row['emp_file_no'];
                $first_name = $row['first_name'];
                $surname = $row['surname'];
                $middle_name = $row['middle_name']; 
                $name = $first_name . "&nbsp" . $surname."&nbsp".$middle_name;
                $contact = mysql_query("select * from tbl_empley_contact where tbl_empley_contact.emp_file_no='$emp_file_no'")or die(mysql_error());
                $show_contact = mysql_fetch_array($contact);
                $telephone_no = $show_contact['telephone_no'];
                $email = $show_contact['email'];
                $email2=$show_contact['email2'];
                $mobile_phone = $show_contact['mobile_phone'];


                ?>
                <tr>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $mobile_phone; ?></td>
                    <td><?php echo $telephone_no; ?></td>
                    <td><?php echo $email2; ?></td>
                    <td><?php echo $email; ?></td>

                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>