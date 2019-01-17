<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
session_start();
if(isset($_POST['reveal'])){
	$store = do_pass_reveal();
	show_messages($store);
}

?>
<form class='form' method='post'>
<table class="table_reg">

                    <tbody>
                      <tr>
                        <td width="30%"><?php echo phrase_username?></td>
                        <td align='left' colspan='3'><input id="username" type='text' name='account' maxlength='12' class='button' onblur='showHint(this.value)'><span class='error' id='txtHint'></span></td>
                      </tr>
                      <tr>
                        <td width="30%">&nbsp;&nbsp;<?php echo phrase_email?></td>
                        <td align='left'colspan='3' width="30%">
                        <input type='text' id="email" name='email' maxlength='40' class='button' onblur='showMail(this.value)'>
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
                       <td align='left'colspan='1' width="30%"><input type="text" class="lanyu" onkeypress="return num(event, this)" name="verify" maxlength="7"/></td>
					   <td style="text-align:left;"><img src="js/verify/verify.php"/></td>
                      </tr>
                      <tr>                       
                        <td colspan="5" style="text-align: center;">
                        <hr></br>
                    
                            <input type='submit' class="button" value='<?php echo phrase_pass_reveal?>' name="reveal">
							<input type="reset" name="Reset" value="<?php echo phrase_reset?>" class="button"></td>
					 
                      </tr>
                    </tbody>
					
					
       </form>
					</table>
					
<?php }?>