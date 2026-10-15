
<?php
include "DBConfig.php";
$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);

if ($conn->connect_error) {
 
 die("Connection failed: " . $conn->connect_error);
} 




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SINCRO AUTOMATION SYSTEM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
      <script type="text/javascript">
        $(document).ready(function (e) {
            $("#signin").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({url: "signin.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $("#site_locatonz").html(data);
                    },
                    error: function () {
                    }
                });
            }));
        });
    </script>
</head>
<body>

<div class="container">
 
    <div class="row" style="margin-top: 4%;">
     <div class="col-lg-3"></div>
     <div class="col-lg-6">
  <div class="alert alert-info">
                            <strong>Info!</strong> Please click the button bellow to find your current location.
                        </div>
                        <div class="input-group">
                            <button type="button" onclick="getLocation()" class="btn btn-primary">My Current Location</button>&nbsp;
                            <button  class="btn btn-default" data-toggle="modal" data-target="#myModalverif">Site Attendance Verification</button>
                        </div>

                        <br>
         
          <div class="modal-content">
      <div class="modal-header">
<!--        <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--<h5 class="modal-title"><i class="glyphicon glyphicon-lock"></i>&nbsp;Login SAS V2.1</h5>-->
      </div>
      <div class="modal-body">
  <div  id="site_locatonz">
                     
                    </div>
          <br>
         <form action="" method="POST" id="signin">
    <div class="input-group" style="width:100%;">
        <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Latitude:&nbsp;&nbsp;</span></span>
                                <input name="techcian"   value="" aria-describedby="sizing-addon1"   type="hidden">
                                <input id="latitude1" name="latitude" class="form-control editable " placeholder=""  value="" aria-describedby="sizing-addon1" readonly="" type="text">

                            </div>
      <br>
    <div class="input-group" style="width:100%;">
                                <span class="input-group-addon" id="sizing-addon1" style="width:20%; text-align:right"><span class="text-right">Longitude:</span></span>
                                <input id="longtude1" name="longitude" class="form-control editable" placeholder=""  value="" aria-describedby="sizing-addon1" readonly="" type="text">
                                <input  name="techcian" class="form-control editable" placeholder=""  value="<?php echo $_GET['id']?>" aria-describedby="sizing-addon1"  type="hidden">

                            </div>
      <br>
      <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon1"><span class="text-right">Site Name:</span></span>
                                <select class="form-control" data-live-search="true" id="af" name="site_cla">
                                    <option value="">Select Site Name</option>
                                     <?php
$sql = "SELECT * FROM tbl_class_a_site";
foreach ($conn->query($sql) as $row) {
    ?>
                                        <option value="<?php echo $row['s_id']; ?>"><?php echo $row['sitename'];?></option>
    <?php
}
$conn->close();
?>
                                </select>
                            </div>
      
      
                            <hr>
                         <div  id="site_locaton">

    </div>      
                       
      <br>
   <div class="input-group">
                                <button type="submit" name="verifyin" value="in" class="btn btn-info ">Sign In</button>&nbsp;
                                <button  type="submit" class="btn btn-default ">Sign Out</button>
                            </div>
      
   
                            
                            <!--<button type="submit" name="verifyin" value="in" class="btn btn-default" >Sign </button>-->
                       

  </form> 
      </div>
     
    </div>
       
     </div>
     <div class="col-lg-3"></div>
    
 </div>
    <script>
var y = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        y.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
   document.getElementById("latitude1").value = position.coords.latitude;
   document.getElementById("longtude1").value = position.coords.longitude;
    
    
}
</script>
  
<div class="row" style="margin-top: 4%;">
<div class="col-lg-3"></div>
<div class="col-lg-6">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- bongo-sound_main_Blog1_1x1_as -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6960259539797167"
     data-ad-slot="1956526934"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<div class="col-lg-3"></div>
</div>
  
</div>

</body>
</html>


