<?php
if(!isset($_SESSION['dt_username'])){
	$height='820';
}
else{
	$height='1200';
}
echo '<iframe frameBorder="0" align="center" height="'.$height.'px" width="590px" src="mod/auction/index.php" sandbox="allow-same-origin allow-scripts allow-popups allow-forms"></iframe>';
?>
