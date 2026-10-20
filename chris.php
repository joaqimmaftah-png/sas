<html>
    <head>
             <script src="js/jquery/jquery.min.js"></script> 
             <script>
        function getPage(url) {
//            $('#change').fadeOut(1000, function () {
                $('#change').load(url);
//                $('#change').fadeIn(1000, function () {
//                });
//            });
        }
        
        $('html, body').animate({
    scrollTop: $("#change").offset().top
}, 50);
        </script>
 
    </head>
    <body>
        <div id='we' style="height: 200px;"></div>
        <a  href="#" onclick='getPage("chris2.php?idata=<?php
require_once __DIR__ . '/mysql_compat.php';
 echo 'MCC';?>")'><i class="icon-cancel  fg-blue"></i>&nbsp;<?php echo 'JOAQIM'?></a>
       <div id="change">
        <input type="text" name="" value="Joaqim" >
        </div>
    </body>
</html>