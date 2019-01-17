<?php

if(isset($_POST['update'])){
	$store = do_update_account();
	show_messages($store);
}
$details = mssql_fetch_array(mssql_query("Select * from memb_info where memb___id='".$_SESSION['dt_username']."'"));
?>
<form class='form' method='post'>
<table class="table_reg">

                    <tbody>
                      <tr>
                        <td width="30%">&nbsp;&nbsp;<?php echo phrase_email?></td>
                        <td align='left'colspan='3' width="30%">
                        <input type='button' id="email" value="<?php echo $details['mail_addr']?>"  onblur='showMail(this.value)'>
                        <span id='txtMail'> * <?php echo phrase_current_email?></span>
                        </td>
                        
                      </tr>
					  <tr>
                        <td width="30%">&nbsp;&nbsp; <?php echo phrase_new?><?php echo phrase_email?></td>
                        <td align='left'colspan='3' width="30%">
                        <input title="Leave blank if do not want to be changed" type='email' id="newemail" name='newemail' maxlength='40' class='button' onblur='showMail(this.value)'>
                        <span id='txtMail'> * <?php echo phrase_set_new_email?> </span>
                        </td>
<tr><td colspan='90'><hr class="style1"> </td></tr>
					  <tr>
                        <td width="30%">&nbsp;&nbsp;<?php echo phrase_password?></td>
                        <td align='left'colspan='3' width="30%">
                        <input type='button' id="password" maxlength='40' value="<?php echo $details['memb__pwd']?>"  onblur='showMail(this.value)'>
                        <span id='txtMail'> * <?php echo phrase_current_password?></span>
                        </td>
                        
                      </tr>
					  <tr>
                        <td width="30%">&nbsp;&nbsp; <?php echo phrase_new?><?php echo phrase_password?></td>
                        <td align='left'colspan='3' width="30%">
                        <input type='text' title="Leave blank if do not want to be changed"  id="newpassword" name='newpassword' maxlength='40' class='button' onblur='showMail(this.value)'>
                        <span id='txtMail'> * <?php echo phrase_set_new_password?></span>
                        </td>
<tr><td colspan='90'><hr class="style1"> </td></tr>                        
                      </tr>
                      <tr>
                        <td width="30%">&nbsp;&nbsp;<?php echo phrase_quetsion?></td>
                        <td align='left'colspan='2' width="30%"><input type='text' name='question' maxlength='20' class='button'></td>
		                <td align='left'><span id='txtMail'> * <?php echo phrase_type_you_question?></span></td>
                      </tr>
                      <tr>
                        <td width="30%">&nbsp;&nbsp;<?php echo phrase_answer?></td>
                       <td align='left'colspan='2' width="30%"><input type='text' name='answer' maxlength='20' class='button'></td>
                       <td align='left'><span id='txtMail'> * <?php echo phrase_type_you_answer?></span></td>
					 </tr>
                        <tr>
                        <td width="30%">&nbsp;&nbsp;<?php echo phrase_code_check?></td><td>
                       <td align='left'colspan='1' width="30%"><input type="text" class="lanyu" onkeypress="return num(event, this)" name="verify" maxlength="7"/></td>
					   <td style="text-align:left;"><img src="js/verify/verify.php"/></td>
                      </tr>
					 <tr><td align='center' colspan='200'>* <?php echo phrase_code_must_be_typed_in_capitol?></td></tr>
                      <tr>                       
                        <td colspan="5" style="text-align: center;">
                        <hr class="style1"></br>
                    
                            <input type='submit' class="button" value='<?php echo phrase_update?>' name="update">
					 
                      </tr>
                    </tbody>
					
					
       </form>
					</table>
<style>

.style1{
	border-top: 1px solid #a1310c;

}
	.table_reg input{
		width:200px;
		
	}
</style>