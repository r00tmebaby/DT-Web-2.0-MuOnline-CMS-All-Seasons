
<ul>
	<li class="nav_text">MU ONLINE</li>
	<li><a onclick="page('downloads')">Download Client</a></li>
	<li><a onclick="page('halloffame')">Hall Of Fame</a></li>
	<li><a onclick="page('information')">Information</a></li>
	<li><a onclick="page('statistics')">Statistics</a></li>

	<li class="nav_text">Account</li>
	<li><a href="<?php echo (isset($_SESSION['dt_username'])) ? '?p=characters' : '?p=login' ; ?>">My Account</a></li>
	<li><a onclick="page('register')">Register</a></li>
	
	<li class="nav_text">News</li>
	<li><a href="?p=home">Game Notices</a></li>
	
	<li class="nav_text">Rankings</li>
	<li><a onclick="page('topchars')">Top Characters</a></li>
	<li><a onclick="page('grankings')">Top Guilds</a></li>
	<li><a onclick="page('rank-killers')">Top Killers</a></li>
	<li><a onclick="page('gamemasters')">Game Masters</a></li>
</ul>
