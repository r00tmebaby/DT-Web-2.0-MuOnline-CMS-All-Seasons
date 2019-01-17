<?php
lang();
$active1="";$active2="";$active3="";$active4="";$active5="";$active6="";$active7="";$active8="";$active9="";$active10="";$active11="";$active12="";$active13="";$active14="";$active15="";$active16="";$active17="";
if(isset($_GET['p'])){
	switch($_GET['p']){case "topchars":    $active1 ="active";break;case "hof":         $active2 ="active";break;case "topguilds":   $active3 ="active";break;case "topkillers":  $active4 ="active";break;case "banned":      $active5 ="active";break;case "mostonline":    $active6 ="active";break;case "topquests":    $active7 ="active";break;case "topbc":    $active8 ="active";break;case "topds":    $active9 ="active";break;case "topsky":    $active10="active";break;case "onlinenow":    $active11="active";break;case "admins":    $active12="active";break;case "topelf":    $active13="active";break;case "topdl":    $active14="active";break;case "topmg":    $active15="active";break;case "topbk":    $active16="active";break;case "topsm":    $active17="active";break;default:$active1="active";break;}
}
echo '
<div class="top_rank">The Top Players of the server are shown here </div> 	

	<div style="text-align:center;">
		<a href="javascript:;" onclick="window.location.href=\'?p=topchars\'"   class="btn active1     '.$active1 .'  border hvr-pulse"      id="players">Players</a>		
		<a href="javascript:;" onclick="window.location.href=\'?p=hof\'"        class="market_bottom_2 '.$active2 .' border hvr-pulse" id="hof">Hof</a>		
		<a href="javascript:;" onclick="window.location.href=\'?p=topguilds\'"  class="market_bottom_2 '.$active3 .' border hvr-pulse" id="guilds">Guilds</a>		
		<a href="javascript:;" onclick="window.location.href=\'?p=topkillers\'" class="market_bottom_2 '.$active4 .' border hvr-pulse" id="killers">Killers</a>										
	    <a href="javascript:;" onclick="window.location.href=\'?p=banned\'"     class="market_bottom_2 '.$active5 .' border hvr-pulse" id="banned" >Banned</a>		
		<a href="javascript:;" onclick="window.location.href=\'?p=mostonline\'" class="market_bottom_2 '.$active6 .' border hvr-pulse" id="tonline">Most Online</a>									
		<a href="javascript:;" onclick="window.location.href=\'?p=topquests\'"  class="market_bottom_2 '.$active7 .' border hvr-pulse" id="quest">Quest</a>		
		<a href="javascript:;" onclick="window.location.href=\'?p=topbc\'"      class="market_bottom_2 '.$active8 .' border hvr-pulse" id="bc">BC</a>		
		<a href="javascript:;" onclick="window.location.href=\'?p=topds\'"      class="market_bottom_2 '.$active9 .' border hvr-pulse" id="ds">DS</a>		
		<a href="javascript:;" onclick="window.location.href=\'?p=topsky\'"     class="market_bottom_2 '.$active10.' border hvr-pulse" id="sky">Sky Event</a>		
		<a href="javascript:;" onclick="window.location.href=\'?p=onlinenow\'"  class="market_bottom_2 '.$active11.' border hvr-pulse" id="onusers">Online Users</a>		
		<a href="javascript:;" onclick="window.location.href=\'?p=admins\'"     class="market_bottom_2 '.$active12.' border hvr-pulse" id="onusers">Administrators</a>
		<div class="top_rank">Class Rankings</div> 		                                                
		<a href="javascript:;" onclick="window.location.href=\'?p=topelf\'"     class="market_bottom_2 '.$active13.' border hvr-pulse" id="weekbc">Muse Elf</a>		
		<a href="javascript:;" onclick="window.location.href=\'?p=topdl\'"      class="market_bottom_2 '.$active14.' border hvr-pulse" id="weekds">Dark Lord</a>		
		<a href="javascript:;" onclick="window.location.href=\'?p=topmg\'"      class="market_bottom_2 '.$active15.' border hvr-pulse" id="weeksky">Magic Gladiator</a>		
		<a href="javascript:;" onclick="window.location.href=\'?p=topbk\'"      class="market_bottom_2 '.$active16.' border hvr-pulse" id="weekvoters">Blade Knight</a>		
		<a href="javascript:;" onclick="window.location.href=\'?p=topsm\'"      class="market_bottom_2 '.$active17.' border hvr-pulse" id="weekvoters">Soul Master</a>
	</div>
	';
?>
	
	<style>
.active{
	background:rgba(179,45,0,0.5);
	text-shadow:1px 1px #000;
}
</style>
	