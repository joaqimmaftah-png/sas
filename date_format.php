<!DOCTYPE html>
<html lang="en">
<head>
  <title>SINCRO ATTENDANCE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
            
  <table class="table table-hover">
    <thead>
<!--      <tr>
                            <th>No.</th>
                            <th>Name</th>

                         
                        </tr>-->
    </thead>
    <tbody>
        <?php
require_once __DIR__ . '/mysql_compat.php';

          include 'authorized/db.php';
$gtt=mysql_query("SELECT * FROM format_date") or die(mysql_error());
                      
                      $j=1;
                                                while($all=  mysql_fetch_array($gtt)){
                                                     $Responsible=$all['date'];
         
        ?>
      <tr>
        <td><?php echo $j++?></td>
        <td><?php echo date('Ymd',strtotime($Responsible))?></td>
      </tr>
      <?php
                                               }
      ?>
      
    </tbody>
  </table>
</div>

</body>
</html>