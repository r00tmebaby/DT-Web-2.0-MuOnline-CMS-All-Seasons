<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
if(isset($_POST['register'])){

	$store = do_registration();
	show_messages($store);
}

?>
<script src="js/chekname.js"></script>
<script src="js/chekmail.js"></script>
<script src="js/passwordStrength.js"></script>

<form class='form' id="register" method='post'>
<table class="table_reg">

                    <tbody>
                      <tr>
                        <td width="30%"><?php echo phrase_username?></td>
                        <td align='left' colspan='3'><input id="username" type='text' name='account' maxlength='12' class='button' onblur='showHint(this.value)'><span class='error' id='txtHint'></span></td>
                      </tr>
                      <tr>
                        <td width="30%"><?php echo phrase_password?></td>
                        <td align='left' colspan='2' width="30%">
                            <input id="password" type='password' name='password' maxlength='12' class='button' onKeyUp='checkPassword(this.value)'>
                       </td>
                       <td width="40%">
                        <span class="info"><div class="clear passStrenArea" style="width: 180px;"><div class="clear passStrenProgressBar" ><div class="clear" id="progressBar">&nbsp;</div></div></div></span>
                        </td>
                      </tr>
                      <tr>
                        <td width="30%"><?php echo phrase_repeat_pass?></td>
                       <td align='left'colspan='2' width="30%">
                        <input id="password2" type='password' name='repassword' maxlength='12' class='button'>
                        </td>
                      </tr>
                       <tr><td height="20px">

                      </td></tr>                     
                      <tr><td colspan="4">
                      <span class="info"><center>&nbsp;&nbsp;<?php echo phrase_valid_information?></center></span>
                      <hr><br>
                      </td></tr>
			  
                      <tr>
                        <td width="30%">&nbsp;&nbsp;<?php echo phrase_email?></td>
                        <td align='left'colspan='3' width="30%">
                        <input type='email' id="email" name='email' maxlength='40' class='button' onblur='showMail(this.value)'>
                        <span id='txtMail'></span>
                        </td>
                        
                      </tr>
                      <tr>
                        <td width="30%">&nbsp;&nbsp;<?php echo phrase_quetsion?></td>
                        <td align='left'colspan='2' width="30%"><input type='text' name='question' maxlength='20' class='button'></td>
		
                      </tr>
                      <tr>
                        <td width="30%">&nbsp;&nbsp;<?php echo phrase_answer?></td>
                       <td align='left'colspan='2' width="30%"><input type='text' name='answer' maxlength='20' class='button'></td>
                      </tr>
                        <tr>
                        <td width="30%">&nbsp;&nbsp;<?php echo phrase_code_check?></td><td>
                       <td align='left'colspan='1' width="30%"><input type="text" class="lanyu" onkeypress="return num(event, this)" name="verify" maxlength="7"/> </td>
					   <td style="text-align:left;"><img src="../js/verify/verify.php"/></td>
                      </tr>
                      <tr>                       
                        <td colspan="5" style="text-align: center;">
                        <hr></br>
                     
                            <input type='submit' class="button" id='reg_accept' value='<?php echo phrase_register?>' name="register">
							<input type="reset" name="Reset" value="<?php echo phrase_reset?>" class="button"></td>
							 <span id="submitresults"></span>
					 
                      </tr>
                    </tbody>
					
					
       </form>
	</table>

<?php } ?>