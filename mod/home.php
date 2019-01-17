<link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
<script src="../tinymce/tinymce.min.js"></script>
<script>
  ed.on('init', function(){
    this.getDoc().body.style.fontSize = '12pt';
    this.getDoc().body.style.fontFamily = 'Arial';
    if(this.id=='header1Data'){
        this.getDoc().body.style.color=$('#header1').css('color');
        this.getDoc().body.style.backgroundColor=$('#header1').css('background-color');
        this.getDoc().body.style.backgroundImage=$('#header1').css('background-image');
    }else if(this.id=='header2Data'){
        this.getDoc().body.style.color=$('#header2').css('color');
        this.getDoc().body.style.backgroundColor=$('#header2').css('background-color');
        this.getDoc().body.style.backgroundImage=$('#header2').css('background-image');
    }else if(this.id=='footerData'){
        this.getDoc().body.style.color=$('#footerData').css('color');
        this.getDoc().body.style.backgroundColor=$('#footer1').css('background-color');
        this.getDoc().body.style.backgroundImage=$('#footer1').css('background-image');
    }
});

</script>
<script type="text/javascript">
tinymce.init({
        selector: "textarea",
        plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],
        
        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
        menubar: false,
        toolbar_items_size: 'small',

});</script>
<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{

/////////////////////////////////////////////
// Simple News System ////Show-Hide News/////
//  by r00tme  /////////////  Version  //////
//   v.1.0     //////////////////////////////
///01-09-2015////////////////////////////////
$style_pic = '';
$set = web_settings();
$uve = 0;
$style_none = 'style="display:none;"';
if($set[3] != "Aion"){
	$style_none = '';
}
if($set[3] == "Legend"){
	$style_pic = '<div class="where_image"></div>';
}
echo $style_pic . ' <div class="where_nav">Latest News</div></br>';

$tds = array();
if(isset($_SESSION['lang'])){
    switch($_SESSION['lang']){
		case "en":    $smqna = 0;break;
		case "bg":    $smqna = 1;break;
		case "es":    $smqna = 2;break;
		case "ro":    $smqna = 3;break;
		case "ru":    $smqna = 4;break;
		default ;
	}
	$switch_lang = "and [lang] ='".$smqna."'";
}
else{
	$switch_lang = "";
}
if(!isset($_SESSION['dt_username']) || check_admin($_SESSION['dt_username']) == false){
	            $all_news = mssql_query("Select * from [DTweb_News_System] where [active]=1 ".$switch_lang." order by [id] desc");
	        		while ($news = mssql_fetch_array($all_news))
	   	    		{
 	
		            $uve++;
                     echo '
					 <script>
                         function show_div'.$uve.'()
						 { 	                       						 
                         $(".showHide'.$uve.'").show(500,\'swing\');
                         $(".show'.$uve.'").replaceWith(\'<div id="eventimo'.$uve.'"  class="tema hide'.$uve.'" onclick="hide_div'.$uve.'()" ><span class="news_color"><b>[News - '.$uve.']</span></b>'.$news['subject'].'<div class="news_date"><i>'.date("M d Y", $news['date']).'</i></div></div>\');                    
                         }
                         function hide_div'.$uve.'()
					     {                   
                         $(".showHide'.$uve.'").hide(500, \'swing\');
                         $(".hide'.$uve.'").replaceWith(\'<div id="eventimo'.$uve.'" class=" tema show'.$uve.'" onclick="show_div'.$uve.'()" ><span class="news_color"><b>[News - '.$uve.']</span></b>'.$news['subject'].'<div class="news_date"><i>'.date("M d Y", $news['date']).'</i></div></div>\');
                         }					 
                     </script> ';
                   $tds[] = ' 
                       				   
						<div id="eventimo'.$uve.'" class="tema tema_fix show'.$uve.'" onclick="show_div'.$uve.'()"><span class="news_color"><b>[News - '.$uve.']</span></b>'.$news['subject']. '<div class="news_date"><i>'.date("M d Y", $news['date']).'</i></div>	</div>
					    <div '.$style_none.' class="news_content showHide'.$uve.'">'.(htmlspecialchars_decode($news['content'])).'						
						<div class="author"> Автор: <span class="author_name">'.$news['author'].'</span> / Дата:  '.date("Y-M-D h:i:s", $news['date']).'</div>	</div>						
				         						   	             
					  ';
		    		}
		    }	
else{	
$is_admin = check_admin($_SESSION['dt_username']);	
		if($is_admin[1] < 3){
					$all_news = mssql_query("Select * from [DTweb_News_System] where [author] = '".$_SESSION['dt_username']."' order by [id] desc");
				}
				else{
				    $all_news = mssql_query("Select * from [DTweb_News_System] order by [id] desc");
				}
				
				$edit = 0;
     		    if ((isset($_POST['edit'])) && (isset($_POST['id'])))
		                {   
					        $edit = 1;
					        $news = mssql_fetch_array(mssql_query("Select * from [DTweb_News_System] where [id]='".clean_post($_POST['id'])."'"));													
                           	echo"					
							<form name= '".form_enc()."' class='form market_button' method='post'>
                                <input type='hidden' name='id_save'	value='".$news['id']."'>						
								<input style='width:100%;height:50px;padding:5px 5px;' class='tema tema_fix' maxlength='200' size='200' name='upd_subject' value='".$news['subject']."'/>
								<textarea style='color:black;width:100%; height:200px' cols='50' rows='5' name='upd_content'/>".$news['content']."</textarea></br>                             
								<input type='submit' name='save' value='".phrase_update."'/>
							</form>				
							";							
		                } 

		if (isset($_POST['save']) && isset($_POST['id_save']))
		                  { 

		                    mssql_query("Update DTweb_News_System set date = '".time()."', subject = '".clean_post($_POST['upd_subject'])."', content = '".(htmlspecialchars($_POST['upd_content']))."' where id = '".clean_post(($_POST['id_save']))."'");
						  	make_log_news("Edited News","
							<span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>Subject:</span> ".clean_post($_POST['upd_subject'])." |  
							<span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>ID:</span> ".clean_post(($_POST['id_save']))." | 
							<span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>GM:</span> ".$_SESSION['dt_username']."</br>
							<span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>Content:</span> </br>".clean_post($_POST['upd_content'])."
							");
							
						  home();	
						  }
	                $uve3 = 0;
	                while ($news = mssql_fetch_array($all_news))
				    {
                   		$uve3++;				
                     echo '
					 <script>
                         function show_div'.$uve3.'()
						 { 	                       						 
                         $(".showHide'.$uve3.'").show(500,\'swing\');
                         $(".show'.$uve3.'").replaceWith(\'<div id="eventak'.$uve3.'"  class="tema hide'.$uve3.'" onclick="hide_div'.$uve3.'()" ><span class="news_color"><b>[News - '.$uve3.']</span></b>'.$news['subject'].'<div class="news_date"><i>'.date("M d Y", $news['date']).'</i></div></div>\');                    
                         }
                         function hide_div'.$uve3.'()
					     {                   
                         $(".showHide'.$uve3.'").hide(500, \'swing\');
                         $(".hide'.$uve3.'").replaceWith(\'<div id="eventak'.$uve3.'" class=" tema show'.$uve3.'" onclick="show_div'.$uve3.'()" ><span class="news_color"><b>[News - '.$uve3.']</span></b>'.$news['subject'].'<div class="news_date"><i>'.date("M d Y", $news['date']).'</i></div></div>\');
                         }					 
                     </script> ';
					
					 
                        switch($news['active']){
							case 1 :$status = 'Активна'  ;$color = "#5CFF26";break;
							default:$status = 'Неактивна';$color = "#FF4C4C";break;
						}
			                      						                  
				    	if (($edit != 1))
						{	
							if($is_admin[1] > 1)	{								
								$td = 
								"
								<input type='submit' name='activate' value='Активирай'/>
								<input type='submit' name='deactivate' value='Деактивирай'/> 
								";
							}
                            if($is_admin[1] == 1){
                            	$td='';
                            }
                           $tds[] = "
                              <div class='market_button'>	
							  
                                <div style='color:".$color."'> ".$status."</div>							
						        <div id='eventak".$uve3."' class='tema tema_fix show".$uve3."' onclick='show_div".$uve3."()'> ".$news['subject']."</div>									
                                <div style='display:none;' class='news_content showHide".$uve3."'> ".htmlspecialchars_decode($news['content'])."
								<div class='author'> Автор <span class='author_name'>".$news['author']."</span> - ".date("j/m/y g:i a", $news['date'])."</div>
							   <center>
							 	 <form name= '".form_enc()."' method='post' >
								      <input name='id' type='hidden' value='".$news['id']."'/>							                                           
									  ".$td."							  			    	 
									  <input type='submit' name='edit' value='Промени'/> 
							    	  <input type='submit' name='delete' value='Изтрий'/>
							       </form>
							   </center>
							 </div>	
								
                             </div>								   
						 ";
				}					
		}
}
		        if (isset($_POST['delete'])){	
                        mssql_query("Delete from DTweb_News_System where id = '".clean_post(($_POST['id']))."'");
			      	    make_log_news("Deleted News"," 
			    	    <span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>ID:</span> ".clean_post(($_POST['id']))." | 
			    	    <span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>GM:</span> ".$_SESSION['dt_username']."");							
		                 home();	                
					}
		        if (isset($_POST['activate']))
			        {
		                mssql_query("Update DTweb_News_System set active = '1' where id = '".clean_post(($_POST['id']))."'");
			    	    make_log_news("Activate News"," 
			    	    <span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>ID:</span> ".clean_post(($_POST['id']))." | 
			    	    <span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>GM:</span> ".$_SESSION['dt_username']."");			    	
					    home();	
					}
		        if (isset($_POST['deactivate']))
			        {
		                mssql_query("Update DTweb_News_System set active = '0' where id = '".clean_post(($_POST['id']))."'");
			    	    make_log_news("Deactivate News"," 
			    	    <span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>ID:</span> ".clean_post(($_POST['id']))." | 
			    	    <span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>GM:</span> ".$_SESSION['dt_username']."");	
		             	home();		    	 
					}
			
		foreach ($tds as $render){
			echo $render;
		}	
}
	?>
