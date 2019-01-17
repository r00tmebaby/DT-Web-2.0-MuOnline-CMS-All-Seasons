<!DOCTYPE HTML PUBLIC>
<?php $set = web_settings(); $message="";?>
<html>
  <head>
  <title><?php echo $set[0]?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="-1" />
  <meta http-equiv="Cache-Control" content="no-cache" />
   
  <link rel="canonical" href="index.html" />
  <meta name="author" content="r00tme DarksTeam.net" />
  <meta name="generator" content="DTWeb 2.0" />
  <meta name="keywords" content="<?php echo $set[1]?>" />
  <meta name="description" content="<?php echo $set[2]?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="shortcut icon" href="themes/Elfita/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="themes/Elfita/style.css" />
  	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<link type="text/css" href="themes/Elfita/skitter.css" media="all" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/jquery.skitter.js"></script>
	<script type="text/javascript" src="js/easyTooltip.js"></script>
	<script type="text/javascript">$(document).ready(function(){	$("[title]").easyTooltip();});</script>
    <script>var lang=new Array("Starts at","Open, starts at","Starts at","Hurry, left");</script>
    <script type="text/javascript" language="javascript">$(document).ready(function(){$(".box_skitter_large").skitter({interval: 5000})});</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

   </head>
	<body>
<div id='body_top'>
	<div id='body_bottom'>
		<div id='wrapper'>
			<div id='top_panel'>
				<div id='panel'>
					<div id='server'>
            <div id='co_status_new' style='display:none;'></div>
            <div id='po_status_new' style='display:none;'></div>
            <span>Status</span> 
            <?php 
			if($stscheck=@fsockopen($set[5], $set[6], $ERROR_NO, $ERROR_STR, (float)0.5))
	           { 
	           	$status='online.png';$nadpis = "<font color='#99ff99'>Online</font>";
	           	fclose($stscheck); 
	           }
			   else{
				$status='offline.png';$nadpis = "<font color='#ff4c4d'>Offline</font>";   
			   }
			
			?>
            <img src="themes/Elfita/design_img/<?php echo $status?>" alt=""><b><?php echo $nadpis?></b>			
          </div>
				<div id='support'>
				    <a href="https://siteheart.com/webconsultation/854765?" target="siteheart_sitewindow_854765" onclick="o=window.open;o('https://siteheart.com/webconsultation/854765?', 'siteheart_sitewindow_854765', 'width=550,height=400,top=30,left=30,resizable=yes'); return false;">Support</a>
				</div>
					<div  style='display:inline' >
                        <form style='display:inline' method="post" >
                          <input type="submit" value="en"  style='font-size:12px'  name="change_lang">
                          <input type="submit" value="bg"  style='font-size:12px' name="change_lang">
                        </form>
					</div>
				</div>
			</div>

<div id='header'><center><div class="logo"><?php echo $set[0] ?></div></center>
      	<object style='position:relative;z-index:1;' classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="980" height="323" id="980" >
      		<param name="allowScriptAccess" value="sameDomain" />
      		<param name="allowFullScreen" value="false" />
      		<param name="wmode" value="transparent"/>
      		<param name="movie" value="themes/Elfita/980.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#999999" />	<embed wmode="transparent" style='position:relative;z-index:1;' src="themes/Elfita/980.swf" quality="high" bgcolor="#999999" width="980" height="323" name="980"  allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
      	</object>
</div>
			<div id='menu_panel'>
              <?php include("menus/top_menu.php");?>
<div id='start'>
        <object style='position: relative;top: -14px;left: -14px;' codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="327" height="154" id="327x154" align="middle">
            <param name="allowScriptAccess" value="sameDomain" />
            <param name="allowFullScreen" value="false" />
            <param name="wmode" value="transparent"/>
            <param name="movie" value="themes/Elfita/327.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#999999" />	<embed wmode="transparent" src="themes/Elfita/327.swf" quality="high" bgcolor="#999999" width="327" height="154" name="327" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
        </object>
</div>
			</div>
			<div id='contents'>
				<div id='content_top'>
					<div id='content_bottom'>
						<div id='left_block'>
                           <?php 
						   
						    if(!isset($_SESSION['dt_username'])) {						   
							        if(isset($_POST['account'])&& isset($_POST['password'])){
										$store = do_login();										
										$message=  $store['error'][0];
									}
									
							   echo' <div style="color:white;margin-bottom:5px ;font-weight:600;text-align:center;text-shadow:1px 1px #000">'.$message.'</div>						   
                                <div id="login" class="block">
															
                                  <form method="post" name="uss_login_form">
								 
                                    <div class="in_input" align="right">
                                      <input type="text" name="account" maxlength="10">
                                    </div>
                                    <div class="in_input" align="right">
                                      <input type="password" name="password" maxlength="12">
                                      <input type="hidden" name="process_login">
                                    </div>
                                    <a href="?p=retrivepass" id="rem_link">Forgot Password?</a>
                                    <button name="apply" value="Login" type="submit" id="login_button" onclick="uss_login_form.submit();">Login</button> 
                                  </form>
                                </div>';                            
                            }
						   else{
						        echo '<div id="memb_top"></div>
								           <div id="left_box_body">'; 
           
                                        include("menus/user_panel.php");
								echo ' </div>
                                        <div id="left_box_bot"></div>';
						        }

							?>	
   <div id="game_menu_top"></div>
        <div id="left_box_body"> <?php include("inc/menu.php");?></div>
    <div id="left_box_bot"></div>
			
    <div id="server_stats_top"></div>
        <div id="left_box_body"> <?php include("menus/statistics.php"); ?></div>
	<div id="left_box_bot"></div>
	
	<div id="facebook_top"></div>
        <div id="left_box_body"></br></br>       
    <div class="fb-page" data-href="https://www.facebook.com/Muplayring/" data-tabs="timeline" data-width="250" data-height="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Muplayring/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Muplayring/">Muplayring</a></blockquote></div>
       </div>
<div id="left_box_bot"></div>
					
	<div id="market_top"></div>
        <div id="left_box_body"> 
             
    <table class='clear'>
      <tr class='title'>
	    <td>Item</td>
	    <td>Price</td>
	    <td>Seller</td>
	  </tr>
<?php 
    $check_items = mssql_query("Select Top 5 * from [DTweb_Market] where [is_sold] = 0 order by [start_date] desc");
    while($items = mssql_fetch_array($check_items)){
		$item = iteminfouser($items['item']);
		$chk_prices    = mssql_fetch_array(mssql_query("Select * from DTweb_Market where id = '".$items['id']."' and is_sold='0'"));
		$prices        = array(" Zen " => $chk_prices['zen']," Bless " => $chk_prices['bless']," Credits " => $chk_prices['credit']," Chaos " => $chk_prices['chaos']," Creation " => $chk_prices['creation']," Rena " => $chk_prices['rena']," Stone " => $chk_prices['stone']," Life " => $chk_prices['life']," Soul " => $chk_prices['soul']);
        $filter_prices = array_filter($prices);

echo"
<SCRIPT type='text/javascript' src='js/overlib.js'></SCRIPT>
    <tr>
       <td><img src=\"" . $item['thumb'] . "\" class=\"someClass\" title=\"<div align=center style=\'padding-left: 6px; padding-right:6px;font-family:arial;font-size: 10px;\'><span style=\'font-weight:bold;font-size: 11px; color:#FFFFFF;\'> </span> <br />" . $item['overlib'] . "   </font>    </span></div>\" alt=\"\" border=\"1\" /></td>
	   <td>";
	   	 foreach($filter_prices as $resource => $prices){
		  echo number_format($prices) . $resource . "</br>";
		 }
echo "</td>
      <td><a href='?p=market&seller=".$items['seller']."'>".$items['seller']."</a><td>
	</tr>
";
	}

?></table>
    </div>
    <div id="left_box_bot"></div>
			
            
	<div id="events_top"></div>
        <div id="left_box_body"> 
	    <div id="events"> 
		    <script type="text/javascript">
                var lang = {};
                lang[0]="Normal";
                lang[1]="Normal Ready";
                lang[2]="Custom";
                lang[3]="Custom Ready";
                //don't know what's lang
                var MuEvents = {};
                MuEvents.text = [
                    [lang[0], lang[1]],
                    [lang[2], lang[3]]
                ];
                MuEvents.sked = [
                ['Blood Castle', 0, '00:30', '02:30', '04:30', '06:30', '08:30', '10:30', '12:00', '14:30', '16:00', '18:30', '21:30', '22:30'],
                ['Chaos Castle', 0, '06:00', '12:00', '18:00', '24:00'],
                ['Devil Square', 0, '00:00', '02:00', '04:00', '06:00', '08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00', '22:00'],
                ['Illusion Temple', 0, '01:00','05:00', '09:00', '13:00', '17:00', '21:00'],
                ['White Wizard', 0, '07:00', '14:00', '21:00'],
                ['Golden Invasion', 0, '00:00', '02:00', '04:00', '06:00', '08:00', '10:00', '12:00', '14:00', '16:00', '18:00', '20:00', '22:00'],
                ['Red Dragon Invasion', 0, '11:00',  '23:00'],
                ['Skeleton King', 0, '01:00', '13:00'],
                ['Balgass Event', 0, '21:30'],
                ['Carnage Event', 1, '2:30','14:30'],
                ['HappyHour', 1, '15:00','23:00']
                ];
                MuEvents.init = function (e) {
                
                
                    if (typeof e == "string") var g = new Date(new Date().toString().replace(/\d+:\d+:\d+/g, e));
                    var f = (typeof e == "number" ? e : (g.getHours() * 60 + g.getMinutes()) * 60 + g.getSeconds()),
                        q = MuEvents.sked,
                        j = [];
                    for (var a = 0; a < q.length; a++) {
                        var n = q[a];
                        for (var k = 2; k < q[a].length; k++) {
                            var b = 0,
                                p = q[a][k].split(":"),
                                o = (p[0] * 60 + p[1] * 1) * 60,
                                c = q[a][2].split(":");
                            if (q[a].length - 1 == k && (o - f) < 0) b = 1;
                            var r = b ? (1440 * 60 - f) + ((c[0] * 60 + c[1] * 1) * 60) : o - f;
                            if (f <= o || b) {
                                var l = Math.floor((r / 60) / 60),
                                    l = l < 10 ? "0" + l : l,
                                    d = Math.floor((r / 60) % 60),
                                    d = d < 10 ? "0" + d : d,
                                    u = r % 60,
                                    u = u < 10 ? "0" + u : u;
                                j.push('<li class="events">' + (l == 0  && !q[a][1] && d < 5 ? '<img src="themes/Elfita/design_img/online.png" />' : '') +  '<b class="rightfloat">' + q[a][b ? 2 : k]  + "</b><b>" + n[0] + '</b><span><div class="rightfloat">' + (l + ":" + d + ":" + u) + "</div>"  +(MuEvents.text[q[a][1]][+((l == 0 &&  d <(q[a][1] ? 1 : 5)))])+ "</span>") ;
                                break;
                            };
                        };
                    };
                	
                    document.getElementById("events").innerHTML = j.join("");
                    setTimeout(function () {
                        MuEvents.init(f == 86400 ? 1 : ++f);
                    }, 1000);
                };
            
            </script> 
	    </div>


	<script>
	var cDate = new Date();
	var current_time_str = cDate.getHours()+":"+ cDate.getMinutes()+":"+ cDate.getSeconds();
	window.onload=MuEvents.init(current_time_str);
	</script>

</div>
<div id="left_box_bot"></div>
            
            
    <div id="player_top"></div>
        <div id="left_box_body"><br></br>

	    <table class='clear' border='0' align="center">
                        <tr class='title'>
                          <td><div align="center">N.</div></td>
                          <td><div align="center">Name</div></td>
                          <td><div align="center">Level</div></td>
                          <td><div align="center">RR</div></td>
                          <td><div align="center">GR</div></td>
                        </tr>
            <?php
			$i= 0;
             $select_chars = mssql_query("Select TOP 5 * from [Character] order by [Resets] desc");
                  while($top_chars  = mssql_fetch_array($select_chars)){
					  $i++;
					 echo 
					 "
					   <tr>
					      <td>{$i}</td>
						  <td><a href='?p=user&character=".$top_chars['Name']."'>".$top_chars['Name']."</a></td>
						  <td>{$top_chars['cLevel']}</td>
						  <td>{$top_chars['Resets']}</td>
						  <td>{$top_chars['GrandResets']}</td>
					    </tr>
					 "; 
				    }
			 ?>			
        </table>      
    </div>
    <div id="left_box_bot"></div>

<div id="guild_top"></div>
            <div id="left_box_body"> 
              <br></br> 		
 <table class='clear' border='0' align="center">
                <tr class='title'>
                  <td><div align="center">N.</div></td>
                  <td><div align="center">Name</div></td>
                  <td><div align="center">Logo</div></td>
                  <td><div align="center">Memb.</div></td>
                  <td><div align="center">Score</div></td>		  
                </tr>
            <?php
             $select_guild = mssql_query("Select TOP 5 * from [Guild] order by [G_Score] desc");
                  for($i=1; $i<mssql_num_rows($select_guild)+1;$i++){
					$top_guild  = mssql_fetch_array($select_guild);
					$total_players = mssql_num_rows(mssql_query("Select * from GuildMember where G_Name='".$top_guild['G_Name']."'"));
					 echo 
					 "	
					    <tr>
					      <td>{$i}</td>
						  <td>{$top_guild['G_Name']}</td>
						  <td>{$top_guild['cLevel']}</td>
						  <td>{$total_players}</td>
						  <td>{$top_guild['G_Score']}</td>
					    </tr>
					 "; 
				    }
			 ?>	
                </table>            </div>
            <div id="left_box_bot"></div>
              
							
</div>
	<div id='right_block'>
		<div id='content_p'>
                <div id='slider_block'>
                    <div id="slider-wrapper">
                      <div id="slider" class="nivoSlider">
                          <?php include("menus/carousel.php");?>
                      </div>							
                    </div>
                  </div>
				  	<div class="tmp_m_content"> 
                    <div class="tmp_page_content">	
                        <div id='content'>				
                 	        <?php 							  
					            if(isset($_GET['p']) && !empty($_GET['p'])){
									  
                                        switch($_GET["p"]){
                                        case "home": include("mod/home.php");	break;			
                                        default: include("inc/loader.php"); break;
					                   } 
																	
					        	}
                                else{
                                	 include("mod/home.php");
                                }						
					        ?>
		                </div>	
                    </div> 
                </div>                             	            
                <div style="clear: both"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id='footer'>
				<div id='f_menu'>
					<div>
						<a href="?p=home">News</a>
						<a href="?p=register">Register</a>
						<a href="?p=downloads">Download</a>
						<a href="?p=rules">Rules</a>
			    </div>
				<div>
						<a href="?p=topchars">Rankings</a>
						<a href="?p=statistic">Statistics</a>
						<a href="?p=market">Market</a>
						<a href="?p=forum">Forum</a>
				</div>
			</div>

				<div id='f_copyright'>
					Copyright &copy; 2016 
				<a href="http://darksteam.net/releases/22207-release-dtweb-2-0-release-r00tme-version.html">DTWeb 2.0</a> <br>All rights reserved.</br>Template by <b> r00tme</b>
          
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>