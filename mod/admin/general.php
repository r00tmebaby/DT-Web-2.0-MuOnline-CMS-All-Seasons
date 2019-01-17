<div class='afix battle_tap title'>
   <a class="border market_bottom_2 hvr-pulse" href="?p=general"><?PHP print phrase_main_config ?></a>  
   <a class="border market_bottom_2 hvr-pulse" href="?p=general&depositconf"> <?PHP print phrase_deposit_config ?></a>         
   <a class="border market_bottom_2 hvr-pulse" href="?p=general&auctionconf"><?PHP print phrase_auction_config ?></a>		    
   <a class="border market_bottom_2 hvr-pulse" href="?p=general&marketconf"><?PHP print phrase_market_config ?></a>
   <a class="border market_bottom_2 hvr-pulse" href="?p=general&banner"><?PHP print phrase_slider_config ?></a>
   <a class="border market_bottom_2 hvr-pulse" href="?p=general&toto"><?PHP print phrase_r0toto_config ?></a>
   <a class="border market_bottom_2 hvr-pulse" href="?p=general&buyjewels"><?PHP print phrase_buyjewels_config ?></a>
</div>
<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>	

<script>
function clean(el){
	var textfield = document.getElementById(el);
	var regex = /[^a-z 0-9?!.,]/gi;
	if(textfield.value.search(regex) > -1) {
		textfield.value = textfield.value.replace(regex, "");
        }
}
</script>
<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
$themes = '';
$sel    = '';
$sel1  = '';

if(isset($_GET['auctionconf'])){
	include("mod/admin/auction_admin.php");
}
elseif(isset($_GET['marketconf'])){
	include("mod/admin/market_admin.php");
}
elseif(isset($_GET['depositconf'])){
    include("mod/admin/jewel_admin.php");
}
elseif(isset($_GET['banner'])){
    include("mod/admin/add_slider.php");
}
elseif(isset($_GET['toto'])){
    include("mod/admin/r0toto.php");
}
elseif(isset($_GET['buyjewels'])){
    include("mod/admin/buyjewels_admin.php");
}
else{
  if(isset($_POST['submit'])){
     if($_POST['topc_row']  == 0   || $_POST['topg_row'] == 0  || $_POST['topk_row'] == 0){
		echo "<div class='alert alert-warning'>Rankings fields can not be 0</div>";
	 }
   else{	 
	   mssql_query("Update [web_settings] set
	              [title]             = '".base64_encode($_POST['title'])."'
                 ,[keywords]          = '".base64_encode($_POST['keywords'])."'
                 ,[meta]              = '".base64_encode($_POST['description'])."'
                 ,[theme]             = '".clean_post($_POST['theme'])."'
                 ,[server_name]       = '".base64_encode($_POST['name'])."'
                 ,[server_ip]         = '".base64_encode($_POST['ip'])."'
                 ,[server_port]       = '".base64_encode($_POST['port'])."'
                 ,[server_version]    = '".base64_encode($_POST['version'])."'
                 ,[server_host]       = '".base64_encode($_POST['host'])."'
                 ,[server_exp]        = '".base64_encode($_POST['experience'])."'
                 ,[server_max]        = '".base64_encode($_POST['max'])."'
                 ,[server_drop]       = '".base64_encode($_POST['drop'])."'
                 ,[topcchar]          = '".(int)clean_post($_POST['topc_row'])."'
                 ,[topcharpage]       = '".(int)clean_post($_POST['topc_page'])."'
                 ,[topguild]          = '".(int)clean_post($_POST['topg_row'])."'
                 ,[topguildpage]      = '".(int)clean_post($_POST['topg_page'])."'
                 ,[topkills]          = '".(int)clean_post($_POST['topk_row'])."'
                 ,[topkillspage]      = '".(int)clean_post($_POST['topk_page'])."'
                 ,[facebook_link]     = '".base64_encode($_POST['feed_link1'])."'
                 ,[tweeter_link]      = '".base64_encode($_POST['feed_link2'])."'
                 ,[shop_link]         = '".base64_encode($_POST['feed_link3'])."'
                 ,[vote_link1]        = '".base64_encode($_POST['vote_link_1'])."'
                 ,[vote_link2]        = '".base64_encode($_POST['vote_link_2'])."'
                 ,[vote_text]         = '".base64_encode($_POST['vote_text'])."'  
	   ");
     }
	   refresh();
   
   }
        $check_all = mssql_fetch_array(mssql_query("Select * from [DTweb_settings]"));
		
		$directory = ('themes'); 
        $set = web_settings();		
        foreach (scandir($directory) as $file) {
            if ('.' === $file) continue;
            if ('..' === $file) continue;  
            if ('index.html' === $file) continue; 	
          	if($set[3] == $file){$selected = "selected";}else{$selected = "";}
            $themes .= "<option ".$selected."  value='".$file."'>".$file."</option>";
           }
		   $ver = base64_decode($check_all['server_version']);
		   switch($ver){case "97d": $sel = "selected";break;case "99t":$sel1 = "selected";break;default: $sel1 = "selected";break;}
		echo "
		
		    <table class='form' style='font-size:12pt;text-align:left'>
			<form  name='".form_enc()."' class='form' method='post'>
			<input class='button' type='submit' value='".phrase_update."' name='submit'/>
		        <tr class='title'><td style='text-align:center' colspan='2'>".phrase_web_settings."</td></tr>
				    <tr><td title='<div class=admin-title><span>".phrase_web_title.": </span> ".phrase_web_titles."'>".phrase_web_title."</td><td><input type='text' class='fields' value='".base64_decode($check_all['title'])."' name='title'/></td></tr>
                    <tr><td title='<div class=admin-title><span>".phrase_web_description.": </span> ".phrase_web_descriptions."'>".phrase_web_description."</td><td><input type='text' class='fields' value='".base64_decode($check_all['meta'])."' name='description'/></td></tr>
                    <tr><td title='<div class=admin-title><span>".phrase_web_keywords.": </span> ".phrase_web_keywordss."'>".phrase_web_keywords."</td><td><input type='text' class='fields' value='".base64_decode($check_all['keywords'])."' name='keywords'/></td></tr>
                    <tr><td title='<div class=admin-title><span>".phrase_web_theme.": </span> ".phrase_web_themes."'>".phrase_web_theme."</td>
					<td><select name='theme'>".$themes."</select></td></tr>
				<tr class='title'><td style='text-align:center' colspan='2'>".phrase_server_settings."</td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_server_name.": </span> ".phrase_server_names."'>".phrase_server_name."</td><td><input type='text' class='fields' value='".base64_decode($check_all['server_name'])."' name='name'/></td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_server_ip.": </span> ".phrase_server_ips."'>".phrase_server_ip."</td><td><input type='text' class='fields' value='".base64_decode($check_all['server_ip'])."' name='ip'/></td></tr>
					<tr><td title='<div class=admin-title><span> ".phrase_server_port.": </span> ".phrase_server_ports."'>".phrase_server_port."</td><td><input type='text' class='fields' value='".base64_decode($check_all['server_port'])."' name='port'/></td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_server_host.": </span> ".phrase_server_hosts."'>".phrase_server_host."</td><td><input type='text' class='fields' value='".base64_decode($check_all['server_version'])."' name='host'/></td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_server_version.": </span> ".phrase_server_versions."'>".phrase_server_version."</td><td>
					<select style='width:150px;'name='version'/><option ".$sel." value='97d'>DarksTeam 97D</option><option ".$sel1." value='99t'>DarksTeam 99T</option></select>					</td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_server_experience.": </span> ".phrase_server_experiences."'>".phrase_server_experience."</td><td><input type='text' class='fields' value='".base64_decode($check_all['server_exp'])."' name='experience'/></td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_server_drop.": </span> ".phrase_server_drops."'>".phrase_server_drop."</td><td><input type='text' class='fields' value='".base64_decode($check_all['server_drop'])."' name='drop'/></td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_server_max.": </span> ".phrase_server_maxs."'>".phrase_server_max."</td><td><input type='text' class='fields' value='".base64_decode($check_all['server_max'])."' name='max'/></td></tr>
				<tr class='title'><td style='text-align:center' colspan='2'>".phrase_ranking_pagination."</td></tr>
				    <tr><td title='<div class=admin-title><span> ".phrase_top_chars_ranking." </span> ".phrase_top_chars_rankings."'>".phrase_top_chars_ranking."</td>
					<td>
					<input type='number' min='1' class='field' value='".($check_all['topcharpage'])."' name='topc_page'/>
					<input type='number' min='1'  min='1' class='field' value='".($check_all['topcchar'])."' name='topc_row'/>
					</td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_top_killers_ranking.": </span>".phrase_top_killers_rankings."'>".phrase_top_killers_ranking."</td><td>
					<input type='number' min='1'  class='field' value='".$check_all['topkillspage']."' name='topk_page'/>
					<input type='number' min='1'  class='field' value='".$check_all['topkills']."' name='topk_row'/></td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_top_guild_ranking.": </span> ".phrase_top_guilds_rankings."'>".phrase_top_guild_ranking."</td><td>
					<input type='number' min='1'  class='field' value='".($check_all['topguildpage'])."' name='topg_page'/>
					<input type='number' min='1' class='field' value='".($check_all['topguild'])."' name='topg_row'/></td></tr>	
				<tr class='title'><td style='text-align:center' colspan='2'>".phrase_feedback_links."</td></tr>
				    <tr><td title='<div class=admin-title><span> ".phrase_facebook_link." : </span>".phrase_facebook_links."'>".phrase_facebook_link."</td><td><input type='text' class='fields' value='".base64_decode($check_all['facebook_link'])."' name='feed_link1'/></td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_your_link." : </span> ".phrase_your_links."'>".phrase_your_link."</td><td><input type='text' class='fields' value='".base64_decode($check_all['tweeter_link'])."' name='feed_link2'/></td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_tweeter_link." : </span> ".phrase_tweeter_links."'>".phrase_tweeter_link."</td><td><input type='text' class='fields' value='".base64_decode($check_all['shop_link'])."' name='feed_link3'/></td></tr>	
				<tr class='title'><td style='text-align:center' colspan='2'>".phrase_vote_panel."</td></tr>
				    <tr><td title='<div class=admin-title><span> ".phrase_xteme_vote.": </span> ".phrase_xtreme_link."'>".phrase_xteme_vote."</td><td><input type='text' class='fields' value='".base64_decode($check_all['vote_link1'])."' name='vote_link_1'/></td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_gtop_vote.": </span> ".phrase_gtop_link."'>".phrase_gtop_vote."</td><td><input type='text' class='fields' value='".base64_decode($check_all['vote_link2'])."' name='vote_link_2'/></td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_vote_panel.": </span> ".phrase_text_vote_panel."'>".phrase_vote_panel." </td><td><input type='text' class='fields' value='".base64_decode($check_all['vote_text'])."' name='vote_text'/></td></tr>
				<tr><td align='center' colspan='20'>
				<input class='button' type='submit' value='".phrase_update."' name='submit'/></td></tr>
			  </form>		
		    </table>
		
			
		";
 
}
}
?>

<style>
.fields{
margin-left:10px;
margin-top:10px;
min-width:450px;
}
.field{
margin-top:10px;
min-width:80px;
}
</style>