<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
function toto_won_nr(){
	$get_config = simplexml_load_file('./configs/mod_settings/r0toto_settings.xml');
	$max = $get_config -> maxs;
	$min = $get_config -> win_nr;
	    include("configs/config.php");
		$numbers     = range(1, $max);
        shuffle($numbers);
        $numbers     = array_slice($numbers, 0, $min); 
        $won_numbers = json_encode($numbers); 
		return($won_numbers);
}

function guild_res($guild){
	$a = array();
	$check = mssql_query("Select name from GuildMember where g_name='".$guild."'");
	while($all = mssql_fetch_array($check)){
	   $query_total = mssql_fetch_array(mssql_query("Select sum(Resets) as totalres from Character where Name='".$all['name']."' "));
     $a[] = $query_total['totalres'];
	}
	return array_sum($a);
}

function balls($var){
	$pic ='';
	$get_config = simplexml_load_file('./configs/mod_settings/r0toto_settings.xml');
	$design     = $get_config -> balldesign;
	$nr = json_decode($var);
	    foreach ($nr as $key => $value){
            $pic .= "<img style='width:35px;height:35px;' src='imgs/r0toto/balls/".$design."/".$value.".png'/>";
		}
	return $pic;
}
function save_config($file, $field, $yops){

   $feed = file_get_contents($file);
   $xml = simplexml_load_string($feed);
   $xml->$field=$yops;
   $xml->asXml($file);
}
	
function do_pass_reveal(){
    $show_msg = array('error'=> array());
	$email    = protect($_POST['email']);
	$question = protect($_POST['question']);
	$answer   = protect($_POST['answer']);
	$account  = protect($_POST['account']);
	$verify   = protect($_POST['verify']);
	$check = mssql_fetch_array(mssql_query("Select [memb___id] From [MEMB_INFO] WHere [memb___id]='".$account."' and [mail_addr]='".$email."' and [fpas_ques]='".$question."' and [fpas_answ]='".$answer."'"));
	if($verify != $_SESSION['verify']){
		$show_msg['error'][] = phrase_wrong_security_code;			
		}
	elseif($check['memb___id'] != $account){
        $show_msg['error'][] = phrase_this_acc_not_exist;
	}
	else{
		$show = mssql_fetch_array(mssql_query("Select memb__pwd from Memb_Info where [mail_addr] = '".$email."' and [fpas_ques] = '".$question."' and [fpas_answ] = '".$answer."' and [memb___id]='".$account."'")); 
		$show_msg['success'][0] =  phrase_acc_pass ."<font color='orange'>".$show['memb__pwd']."</font>";
	}
	return $show_msg;
}

function do_update_account(){
	$account     = $_SESSION['dt_username'];
	$newemail    = protect($_POST['newemail']);
	$newpassword = protect($_POST['newpassword']);
	$question    = protect($_POST['question']);
	$answer      = protect($_POST['answer']);
	$verify      = protect($_POST['verify']);
	$check       = mssql_fetch_array(mssql_query("Select * From [MEMB_INFO] WHere [memb___id]='".$account."' and [fpas_ques]='".$question."' and [fpas_answ]='".$answer."'"));
	$exist       = mssql_query("Select * from MEMB_INFO");
	if(isset($newemail)){$newemail = $newemail;}else{$newemail = $check['memb___id'];}
	 if(isset($newpassword)){$newpassword = $newpassword;}else{$newpassword = $check['memb__pwd'];}
	 
	    if($check['memb___id'] != $account){
	       $show_msg['error'][] = phrase_wrong_details;
	    }
	    elseif($verify != $_SESSION['verify']){
		   $show_msg['error'][] = phrase_wrong_security_code;			
		}
	    elseif(strlen($newpassword) < 4 OR strlen($newpassword) > 10){
		   $show_msg['error'][] = phrase_invalid_password_reg;
		}
	    else{			
		  mssql_query("Update [Memb_Info] set [memb__pwd] = '".$newpassword."', [mail_addr] = '".$newemail."' where [memb___id]='".$account."'");
		  $show_msg['success'][0] =  phrase_success_up_details;
		  mssql_query("Insert into [DTweb_Modules_Logs] 
		  ([module],[account],[date],[ip],[stats],[bank],[newmail],[newpass]) VALUES 
		  ('Change Account Details','".$account."', '".time()."', '".ip()."','".$check['mail_addr']."', '".$check['memb__pwd']."', '".$newemail."', '".$newpassword."')");
		}
	return $show_msg;
}

function do_reset_stats()
	{
		global $option;
		$acc = $_SESSION['dt_username'];
		$char = $_POST['character'];	
		$show_msg=array(
			'error'=>array()
		);
		
		if(empty($char))
		{
			$show_msg['error'][] = phrase_select_char;
		}
		elseif(preg_match('/[^a-zA-Z0-9\_\-]/', $char))
		{
			$show_msg['error'][] = phrase_invalid_symbols;
		}
		elseif(strlen($char) < 3 || strlen($char) > 10)
		{
			$show_msg['error'][] = phrase_invalid_char_name;
		}
		else
		{
			$is_acc_char = mssql_num_rows(
				mssql_query("SELECT Name FROM Character WHERE AccountID='". $acc ."' AND Name='". $char ."'")
			);
			
			$is_online=is_online($char, 1);
			$character = char_info($char);
			
			$new_lvlupp = $character['LevelUpPoint'] + $character['Strength'] + $character['Dexterity'] + $character['Vitality'] + $character['Energy'];

			$new_money = ($character['Money'] - $option['rs_zen']);

			if($is_acc_char==0)
			{
				$show_msg['error'][] = phrase_char_not_yours;
			}
			elseif($is_online === 1)
			{
				$show_msg['error'][] = phrase_leave_the_game;
			}
			elseif($new_money < 0)
			{
				$show_msg['error'][] = phrase_not_enough . phrase_zen;
			}
			elseif($character['cLevel'] < $option['rs_level'])
			{
				$show_msg['error'][] = phrase_you_need . ($option['rs_level'] - $character['cLevel']).phrase_more . phrase_levels . '!';
			}
			elseif($character['Resets'] < $option['rs_resets'])
			{
				$show_msg['error'][] = phrase_you_need . ($option['rs_resets'] - $character['Resets']).phrase_more . phrase_resets . '!';
			}
			else
			{
				$sql = "UPDATE Character SET Strength = 0, Dexterity = 0, Vitality = 0, Energy = 0,  Money = ".$new_money.",  LevelUpPoint = ".$new_lvlupp." WHERE Name='".$character['Name']."' AND AccountID='".$acc."'";
				mssql_query($sql);
				$show_msg['success'][0] =  phrase_stats_reset_success . $char . phrase_have . $new_lvlupp. phrase_points;
			}
		}
		return $show_msg;
	}

	function do_grand_reset()
	{
		global $option;
		$acc = $_SESSION['dt_username'];
		$char = $_POST['character'];
		
		$show_msg=array(
			'error'=>array()
		);
		
		if(empty($char))
		{
			$show_msg['error'][] = phrase_select_char;
		}
		elseif(preg_match('/[^a-zA-Z0-9\_\-]/', $char))
		{
			$show_msg['error'][] = phrase_invalid_symbols;
		}
		elseif(strlen($char) < 3 || strlen($char) > 10)
		{
			$show_msg['error'][] = phrase_invalid_char_name;
		}
		else
		{
			$is_acc_char = mssql_num_rows(
				mssql_query("SELECT Name FROM Character WHERE AccountID='". $acc ."' AND Name='". $char ."'")
			);

			$is_online = is_online($char, 1);
			$character = char_info($char);
			
			$new_gr = ($character['GrandResets'] + 1);
			
			$new_res = ($character['Resets'] - $option['gr_resets']);
			
			$new_money = ($character['Money'] - $option['gr_zen']);
		
			if($is_acc_char == 0)
			{
				$show_msg['error'][] = phrase_char_not_yours;
			}
			elseif($is_online === 1)
			{
				$show_msg['error'][] = phrase_leave_the_game;
			}
			elseif($character['cLevel'] < $option['gr_level'])
			{
				$show_msg['error'][] = phrase_you_need .($option['gr_level'] - $character['cLevel']).phrase_more . phrase_levels . '!';
			}
			elseif($new_res < 0)
			{
				$show_msg['error'][] = phrase_you_need .($option['gr_resets'] - $character['Resets']).phrase_more . phrase_resets . '!';
			}
			elseif($new_money < 0)
			{
				$show_msg['error'][] = phrase_not_enough . phrase_zen;
			}
			elseif($new_gr > $option['gr_max_resets'])
			{
				$show_msg['error'][] = phrase_grand_reset_max;
			}
			else
			{
				$sql ="UPDATE Character SET Resets = ". $new_res .", Money = ".$new_money.", GrandResets = ". $new_gr .", LevelUpPoint = ". $option['gr_reward'] .",cLevel = 1,Experience = 0 WHERE Name='".$character['Name']."' AND AccountID='".$acc."'";
				mssql_query($sql);
				
				if($option['gr_credits'] === 1)
				{
					$reward = mssql_fetch_array(
						mssql_query("SELECT ". $option['cr_db_column'] ." FROM ". $option['cr_db_table'] ." WHERE " . $option['cr_db_check_by'] ."='" . $acc . "'")
					);
					
					$gr_reward=($reward[$option['cr_db_column']] + $option['gr_reward']);
					
					$sql2 = "UPDATE ". $option['cr_db_table'] ." SET ". $option['cr_db_column'] ." = ".$gr_reward." WHERE  " . $option['cr_db_check_by'] ."='" . $acc . "'";
					mssql_query($sql2);
				}
				
				$show_msg['success'][0] = $char . phrase_grand_reset_success .$new_gr. phrase_time ;
			}
		}
		return $show_msg;
	}

	function do_add_stats()
	{
		global $option;
		$acc = $_SESSION['dt_username'];
		$char = $_POST['character'];
		$str = (int)$_POST['str'];
		$agi = (int)$_POST['agi'];
		$vit = (int)$_POST['vit'];
		$ene = (int)$_POST['ene'];
		$com = (int)$_POST['com'];
		$has_command = '';
		$is_dl = 0;

		$total_points=($str + $agi + $vit + $ene + $com);
		
		$show_msg=array(
			'error'=>array()
		);
		
		if(empty($char))
		{
			$show_msg['error'][] = phrase_select_char;
		}
		elseif(preg_match('/[^a-zA-Z0-9\_\-]/', $char))
		{
			$show_msg['error'][] = phrase_invalid_symbols;
		}
		elseif($com < 0 || $ene < 0 || $vit < 0 || $agi < 0 || $str < 0)
		{
			$show_msg['error'][] = phrase_invalid_symbols;
		}
		elseif(strlen($char) < 3 || strlen($char) > 10)
		{
			$show_msg['error'][] = phrase_invalid_char_name;
		}
		else
		{
			$is_acc_char = mssql_num_rows(
				mssql_query("SELECT Name FROM Character WHERE AccountID='". $acc ."' AND Name='". $char ."'")
			);
			
			$is_online=is_online($char, 1);
			$character=char_info($char);
			
			$lvlupp = $character['LevelUpPoint'];
			$new_lvlupp=($lvlupp - $total_points);
			
			$new_str = $character['Strength'] + $str;
			$new_agi = $character['Dexterity'] + $agi;
			$new_vit = $character['Vitality'] + $vit;
			$new_eng = $character['Energy'] + $ene;
			$new_com = 0;
			$set     = web_settings();
			if($set[7] === "99t")
			{
				if($character['Class'] == 64 OR $character['Class'] == 65 OR $character['Class'] == 66)
				{
					$new_com = $character['Leadership'] + $com;
					$has_command .= ', Leadership = '. $new_com;
					$is_dl = 1;
				}
			}
				
			if($is_acc_char == 0)
			{
				$show_msg['error'][] = phrase_char_not_yours;
			}
			elseif($is_online === 1)
			{
				$show_msg['error'][] = phrase_leave_the_game;
			}
			elseif($lvlupp < 1)
			{
				$show_msg['error'][] = phrase_you_need . phrase_more . phrase_points;
			}
			elseif($new_lvlupp < 0)
			{
				$show_msg['error'][] = phrase_you_need .($total_points - $lvlupp). phrase_more . phrase_points;
			}
			elseif($is_dl === 0 && $com != 0)
			{
				$show_msg['error'][] = phrase_char_use_command;
			}
			elseif(($new_str > $option['as_max_stats']) OR ($new_agi > $option['as_max_stats']) OR 
			($new_vit > $option['as_max_stats']) OR ($new_eng > $option['as_max_stats']))
			{
				$show_msg['error'][] = phrase_cant_have_more . $option['as_max_stats']. phrase_points;
			}
			else
			{
				$sql="UPDATE Character SET Strength = ".$new_str.", Dexterity = ".$new_agi.", Vitality = ".$new_vit.",Energy = ".$new_eng." ".$has_command.",  LevelUpPoint = ".$new_lvlupp." WHERE Name='".$character['Name']."' AND AccountID='".$acc."'";
				mssql_query($sql);
				$show_msg['success'][0] =  phrase_stats_added_success . $char . phrase_have . $new_lvlupp . phrase_points;
			}
		}
		return $show_msg;
	}

	function do_reset_character()
	{
		global $option;
		$acc = $_SESSION['dt_username'];
		$char = $_POST['character'];

		$show_msg=array(
			'error'=>array()
		);

		if(empty($char))
		{
			$show_msg['error'][] = phrase_select_char;
		}
		elseif(preg_match('/[^a-zA-Z0-9\_\-]/', $char))
		{
			$show_msg['error'][] = phrase_invalid_symbols;
		}
		elseif(strlen($char) < 3 || strlen($char) > 10)
		{
			$show_msg['error'][] = phrase_invalid_char_name;
		}
		else
		{
			$is_acc_char = mssql_num_rows(
				mssql_query("SELECT Name FROM Character WHERE AccountID='". $acc ."' AND Name='". $char ."'")
			);
	
			$is_online=is_online($char, 1);
			$character=char_info($char);
			
			$new_res=($character['Resets'] + 1);
			
			if($option['rc_zen_type'] === 1)
			{
				$option['rc_zen'] = ($option['rc_zen'] * $new_res);
			}
			
			$new_money=($character['Money'] - $option['rc_zen']);
			if($option['rc_bonus_points'] == 1)
			{
				switch($character['Class'])
				{
					case 0:
					case 1:
					case 2:
						$option['rc_stats_per_reset'] = $option['rc_stats_for_sm'];
						break;
					case 16:
					case 17:
					case 18:
						$option['rc_stats_per_reset'] = $option['rc_stats_for_bk'];
						break;
					case 32:
					case 33:
					case 34:
						$option['rc_stats_per_reset'] = $option['rc_stats_for_me'];
						break;
					case 48:
					case 49:
						$option['rc_stats_per_reset'] = $option['rc_stats_for_mg'];
						break;
					case 64:
					case 65:
						$option['rc_stats_per_reset'] = $option['rc_stats_for_dl'];
						break;
				}
			}

            
             if(($character['Resets'] > $option['rc_level_req1'][0]) && ($character['Resets'] < $option['rc_level_req1'][1])){
             	$request_level = $option['rc_level_req1'][2];
              }
             elseif(($character['Resets'] > $option['rc_level_req2'][0]) && ($character['Resets'] < $option['rc_level_req2'][1])){
             	$request_level = $option['rc_level_req2'][2];         
			}  
             elseif(($character['Resets'] > $option['rc_level_req3'][0]) && ($character['Resets'] < $option['rc_level_req3'][1])){
             	$request_level = $option['rc_level_req3'][2];             
			}
	    	else{$request_level = $option['rc_level'];
			}

			$level_up_points = $option['rc_stats_per_reset'];
			if($option['rc_stats_type'] === 1)
			{
				 $level_up_points = $level_up_points * $new_res;
			}
			if($option['rc_gr_bonus'] === 1)
			{
				 $level_up_points += ($option['gr_reward'] * $character['GrandResets']);
			}
		
			if($is_acc_char == 0)
			{
				$show_msg['error'][] = phrase_char_not_yours;
			}

			elseif($is_online === 1)
			{
				$show_msg['error'][] = phrase_leave_the_game;
			}
			elseif($character['cLevel'] < $request_level)
			{
				$show_msg['error'][] = phrase_you_need. $request_level. phrase_levels_to_reset;
			}
			elseif($new_money < 0)
			{
				$show_msg['error'][] = phrase_not_enough . phrase_zen;
			}
			elseif($new_res > $option['rc_max_resets'])
			{
				$show_msg['error'][] = phrase_maximum_resets;
			}
			else
			{
				
				$sql='UPDATE Character SET ';
				if($option['rc_clear_stats'] === 1)
				{
					$sql .='Strength = 25, Dexterity = 25, Vitality = 25, Energy = 25, ';
				}
				$sql .="Resets = ".$new_res.", Money = ".$new_money.", LevelUpPoint = ".$level_up_points.",cLevel = 1,Experience = 0 WHERE Name='".$character['Name']."' AND AccountID='".$acc."'";
				mssql_query($sql);
				$show_msg['success'][0] = $char . phrase_success_resets . $new_res . phrase_time;
			}
		}
		return $show_msg;
	}

	function do_pk_clear()
	{
		global $option;
		$acc = $_SESSION['dt_username'];
		$char = $_POST['character'];
		
		$show_msg=array(
			'error'=>array()
		);
		
		if(empty($char))
		{
			$show_msg['error'][] = phrase_select_char;
		}
		elseif(preg_match('/[^a-zA-Z0-9\_\-]/', $char))
		{
			$show_msg['error'][] = phrase_invalid_symbols;
		}
		elseif(strlen($char) < 3 || strlen($char) > 10)
		{
			$show_msg['error'][] = phrase_invalid_char_name;
		}
		else
		{
			$is_acc_char = mssql_num_rows(
				mssql_query("SELECT Name FROM Character WHERE AccountID='". $acc ."' AND Name='". $char ."'")
			);
			
			$is_online = is_online($char, 1);
			$character = char_info($char);
			
			if($option['pkc_zen_type'] === 1)
			{
				$option['pkc_zen'] = ($option['pkc_zen'] * ($character['PkLevel'] - 3));
			}
			
			$new_money=($character['Money'] - $option['pkc_zen']);
			
			if($is_acc_char==0)
			{
				$show_msg['error'][] = phrase_char_not_yours;
			}
			elseif($is_online === 1)
			{
				$show_msg['error'][] = phrase_leave_the_game;
			}
			elseif($character['PkLevel'] <= 3)
			{
				$show_msg['error'][] = phrase_char_not_killer;
			}
			elseif($new_money < 0)
			{
				$show_msg['error'][] = phrase_not_enough . phrase_zen;
			}
			else
			{
				$sql = "UPDATE Character SET Money = ".$new_money.",  PkLevel = 3 WHERE Name='".$character['Name']."' AND AccountID='".$acc."'";
				mssql_query($sql);
				$show_msg['success'][0] =  $char . phrase_char_success_cleared;
			}
		}
		return $show_msg;
	}

	function do_login()
	{
		global $option;
		$acc = $_POST['account'];
		$pass = $_POST['password'];
		$show_msg=array(
			'error'=>array()
		);
		
		if(empty($acc) OR empty($pass))
		{
			$show_msg['error'][] = phrase_empty_fields;
		}
		elseif(preg_match('/[^a-zA-Z0-9\_\-]/', $acc) OR preg_match('/[^a-zA-Z0-9\_\-]/', $pass))
		{
			$show_msg['error'][] = phrase_invalid_symbols;
		}
		else
		{
			$is_acc_pass = mssql_num_rows(
				mssql_query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='". $acc ."' AND memb__pwd='". $pass ."'")
			);
			
			if($is_acc_pass == 0)
			{
				$show_msg['error'][] = phrase_wrong_login_details;
			}
			else
			{
				
				$_SESSION['dt_username'] = $acc;
				$_SESSION['dt_password'] = $pass;
				home();
			}
		}
		return $show_msg;
	}

	function do_registration()
	{
		global $option;
		$acc = clean_post($_POST['account']);
		$pass = clean_post($_POST['password']);
		$repass = clean_post($_POST['repassword']);
		$mail = clean_post($_POST['email']);
		$sq = clean_post($_POST['question']);
		$sa = clean_post($_POST['answer']);
		$verify = clean_post($_POST['verify']);
		$show_msg=array(
			'error'=>array()
		);
		$error=0;
		
		if(empty($acc) OR empty($pass) OR empty($repass) OR empty($mail) OR empty($sq) OR empty($sa))
		{
			$show_msg['error'][] = phrase_empty_fields;
		}
		elseif(preg_match('/[^a-zA-Z0-9\_\-]/', $acc) OR preg_match('/[^a-zA-Z0-9\_\-]/', $pass) OR preg_match('/[^a-zA-Z0-9\_\-]/', $repass) OR preg_match('/[^a-zA-Z0-9\_\-]/', $sq) OR preg_match('/[^a-zA-Z0-9\_\-]/', $sa))
		{
			$show_msg['error'][] = phrase_invalid_symbols;
		}
		else
		{
			if(strlen($acc) < 4 OR strlen($acc) > 10)
			{
				$show_msg['error'][] = phrase_invalid_account__reg;
				$error=1;
			}
			if(strlen($pass) < 4 OR strlen($pass) > 10)
			{
				$show_msg['error'][] = phrase_invalid_password_reg;
				$error=1;
			}
			if($pass!=$repass)
			{
				$show_msg['error'][] = phrase_invalid_password_reg_mach;
				$error=1;
			}
			if(strlen($mail) > 60)
			{
				$show_msg['error'][] = phrase_invalid_mail_reg_width;
				$error=1;
			}
			if($sq==$sa)
			{
				$show_msg['error'][] = phrase_invalid_ques_reg_diff;
				$error=1;
			}
			if(strlen($sq) < 6 OR strlen($sq) > 10)
			{
				$show_msg['error'][] = phrase_invalid_ques_reg_wi;
				$error=1;
			}
			if(strlen($sa) < 6 OR strlen($sa) > 10)
			{
				$show_msg['error'][] = phrase_invalid_ans_reg_wi;
				$error=1;
			}
			if(isset($_SESSION['verify'])){
				if($verify != $_SESSION['verify']){
				$show_msg['error'][] = phrase_wrong_security_code;
				$error=1;
				}
			}
			if($error===0)
			{
				$is_acc_mail = mssql_num_rows(
					mssql_query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='". $acc ."' OR mail_addr='". $mail ."'")
				);
				
				if($is_acc_mail!=0)
				{
					$show_msg['error'][] = phrase_invalid_use_reg;
				}
				else
				{
					$id = 0;
					$qid = mssql_fetch_array(mssql_query("SELECT * FROM memb_info WHERE memb_guid=(SELECT MAX(memb_guid) FROM memb_info)"));
	                $id = $qid['memb_guid']+1;
					
				    if($option['md5'] == 1) {
				    	$do_reg = mssql_query("insert into Memb_Info ([memb___id],[memb__pwd],[memb_name],[sno__numb] ,[mail_addr],[fpas_ques],[fpas_answ],[bloc_code],[ctl1_code],[reg_date],[reg_ip]) Values ('".$acc."',[dbo].[fn_md5]('".$password."','".$username."'),'".$acc."','111111111','". $mail ."','". $sq ."','". $sa ."','0','0','".time()."','".ip()."')");
				    } else {
                        $do_reg = mssql_query("insert into Memb_Info ([memb___id],[memb__pwd],[memb_name],[sno__numb] ,[mail_addr],[fpas_ques],[fpas_answ],[bloc_code],[ctl1_code],[reg_date],[reg_ip]) Values ('".$acc."','".$pass."','".$acc."','111111111','". $mail ."','". $sq ."','". $sa ."','0','0','".time()."','".ip()."')");			
					}
				   	$vi  = mssql_query("INSERT INTO VI_CURR_INFO (ends_days,chek_code,used_time,memb___id,memb_name,memb_guid,sno__numb,Bill_Section,Bill_value,Bill_Hour,Surplus_Point,Surplus_Minute,Increase_Days )  VALUES ('2005','1',1234,'".$acc."','".$pass."','".$id."','111111111','6','3','6','6','2003-11-23 10:36:00','0' )");
					$go  = mssql_query("INSERT into DTweb_JewelDeposit ([memb___id]) Values ('".$acc."')") ;
					$nes = mssql_query("INSERT into Memb_Credits ([memb___id]) Values ('".$acc."')") ;
					$ko  = mssql_query("INSERT into DTweb_Bank ([memb___id]) Values ('".$acc."')") ;
					
					$show_msg['success'][0] = phrase_thanks . $acc. phrase_success_reg;
				}
			}
		}
return $show_msg;
}

function web_settings(){
	
$settings = mssql_fetch_array(mssql_query("Select * from [DTweb_settings]")); 
if($settings['title'] == null){
	mssql_query("INSERT [dbo].[DTweb_settings] ([title], [keywords], [meta], [theme], [server_name], [server_ip], [server_port], [server_version], [server_host], [server_exp], 
	[server_max], [server_drop], 
	[topcchar], 
	[topcharpage], 
	[topguild], 
	[topguildpage], 
	[topkills], 
	[topkillspage], 
	[facebook_link], 
	[tweeter_link],
	[shop_link], 
	[vote_link1], 
	[vote_link2], 
	[vote_text]) VALUES ('RFQgV2ViIDIuMA==', 'bXVvbmxpbmUsIHNlcnZlciwgTm8gV2Vic2hvcHMgYW5kIGV0YyA=', 'TXVPbmxpbmUgRGFya3NUZWFtIEZpbGVzIDk3RCwgQmFzZWQgaW4gQnVsZ2FyaWEsIEN1c3RvbSBtb2JzLCBjdXN0b20gamV3ZWxzLCBObyBGTyBpdGVtcyBhbmQgZXRj', 'Aion', 'TXUgRGFya3NUZWFt', 'MTI3LjAuMC4x', 'MTI3LjAuMC4x', 'OTdk', 'QnVsZ2FyaWE=', 'OTB4', 'MjAw', 'MzB4', 1, 20, 1, 1, 2, 5, 'aHR0cDovL3d3dy5mYWNlYm9vay5jb20=', 'aHR0cHM6Ly90d2l0dGVyLmNvbS8/bGFuZz1lbg==', 'aHR0cDovL2RhcmtzdGVhbS5uZXQv', 'aHR0cDovL3h0cmVlbS5jb20=', 'aHR0cDovL3h0cmVlbS5jb20=', 'VGhpcyByZWFsbHkgbWF0dGVy')");
    refresh();
	}
else{
return array(base64_decode($settings['title']),base64_decode($settings['keywords']),base64_decode($settings['meta']),$settings['theme'],  
base64_decode($settings['server_name']),
base64_decode($settings['server_ip']),
base64_decode($settings['server_port']),
base64_decode($settings['server_version']),   
base64_decode($settings['server_host']),   
base64_decode($settings['server_exp']),
base64_decode($settings['server_max']),
base64_decode($settings['server_drop']),
$settings['topcchar'],
$settings['topcharpage'],
$settings['topguild'],
$settings['topguildpage'],
$settings['topkills'],
$settings['topkillspage'],
base64_decode($settings['facebook_link']),
base64_decode($settings['tweeter_link']),   
base64_decode($settings['shop_link']),   
base64_decode($settings['vote_link1']),
base64_decode($settings['vote_link2']),
base64_decode($settings['vote_text'])
);
}
}	
function lang(){
	
	  if(isset($_POST['change_lang']) ){	
           $_SESSION['lang'] = $_POST['change_lang'];	  
		}
	if(!empty($_SESSION['lang'])){
       $filename = $_SERVER['DOCUMENT_ROOT'].'/lang/'.$_SESSION['lang'].'.php';		
      if (file_exists($filename)){
		  require_once($filename);
	  }
	  else{
		 echo "This language file  doesn't exists";
	  }
    }
      else{
      	require_once($_SERVER['DOCUMENT_ROOT']."/lang/en.php");
      }	
}

function intersect($a=0,$b=0) 
{ 
 $m = array();
 $get=array(); 
 
        for($i=0;$i<sizeof($a);$i++) { 
                $m[]=$a[$i]; 
        } 
        for($i=0;$i<sizeof($a);$i++) 
        { 
                $m[]=$b[$i]; 
        } 
        sort($m); 
        
        for($i=0;$i<sizeof($m);$i++) 
        {     
	            $k = $i+1;
	            if(isset($m[$i]) && isset($m[$k])){
                if($m[$i]==$m[$k]) {
                $get[]=$m[$i]; 
				  }
				}
        } 
        return $get; 
}
	
function server_time($times){
@session_start();
$bg = array( 'Януари', 'Февруари', 'Март', 'Април', 'Май', 'Юни', 'Юли', 'Август', 'Септември', 'Октомври', 'Ноември', 'Декември' );
$en = array( 'January', 'February', 'March', 'April','May', 'June', 'July', 'August', 'September', 'Oktober', 'November', 'December' ); 
$es = array( 'Enero', 'Febrero', 'Marzo', 'Abril','Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ); 
$ro = array( 'Ianuarie', 'Februarie', 'Martie', 'Aprilie','Mai', 'Iunie', 'Iulie', 'August', 'Septembrie', 'Octombrie', 'Noiembrie', 'Decembrie' ); 
$ru = array( 'Январь', 'Февраль', 'Март', 'Апрель','Май', 'Июнь', 'Июль', 'Августейший', 'Сентябрь', 'Октября', 'Ноябрь', 'Декабрь' ); 

$time = date("H:i:s F j, Y",$times);
   if(isset($_SESSION['lang'])){
      switch($_SESSION['lang']){
      case $_SESSION['lang']:$change = str_replace($en, ${$_SESSION['lang']}, $time);break;
      default:$change = $time;break;
  }
   }
   else{
	  $change = $time; 
   }
  return $change;
}

function form_enc() {	
	$get_key    = mssql_fetch_array(mssql_query("Select [encrypt_key] from [DTweb_Market_Settings]"));
    $secure = base64_encode($get_key['encrypt_key']);
	return $secure;
}

function lang_form(){
	
	return '
	 <div id="lang">
	   <form method="post">
                  <input type="submit" value="en" style="color:transparent;background-image:url(../imgs/flags/us.png);width:45px;height:27px;" class=" border hvr-pop " name="change_lang"/>
                  <input type="submit" value="bg" style="color:transparent;background-image:url(../imgs/flags/bg.png);width:45px;height:27px;" class=" border hvr-pop" name="change_lang"/>
				  <input type="submit" value="es" style="color:transparent;background-image:url(../imgs/flags/es.png);width:45px;height:27px;" class=" border hvr-pop" name="change_lang"/>
				  <input type="submit" value="ro" style="color:transparent;background-image:url(../imgs/flags/ro.png);width:45px;height:27px;" class=" border hvr-pop" name="change_lang"/>
				  <input type="submit" value="ru" style="color:transparent;background-image:url(../imgs/flags/ru.png);width:45px;height:27px;" class=" border hvr-pop" name="change_lang"/>
        </form>
	 </div>';
}
function time_diff($start, $s) {
	$string = "";
	if(isset($_SESSION['lang'])){
	 switch($_SESSION['lang']){
		 case "bg": $d = "д";$h="ч";$m="м";$ss="с";break;
		 default:$d ="d";$h="h";$m="m";$ss="s";break;
	 }
	}
	else{
		$d ="d";$h="h";$m="m";$ss="s";
	}
    $t = array( 
        $d => 86400,
        $h => 3600,
        $m => 60,
    );
    $s = abs($s - $start);
    foreach($t as $key => &$val) {
        $$key = floor($s/$val);
        $s -= ($$key*$val);
        $string .= ($$key==0) ? '' : $$key . "$key ";
    }
    return $string . $s. $ss;
}


function serial_search($location = ""){
if (isset($_GET['serial'])){
	$serial = trim(clean_post($_GET['serial']));
	if(strlen($serial) == 8){
		$result = mssql_query("select [Name] from [Character] where (charindex (0x".$serial.", Inventory) > 0 )") ;
		  	while($check  = mssql_fetch_array($result)){			
			      $show_char[] = '<a href="?p=logs&logs=market&account=inventory&inventory='.($check['Name']).'">'.$check['Name'].'</a>';				
			}
		$results = mssql_query("select [AccountId] from [warehouse] where (charindex (0x".$serial.", Items) > 0 )") ;
		  	while($checks  = mssql_fetch_array($result)){			
			      $show_acc[] = '<a href="?p=logs&logs=market&account=inventory&inventory='.($checks['Name']).'">'.$checks['Name'].'</a>';							
			 }
		if(!empty($show_char)){
		echo phrase_serial_has_been_found_inventory;
		foreach($show_char as $key){
			$_SESSION['admin_user'] = $_SESSION['dt_username'];$_SESSION['location']=$location;$_SESSION['admin_ip'] = ip();
			echo $key." | </br>";
		}
	}
	   if(!empty($show_acc)){
		echo phrase_serial_has_been_found_warehouse;
		foreach($show_acc as $keys){
			$_SESSION['admin_user'] = $_SESSION['dt_username'];$_SESSION['location']=$location;$_SESSION['admin_ip'] = ip();
			echo $keys." | </br>";
		}
	}
	   if(empty($show_acc) && empty($show_char)){
		echo phrase_serial_doesnt_exist. "</br>";
	}
 }
    else{
		echo phrase_type_8_chars;
	}		  
  }
}

function send_gifts($char,$receiver,$sender){
	include("configs/config.php");
    $show_msg     = array();		
    $chk_usr_res  = mssql_fetch_array(mssql_query("Select * from [DTweb_JewelDeposit] where [memb___id] = '{$sender}'"));
	$chk_usr_cr   = mssql_fetch_array(mssql_query("Select * from [Memb_Credits] where [memb___id] = '{$sender}'"));
    $chk_usr_zen  = mssql_fetch_array(mssql_query("Select * from [Bank] where [memb___id] = '{$sender}'"));
		
	foreach($option['gift_res'] as $value){
	 if(!empty($_POST[$value])){
		$count = (int)trim(clean_post($_POST[$value]));  
		    if($option['gift_procent'] > 0){
		        $count_multy = ceil($count*($option['gift_procent']/100));
				$option['gift_credits'] = 0;
	        }
	        else{
		        $count_multy = $count;
	        }
         if($value === 'zen' && isset($_POST[$value])  && $count > 0){
			if($chk_usr_zen['Zen'] < $count) {
				$error = 1; 
				$show_msg[] = "Not Enough &nbsp". $value;
			 }
			else{
				$update_sen = mssql_query("Update [DTweb_Bank] set [Zen] = [Zen]- {$count_multy} where [memb___id] = '{$sender}'");
				$update_rec = mssql_query("Update [DTweb_Bank] set [Zen] = [Zen]+ {$count} where [memb___id] = '{$receiver}'");
			   if(!$update_sen || !$update_rec){
				$error = 1; 
				$show_msg[] = phrase_contact_administrator;				   
			    }
			   else{
				 $error = 0;
		         $show_msg[] = $count . "&nbsp". $value ." has been send to {$char} ";  
			    }
			 }
		  }
		 if($value === 'credits' && isset($_POST[$value])  && $count > 0){
			if($chk_usr_cr['credits'] < $count) {
				$error = 1;
				$show_msg[] = "Not Enough &nbsp". $value;
			}
			else{
				$update_sen = mssql_query("Update [Memb_Credits] set [credits] = [credits]- {$count_multy} where [memb___id] = '{$sender}'");
				$update_rec = mssql_query("Update [Memb_Credits] set [credits] = [credits]+ {$count} where [memb___id] = '{$receiver}'");
			   if(!$update_sen || !$update_rec){
				$error = 1; 
				$show_msg[] = phrase_contact_administrator;				   
			    }
			   else{
				 $error = 0;
		         $show_msg[] = $count . "&nbsp". $value ." has been send to {$char} ";  
			    }
			 }
		  }

		 if($value != 'credits' && $value != 'zen' && isset($_POST[$value]) && $count > 0){
			if($chk_usr_res[$value] < $count ) {
				$error = 1;
				$show_msg[] = "Not Enough &nbsp". $value;
			}
			else{
				$update_sen = mssql_query("Update [DTweb_JewelDeposit] set [{$value}] = [{$value}]- {$count_multy} where [memb___id] = '{$sender}'");
				$update_rec = mssql_query("Update [DTweb_JewelDeposit] set [{$value}] = [{$value}]+ {$count} where [memb___id] = '{$receiver}'");				
			   if(!$update_sen || !$update_rec){
				$error = 1; 
				$show_msg[] = phrase_contact_administrator;				   
			    }
			   else{
				 $error = 0;
		         $show_msg[] = $count . "&nbsp". $value ." has been send to {$char} ";  
			    }
			}
		}
	}
}
	 
foreach($show_msg as $message){
	if($error == 1){
		echo "<div class='error'>".$message."</div>";
	}
	else{
		if($option['gift_credits'] != 0){
		   $pay_credits = mssql_query("Update [Memb_Credits] set [credits] = [credits] - {$option['gift_credits']} where [memb___id]='{$sender}'");	
		}
		echo "<div class='success'>".$message."</div>";
		echo "<script>setTimeout(\"location.href = '?p=user&character=".$char."';\",1000);</script>";
	}
  }
}

function auto_ban(){
	include("configs/config.php");
	$banned   = mssql_query("Select * from [DTweb_Banned]");
	while($accounts = mssql_fetch_array($banned)){	
	if($accounts['account'] <> NULL && $accounts['character'] === NULL){
	    if(time() > $accounts['end_date']){			
	    	    mssql_query("Update [Memb_Info] set [bloc_code] = 0 where [memb___id] = '".$accounts['account']."'");
	    	    mssql_query("Update DTweb_Banned set [active] = 0 where [id] = '".$accounts['id']."'");	   
			}
	    if(time() > $accounts['start_date'] && $accounts['active'] == 1){
	    	    mssql_query("Update [Memb_Info] set [bloc_code] = 1 where [memb___id] = '".$accounts['account']."'");
			}
		}		
	elseif($accounts['character'] <> NULL && $accounts['account'] === NULL){
	    if(time() > $accounts['end_date']){
				mssql_query("Update [Character] set [CtlCode] = 0 where [Name] = '".$accounts['character']."'");
				mssql_query("Update DTweb_Banned set [active] = 0 where [id] = '".$accounts['id']."'");
			}
	    elseif(time() > $accounts['start_date'] && $accounts['active'] == 1 && $accounts['warn_count'] == 0){
	    		mssql_query("Update [Character] set [CtlCode] = 1 where [Name] = '".$accounts['character']."'");
			}
		elseif(time() > $accounts['start_date'] && $accounts['active'] == 1 && $accounts['warn_count'] >= $option['warning_times']){
	    		mssql_query("Update [Character] set [CtlCode] = 1 where [Name] = '".$accounts['character']."'");
			}
		}
        else{
		       return;		
        }    	
    }		
}


}