<?php
	if(isset($_SESSION['dt_username']) && isset($_SESSION['dt_password'])):
?>
<ul class="side_menu">
	<li class="nav_text">Welcome <span style="color:#890000;font-weight:bold;"><?php echo $_SESSION['dt_username']; ?></span></li>
	<li><a href="?p=characters">Characters</a></li>
	<li><a href="?p=resetcharacter">Reset Character</a></li>
	<li><a href="?p=addstats">Add Stats</a></li>
	<li><a href="?p=pkclear">PK Clear</a></li>
	<li><a href="?p=resetstats">Reset Stats</a></li>
	<li><a href="?p=grandreset">Grand Reset</a></li>
	<li><a href="?p=market">Web Market</a></li>
	<li><a href="?p=logout">Logout</a></li>
</ul>
<?php
	else:
?>
<div class="login_form">
	<h4>User Panel</h4>
	<form action="?p=login" method="post">
		<ul class="form">
			<li>
				<label for="acc">Account: </label>
				<input id="acc" name="account" type="text" maxlength="10" />
			</li>
			<li>
				<label for="pass">Password: </label>
				<input id="pass" name="password" type="password" maxlength="10" />
			</li>
			<li class="buttons">
				<input name="login" type="submit" value="Login" />
				<input type="button" onclick="window.location.href='?p=register'" value="Sign UP" />
			</li>
		</ul>
	</form>
</div>
<?php
	endif;
?>