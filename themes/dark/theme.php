<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title><?php echo $option['title']; ?></title>
	<link rel="stylesheet" href="themes/dark/css/style.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<script type="text/javascript" src="js/easyTooltip.js"></script>
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
			<form  name='<?php echo form_enc()?>' method="post" >
                <input type="submit" value="en" class="en border hvr-pop " name="change_lang">
                <input type="submit" value="bg" class="bg border hvr-pop" name="change_lang">
             </form>
			<div class="logo">
				<img src="themes/dark/imgs/logo.jpg" alt="Logo" />
			</div>
			<nav>
				<?php include 'inc/menu.php'; ?>
			</nav>
		</header>
		<div id="container">
			<div class="clearfix">
				<div class="right col_1"><div class="content"><div id="content">
					<?php
						require 'inc/loader.php';
					?>
				</div></div></div>
				<div class="left col_2">
					<div class="box">
						<div class="boxTitle">USER PANEL</div>
						<div class="boxBody">
							<?php include 'inc/user_panel.php'; ?>
						</div>
					</div>
					<div class="box">
						<div class="boxTitle">RANKINGS</div>
						<div class="boxBody">
							<?php include 'inc/ranks.php'; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<p>Copyrights &copy; MeMoS</p>
		</footer>
	</div>
</body>
</html>