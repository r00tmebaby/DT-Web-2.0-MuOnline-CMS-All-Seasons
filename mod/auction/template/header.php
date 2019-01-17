<?php
require $_SERVER['DOCUMENT_ROOT']."/inc/modules_funcs.php";
lang();
 $check = web_settings();
 	if(isset($_SESSION['lang'])){
	   	$js = "main_".strtolower($_SESSION['lang']).".js";
		$newcountdown = "newcountdown_".strtolower($_SESSION['lang']).".js";
    }
	else{
		$js = "main_en.js";
		$newcountdown = "newcountdown_en.js";
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DPWeb Auction v2 r00tme edition for DTWeb 2.0</title>
        <link rel="icon" type="image/png" href="./template/images/favicon.png" />
        <link rel="stylesheet" type="text/css" href="./template/css/<?php echo $check[3]?>.css" /> 
        <link rel="stylesheet" type="text/css" href="./template/css/tipTip.css" />
        <script type="text/javascript" src="./template/javascript/<?php echo $newcountdown ?>"></script>
        <script type="text/javascript" src="./template/javascript/jquery.js"></script>
        <script type="text/javascript" src="./template/javascript/tipTip.js"></script>
        <script type="text/javascript" src="./template/javascript/<?php echo $js ?>"></script>
        
<script type="text/javascript">
                $(function() {
                    var startTime = <?php echo Auction::$inst->getTime(); ?>;
                    var finished = 0;
                    newCountDown(startTime);

                    setInterval(function() {
                        startTime = startTime - 1;
                        if (startTime <= 0 && finished === 0) {
                            $("countdown").text('<?php echo phrase_auction_has_finished?>').css('color', '#ffffff').hide().fadeIn("slow");
                            finished = 1;
                            setTimeout(function() {
                                window.location.reload();
                            }, 1500);
                        } else if (finished === 0) {
                            newCountDown(startTime);
                            console.clear();
                        }
                    }, 1000);
                });
        </script>
  </head>
    <body>
        <div id='main'>