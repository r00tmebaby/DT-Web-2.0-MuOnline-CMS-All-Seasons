<!DOCTYPE html>
<?php $set = web_settings(); ?>
<head>
	<meta charset="UTF-8">
    <meta name="keywords" content="<?php echo $set[1]?>"/>
    <meta name="description" content="<?php echo $set[2]?>"/>
	<title><?php echo $set[0]?></title>
	<link rel="shortcut icon" href="themes/Legend/images/favicon.ico" /> 
	<link href="themes/Legend/css/style.css" rel="stylesheet" type="text/css">
	<link href="themes/Legend/css/engine.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/easyTooltip.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/servertime.js"></script>
		<script type="text/javascript" src="js/overlib.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){	
			$("[title]").easyTooltip();
		});
	</script>
		<script src="themes/Legend/js/jquery.tinycarousel.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$('#slider1').tinycarousel();
			});
		</script>
		<script>
			$(document).ready(function(){   
				$(window).scroll(function () {
					if ($(this).scrollTop() > 0) {
						$('#top').fadeIn();
					} else {
						$('#top').fadeOut();
					}
				});
				$('#top').click(function () {
					$('body,html').animate({
						scrollTop: 0
					}, 400);
					return false;
				});
			});
		</script>
	</head>
	<body>
		<header class="header">
			<div id="general">
    			    <div class="sns_wrap1" >
                        <form method="post" >
                           <span><input type="submit" value="bg" class="bg"   style='font-size:0.1px' name="change_lang"></span>
                           <span><input type="submit" value="en"  class="en" style='font-size:0.1px' name="change_lang"></span>
                       </form>
    			   </div>
				<div class="wrapper">
					<menu>
						<li ><a class="forum" onclick="window.location.href='?p=home'" class="home"><?php echo phrase_news?></a></li>
						<li ><a class="forum" onclick="page('statistics')"><?php echo phrase_statistic?></a></li>
						<li ><a class="forum" onclick="page('statistics')" ><?php echo phrase_download?></a></li>
						<li ><a class="forum" onclick="window.location.href='?p=topchars'" ><?php echo phrase_ranking?></a></li>
						<li ><a class="forum" onclick="window.location.href='?p=market'"><?php echo phrase_market?></a></li>
						<li ><a class="forum" onclick="window.location.href='?p=auction'"><?php echo phrase_auction?></a></li>
						<li ><a class="forum" onclick="window.location.href='?p=banned'"><?php echo phrase_banned?></a></li>
					</menu>
					<div class="lk right"><a onclick="window.location.href='?p=retrivepass'">Lost Password  ?</a></div>
				</div>
			</div>
			<section class="head">
				<div class="wrapper">
        <div class="logo"><?php echo $set[0] ?></div>
					<div class="right-box right">				
						<div class="timer">
							<div class="right"></div>
						</div>					
						<div class="bot right">
							<a onclick="window.location.href='?p=register'" class="bot1">Create New Account</a>
							<a onclick="window.location.href='?p=files'" class="bot1"><?php echo phrase_download?></a>
						</div>
					</div>
				</div>
			</section>
		</header>
		<!-- .header-->
		<div class="wrapper">
			<div class="middle">
				<div class="page_wrap">
					<div class="container">
						<div class="cont">
							<div class="cont_cent">
								<main class="content">
									<p class="wr_title forum"><?php echo $set[4]?></p>
									<section class="shop">
										<!-- тут карусель -->
											<div class="shop_home clear_fix">
												<div id="slider1">
													<a class="buttons prev prew_shop" ></a>
													<div class="viewport">
														<div class="shop_wrapp">
															<ul class="overview" style="width: 1290px; left: -172px;">			
							                                	<li><a href="http://www.darksteam.net"><img src="themes/Legend/images/1.jpg"></a></li>
							                                	<li><a href="http://www.darksteam.net"><img src="themes/Legend/images/2.jpg"></a></li>
							                                	<li><a href="http://www.darksteam.net"><img src="themes/Legend/images/3.jpg"></a></li>														
                                                            </ul>
														</div>
													</div>
													<a class="buttons next next_shop"></a>
												</div>
											</div>
									</section>
									<img src="themes/Legend/images/news-title.jpg" class="wr_title">
									<br><br><article class="post clear_fix">	
<br>
		<div class="post_wrapp">
		        <div id='content'>
                       	    <?php 							          			  
	                             include("menus/user_panel.php");		        			         					
		        				
if($stscheck=@fsockopen($set[5], $set[6], $ERROR_NO, $ERROR_STR, (float)0.5))
   { 
   	$status='online.png';$nadpis = "<font color='#99ff99'>Online</font>";
   	fclose($stscheck); 
   }
   else{
	$status='offline.png';$nadpis = "<font color='#ff4c4d'>Offline</font>";   
   }
$online = mssql_num_rows(mssql_query('SELECT ConnectStat FROM MEMB_STAT WHERE ConnectStat > 0'));	
$select_chars = mssql_fetch_array(mssql_query("Select TOP 1 * from [Character] order by [Resets] desc"));
$select_guild = mssql_fetch_array(mssql_query("Select TOP 1 * from [Guild] order by [G_Score] desc"));								
					        ?>
				</div>
		</div>
    <br>
											</article>
									</section>
								</main><!-- .content -->
							</div>
						</div>
					</div><!-- .container-->
					<aside class="right-sidebar">					
						<div class="sta_box_top">
							<div class="ss_title"><img src="themes/Legend/images/stats.png"></div>							
							<div class="sta_cont_top sta_cont_bf">
								<div id="col2" style="height:162px;">									
									<p style="padding: 3px;margin: 3px auto;background: rgba(0, 0, 0, 0.11);width: 225px;">Status:<span style="float: right;" id="sStatus">&nbsp;<?php echo $nadpis?></span></p>
									<p style="padding: 3px;margin: 3px auto;background: rgba(0, 0, 0, 0.11);width: 225px;">In Game:<span style="float: right;" id="sOnline">&nbsp; <?php echo $online?></span></p>
									<p style="padding: 3px;margin: 3px auto;background: rgba(0, 0, 0, 0.11);width: 225px;">Top Player:<a id="sPlayerLink" href="?p=user&character=<?php echo $select_chars['Name']?>"><span style="float: right;" id="sPlayer">&nbsp;<?php echo $select_chars['Name']?></span></a></p>
									<p style="padding: 3px;margin: 3px auto;background: rgba(0, 0, 0, 0.11);width: 225px;">Top Guild:<a id="sGuildLink" href="?p=user&profile=<?php echo $select_guild['G_Name']?>"><span style="float: right;" id="sPlayer">&nbsp;<?php echo $select_guild['G_Name']?></a></p>	
									<p style="padding: 3px;margin: 3px auto;background: rgba(0, 0, 0, 0.11);width: 225px;">Server Time: <span style="float: right;" class="stime" id="timer"></span>
								</div>
							</div>
					<div class="sta_foot mar0"></div>
				</div>
		<div class="sb_top">
				<div class="ss_titlefor"><img src="themes/Legend/images/account.png"></div>
				   <div class="sta_cont_top">
					    <div class="forum_home">									
				            <div style="text-align:center;margin:0 auto;">
		                       <div></div>
							<?php 						   
						    if(!isset($_SESSION['dt_username'])) {						   
							        if(isset($_POST['login'])&& isset($_POST['account'])&& isset($_POST['password'])){
										
										$store = do_login();										
										$message=  $store['error'][0];
									}
									
							   echo' 
							   <div style="color:white;margin-bottom:5px ;font-weight:600;text-align:center;text-shadow:1px 1px #000">'.$message.'</div>						   
                                <div id="login" class="block">									
			                      <form method="post" >	
				                    <input type="text" name="account" id="login_input" maxlength="10" class="input-main" style="width:182px;" placeholder="Username" />			
				                    <input type="password" name="password" id="password_input" maxlength="20" class="input-main" style="width:182px;" placeholder="Password" />
				                        <div style="margin-left:15px">
				                        	<input name="login" type="submit" id="submit" value="Login" class="button-style" style="border:none;cursor:pointer" />
				                        </div>
			                      </form>
								  
                                </div>
								<a onclick="window.location.href=\'?p=retrivepass\'">Lost Password?</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a onclick="window.location.href="?p=register"">Registration</a><br/>
								';                            
                            }
						   else{
						        echo '<div id="memb_top"></div>
								           <div id="left_box_body">'; 
           
                                        include("inc/user_panel.php");
								echo ' </div>
                                        <div id="left_box_bot"></div>';
						        }

							?>	


			                </div>
						<br><center>						
					     </div>
				    </div>
			<div class="sta_foot mar0"></div>				
		</div>
		<div class="sb_top">
				<div class="ss_titlefor1"><p class='forum'><?php echo phrase_events?></p></div>
				   <div class="sta_cont_top">
					    <div class="forum_home">									
				            <div style="text-align:center;margin:0 auto;">
		                       <div></div>
                                 <?php include("inc/events.php");?>


			                </div>
						<br><center>						
					     </div>
				    </div>
			<div class="sta_foot mar0"></div>				
		</div>
					</div></aside><!-- .right-sidebar -->
				</div>
			</div><!-- .middle-->
		</div><!-- .wrapper -->
		<footer class="footer">
			<div class="page_footer">
				<div class="to_up">
					<a id="top" style="display: none;"></a>
				</div>
				<ul class="foot_nav">
                  <?php include("inc/menu.php"); ?>
				</ul>
				<div class="adban"></div>
					Copyright &copy; 2016 
				<a href="http://darksteam.net/releases/22207-release-dtweb-2-0-release-r00tme-version.html">DTWeb 2.0</a> </br>Template by <b> r00tme</b>

		</div>
			</div>		
		</footer>
</body>
</html>