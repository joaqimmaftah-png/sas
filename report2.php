<?php
include_once 'authorized/db.php';
$query = mysql_query("SELECT department_name,office_phone_number FROM tbl_department") or die("cannot select");
$username_array = array(); // start an array
$number_array=array();
while($row = mysql_fetch_array($query)){ // cycle through each record returned
  $username_array[] = "\"".$row['department_name']."\""; // get the username field and add to the array above with surrounding quotes
 $number_array[]=$row['office_phone_number'];
  
}
$username_string = implode(",", $username_array); // implode the array to "stick together" all the usernames with a comma inbetween each
$number_arrayshow = implode(",", $number_array);
//echo $username_string; 
// output the string to the display
//echo $number_arrayshow;


?>
<!doctype html>
<html>
	<head>
		<title>Bar Chart</title>
		<script src="Chart.js"></script>
	</head>
	<body>
		<div style="width: 50%">
			<canvas id="canvas" height="450" width="600"></canvas>
		</div>


	<script>
	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	var barChartData = {
		labels : [<?php echo $username_string;?>],
		datasets : [
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data: [<?php echo $number_arrayshow;?>]
			}
		]

	}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
	}

	</script>
	</body>
</html>
