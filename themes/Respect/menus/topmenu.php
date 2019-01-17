<?php $set = web_settings();?>
	<div class="lnb_bx" >
			<aside class="starter_wrp">
			<a onclick="page('downloads')"><button type="button" class="btn_starter">
				<span class="front"></span>
				<span class="back02"></span>
				<span class="back03"></span>
				<span class="back04"></span>
			</button></a>
		</aside>
           <nav class="lnb_nav" id="GameNavi">
           <div class="menu_list"><h2><a href="?p=home" rel="" class=""><strong>Home</strong></a></h2></div>
           <div class="menu_list"><h2><a href="?p=register" rel="" class=""><strong>Registration</strong></a></h2></div>
           <div class="menu_list"><h2><a href="?p=topchars" rel="" class=""><strong>Rankings</strong></a></h2></div>
           <div class="menu_list"><h2><a href="<?php echo $set[18]?>" rel="" class=""><strong>Facebook</strong></a></h2></div>
           <div class="menu_list"><h2><a style='cursor:pointer'onclick="page('information')" rel="" class=""><strong>Information</strong></a></h2></div>
           <div class="menu_list"><h2><a href="#" rel="" class=""><strong>Rules</strong></a></h2></div>
         </nav>
	</div>