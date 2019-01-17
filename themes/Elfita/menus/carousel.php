<?php 
 $li  = "";
$check_banners = mssql_query("Select * from DTweb_Carousel_Settings");
$is_banner  = mssql_num_rows($check_banners);
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
			       <a href="'.base64_decode($banners['link']).'"><img src="'. $filename .'" class="'.$banners['effect'] .'" /></a>
		   	       <div class="label_text"><p>'.base64_decode($banners['text']) .'</p></div>
		         </li>';
	  }
 }

echo'
<div '.$class.'">
	<ul>
       '.$li.'
	</ul>
</div>';

?>
