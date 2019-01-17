<?php
$set = web_settings();
echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="icon" type="ico" href="themes/aion/favicon.ico"/>	
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="'.$set[2].'" name="description"/>
    <meta name="keywords" content="'.$set[1].'"/>
	<title>'.$set[0].'</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>	
	<link rel="stylesheet" href="themes/Aion/css/style.css" />
	<link rel="stylesheet" href="themes/Aion/css/hover.css" media="all"/>	
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="all"/>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/servertime.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript">$(document).ready(function(){$("[title]").easyTooltip();});</script>
<!--    <script>$(document).keydown(function(event) {if (event.ctrlKey==true && (event.which == "61" || event.which == "107" || event.which == "173" || event.which == "109"  || event.which == "187"  || event.which == "189"  ) ) {event.preventDefault();}});$(window).bind("mousewheel DOMMouseScroll", function (event) {if (event.ctrlKey == true) {event.preventDefault();}});</script>-->
</head>	
<body>
    <div id="wrapper"> 
         <div id="container">
		 	<div id="top_menu">
              <div class="server-time">'.phrase_server_time.':</div><div id="timer"> '.phrase_loading.'</div>
              '.lang_form().'
			 </div>
		   <div class="logo">'.$set[4].'</div>
             <div class="menu list-inline ">'; 
			 include ("inc/menu.php"); 
			 echo'
			 </div>  
				  <div id="contents">
                    <div id="panel_left">';		
               include("menus/social_media.php");
               include("menus/login_form.php");	
			   include("inc/ranks.php");	
               echo'</div>		   
			   <div id="panel_right">
			      <div id="content">';
                     if(isset($_GET['p'])){
                          switch($_GET['p'])	{
                          case "home":include("menus/main_page.php");	break;						
                          default:include("inc/loader.php");break;
						}				
				      }	 				  
				      else{
					      include("menus/main_page.php");					 
				      }
					  echo'
 			    </div> 
                 </div>	
			  </div>		
	       </div>	
	   <div id="footer">		    
		    <div class="footer_links">
		       <a href="#"> '.phrase_rules.' </a>&nbsp;  | &nbsp;     	      
		       <a href="#"> '.phrase_banned.' </a>&nbsp;  | &nbsp;
               <a href="#"> '.phrase_warned.'</a>&nbsp;  | &nbsp;		  
               <a href="#"> '.phrase_term_of_service.' </a>&nbsp; | &nbsp;
               <a href="#"> '.phrase_privacy.' </a>&nbsp;  | &nbsp;
               <a href="#"> '.phrase_cotacts.' </a> 
		    </div>
		<div class="footer_info"> '.$set[0].' by r00tme | Copyrights &copy; MeMoS</div>
	 </div>	 	
   </div>			
 </body>
 </html>
';
////////////////////////////////////
//  Aion Template       ////////////
//   by r00tme          ////////////
// Credits to mistar_ti ////////////
// http://DarksTeam.net ////////////
// for giving me the psd file     //
////////////////////////////////////