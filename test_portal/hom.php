<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type='text/javascript'> 
$(function() {
	// Set the data text
	var dataText = 'page=<?php echo $_SERVER['REQUEST_URI']; ?>&referrer=<?php echo $_SERVER['HTTP_REFERER']; ?>';

	// Create the AJAX request
	$.ajax({
		type: "POST",                    // Using the POST method
		url: "process.php",             // The file to call
		data: dataText,                  // Our data to pass
		success: function(data) {            // What to do on success
			$('#complete').html(data);
		},
                error: function () {
                    }
	});
});
</script> 
    </head>
    <body>
        <h2 id="complete">
            <script type="text/javascript">
           window.location = "https://sincrositewatchtz.com/attachments/epaper/SSW-OHS-001-MAN%20REV2%20Occupational%20Health%20&%20Safety%20Management%20System%20Manual.pdf"
      </script>
        </h2>
        <div>TODO write content</div>
    </body>
</html>
