<?php
	$error = 0;
	$current_page = (isset($_GET['p'])) ? $_GET['p'] : 'home';
	
	$active_pages['home'] = 'home.php';
	$active_pages['register'] = 'register.php';
	$active_pages['login'] = 'user_panel.php';
	$active_pages['files'] = 'downloads.php';
	$active_pages['auction'] = 'auction.php';
	$active_pages['market'] = 'market/market.php';
	$active_pages['retrivepass'] = 'forgotenpass.php';
	$active_pages['user'] = 'user.php';
	$active_pages['banned'] = 'banned.php';
	//Rankings
	$active_pages['topchars'] = 'rankings/rank-characters.php';
	$active_pages['topguilds'] = 'rankings/rank-guilds.php';
	$active_pages['topkillers'] = 'rankings/rank-killers.php';
	$active_pages['lottorank'] = 'rankings/rank-r0toto.php';
	$active_pages['mostonline'] = 'rankings/rank-totaltime.php';
	$active_pages['topquests'] = 'rankings/rank-quests.php';
	$active_pages['topbc'] = 'rankings/rank-bc.php';
	$active_pages['topds'] = 'rankings/rank-ds.php';
	$active_pages['topsky'] = 'rankings/rank-sky.php';
	$active_pages['hof'] = 'rankings/rank-hof.php';
	$active_pages['admins'] = 'rankings/rank-admins.php';
    $active_pages['onlinenow'] = 'rankings/rank-online.php';
	$active_pages['topelf'] = 'rankings/rank-elf.php';
	$active_pages['topdl'] = 'rankings/rank-dl.php';
	$active_pages['topmg'] = 'rankings/rank-mg.php';
	$active_pages['topbk'] = 'rankings/rank-bk.php';
	$active_pages['topsm'] = 'rankings/rank-sm.php';

    //End

	
	
	if(isset($_SESSION['dt_username']) && isset($_SESSION['dt_password']))
	{  
        $active_pages['buyvip'] = 'user/vip/buyvip.php';
		$active_pages['buycredits'] = 'user/vip/buycredits.php';
        $is_admin = check_admin($_SESSION['dt_username']);
		if($is_admin == false){
		$active_pages['characters'] = 'user/characters.php';
		$active_pages['user'] = 'user.php';
		$active_pages['lotto'] = 'user/toto.php';		
		$active_pages['resetcharacter'] = 'user/reset_character.php';
		$active_pages['addstats'] = 'user/add_stats.php';
		$active_pages['pkclear'] = 'user/pk_clear.php';
		$active_pages['resetstats'] = 'user/reset_stats.php';
		$active_pages['grandreset'] = 'user/grand_reset.php';
		$active_pages['bank'] = 'user/zenbank.php';
		$active_pages['auction'] = 'auction.php';
		$active_pages['jewels'] = 'user/jewelbank.php';
		$active_pages['accdetails'] = 'user/info.php';
		$active_pages['buyjewels'] = 'user/buy_jewels.php';
		$active_pages['storage'] = 'user/storage.php';
		$active_pages['warehouse'] = 'user/merchant.php';
		$active_pages['banned'] = 'banned.php';
		}
		else{
		gm_box_timer($_SESSION['dt_username']);
		$active_pages['lotto'] = 'user/toto.php';
        $active_pages['warehouse'] = 'user/merchant.php';		
		$active_pages['storage'] = 'user/storage.php';
		$active_pages['buyjewels'] = 'user/buy_jewels.php';	
		$active_pages['changeaccdet'] = 'user/changedetails.php';
		$active_pages['accdetails'] = 'user/info.php';	
		$active_pages['jewels'] = 'user/jewelbank.php';
		$active_pages['characters'] = 'user/characters.php';
		$active_pages['resetcharacter'] = 'user/reset_character.php';
		$active_pages['addstats'] = 'user/add_stats.php';
		$active_pages['pkclear'] = 'user/pk_clear.php';
		$active_pages['resetstats'] = 'user/reset_stats.php';
		$active_pages['grandreset'] = 'user/grand_reset.php';
		$active_pages['bank'] = 'user/zenbank.php';
		$active_pages['storage'] = 'user/storage.php';
		$active_pages['auction'] = 'auction.php';
		/* + Admin modules */
		$active_pages['addnews'] = 'admin/add_news.php';
		$active_pages['general'] = 'admin/general.php';
		$active_pages['admauction'] = 'admin/auction_admin.php';
		$active_pages['accountedit'] = 'admin/accountedit.php';
		$active_pages['logs'] = 'admin/logs.php';
		$active_pages['addbox'] = 'admin/gm_boxadder.php';
		$active_pages['bans'] = 'admin/add_ban.php';
		$active_pages['banned'] = 'banned.php';
		}
		
	}	
	if(@$active_pages[$current_page] && file_exists('mod/' . $active_pages[$current_page]))
	{
		include('mod/' . $active_pages[$current_page]);	
	}
	else
	{
		
		echo '<p class="error">Page not found or you don&#39;t have the permission to access this page.</p>';
	}