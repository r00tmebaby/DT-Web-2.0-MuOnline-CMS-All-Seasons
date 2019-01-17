<!DOCTYPE html>
<!-- 
///////////////////////////////////////////////////////////
Jewel Bank Admin Panel ///////////11 / 01 / 2016///////////
     by r00tme         ////http://www.DarksTeam.net
///////////////////////////////////////////////////////////
* This module is created for DarksTeam users and integrated to DTweb
* This module version works only with the tables given in the release
* The module doesn't check, create tables or columns itself, you have to make sure 
they exists before adding an item for deposit, the field ItemColumn only gives a path to the column name in the table nothing more! 
* If you want to use this code somewhere else, it is possible but you need to prepare it first
* I do not give any warranty that the code will work properly anywhere else outside the original release

//////////////////////////////////////////////////////////////
-->
<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>	


<?php 
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
$message       = array();
$check_config  = mssql_query(" Select * from [DTweb_Deposit_Settings]"); 
			

if(isset($_POST['create'])){
		if(!empty($_POST['column']) && !empty($_POST['color'])  && !empty($_POST['item'])  && !empty($_POST['code'])){
			$color    = trim($_POST['color']);
			$column   = clean_post($_POST['column']);
			$item     = trim($_POST['item']);
            $code     = clean_post($_POST['code']);
			$hex      = $code."0055555555800000";
        	if(is_int($column) == true){
			$message[] = phrase_column_name_string;	
			}
            else{ 
            $check_cols = mssql_fetch_array(mssql_query("Select {$column} from  [DTweb_JewelDeposit] "));
			
			if(isset($check_cols[$column]) && $check_cols[$column] <> NULL){			
				$message[] = phrase_column_already_exist;
							mssql_query("Insert into [DTweb_Deposit_Settings] ([ItemName],[ItemColor],[ItemHex],[ItemFour],[ItemColumn],[Active]) VALUES ('".$item."','".$color."','".$hex."','".$code."','".$column."','1')");
			}
			else{
			$go_column = mssql_query("ALTER table [DTweb_JewelDeposit] add  [{$column}]  int NOT NULL default (0)");
            if($go_column){			
			mssql_query("Insert into [DTweb_Deposit_Settings] ([ItemName],[ItemColor],[ItemHex],[ItemFour],[ItemColumn],[Active]) VALUES ('".$item."','".$color."','".$hex."','".$code."','".$column."','1')");
			$message[] = phrase_new_item_has_been_added;
			refresh();
			}
			else{
			$message[] = phrase_contact_administrator;	
			 }
		    }		
		  }			
		}
       else{
	        $message[] = phrase_empty_fields;
       }		
	}		
  if (isset($_POST['save'])){
	  		$color    = trim($_POST['color']);
			$column   = clean_post($_POST['column']);
			$item     = trim($_POST['item']);
            $code     = clean_post($_POST['code']);
			$hex      = $code."0055555555800000";
	  mssql_query("Update [DTweb_Deposit_Settings] set active = '".(int)trim($_POST['active'])."', ItemColor = '".$color."',ItemColumn = '".$column."', ItemFour = '".$code."',ItemHex = '".$hex."',ItemName='".$item."' where [ItemName] = '".$_POST['id']."'");

		   
  }
  if (isset($_POST['select_jewel']) && isset($_POST['delete'])){
	  $select_jewel  = trim($_POST['select_jewel']);
	  $check_column = mssql_fetch_array(mssql_query("Select * from [DTweb_Deposit_Settings] where ItemName = '".$select_jewel."'"));	
	  
   	      $del_settings = mssql_query("Delete from [DTweb_Deposit_Settings] where [ItemColumn] = '".$check_column['ItemColumn']."'");	  
	    //  $del_column   = mssql_query("ALTER TABLE [DTweb_JewelDeposit] DROP column ".$check_column['ItemColumn']."");
	     
		 if(!$del_settings){
			  $message[] =  phrase_contact_administrator;
		  }
		  else{
			  $message[] = phrase_this_jewel_was_deleted;
		//  refresh();
		  }
			  
    }
      foreach($message as $return){
		echo "</br>". $return;
	}	
echo "</br></br></br>
<div class=''jewel_block'>
<div class='form jewel_left'>
        <form  name='".form_enc()."' method='post'>			  			 
			 <p title=\"<div class=admin-title><span>".phrase_item_name."</span> ".phrase_jewe_deposit_name."</div>\"> ".phrase_item_name."
		         <input type='text' id='column' onkeyup=\"clean('ta')\" onkeydown=\"clean('ta')\" name='item'/></p></br>  			       
			 <p title=\"<div class=admin-title><span>".phrase_item_code."</span> ".phrase_item_code_expl." </div>\" > ".phrase_item_code."
		         <input type='text' maxlength='4' id='column' name='code'/></p></br> 
			 <p title=\"<div class=admin-title><span>".phrase_item_color."</span> ".phrase_item_color_expl."</div>\"> ".phrase_item_color."
		         <input type='color' id='column' name='color'/></p></br>  
			 <p title=\"<div class=admin-title><span>".phrase_item_column."</span> ".phrase_item_column_expl."</div>\"> ".phrase_item_column."
		         <input type='text' id='column' name='column'/></p></br> 			 
			     <input type='submit' name='create' value ='".phrase_create."'/> 
       </form>
	 </div>

<div class='form jewel_right'>
        <form  name='".form_enc()."' method='post'>		
			<select name='select_jewel'>";				
		     while($config = mssql_fetch_array($check_config )){
				echo "<option value='".$config['ItemName'] ."'>".$config['ItemName'] ."</option>";			    
			}			
		echo "</select>		
        <input style='width:70px;' type='submit' value='".phrase_edit."' name='edit'/>
		<input style='width:70px;' type='submit' class='putoni' name='delete' value='".phrase_delete."'/>
		";
if (isset($_POST['select_jewel']) && isset($_POST['edit'])){
	$jewel_info = mssql_fetch_array(mssql_query("Select * from [DTweb_Deposit_Settings] where [ItemName] = '".trim($_POST['select_jewel'])."'"));
				     if ($jewel_info['Active'] == 1){
				     	 $selected1 = 'selected';$selected2 = '';					 
				     }
					 else{
						 $selected2 = 'selected';	$selected1 = '';					 
					 }			
        echo "	
		    <p> ".phrase_item_name."
		           <input type='text'  value='".$jewel_info['ItemName']."' name='item'/>
		    <p> ".phrase_item_code."
		           <input maxlength='4' type='text'  value='".$jewel_info['ItemFour']."' name='code'/></p></br> 
		    <p> ".phrase_item_color."
		           <input type='color'value='".$jewel_info['ItemColor']."' name='color'/></p></br>  
		    <p> ".phrase_item_column."
		           <input type='text' value='".$jewel_info['ItemColumn']."' name='column'/></p></br> 
			<p> ".phrase_active."		         
				    <select name='active'>
				        <option ".$selected1." value='1'>".phrase_yes."</option>
				        <option ".$selected2." value='0'>".phrase_no."</option>
				    </select></p>
					
                  <input type='submit' class='putoni' name='save' value='Save'/>				  
                  <input name='id' type='hidden' class='putoni' value='".$jewel_info['ItemName']."'/>
		</form>";
			}
echo "</div></div>";	
}
	?>