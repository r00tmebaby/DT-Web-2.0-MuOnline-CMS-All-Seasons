<?php 				
$show_msg= array();
      if(isset($_POST['account']) && isset($_POST['password'])) {	
	  if(empty($_POST['account']) OR empty($_POST['password']))
		{
			$show_msg[] .= phrase_empty_fields;
		}
		else
		    {
		        $acc = clean_post($_POST['account']);
		        $pass = clean_post($_POST['password']);
			    $is_acc_pass = mssql_num_rows(mssql_query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='{$acc}' AND memb__pwd='{$pass}'")
			);
			if($is_acc_pass == 0)
			{
				$show_msg[] .= phrase_wrong_login_details;
			}
			else
			{   
				$_SESSION['dt_username'] = $acc;
				$_SESSION['dt_password'] = $pass;              		
			}
		}
	}
		foreach($show_msg as $error){
			echo "<div class='login_error'>" . $error . "</div>";
		}

if(!isset($_SESSION['dt_username']) && !isset($_SESSION['dt_password'])){

echo'

<div class="login_form">
   <form name="'.form_enc().'"  method="post">
       <input style="display:none">
      <input type="password" style="display:none">
      <input placeholder="'.phrase_username.'"   name="account" class="login_username" type="text"/>
	  <input placeholder="'.phrase_password.'"  id="password" name="password" class="login_password" type="password"/>
	  <div class="login_checkbox">	 
	     <div class="left"><input type="checkbox"  name="remember_pass"/></div> <div class="right">'.phrase_remember_password.'</div></br>
	     <div class="forgot afix"><a href="?p=retrivepass"><u>'.phrase_forgot_password.'?</u></a></div>
	  </div>  
     <input class="login_sign_in_btn" type="submit" value=""/> 
   </form>
 </div>';
}

else{
	include("inc/user_panel.php");
}
?>

<script>

$(document).ready(function(){

$('#password').securenumbermask({

mask:'*',

maxlength:15

});

});

</script>
