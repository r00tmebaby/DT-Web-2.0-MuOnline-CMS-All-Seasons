<?php 
$set = web_settings();
echo "
<div class='social_media_box'>
   <div class='media'>
      <a class='hvr-buzz-out' target='_blank' href='".$set[18]."'/><img onmouseover='this.src='".img_dir("facebook_on.png")."' onmouseout='this.src='".img_dir("facebook.png")."'; src='".img_dir("facebook.png")."'/></a>
      <a class='hvr-wobble-horizontal' target='_blank' href='".$set[19]."'/><img onmouseover='this.src='".img_dir("shop_on.png")."' onmouseout='this.src='".img_dir("shop.png")."'; src='".img_dir("shop.png")."'/></a>
      <a class='hvr-wobble-vertical' target='_blank' href='".$set[20]."' /><img onmouseover='this.src='".img_dir("tweeter_on.png")."' onmouseout='this.src='". img_dir("tweeter.png")."'; src='".img_dir("tweeter.png")."'/></a>
   </div>
</div>
";
?>