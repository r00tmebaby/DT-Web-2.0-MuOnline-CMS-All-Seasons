<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
$success = 0;
$messages  = array();
 if(isset($_SESSION['dt_username']))
     {
	ini_set('max_execution_time', 0);  
     $is_admin = check_admin($_SESSION['dt_username']);		
     $set=web_settings();
          
		  echo 
		  "
		  <div class='news_add'>
		  <h5>".phrase_hello." <span style='color:orange;text-shadow:0.4px 0.4px #000; font-height:600;'>".$_SESSION['dt_username']."</span>, ".phrase_you_have_rights."</h5>
		  <div style='text-align:left'>
		  <b>*</b> ".phrase_important_information."</br> 
		  &nbsp;&nbsp;- ".phrase_do_not_post_bad_media." </br>
		  &nbsp;&nbsp;- ".phrase_needs_activating."</br>
		  &nbsp;&nbsp;- ".phrase_after_adding." </br>
		  &nbsp;&nbsp;- ".phrase_displayed_correctly." </br>
		  &nbsp;&nbsp;- ".phrase_arent_too_small_too_big." </br>
		  &nbsp;&nbsp;- ".phrase_always_check_all_links."</br>
		  <span style='float:right;color:#FF9326;margin-right:20px;'>". phrase_from .$set[4] . phrase_admins ." </br>
		  </div></br></br> ";
          include("configs/config.php");
		  
    if(isset($_POST['add'])) {
          if (isset($subject) && empty($content)){
          	    $messages[] =  phrase_content_empty ;
          }
          elseif (isset($content) && empty($_POST['subject'])){
          		$messages[] = phrase_subject_empty ;
          }
          else{
			  $subject  = trim(htmlspecialchars($_POST['subject']));
			  $content  = trim(htmlspecialchars($_POST['content']));
                if (isset($_POST['lang'])){
					$lang = (int)$_POST['lang'];
                	mssql_query("Insert into DTweb_News_System ([date], [subject], [content], [author],[active],[lang]) values ('".time()."', '".$subject."','".$content."', '".$_SESSION['dt_username']."', '0','".$lang."')");
					$last_news = mssql_fetch_array(mssql_query("Select MAX(id) as ida from DTweb_News_System"));
                    make_log_news("Added News","					
					<span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>Subject: </span>".$subject." | 
					<span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>ID: </span> ".$last_news['ida']." |
					<span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>GM: </span> ".$_SESSION['dt_username']."</br> </br> 
					<span style='color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;'>Content: </span> ".$content." 
					");	
					$success = 1;	
                    $messages[] = phrase_news_added;				
				    
          	        }
		          }
               }
		message($messages,$success);
?>
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

<form class='form' name='<?php echo form_enc()?>' style="width:100%" method="post"> 	         
	          <input name="subject" type="Text" style='width:100%;height:50px;padding:10px 5px;font-weight:600' placeholder='<?php echo phrase_subject?>' maxlength="50"><br />			  
	          <textarea placeholder='<?php echo phrase_content?>' name="content" cols="50" rows="5"></textarea><br />              
			
			 <select name="lang">
			      <option value="0">English</option>
				  <option value="1">Bulgarian</option>
				  <option value="2">Spanish</option>
				  <option value="3">Romanian</option>
				  <option value="4">Russian</option>
			  </select>
			  <input type='submit' name="add" value="Add News"/>
</form>
</div>

<?php 
	 }
   
}
