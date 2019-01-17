<link type="text/css" href="../themes/aion/css/skitter.css" media="all" rel="stylesheet" />
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../themes/aion/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../themes/aion/js/jquery.skitter.js"></script>

<script type="text/javascript" language="javascript">
$(document).ready(function(){$(".box_skitter_large").skitter({interval: 5000})});
</script>

<?php 
$check_banners = mssql_query("Select * from DTweb_Carousel_Settings");
$is_banner  = mssql_num_rows($check_banners);
$li = '';
$set = web_settings();
if($is_banner == 0){
	$news = "id=news_new";
	$class = ''; 
 }
 else{
	$news = "id=news"; 
	$class = 'class="box_skitter border box_skitter_large'; 
 }
for($i=0,$max = mssql_num_rows($check_banners); $i < $max; $i++){
    $banners =  mssql_fetch_array($check_banners);	

	$filename = 'imgs/banners/'.$banners['filename'];
	
	  if(file_exists($filename)){
	     $li  .= '<li>
			       <a  href="'.base64_decode($banners['link']).'"><img src="'. $filename .'" class="'.$banners['effect'] .'" /></a>
		   	       <div class="label_text"><p>'.base64_decode($banners['text']) .'</p></div>
		         </li>';
	  }
 }

$online = mssql_fetch_array(mssql_query("SELECT count(*) as count From MEMB_STAT where Connectstat='1'"));

if($stscheck = @fsockopen($set['server_ip'], $set['server_port'], $ERROR_NO, $ERROR_STR, (float)0.5)){
	$s = 'srv-online';
}
else{
	$srv_online = 'srv-offline';
}
echo'
<div class="vote_uptime">
            <div id="uptime">
                  <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="150" aria-valuemin="0" aria-valuemax="150" style="width:'.$online['count'].'%"></div>
				  '.$set[10]. phrase_max.'
			</div>
		    <div class="uptime_online">
		         <span style=" font-weight:900;font: 700 20px "Bitter"">'.$online['count'].'</span> '.phrase_characters_online.'
		    </div>
		    <div class="'.$srv_online.'"></div>
</div>
	   
<div id="vote">
       <div class="vote_text"> '.$set[23].'</div>
          <a class="vote_link_left" href="'.$set[21].'"/><u>XtremeTop 100</u></a>
          <a class="vote_link_right" href="'.$set[22].'"/><u>GTop 100</u></a>
       </div>
</div>

<div '.$class.'">
	<ul>
       '.$li.'
	</ul>
</div>

<div '.$news.'>';
include("mod/home.php"); 
echo '</div> '; 

?>
