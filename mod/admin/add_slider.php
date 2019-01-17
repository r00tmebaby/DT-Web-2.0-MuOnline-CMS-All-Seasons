<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>	

<?php

if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
if(isset($_SESSION['dt_username']))
     {
$set = web_settings();
$select1="";$select2="";$select3="";$select4="";$select5="";$select6    ="";$select7    ="";$select8    ="";$select9    ="";$select10="";$select11="";$select12="";$select13="";$select14="";$select15="";$select16="";$select17="";$select18 ="";$select19 ="";$select20 ="";$select21 ="";$select22 ="";$select23 ="";$select24 ="";$select25 ="";$select26 ="";$select27="";$select28="";$select29="";$select30="";$select31 ="";$select32 ="";
$success = 0;
$messages = array();


if(isset($_POST['save']) && isset($_POST['id']) /* && isset($_POST['text']) && isset($_POST['effectsw']) && isset($_POST['links'] )*/){
	
	mssql_query("Update DTweb_Carousel_Settings set  text = '".base64_encode($_POST['texts'])."', link = '".base64_encode($_POST['links'])."', effect = '".trim($_POST['effectsw'])."' where id = '".$_POST["id"]."'");
    $messages[] = "Banner ".$_POST["id"]. " has been successful updated";
	refresh();
	}
if(isset($_POST['delete']) && isset($_POST['id'])){
	mssql_query("Delete from [DTweb_Carousel_Settings] where [id] = '".$_POST["id"]."'");
	$messages[] = "Banner ".$_POST["id"]. " has been successfullt deleted";
	refresh();
}					  


if(isset($_POST['add']) && !empty($_FILES["banner"]["tmp_name"])){
	$text          = base64_encode($_POST['text']);
    $link          = base64_encode($_POST['link']);
    $check = getimagesize($_FILES["banner"]["tmp_name"]);
    if($check == false) {
      $messages[] = "<div style=''>This file is not an image</div>";
    }
	elseif (empty($text) || empty($effect) || empty($link)) {
      $messages[] = "You can not leave empty fields";
    }
   elseif (file_exists($file)) {
      $messages[] = "Sorry, file already exists.";
    }
   elseif ($_FILES["banner"]["size"] > 900000) {
      $messages[] = "Sorry, your file is too large.";  
    }
   elseif($type != "jpg" && $type != "png" && $type != "jpeg"&& $type != "gif" ) {
     $messages[] ="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  }  
 else {
    if (move_uploaded_file($_FILES["banner"]["tmp_name"], $file)) {
		mssql_query("Insert into [DTweb_Carousel_Settings] (filename,link,effect,text) values ('".basename( $_FILES["banner"]["name"])."','".$link."','".$effect."','".$text."')");
        $messages[] = "The file ". basename( $_FILES["banner"]["name"]). " has been successfully uploaded";
		$success = 1;
		refresh();
    } 
	else {
       $messages[] = "Sorry, there was an error uploading your file.";
    }
  }
}
foreach ($messages as $msg){
		 switch($success){
			 case 1: $class='success';break; 
			 default:$class='error';break;
			 }
		 echo "<div class='".$class."'>" . $msg ." </div>";
} 
$check_banners = mssql_query("Select * from [DTweb_Carousel_Settings]");
	 
        echo "
			
	   <table class='form' width='550px'>
	   <form   name='".form_enc()."' method='post' enctype='multipart/form-data' >
		<tr class='title'><td colspan='3'>".phrase_add_new_banner."<td></tr>
		<tr>
	        <td>".phrase_banner_file.": </td><td><div class='upload'> <input  type='file' class='button' name='banner'/></div></td>
		</tr> 
        <tr>
		<td>".phrase_slider_effect."</td>
		
		<td style='float:left;margin-left:20px;margin-bottom:5px;'>		
				<select name='effects'>
				    <option ".$select1." value='block'>Block</option>
				    <option ".$select2." value='horizontal'>Horizontal</option>
				    <option ".$select3." value='paralell'>Paralell</option>
				    <option ".$select4." value='tube'>Tube</option>
				    <option ".$select5." value='cut'>Cut</option>
				    <option ".$select6." value='fade'>Fade</option>
				    <option ".$select7." value='randomSmart'>RandomSmart</option>
				    <option ".$select8." value='random'>Random</option>
				    <option disabled>--- Cube ---</option>
				    <option ".$select9." value='cubeRandom'>cubeRandom</option>
				    <option ".$select10." value='cubeStop'>cubeStop</option>
				    <option ".$select11." value='cubeHide'>cubeHide</option>
				    <option ".$select12." value='cubeShow'>cubeShow</option>
				    <option ".$select13." value='cubeSize'>cubeSize</option>
				    <option ".$select14." value='cubeStopRandom'>cubeStopRandom</option>
				    <option ".$select15." value='cubeSpread'>cubeSpread</option>
				    <option ".$select16." value='cubeJelly'>cubeJelly</option>
				    <option ".$select17." value='glassCube'>glassCube</option> 
				    <option  disabled>--- Blind --- </option>
				    <option ".$select18." value='blind'>blind</option>
				    <option ".$select19." value='blindHeight'>blindHeight</option>
			        <option  disabled>--- Bars --- </option>
				    <option ".$select20." value='hideBars'>hideBars</option>
				    <option ".$select21." value='swapBars'>swapBars</option>
				    <option ".$select22." value='upBars'>upBars</option>
				    <option ".$select23." value='downBars'>downBars</option>
				    <option ".$select24." value='swapBarsBack'>swapBarsBack</option>
				    <option ".$select25." value='swapBlocks'>swapBlocks</option>
				    <option ".$select26." value='showBarsRandom'>showBarsRandom</option>
				    <option  disabled>--- Direction ----</option>
				    <option ".$select27." value='directionTop'>directionTop</option>
				    <option ".$select28." value='directionBottom'>directionBottom</option>
				    <option ".$select29." value='directionRight'>directionRight</option>
				    <option ".$select30." value='directionLeft'>directionLeft</option>
				    <option  disabled>--- Circles ---</option>
				    <option ".$select31." value='circlesInside'>circlesInside</option> 
				    <option ".$select32." value='circlesRotate'>circlesRotate</option>		 
			    </select></td></tr>
				
				<tr><td>".phrase_slider_link.":</td><td><input  type='text' name='link'/></td></tr> 
				<tr><td tit>".phrase_slider_text.":</td><td><input  type='text' name='text' /></td></tr>
				<tr><td style='padding:10px 10px;'colspan='3'>
				<input name='add' value='".phrase_add_new_banner."' type='submit'/></td>
                </tr>
		</table></br></form>";
if(mssql_num_rows($check_banners) > 0){		 
				    echo "
					 <table class='form' >
					 <tr class='title'><td colspan='3'>".phrase_edit_banners."<td></tr>
					   <tr>	     
					      <td>".phrase_banner_image."</td>
					      <td>".phrase_slider_effect."</td>						  
					      <td>".phrase_slider_link."</td>
					      <td>".phrase_slider_text."</td>
					   </tr>
					 ";		
			while($banners = mssql_fetch_array($check_banners)){
				$dir           = "imgs/banners/";
                $file  = $dir . basename($banners['filename']);
                $type  = pathinfo($file,PATHINFO_EXTENSION);
				switch($banners['effect']){
					case "block": $select1 = "selected";break;
					case "horizontal": $select2 = "selected";break;
					case "paralell": $select3 = "selected";break;
					case "tube": $select4 = "selected";break;
					case "cut": $select5 = "selected";break;
					case "fade": $select6 = "selected";break;
					case "randomSmart": $select7 = "selected";break;
					case "random": $select8 = "selected";break;
					case "cubeRandom": $select9 = "selected";break;
					case "cubeStop": $select10 = "selected";break;
					case "cubeHide": $select11 = "selected";break;
					case "cubeShow": $select12 = "selected";break;
					case "cubeSize": $select13 = "selected";break;
					case "cubeStopRandom": $select14 = "selected";break;
					case "cubeSpread": $select15 = "selected";break;
					case "cubeJelly": $select16 = "selected";break;
					case "glassCube": $select17 = "selected";break;
					case "blind": $select18 = "selected";break;
					case "blindHeight": $select19 = "selected";break;
					case "hideBars": $select20 = "selected";break;
					case "swapBars": $select21 = "selected";break;
					case "upBars": $select22 = "selected";break;
					case "downBars": $select23 = "selected";break;
					case "swapBarsBack": $select24 = "selected";break;
					case "swapBlocks": $select25 = "selected";break;
					case "showBarsRandom": $select26 = "selected";break;
					case "directionTop": $select27 = "selected";break;
					case "directionBottom": $select28 = "selected";break;
					case "directionRight": $select29 = "selected";break;
					case "directionLeft": $select30 = "selected";break;
					case "circlesInside": $select31 = "selected";break;
					case "circlesRotate": $select32 = "selected";break;
				 }
				
		 	
                   echo "	<form method='post'>
					   <tr>
					      <td style='float:left'><img title='<div style=\"width:250px;\" class=\"admin-title\">
						  <span>".phrase_file_id.":</span> ".$banners['id']."</br>
						  <span>".phrase_file_directory.":</span> imgs/banners/</br>
						  <span>".phrase_file_name.":</span> ".$banners['filename']."</br> 
						  <span>".phrase_file_uploaded.":</span> ".server_time(filemtime($file))."</br>
						  <span>".phrase_file_size.":</span> ".FileSizeConvert(filesize($file))."</br>
						  </div>'width='100px;' height='50px;' src='imgs/banners/".$banners['filename']."'/></br></td>
					      				
		<td>		
				<select name='effectsw'>
				    <option ".$select1." value='block'>Block</option>
				    <option ".$select2." value='horizontal'>Horizontal</option>
				    <option ".$select3." value='paralell'>Paralell</option>
				    <option ".$select4." value='tube'>Tube</option>
				    <option ".$select5." value='cut'>Cut</option>
				    <option ".$select6." value='fade'>Fade</option>
				    <option ".$select7." value='randomSmart'>RandomSmart</option>
				    <option ".$select8." value='random'>Random</option>
				    <option disabled>--- Cube ---</option>
				    <option ".$select9." value='cubeRandom'>cubeRandom</option>
				    <option ".$select10." value='cubeStop'>cubeStop</option>
				    <option ".$select11." value='cubeHide'>cubeHide</option>
				    <option ".$select12." value='cubeShow'>cubeShow</option>
				    <option ".$select13." value='cubeSize'>cubeSize</option>
				    <option ".$select14." value='cubeStopRandom'>cubeStopRandom</option>
				    <option ".$select15." value='cubeSpread'>cubeSpread</option>
				    <option ".$select16." value='cubeJelly'>cubeJelly</option>
				    <option ".$select17." value='glassCube'>glassCube</option> 
				    <option  disabled>--- Blind --- </option>
				    <option ".$select18." value='blind'>blind</option>
				    <option ".$select19." value='blindHeight'>blindHeight</option>
			        <option  disabled>--- Bars --- </option>
				    <option ".$select20." value='hideBars'>hideBars</option>
				    <option ".$select21." value='swapBars'>swapBars</option>
				    <option ".$select22." value='upBars'>upBars</option>
				    <option ".$select23." value='downBars'>downBars</option>
				    <option ".$select24." value='swapBarsBack'>swapBarsBack</option>
				    <option ".$select25." value='swapBlocks'>swapBlocks</option>
				    <option ".$select26." value='showBarsRandom'>showBarsRandom</option>
				    <option  disabled>--- Direction ----</option>
				    <option ".$select27." value='directionTop'>directionTop</option>
				    <option ".$select28." value='directionBottom'>directionBottom</option>
				    <option ".$select29." value='directionRight'>directionRight</option>
				    <option ".$select30." value='directionLeft'>directionLeft</option>
				    <option  disabled>--- Circles ---</option>
				    <option ".$select31." value='circlesInside'>circlesInside</option> 
				    <option ".$select32." value='circlesRotate'>circlesRotate</option>		 
			    </select>
					 </td>
						  <td><textarea name='links' class='border' maxwidth='200px'>".base64_decode($banners['link'])."</textarea></td>					      
					      <td><textarea name='texts' class='border' maxwidth='200px'>".base64_decode($banners['text'])."</textarea></td></tr>
						<tr>
						  <td colspan='3'><input type='submit' value='".phrase_save."' name='save'/></td>
						  <td colspan='3'><input type='submit' value='".phrase_delete."' name='delete'/></td></tr>
						  <input type='hidden' name='id' value='".$banners['id']."' />
					   </tr>			   
				     </form> ";
					 
			}		 
					 
		echo"</table>";		
   }
   else{
	   echo "";
   }
 }
}

?>
