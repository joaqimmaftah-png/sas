<?php
require_once __DIR__ . '/../mysql_compat.php';

       // from the form
$messages='
    <html>
    <body>
    <head>
    <style>
    audio,canvas,progress,video{
	display:inline-block;
	vertical-align:baseline
}
.progress{
	height:20px;
	margin-bottom:20px;
	overflow:hidden;
	background-color:#f5f5f5;
	border-radius:4px;
	-webkit-box-shadow:inset 0 1px 2px rgba(0,0,0,.1);
	box-shadow:inset 0 1px 2px rgba(0,0,0,.1)
}

.progress-bar{
	float:left;
	width:0;
	height:100%;
	font-size:12px;
	line-height:20px;
	color:#fff;
	text-align:center;
	background-color:#337ab7;
	-webkit-box-shadow:inset 0 -1px 0 rgba(0,0,0,.15);
	box-shadow:inset 0 -1px 0 rgba(0,0,0,.15);
	-webkit-transition:width .6s ease;
	-o-transition:width .6s ease;
	transition:width .6s ease
}
.progress-bar-striped,.progress-striped .progress-bar{
	background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
	background-image:-o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
	background-image:linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
	-webkit-background-size:40px 40px;
	background-size:40px 40px
}

.progress-bar.active,.progress.active .progress-bar{
	-webkit-animation:progress-bar-stripes 2s linear infinite;
	-o-animation:progress-bar-stripes 2s linear infinite;
	animation:progress-bar-stripes 2s linear infinite
}

.progress-bar-success{
	background-color:#5cb85c
}

.progress-striped .progress-bar-success{
	background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
	background-image:-o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
	background-image:linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent)
}

.progress-bar-info{
	background-color:#5bc0de
}

.progress-striped .progress-bar-info{
	background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
	background-image:-o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
	background-image:linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent)
}

.progress-bar-warning{
	background-color:#f0ad4e
}

.progress-striped .progress-bar-warning{
	background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
	background-image:-o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
	background-image:linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent)
}

.progress-bar-danger{
	background-color:#d9534f
}

.progress-striped .progress-bar-danger{
	background-image:-webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
	background-image:-o-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);
	background-image:linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent)
}
</style>
</head>
<body>
<div class="container">
  <h2>Stacked Progress Bars</h2>
  <p>Create a stacked progress bar by placing multiple bars into the same div with class .progress:</p> 
  <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" style="width:40%">
      Free Space
    </div>
    <div class="progress-bar progress-bar-warning" role="progressbar" style="width:10%">
      Warning
    </div>
    <div class="progress-bar progress-bar-danger" role="progressbar" style="width:20%">
      Danger
    </div>
  </div>
</div>
</body>
</html>';
       $message = htmlentities($messages);

       // set here
       $subject = "Contact form submitted!";
       $to = 'joaqim@sincrositewatch.com';

       $body = <<<HTML
$message
HTML;

       $headers = "From: $email\r\n";
       $headers .= "Content-type: text/html\r\n";

       // send the email
       mail($to, $subject, $body, $headers);

       // redirect afterwords, if needed
      
?>