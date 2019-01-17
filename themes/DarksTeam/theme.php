<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $option['title']; ?></title>
	<link rel="stylesheet" href="themes/DarksTeam/css/darksteam.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript" src="js/easyTooltip.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>	
	<script type="text/javascript">
		$(document).ready(function(){	
			$("[title]").easyTooltip();
		});
	</script>
</head>
<body>
	<div id="main_body">
		<header>
			<div class="logo clearfix">
			<form  name='<?php echo form_enc()?>' method="post" >
                <input type="submit" value="en" class="en border hvr-pop " name="change_lang">
                <input type="submit" value="bg" class="bg border hvr-pop" name="change_lang">
             </form>
				<p class="left"><img src="themes/DarksTeam/imgs/logo.gif" alt="header" /></p>
				<p class="right banner">
					<a href="http://darksteam.net/" target="_blank">
						<img src="imgs/darksteam.gif" alt="darksteam"/>
					</a>
				</p>
			</div>
			
			<nav class="navbar-default">
				<?php include 'inc/menu.php'; ?>
			</nav>
		</header>
		<div class="container">
			<div class="inner_container clearfix">
				<div class="right col_1">
					<div class="box">
						<div class="boxTitle2">CONTENT</div>
						<div class="boxBody2"><div class="content"><div id="content">
							<?php
								require 'inc/loader.php';
							?>
						</div>
						</div></div>
						<div class="boxFooter-line"></div>
					</div>
				</div>
				<div class="left col_2">
					<div class="box">
						<div class="boxTitle2">USER PANEL</div>
						<div class="boxBody">
							<?php include 'inc/user_panel.php'; ?>
						</div>
						<div class="boxFooter-line"></div>
					</div>
					<div class="box">
						<div class="boxTitle2">RANKINGS</div>
						<div class="boxBody">
							<?php include 'inc/ranks.php'; ?>
						</div>
						<div class="boxFooter-line"></div>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<div class="footer">Copyrights &copy; MeMoS</div>
			<div class="copyrights"><a href="http://darksteam.net/" target="_blank"><img src="themes/DarksTeam/imgs/copyright.gif" alt="copyright" /></a></div>
		</footer>
	</div>
</body>
</html>