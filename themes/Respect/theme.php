<!DOCTYPE html>
<?php $set = web_settings(); ?>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta name="keywords" content="<?php echo $set[1]?>"/>
    <meta name="description" content="<?php echo $set[2]?>"/>
    <title><?php echo $set[0]?></title>
	<link href="themes/Respect/css/engine.css" rel="stylesheet">
	<link rel="stylesheet"href="themes/Respect/css/style.css"type="text/css"/>
    <link rel="shortcut icon"href="themes/Respect/images/favicon.ico"/>
	<link href='https://fonts.googleapis.com/css?family=Cinzel+Decorative:400,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/servertime.js"></script>
	<script type="text/javascript" src="js/easyTooltip.js"></script>
	<script type="text/javascript" src="js/overlib.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){	
			$("[title]").easyTooltip();
		});
	</script>

	
</head>
<body id="game_code_a2">
<section class="gnb_one_wrp game_gnb">
	
<div class="gnb_one_bx">		
<?php include("menus/topnav.php")?>       
    <article class="user_conect_wrp">		    
            <div class="user_conect">		
               <div class="user_join_before"><span class="stime" id="timer"></span></div>
            </div>		    
    </article>
</div>
</section>
<header id="g_header_bar"></header>
<section class="main_roll_wrp">
    <div class="visual_wrp">
        <div class="visual_view"><div class="logo"><?php echo $set[0] ?></div>
    		<!-- s:GMT -->
    			    <div class="sns_wrap1" >
                        <form method="post" >
                           <span><input type="submit" value="bg" class="bg"   style='font-size:0.1px' name="change_lang"></span>
                           <span><input type="submit" value="en"  class="en" style='font-size:0.1px' name="change_lang"></span>
                       </form>
    			   </div>
    		<!-- e:GMT -->
    		<ul class="sns_wrap">
    			<li><a href="<?php echo $set[19]?>" class="sp_sns twt" target="_blank" rel="nofollow">Twitter</a></li>
    			<li><a href="<?php echo $set[18]?>" class="sp_sns face" target="_blank" rel="nofollow">Facebook</a></li>
    			<li><a href="#" class="sp_sns tube" target="_blank" rel="nofollow">Youtube</a></li>
    		</ul>
    	</div>
    </div>

<div class="lnb_wrp"><?php include("menus/topmenu.php");?></div>
 <div class="site_line_wrp">
	<div class="contents_wrp">
        <article class="contents_area_wrp">
            <div id="content">

                <div id="box1">       
                            <?php 
		        			    if(isset($_GET['p'])){
                                      switch(trim($_GET['p'])){
                                         case "home":echo "<div class='title1'> NEWS</div>"; include("mod/home.php");break;			
                                         default:include("menus/user_panel.php");break;
		        			        }   					
		        				}
                                else{
                                	 include("mod/home.php");
                                }	
		        		    ?>			
                </div>
            </div>
        </article>	
		<div class="side_area_wrp">
        <aside class="user_wrap">
                <a onclick="window.location.href='?p=register'" class="btn_login"><span>Register</span></a>
        </aside>
<article class="battle_wrp">
    <h3>Account Panel</h3>
            <div style="margin-bottom: 16px;border-bottom: 1px solid #e5e5e5;"></div>
</article>
			<div class="box-style2">
              <div class="entry">
                <div>
                  <?php
				    if(!isset($_SESSION['dt_username'])) {							   
							        if(isset($_POST['account'])&& isset($_POST['password'])){
										$store = do_login();
										
										$message=  $store['error'][0];
									}
									
							   echo' <div style="color:white;margin-bottom:5px ;font-weight:600;text-align:center;text-shadow:1px 1px #000">'.$message.'</div>						   
                                <div id="login" class="block">													
                                <form id="login_form" method="post">
                                    <input type="text" name="account" id="login_input" maxlength="10" class="input-main" style="width:182px;" placeholder="Username" value=""/>
                                    <input type="password" name="password" id="password_input" maxlength="20" class="input-main" style="width:182px;" placeholder="Password" value=""/>
                                    <div style="margin-left:15px">
                                        <input type="submit" id="submit" value="Login" class="button-style" style="border:none;cursor:pointer "/>
                                    </div>
                                </form>
								 <a onclick="window.location.href="?p=retrivepass"">Lost Password?</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="?p=registration">Registration</a><br/><br/>
                                </div>';                            
                            }
						   else{
						        echo '<div id="memb_top"></div>
								           <div id="left_box_body">'; 
           
                                        include("inc/user_panel.php");
								echo ' </div>
                                        <div id="left_box_bot"></div>';
						        }		  
				  ?>				
             </div><br/><br/>
        </div>
    </div>
	 <?php 
		if($stscheck=@fsockopen($set[5], $set[6], $ERROR_NO, $ERROR_STR, (float)0.5))
	       { 
	       	$status='online.png';$nadpis = "<font color='#99ff99'>Online</font>";
	       	fclose($stscheck); 
	       }
		   else{
			$status='offline.png';$nadpis = "<font color='#ff4c4d'>Offline</font>";   
		   }
		$online = mssql_num_rows(mssql_query('SELECT ConnectStat FROM MEMB_STAT WHERE ConnectStat > 0'));	
	?>
	<article class="history_wrp">
                <h3><strong class="point">Server</strong> Status<a onclick="page('statistics')" class="more" rel="">more</a></h3>
                <div class="server_bx">
     		        <div class="server" id="s1_online">
			            <a onclick="page('information')"><?php echo "v.".$set[7]."/&nbsp;".$set[9]?></a><br>
			            <span style="color: #27c460"><?php echo $nadpis."&nbsp;(".$online. ")"?></span>
		            </div>
	            </div>              
    </article>
<article class="history_wrp">
                <h3><strong class="point">Top</strong>Players<a href="?p=topchars" class="more" rel="">more</a></h3>
                <div class=" server_bx">
     
	    <table class='ranking_tbl' align="center">
                        <tr class='title'>
                          <td><div align="center">N.</div></td>
                          <td><div align="center">Name</div></td>
                          <td><div align="center">Level</div></td>
                          <td><div align="center">RR</div></td>
                          <td><div align="center">GR</div></td>
                        </tr>
            <?php
             $select_chars = mssql_query("Select TOP 5 * from [Character] order by [Resets] desc");
                  while($top_chars  = mssql_fetch_array($select_chars)){
					  $i++;
					 echo 
					 "
					   <tr>
					      <td>{$i}</td>
						  <td><a href='?p=user&character={$top_chars['Name']}'>{$top_chars['Name']}</td>
						  <td>{$top_chars['cLevel']}</td>
						  <td>{$top_chars['Resets']}</td>
						  <td>{$top_chars['GrandResets']}</td>
					    </tr>
					 "; 
				    }
			 ?>			
        </table>      
							
				</div>
				
        
        
            </article>
<br>
<center>


</center>
          
</div></div>
    

     
        <div class="sitemap_wrp" id="SiteMap">
<h1><span>All Rights Reserved. DT Web 2.0 Template coded by r00tme</span></h1>
<nav>
<div class="menu_list"><h2><span>Home</span></h2>
<ul id="gameSlideNav01">
							<li><a href="index.html">Announcements</a></li><br>
                            <li>         <a href="?p=home">News</a></li>
							<li>         <a href="#">Updates</a></li>
							<li>         <a href="#">Events</a></li>
</ul>
</div>
<div class="menu_list"><h2><span>Rankings</span></h2>
<ul id="gameSlideNav02">
                            <li><a href="?p=topchars">Players</a></li>
							<li><a href="?p=topguild">Guilds</a></li>
							<li><a href="rankings.html">Killers</a></li>
							<li><a href="rankings.html">Voters</a></li>
</ul>
</div>
<div class="menu_list"><h2><span>Support</span></h2>
<ul id="gameSlideNav03">
                            <li><a href="#" title="????">Account</a></li>
							<li><a href="#" title="????">Players</a></li>
							<li><a href="#" title="????">Hackers</a></li>
							<li><a href="#" title="????">Donations</a></li>
</ul>
</div>

</nav>
	</div>

</body>

</html>