<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{

function season(){
	require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
	    switch($option['item_hex_lenght']){
			case 20:return array(20,1200,1080); break;
			case 32:return array(32,3840,3776); break;
			case 64:return array(64,7680,7584); break;
			default: return false; break;
		}
}
	
function itemimage($level, $level2, $level3,$ancient=0) {
	
	if(season()){
		$item_conf = season();
		if($item_conf[0] === 20){
		$level1 = hexdec(substr($level, 0, 1));

        if (($level1 % 2) <> 0) {
            $level2 = "1" . $level2;
            $level1--;
        }

        if (hexdec($level3) >= 128) {
            $level1 += 16;
        }

        $level1 /= 2;
        $level2 = hexdec($level2);

		}
		else{
			$level1= $level;
		}
		if($ancient > 0){
			if(file_exists("imgs/items/{$level1}/0".$level2.".gif")){
				$image   = "imgs/items/{$level1}/0".$level2.".gif";
			}
			else{
				$image   = "imgs/items/{$level1}/{$level2}.gif";
			}		  	
		}
		else{		
		  $image   = "imgs/items/{$level1}/{$level2}.gif";	
		}
	  }
	  if(file_exists($image)){
		  return $image;
	  }
	  else{		  
		  return "imgs/items/no.gif";
	  }
    }
	
function Iteminfouser($_item,$level_req=0) {
    require("configs/config.php");
	    $nocolor       = false;
		$socket        = array();
		$nolevel       = 1;
		$plusche       = false;
		$exl           = false;
		$option        = false;
	    $itemexl       = false;
		$socketoption  = false;
		$harmony       = false;
		$itemoption    = false;
		$sockets       = false;
		$refine        = false;
		$anc_opt       = false;
		$iteminfoadmin = false;
		$itemanc       = false;
		$item_for      = false;
		$rowinfo       = false;
		$addinfo       = false;
		$item_for      = false;
		$item_req      = false;
		
        if (substr($_item, 0, 2) == '0x') {
            $_item = substr($_item, 2);
        }
        if(season()){
			$season_settings = season();
            if ((strlen($_item) != $season_settings[0]) || preg_match('/[^\W_ ] /',$_item) || ($_item == str_repeat('F',$season_settings[0]))) {
                return false;
            }
        }
		else{
			return false;
		}
        // Get the hex contents
        $id         = hexdec(substr($_item, 0, 2));  // Item ID
		$ids        = hexdec(substr($_item, 1, 1));  // Item ID
        $lvl        = hexdec(substr($_item, 2, 2));  // Level,Option,Skill,Luck
        $itemdur    = hexdec(substr($_item, 4, 2));  // Item Durability
        $ex         = hexdec(substr($_item, 14, 2)); // Item Excellent Info/ Option
        $serial	    = substr($_item,6,8);            // Item Serial
        $anc	    = hexdec(substr($_item,16,2));   // Item Ancient
		if($season_settings[0] == 64){
			$serial = hexdec(substr($_item,32,8));
		}
		if ($lvl < 128) {
            $skill = '';
			$srch_skill = 0;
        } else {
            $skill = 'This weapon has a special skill</br>';
            $lvl = $lvl - 128;
			$srch_skill = 1;
        }
        
        $itemlevel = floor($lvl / 8);
        $lvl = $lvl - $itemlevel * 8;

        if ($lvl < 4) {
            $luck = '';
			$srch_luck = 0;
        } else {
            $luck = "Luck (success rate of jewel of soul +25%)<br>Luck (critical damage rate +5%)";
            $lvl = $lvl - 4;
			$srch_luck = 1;
        }


        if ($ex - 128 >= 0) {
            $ex = $ex - 128;
        }
        if ($ex >= 64) {
            $lvl+=4;
            $ex+=-64;
        }
        if ($ex < 32) {
            $exc6 = 0;
        } else {
            $exc6 = 1;
            $ex+=-32;
        }
        if ($ex < 16) {
            $exc5 = 0;
        } else {
            $exc5 = 1;
            $ex+=-16;
        }
        if ($ex < 8) {
            $exc4 = 0;
        } else {
            $exc4 = 1;
            $ex+=-8;
        }
        if ($ex < 4) {
            $exc3 = 0;
        } else {
            $exc3 = 1;
            $ex+=-4;
        }
        if ($ex < 2) {
            $exc2 = 0;
        } else {
            $exc2 = 1;
            $ex+=-2;
        }
        if ($ex < 1) {
            $exc1 = 0;
        } else {
            $exc1 = 1;
            $ex+=-1;
        }
       if($season_settings[0] == 20){
		 $level    = substr($_item, 0, 1);
         $level2   = substr($_item, 1, 1);
         $level3   = substr($_item, 14, 2);
         $AA       = $level;
         $BB       = $level2;
         $CC       = $level3; 
		 $refinery = 0;
		 $level1   = hexdec(substr($level, 0, 1));
		 
		if (($level1 % 2) <> 0) {
            $level2 = "1" . $level2;
            $level1--;
        }
        if (hexdec($level3) >= 128) {
            $level1 += 16;
        }
        $level1 /= 2;
        $level2 = hexdec($level2);
        $harmonyoption = 0;
	   }
	   else{		   
		 $level2        =   hexdec(substr($_item, 0, 2)); 
         $level         =   floor((hexdec(substr($_item,18,2))) / 16);
         $level3        =   substr($_item, 14, 2);
         $AA            =   $level;
         $BB            =   strval(intval($level2));
         $CC            =   $level3;  
		 $level1        =   $level;
		 $harmonyoption	=	hexdec(substr($_item,20,1));		
		 $harmonyvalue	=	hexdec(substr($_item,21,1));
         $refinery		=	hexdec(substr($_item,19,1));		 
	     $socket[1]     =   hexdec(substr($_item,22,2));
	     $socket[2]     =   hexdec(substr($_item,24,2));
	     $socket[3]     =   hexdec(substr($_item,26,2));
	     $socket[4]     =   hexdec(substr($_item,28,2));
	     $socket[5]     =   hexdec(substr($_item,30,2));		 
	    }

 
        $rows         = mssql_fetch_array(mssql_query("SELECT * FROM [DTweb_JewelDeposit_Items] WHERE [id]={$level2} AND [type]={$level1}"));
		$invview      = mssql_fetch_array(mssql_query("SELECT * FROM [DTweb_AllSeasons_Items] WHERE [id]={$level2} AND [type]={$level1}"));
        $iopxltype    = $invview['exeopt'];
        $itemname     = $invview['Name'];

		
        if($level1 <= 5){
			if($invview["TwoHand"] === 1){			
				$addinfo .= "Two handed attack power: " . $invview["DamageMin"] . "~" . $invview["DamageMax"]. "</br>";	
			}				
			else{
				$addinfo .= "One handed attack power: " . $invview["DamageMin"] . "~" . $invview["DamageMax"]. "</br>"; 
			}
			if($invview["MagicPower"] > 0){
					$addinfo .= "</br>Magic Power: " . $invview["MagicPower"]. "</br>";
			}
			if($invview["MagicDurability"] > 0){
					$addinfo .= "</br>Magic Durability:" . $invview["MagicDurability"]. "</br>";
			}
		}
		if($level1 == 10 || $level1 <= 5){
			$addinfo .= "Attack Speed: " .$invview["AttackSpeed"]. "</br>";
		}
		if($level1 === 11){
			$addinfo .= "Walk Speed: " .$invview["WalkSpeed"]. "</br>";
		}
		if($level1 > 5 && $level1 < 13){
			$addinfo .= "Armor: " .$invview["Defense"]. "</br>";
		}
		if($level1 == 6){
		    $addinfo .= "Defense Rate: " .$invview["SuccessfulBlocking"] . "</br>";	
		}

		
		if	($invview['ReqLevel']	      >	    0){	 $item_req	.=	"Level Requirement:    ". $invview['ReqLevel']	    ." <br>";	}
		if	($invview['ReqStrength']	  >	    0){	 $item_req	.=	"Strength Requirement: ". $invview['ReqStrength']	." <br>";	}
	    if	($invview['ReqDexterity']	  >	    0){	 $item_req	.=	"Agility Requirement:  ". $invview['ReqDexterity']	." <br>";	}
	    if	($invview['ReqVitality']	  >	    0){	 $item_req	.=	"Vitality Requirement: ". $invview['ReqVitality']	." <br>";	}
	    if	($invview['ReqEnergy']		  >	    0){	 $item_req	.=	"Energy Requirement:   ". $invview['ReqEnergy']		." <br>";	}
	    if	($invview['ReqCommand']		  >	    0){	 $item_req	.=	"Command Requirement:  ". $invview['ReqCommand']	." <br>";	}	    
		if	($invview['GrowLancer']       ==	1){  $item_for	.=  "Can be equipped by Grow Lancer                        <br>";   }
		if	($invview['RageFighter']	  ==	1){  $item_for	.=  "Can be equipped by Rage Fighter                       <br>";   }
		if	($invview['DarkKnight']       ==	1){  $item_for	.=  "Can be equipped by Dark Knight                        <br>";   }
	    if	($invview['DarkKnight']	      ==	2){  $item_for	.=  "Can be equipped by Blade Knight                       <br>";   }
	    if	($invview['DarkKnight']	      ==	3){  $item_for	.=  "Can be equipped by Blade Master                       <br>";   }
	    if	($invview['DarkWizard']	      ==	1){  $item_for	.=  "Can be equipped by Dark Wizard                        <br>";   }
	    if	($invview['DarkWizard']	      ==	2){  $item_for	.=  "Can be equipped by Soul Master                        <br>";   }
	    if	($invview['DarkWizard']	      ==	3){  $item_for	.=  "Can be equipped by Grand Master                       <br>";   }
	    if	($invview['FairyElf']	      ==	1){  $item_for	.=  "Can be equipped by Fairy Elf                          <br>";   }
	    if	($invview['FairyElf']	      ==	2){  $item_for	.=  "Can be equipped by Mouse Elf                          <br>";   }
	    if	($invview['FairyElf']	      ==	3){  $item_for	.=  "Can be equipped by Height elf                         <br>";   }
	    if	($invview['MagicGladiator']	  ==	1){  $item_for	.=  "Can be equipped by Magic Gladiator                    <br>";   }
	    if	($invview['MagicGladiator']	  ==	2){  $item_for	.=  "Can be equipped by Duel Master                        <br>";   }
	    if	($invview['MagicGladiator']	  ==	3){  $item_for	.=  "Can be equipped by Duel Master                        <br>";   }
	    if	($invview['DarkLord']         ==	1){  $item_for	.=  "Can be equipped by Dark Lord                          <br>";   }
	    if	($invview['DarkLord']	      ==	2){  $item_for	.=  "Can be equipped by Lord Emperor                       <br>";   }
	    if	($invview['DarkLord']	      ==	3){  $item_for	.=  "Can be equipped by Lord Emperor                       <br>";   }
	    if	($invview['Summoner']	      ==	1){  $item_for	.=  "Can be equipped by Summoner                           <br>";   }
	    if	($invview['Summoner']	      ==	2){  $item_for	.=  "Can be equipped by Bloody Summoner                    <br>";   }
	    if	($invview['Summoner']	      ==	3){  $item_for	.=  "Can be equipped by Dimension Master                   <br>";   }
		
	    if(strlen($item_for) == 464){
			$item_for_fix = "Can be equipped by any class</br>";}
		else{
			$item_for_fix = $item_for;
		}

			
        switch ($iopxltype) {
			      //All Weapons
                   case 0 :
		               $op1     = 'Increase Mana per kill +8';
		               $op2     = 'Increase hit points per kill +8';
		               $op3     = 'Increase attacking(wizardly)speed+7';
		               $op4     = 'Increase wizardly damage +2%';
		               $op5     = 'Increase Damage +level/20';
		               $op6     = 'Excellent Damage Rate +10%';
		               $inf     = 'Additional Damage';
                       break;
		          //All Armors
                   case 1:
                       $op1     = 'Increase Zen After Hunt +40%';
                       $op2     = 'Defense success rate +10%';
                       $op3     = 'Reflect damage +5%';
                       $op4     = 'Damage Decrease +4%';
                       $op5     = 'Increase MaxMana +4%';
                       $op6     = 'Increase MaxHP +4%';
                       $inf     = 'Additional Defense';			
                       $skill   = '';
                       $nocolor = false;
                       break;
		          //Wings Only ** DB Equal to DarkMaster Server files Item.kor - 97/99XT 
                   case 2:
 		               $op1	    = ' Increased Health +'.(50+(5*$itemlevel));
		               $op2	    = ' Increased Mana +'.(50+(5*$itemlevel));
		               $op3	    = " Ignores 3% of your opponent\'s armor";
		               $op4	    = ' Increase Stamina +50';
		               $op5	    = ' Increase Attacking Speed +5';
		               $op6	    = '';
		               $inf	    = 'Additional Damage';
		               $skill	= '';
		               $nocolor = true;
		          	break;
		          //Rings Only ** DB Equal to DarkMaster Server files Item.kor - 97/99XT 
		          case 3:
                       $op1     = ' + HP 4%';
                       $op2     = ' + MANA 4%';
                       $op3     = ' Reduce DMG +4%';
                       $op4     = ' Reflect DMG + 5%';
                       $op5     = ' Defense Rate + 10%';
                       $op6     = ' Zen After Hunting +40%';
                       $inf     = ' Additional Damage';
                       $skill   = '';
                       $nocolor = true;
		          	break;
		          //Pendants Only **  DB Equal to DarkMaster Server files Item.kor - 97/99XT 
		          case 4:
                       $op1     = ' Excellent DMG Rate +10%';
                       $op2     = ' + DMG LVL/20';
                       $op3     = ' + DMG 2%';
                       $op4     = ' Wizard Speed +7';
                       $op5     = ' +LIFE After Hunting (LIFE/8)';
                       $op6     = ' +MANA After Hunting (MANA/8)';
                       $inf     = ' Additional Damage';
                       $skill   = '';
                       $nocolor = true;
		           break;
				 //Fenrir
		          case 6:
				     $skill	    = " Plasma storm skill (Mana:50)<br>";
                       $op1     = ' Fenrir Destroy </br>Plasma storm skill (Mana:50)<br>Increase final damage 10%';
                       $op2     = ' Fenrir Protect</br>Plasma storm skill (Mana:50)<br>Absorb final damage 10%<br>Increase speed';
                       $op3     = ' Golden Fenrir</br>Plasma storm skill (Mana:50)<br>Increase speed';
                       $op4     = '';
                       $op5     = '';
                       $op6     = '';
                       $inf     = '';
                       $skill   = '';
                       $nocolor = true;
		             break;
		}

	if ($anc > 0){
		$image_tip = 1;
		switch ($anc){
			case 4:$itemanc ='</br><font color=#bfbfff>Ancient Item +5 stamina</font>';break;
			case 9:$itemanc ='</br><font color=#bfbfff>Ancient Item +10 stamina</font>';break;	           				
		}
       
			if( /*Warrior Leather Set*/
				(($rows['type']==7) && ($rows['id']==5)) ||          
				(($rows['type']==8) && ($rows['id']==5)) ||
				(($rows['type']==9) && ($rows['id']==5)) ||
				(($rows['type']==10) && ($rows['id']==5)) ||
				(($rows['type']==11) && ($rows['id']==5)) ||
				(($rows['type']==12) && ($rows['id']==8)) ||
				(($rows['type']==2) && ($rows['id']==1))
			) {$itemname = 'Warrior '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Strength +10<br />Incr. attack rate +10<br />Incr. maximum AG +20<br />AG increase Rate + 5<br />Increase Defense + 20<br />Increase agility +10<br />Critical damage rate + 5%<br />Excellent damage rate + 5%<br />Increase strength + 25</font>";}
			elseif( /*Hyperion Bronze Set*/
				(($rows['type']==8) && ($rows['id']==0)) ||
				(($rows['type']==9) && ($rows['id']==0)) ||
				(($rows['type']==11) && ($rows['id']==0)) 
			) {$itemname = 'Hyperion '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Energy + 15<br />Increase Agility + 15<br />Increase skill attacking rate +20<br />Increase Mana + 30</font>";}
			elseif( /*Eplete Scale Set*/
				(($rows['type']==7) && ($rows['id']==6)) ||
				(($rows['type']==8) && ($rows['id']==6)) ||
				(($rows['type']==9) && ($rows['id']==6)) ||
				(($rows['type']==6) && ($rows['id']==9)) ||
				(($rows['type']==12) && ($rows['id']==2)) 
			) {$itemname = 'Eplete '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase atack skill + 15<br />Increase atack + 50<br />Increase Wizardry dmg + 5%<br />Maximum HP +50<br />Increase maximum AG +30<br />Incr. Critical damage rate +10%<br />Excellent damage rate +10</font>";}
			elseif( /*Garuda Brass Set*/
				(($rows['type']==8) && ($rows['id']==8)) ||
				(($rows['type']==9) && ($rows['id']==8)) ||
				(($rows['type']==10) && ($rows['id']==8)) ||
				(($rows['type']==11) && ($rows['id']==8)) ||
				(($rows['type']==12) && ($rows['id']==13))
			) {$itemname = 'Garuda '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase max stamine + 30<br />Double Damage rate + 5%<br />Energy + 15<br />Maximum HP +50<br />Increase skill attack rate + 25<br />Increase Wizardry Damage + 15%</font>";}
			elseif( /*Kantata Plate Set*/
				(($rows['type']==8) && ($rows['id']==9)) ||
				(($rows['type']==10) && ($rows['id']==9)) ||
				(($rows['type']==11) && ($rows['id']==9)) ||
				(($rows['type']==12) && ($rows['id']==23)) ||
				(($rows['type']==12) && ($rows['id']==9))
			) {$itemname = 'Kantata '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Energy + 15<br />Vitality + 30<br />Increase Wizardry Damage + 10%<br />Strength +15<br />Increase skill damage + 25<br />Excellent damage rate + 10%<br />Increase excellent damage + 20</font>";}
			elseif( /*Hyon Dragon Set*/
				(($rows['type']==7) && ($rows['id']==1)) ||
				(($rows['type']==10) && ($rows['id']==1)) ||
				(($rows['type']==11) && ($rows['id']==1)) ||
				(($rows['type']==0) && ($rows['id']==14))
			) {$itemname = 'Hyon '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase defense + 25<br />2x Dmg rate + 10%<br />Increase skill damage + 20<br />Critical damage rate + 15%<br />Excellent damage rate + 15%<br />Increase Critical Damage + 20<br />Increase Excellent Damage + 20</font>";}
			elseif( /*Apollo Pad Set*/
				(($rows['type']==7) && ($rows['id']==2)) ||
				(($rows['type']==8) && ($rows['id']==2)) ||
				(($rows['type']==9) && ($rows['id']==2)) ||
				(($rows['type']==10) && ($rows['id']==2)) ||
				(($rows['type']==5) && ($rows['id']==0)) ||
				(($rows['type']==12) && ($rows['id']==24)) ||
				(($rows['type']==12) && ($rows['id']==25))
			) {$itemname = 'Apollo '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Energy + 10<br />Incr. wizardry + 5%<br />Incr. attack. skill + 10<br />Maximum mana + 30<br />Maximum life + 30<br />Incr. max. AG + 20<br />Increase critical damage + 10<br />Increase excellent damage + 10<br />Energy + 30</font>";}
			elseif( /*Evis Bone Set*/
				(($rows['type']==8) && ($rows['id']==4)) ||
				(($rows['type']==9) && ($rows['id']==4)) ||
				(($rows['type']==11) && ($rows['id']==4)) ||
				(($rows['type']==12) && ($rows['id']==26))
			) {$itemname = 'Evis '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase attacking skill + 15<br />Increase stamina + 20<br />Increase wizardry damage + 10<br />Double damage rate 5%<br />Increase damage success rate +50<br />Increase AG regen rate +5</font>";}
			elseif( /*Hera Sphinx Set*/
				(($rows['type']==7) && ($rows['id']==7)) ||
				(($rows['type']==8) && ($rows['id']==7)) ||
				(($rows['type']==9) && ($rows['id']==7)) ||
				(($rows['type']==10) && ($rows['id']==7)) ||
				(($rows['type']==11) && ($rows['id']==7)) ||
				(($rows['type']==6) && ($rows['id']==6))
			) {$itemname = 'Hera '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Strength + 15<br />Increase wizardry dmg + 10%<br />Increase defensive skill when equipped with shield + 5%<br />Energy + 15<br />Increase attack success rate + 50<br />Critical damage rate + 10%<br />Excellent damage rate + 10%<br />Increase maximum life + 50<br />Increase maximum mana + 50</font>";}
			elseif( /*Anubis Legendary Set*/
				(($rows['type']==7) && ($rows['id']==3)) ||
				(($rows['type']==8) && ($rows['id']==3)) ||
				(($rows['type']==10) && ($rows['id']==3)) ||
				(($rows['type']==12) && ($rows['id']==21))
			) {$itemname = 'Anubis '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Double Dmg rate + 10%<br />Increase Max mana + 50<br />Increase. Wizardry dmg + 10%<br />Critical damage rate + 15%<br />Excellent damage rate + 15%<br />Increase critical damage + 20<br />Increase excellent damage + 20</font>";}
			elseif( /*Ceto Vine Set*/
				(($rows['type']==7) && ($rows['id']==10)) ||
				(($rows['type']==9) && ($rows['id']==10)) ||
				(($rows['type']==10) && ($rows['id']==10)) ||
				(($rows['type']==11) && ($rows['id']==10)) ||
				(($rows['type']==0) && ($rows['id']==2)) ||
				(($rows['type']==12) && ($rows['id']==22))
			) {$itemname = 'Ceto '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Agility + 10<br />Increase Max HP + 50<br />Increase Def skill + 20<br />Increase defensive skill while using shields + 5%<br />Increase Energy + 10<br />Increases Max HP + 50<br />Increase Strength + 20</font>";}
			elseif( /*Gaia Silk Set*/
				(($rows['type']==7) && ($rows['id']==11)) ||
				(($rows['type']==8) && ($rows['id']==11)) ||
				(($rows['type']==9) && ($rows['id']==11)) ||
				(($rows['type']==10) && ($rows['id']==11)) ||
				(($rows['type']==4) && ($rows['id']==9))
			) {$itemname = 'Gaia '.$itemname; 
			$anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font>
			<br />
			<br /><font color=gray>Increase attacking skill + 10
			<br />Increase max mana + 25<br />Power + 10
			<br />Double dmg rate + 5%
			<br />Agility + 30
			<br />Excellent damage rate + 10%
			<br />Increase excellent damage + 10 </font>";}
			elseif( /*Odin Winds Set*/
				(($rows['type']==7) && ($rows['id']==12)) ||
				(($rows['type']==8) && ($rows['id']==12)) ||
				(($rows['type']==9) && ($rows['id']==12)) ||
				(($rows['type']==10) && ($rows['id']==12)) ||
				(($rows['type']==11) && ($rows['id']==12))
			) {$itemname = 'Odin '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Energy + 15<br />Increase max life + 50<br />Increase attack success rate + 50<br />Agility + 30<br />Increase maximum mana + 50<br />Ignore enemy defensive skill + 5%<br />Increase maximum AG + 50</font>";}
						
			elseif( /*Argo Spirit Set*/
				(($rows['type']==8) && ($rows['id']==13)) ||
				(($rows['type']==9) && ($rows['id']==13)) ||
				(($rows['type']==10) && ($rows['id']==13))
			) {$itemname = 'Argo '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Agility + 30<br />Power + 30<br />Increase attacking skill + 25<br />Double damage rate + 5%</font>";}
			elseif( /*Gywen Guardian Set*/
				(($rows['type']==8) && ($rows['id']==14)) ||
				(($rows['type']==10) && ($rows['id']==14)) ||
				(($rows['type']==11) && ($rows['id']==14)) ||
				(($rows['type']==4) && ($rows['id']==5)) ||
				(($rows['type']==12) && ($rows['id']==28))
			) {$itemname = 'Gywen '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>2x dmg rate + 10%<br />Agility + 30<br />Incr min attacking skill + 20<br />Incr max attacking skill + 20<br />Critical damage rate + 15%<br />Excellent damage rate + 15%<br />Increase critical damage + 20<br />Increase excellent damage + 20</font>";}
			elseif( /*Gaion Storm Crow Set*/
				(($rows['type']==8) && ($rows['id']==15)) ||
				(($rows['type']==9) && ($rows['id']==15)) ||
				(($rows['type']==11) && ($rows['id']==15)) ||
				(($rows['type']==12) && ($rows['id']==27))
			) {$itemname = 'Gaion '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Ignore enemy defensive skill + 5%<br />2x damage rate + 15%<br />Inc. attacking skill + 15<br />Excellent damage rate + 15%<br />Increase excellent damage + 30<br />Increase wizardry + 20%<br />Increase Strength + 30</font>";}
			elseif( /*Agnis Adamantine Set*/
				(($rows['type']==7) && ($rows['id']==26)) ||
				(($rows['type']==8) && ($rows['id']==26)) ||
				(($rows['type']==9) && ($rows['id']==26)) ||
				(($rows['type']==12) && ($rows['id']==9))
			) {$itemname = 'Agnis '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Double Damage Rate + 10%<br />Increase Defense +40<br />Increase Skill Damage +20<br />Increase Critical Damage Rate + 15%<br />Increase Excellent Damage Rate + 15%<br />Increase Critical Damage +20<br />Increase Excellent Damage +20</font>";}
			elseif( /*Krono Red Wing Set*/
				(($rows['type']==7) && ($rows['id']==40)) ||
				(($rows['type']==9) && ($rows['id']==40)) ||
				(($rows['type']==10) && ($rows['id']==40)) ||
				(($rows['type']==12) && ($rows['id']==24))
			) {$itemname = 'Chrono '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Double Damage Rate +20%<br />Increase Defense +60<br />Increase Skill Damage +30<br />Increase Critical Damage Rate + 15%<br />Increase Excellent Damage Rate + 15%<br />Increase Critical Damage +20<br />Increase Excellent Damage +20</font>";}
			elseif( /*Vega's Sacred Set*/
				(($rows['type']==7) && ($rows['id']==59)) ||
				(($rows['type']==8) && ($rows['id']==59)) ||
				(($rows['type']==9) && ($rows['id']==59)) ||
				(($rows['type']==0) && ($rows['id']==32))
			) {$itemname = 'Vega '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase damage success rate +50<br />Increase stamina +50<br />Increase max. damage +5<br />Increase excellent damage rate 15%<br />Double damage rate 5%<br />Ignore enemies defensive skill 5%</font>";}
	        elseif( /*Obscure Leather Set*/
				(($rows['type']==7) && ($rows['id']==5)) ||
				(($rows['type']==9) && ($rows['id']==5)) ||
				(($rows['type']==11) && ($rows['id']==5)) ||
				(($rows['type']==6) && ($rows['id']==0))
			) {$itemname = 'Obscure '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase max. life +50<br />Increase agility +50<br />Increase defensive skill when using shield weapons 10%<br />Increase damage +30</font>";}
			elseif( /*Mist Bronze Set*/
				(($rows['type']==7) && ($rows['id']==0)) ||
				(($rows['type']==9) && ($rows['id']==0)) ||
				(($rows['type']==10) && ($rows['id']==0))
			) {$itemname = 'Mist '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase stamina +20<br />Increase skill attacking rate +30<br />Double damage rate 10%<br />Increase agility +20</font>";}
			elseif( /*Berserker Scale Set*/
				(($rows['type']==7) && ($rows['id']==6)) ||
				(($rows['type']==8) && ($rows['id']==6)) ||
				(($rows['type']==9) && ($rows['id']==6)) ||
				(($rows['type']==10) && ($rows['id']==6)) ||
				(($rows['type']==11) && ($rows['id']==6))
			) {$itemname = 'Berserker '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase max damage +10<br />Increase max damage +20<br />Increase max damage +30<br />Increase max damage +40<br />Increase skill attacking rate +40<br />Increase strength +40</font>";}
			elseif( /*Cloud Brass Set*/
				(($rows['type']==7) && ($rows['id']==8)) ||
				(($rows['type']==9) && ($rows['id']==8)) 
			) {$itemname = 'Cloud '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase critical dmage rate 20%<br />Increase critical damage + 50</font>";}
			elseif( /*Rave Plate Set*/
				(($rows['type']==7) && ($rows['id']==9)) ||
				(($rows['type']==8) && ($rows['id']==9)) ||
				(($rows['type']==9) && ($rows['id']==9)) 
			) {$itemname = 'Rave '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase skill atacking rate + 20<br />Double damage rate 10%<br />Increase damage when using two handed weapon + 30%<br />Ignore enemies defensive skill 5%</font>";}
			elseif( /*Vicious Dragon Set*/
				(($rows['type']==7) && ($rows['id']==1)) ||
				(($rows['type']==8) && ($rows['id']==1)) ||
				(($rows['type']==9) && ($rows['id']==1)) ||
				(($rows['type']==12) && ($rows['id']==22))
			) {$itemname = 'Vicious '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase Skill Damage +15<br />Increased Damage +15<br />Double Damage Rate + 10%<br />Increase Minimum Attack Damage +20<br />Increase Maximum Attack Damage +30<br />Ignore Opponents Defensive Skill + 5%</font>";}
			elseif( /*Banek Pad Set*/
				(($rows['type']==7) && ($rows['id']==2)) ||
				(($rows['type']==9) && ($rows['id']==2)) ||
				(($rows['type']==11) && ($rows['id']==2))
			) {$itemname = 'Banek '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase Wizardy Dmg +10%<br />Increase energy +20<br />Increase skill attacking rate +30<br />Increase max. mana +100</font>";}
			elseif( /*Sylion Bone Set*/
				(($rows['type']==7) && ($rows['id']==4)) ||
				(($rows['type']==8) && ($rows['id']==4)) ||
				(($rows['type']==10) && ($rows['id']==4)) ||
				(($rows['type']==11) && ($rows['id']==4))
			) {$itemname = 'Sylion '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Double damage rate 5%<br />Increase critical damage 5%<br />Increase defensive skill +20<br />Increase strength +50<br />Increase agility +50<br />Increase stamina +50<br />Increase energy +50</font>";}
			elseif( /*Myne Sphinx Set*/
				(($rows['type']==8) && ($rows['id']==7)) ||
				(($rows['type']==9) && ($rows['id']==7)) ||
				(($rows['type']==11) && ($rows['id']==7))
			) {$itemname = 'Myne '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase energy +30<br />Increase defensive skill +30<br />Increase max. mana +100<br />Increase skill atacking rate +15</font>";}
			elseif( /*Isis Legendary Set*/
				(($rows['type']==7) && ($rows['id']==3)) ||
				(($rows['type']==8) && ($rows['id']==3)) ||
				(($rows['type']==9) && ($rows['id']==3)) ||
				(($rows['type']==11) && ($rows['id']==3))
			) {$itemname = 'Isis '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase Skill Damage +10<br />Double Damage Rate + 10%<br />Energy +30<br />Increase Wizardry Damage + 10%<br />Ignore Opponents Defensive Skill + 5%</font>";}
			elseif( /*Drak Vine Set*/
				(($rows['type']==7) && ($rows['id']==10)) ||
				(($rows['type']==8) && ($rows['id']==10)) ||
				(($rows['type']==9) && ($rows['id']==10)) ||
				(($rows['type']==11) && ($rows['id']==10))
			) {$itemname = 'Drak '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase agility +20<br />Increase damage +25<br />Double damage rate 20%<br />Increase defensive skill +40<br />Increase critical damage rate 10%</font>";}
			elseif( /*Peize Silk Set*/
				(($rows['type']==9) && ($rows['id']==11)) ||
				(($rows['type']==10) && ($rows['id']==11)) ||
				(($rows['type']==11) && ($rows['id']==11))
			) {$itemname = 'Peize '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase max. life +100<br />Increase max. mana +100<br />Increase defensive skill +100</font>";}
			elseif( /*Elvian Wind Set*/
				(($rows['type']==9) && ($rows['id']==12)) ||
				(($rows['type']==11) && ($rows['id']==12))
			) {$itemname = 'Elvian '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase agility +30<br />Ignore enemies defensive skill 5%</font>";}
			elseif( /*Karis Spirit Set*/
				(($rows['type']==7) && ($rows['id']==13)) ||
				(($rows['type']==9) && ($rows['id']==13)) ||
				(($rows['type']==11) && ($rows['id']==13))
			) {$itemname = 'Karis '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase skill attacking rate +15<br />Double damage rate 10%<br />Increase critical damage rate 10%<br />Increase agility +40</font>";}
			elseif( /*Aruane Guardian Set*/
				(($rows['type']==7) && ($rows['id']==14)) ||
				(($rows['type']==8) && ($rows['id']==14)) ||
				(($rows['type']==9) && ($rows['id']==14)) ||
				(($rows['type']==11) && ($rows['id']==14))
			) {$itemname = 'Aruane '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increased Damage +10<br />Double Damage Rate + 10%<br />Increase Skill Damage +20<br />Increase Critical Damage Rate + 15%<br />Increase Excellent Damage Rate + 15%<br />Ignore Opponents Defensive Skill + 5%</font>";}
			elseif( /*Muren Storm Crow Set*/
				(($rows['type']==8) && ($rows['id']==15)) ||
				(($rows['type']==9) && ($rows['id']==15)) ||
				(($rows['type']==10) && ($rows['id']==15)) ||
				(($rows['type']==12) && ($rows['id']==21))
			) {$itemname = 'Muren '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase Skill Damage +10<br />Increase Wizardry Damage + 10%<br />Double Damage Rate + 10%<br />Increase Critical Damage Rate + 15%<br />Increase Excellent Damage Rate + 15%<br />Increase Defense +25<br />Increase Two-handed Weapon Equipment Damage + 20%</font>";}
			elseif( /*Browii Adamantine Set*/
				(($rows['type']==9) && ($rows['id']==26)) ||
				(($rows['type']==10) && ($rows['id']==26)) ||
				(($rows['type']==11) && ($rows['id']==26)) ||
				(($rows['type']==12) && ($rows['id']==25))
			) {$itemname = 'Browii '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase Damage +20<br />Increase Skill Damage +20<br />Increase Energy +30<br />Increase Critical Damage Rate + 15%<br />Increase Excellent Damage Rate + 15%<br />Ignore Opponents Defensive Skill + 5%<br />Increase Command +30</font>";}
			elseif( /*Semeden Red Wing Set*/
				(($rows['type']==7) && ($rows['id']==40)) ||
				(($rows['type']==8) && ($rows['id']==40)) ||
				(($rows['type']==10) && ($rows['id']==40)) ||
				(($rows['type']==11) && ($rows['id']==40))
			) {$itemname = 'Semeden '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase Wizardry + 15%<br />Increase Skill Damage +25<br />Increase Energy +30<br />Increase Critical Damage Rate + 15%<br />Increase Excellent Damage Rate + 15%<br />Ignore Opponents Defensive Skill + 5%</font>";}
			elseif( /*Chamereuui's Sacred Set*/
				(($rows['type']==8) && ($rows['id']==59)) ||
				(($rows['type']==9) && ($rows['id']==59)) ||
				(($rows['type']==0) && ($rows['id']==32)) ||
				(($rows['type']==11) && ($rows['id']==59))
			) {$itemname = 'Chamereuui '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray>Increase defensiva skill +50<br />Double damage rate 5%<br />Increase damage +30<br />Increase excellent damage rate 15%<br />Increase skill attacking rate +30<br />Increase excellent damage +20</font>";}
			else {$itemname = 'Ancient '.$itemname; $anc_opt = "<br /><font color=#F4CB3F>Set Item Option Info</font><br /><font color=gray></font>";}
			
			}
		
         if ($exc1 == 1) {
            $itemexl .= '<br>' . $op1;
	
			$exl_opts[] = 1;
        }
        if ($exc2 == 1) {
            $itemexl .= '<br>' . $op2;

			$exl_opts[] = 2;
        }
        if ($exc3 == 1) {
            $itemexl .= '<br>' . $op3;
	
			$exl_opts[] = 3;
        }
        if ($exc4 == 1) {
            $itemexl .= '<br>' . $op4;
	
			$exl_opts[] = 4;
        }
        if ($exc5 == 1) {
            $itemexl .= '<br>' . $op5;
		
			$exl_opts[] = 5;
        }
        if ($exc6 == 1) {
            $itemexl .= '<br>' . $op6;
		
			$exl_opts[] = 6;
        }

        if ($rows['exeopt'] == 0) {
            $itemoption = $lvl * 4;
        } else if ($rows['exeopt'] == 4) {
            $itemoption = ($lvl) . '%';
            $inf = ' Automatic HP Recovery rate ';
        } else {
            $itemoption = $lvl * 5;
            $inf = 'Additional Defense rate ';
        }
		
        $c = '#FFFFFF'; // White -> Normal Item
        if (($lvl > 1) || ($luck != '')) {
            $c = '#8CB0EA';
        }
        if ($itemlevel > 6) {
            $c = '#F4CB3F';
        }

        if ($itemexl != '') {
            $c = '#ccff99';
        } // Green -> Excellent Item 
        if ($nocolor) {
            $c = '#F4CB3F';
        }
        if ($itemoption == 0) {
			$itm        = 0;
            $itemoption = '';
        } else {
			$itm   = $itemoption;
            $itemoption = $inf . " +" . $itemoption;
			
        }
        if (($itemexl != '') && ($itemname) && (!$nocolor)) {
            $itemname = 'Excellent ' . $itemname;
			$rowinfo = '</br><font style=color:#40ff00>Excellent Options</font>';
        }
		if($anc > 0 ){
			$c = '#ff73dc';
			$itemname = 'Ancient ' . $itemname;
		}

        if ($nolevel == 1) {
            $ilvl = 0;
        } else {
            $ilvl = $itemlevel;
        }
		
		// Taken from IGCN Item Editor! -> may not be the same with other editors/servers
		$ref_data = array(
		                "Additional Dmg +200 (PvP)</br> Attack Success Rate Increase +10 (PvP)",       //Swords
					    "",                                                                            //Axes
					    "Additional Dmg +200 (PvP)</br> Attack Success Rate Increase +10 (PvP)",       //Maces
					    "",                                                                            //Spears
					    "Additional Dmg +200 (PvP)</br> Attack Success Rate Increase +10 (PvP)",       //Crossbows & Bows
					    "Additional Dmg +200 (PvP)</br> Attack Success Rate Increase +10 (PvP)",       //Staffs
					    "",                                                                            //Shields
					    "SD Recovery Rate Increase +20 </br> Defense Success Rate Increase +10 (PvP)", //Helmets
					    "SD Auto Recovery</br> Defense Success Rate Increase +10 (PvP)",               //Armors
					    "Defense Skill +200 (PvP)</br>Defense Success Rate Increase +10 (PvP)",        //Pants
					    "Max HP Increase +200</br>Defense Success Rate Increase +10 (PvP)",            //Gloves
					    "Max SD Increase +700</br>Defense Success Rate Increase +10 (PvP)"             //Boots                                                    //
					); 
					
		if ($refinery	>	0)
		{
			@$refine	=	"<br><font color=#FF1493><strong>".$ref_data[$rows['type']]."</strong></font><br>";
		}
		
        $harmony_opt = array(
            1=>array(
               1=>array('name'=>'Minimum Attack Power Increase +','opt'=>array('2','3','4','5','6','7','9','11','12','14','15','16','17','20','23','26')),
               2=>array('name'=>'Maximum Attack Power Increase +','opt'=>array('3','4','5','6','7','8','10','12','14','17','20','23','26','29','32','35')),
               3=>array('name'=>'Require Strength Decrease -','opt'=>array('6','8','10','12','14','16','20','23','26','29','32','35','37','40','43','46')),
               4=>array('name'=>'Require Agility Decrease -','opt'=>array('6','8','10','12','14','16','20','23','26','29','32','35','37','40','43','46')),
               5=>array('name'=>'Attack Power Increase (Min, Max) +','opt'=>array('0','0','0','0','0','0','7','8','9','11','12','14','16','19','22','25')),
               6=>array('name'=>'Critical Damage Increase +','opt'=>array('0','0','0','0','0','0','12','14','16','18','20','22','24','30','33','36')),
               7=>array('name'=>'Skill Attack Power Increase +','opt'=>array('0','0','0','0','0','0','0','0','0','12','14','16','18','20','22','24','26')),
               8=>array('name'=>'Attack Success Rate (PVP) +','opt'=>array('0','0','0','0','0','0','0','0','0','5','7','9','11','14','16','18')),
               9=>array('name'=>'SD Decrease Rate Increase +','opt'=>array('0','0','0','0','0','0','0','0','0','3','5','7','9','10','11','12')),
               10=>array('name'=>'SD Ignore Rate +','opt'=>array('0','0','0','0','0','0','0','0','0','0','0','0','0','10','12','14')),
            ),
            2=>array(
               1=>array('name'=>'Magic Power Increase +','opt'=>array('6','8','10','12','14','16','17','18','19','21','23','25','27','31','33','35')),
               2=>array('name'=>'Require Strength Decrease -','opt'=>array('6','8','10','12','14','16','20','23','26','29','32','35','37','40','43','46')),
               3=>array('name'=>'Require Agility Decrease -','opt'=>array('6','8','10','12','14','16','20','23','26','29','32','35','37','40','43','46')),
               4=>array('name'=>'Skill Attack Power Increase +','opt'=>array('0','0','0','0','0','0','7','10','13','16','19','22','25','30','33','36')),
               5=>array('name'=>'Critical Damage Increase +','opt'=>array('0','0','0','0','0','0','10','12','14','16','18','20','22','28','30','32')),
               6=>array('name'=>'SD Decrease Rate Increase +','opt'=>array('0','0','0','0','0','0','0','0','0','4','6','8','10','13','15','17')),
               7=>array('name'=>'Attack Success Rate (PVP) +','opt'=>array('0','0','0','0','0','0','0','0','0','5','7','9','11','14','15','16')),
               8=>array('name'=>'SD Ignore Rate +','opt'=>array('0','0','0','0','0','0','0','0','0','0','0','0','0','15','17','19')),
            ),
            3=>array(
               1=>array('name'=>'Defense Power Increase +','opt'=>array('3','4','5','6','7','8','10','12','14','16','18','20','22','25','28','31')),
               2=>array('name'=>'Maximum AG Increase +','opt'=>array('0','0','0','4','6','8','10','12','14','16','18','20','22','25','28','31')),
               3=>array('name'=>'Maximum HP Increase +','opt'=>array('0','0','0','7','9','11','13','15','17','19','21','23','25','30','32','34')),
               4=>array('name'=>'HP Automatic Increase +','opt'=>array('0','0','0','0','0','0','1','2','3','4','5','6','7','8','9','10')),
               5=>array('name'=>'MP Automatic Increase +','opt'=>array('0','0','0','0','0','0','0','0','0', '1','2','3','4','5','6','7')),
               6=>array('name'=>'Defense Success rate Increase (PVP)','opt'=>array('0','0','0','0','0','0','0','0','0', '3','4','5','6','8','10','12')),
               7=>array('name'=>'Damage Decrementing Increase +','opt'=>array('0','0','0','0','0','0','0','0','0','1%','1%','2%','3%','4%','8%','9%')),
               8=>array('name'=>'SD Rate Increase +','opt'=>array('0','0','0','0','0','0','0','0','0', '0','0','0','0','5','6','7')),
            ),
        );	
		
		if ($rows['socket']	>0 && $season_settings[0] <> 20)
		    {		
				for($i=1;$i<=5;$i++){
					if ($socket[$i]	==	0){}
					else
					{
					
						for ($i=1;$i<=5;$i++)
						{
							if ($socket[$i]==254)     { $socketoption.="<br><font color=#666666>Socket {$i}: No item application</font>"; }
							elseif ($socket[$i]==0)   { $socketoption.=""; }                          
							elseif ($socket[$i]==1)   { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 1 (Increase Damage/SkillPower (*lvl) + 20)</font>"; }
							elseif ($socket[$i]==2)   { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 1 (Increase Attack Speed + 7)</font>"; }
							elseif ($socket[$i]==3)   { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 1 (Increase Maximum Damage/Skill Power + 30)</font>"; }
							elseif ($socket[$i]==4)   { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 1 (Increase Minimum Damage/Skill Power + 20)</font>"; }
							elseif ($socket[$i]==5)   { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 1 (Increase Damage/Skill Power + 20)</font>"; }
							elseif ($socket[$i]==6)   { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 1 (Slight AG reduction +40%)</font>"; }
							elseif ($socket[$i]==10)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 1 (Attack defensibility increase +10)</font>"; }
							elseif ($socket[$i]==11)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 1 (Increase Defense Success Rate + 10%)</font>"; }
							elseif ($socket[$i]==12)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 1 (Increase Defense + 30)</font>"; }
							elseif ($socket[$i]==13)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 1 (Increase Defense Shield + 7%)</font>"; }
							elseif ($socket[$i]==14)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 1 (Damage reduction +2%)</font>"; }
							elseif ($socket[$i]==15)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 1 (Damage Reflections + 5%)</font>"; }
							elseif ($socket[$i]==16)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 1 (Monster destruction for the Life increase +8)</font>"; }
							elseif ($socket[$i]==17)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 1 (Monster destruction for the Life increase +8)</font>"; }
							elseif ($socket[$i]==18)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 1 (Increases + Rate of Mana After Hunting + 8)</font>"; }
							elseif ($socket[$i]==19)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 1 (Increase Skill Attack Power + 37)</font>"; }
							elseif ($socket[$i]==20)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 1 (Increase Attack Success Rate + 25)</font>"; }
							elseif ($socket[$i]==21)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 1 (Item Durability Reinforcement + 30%)</font>"; }
							elseif ($socket[$i]==22)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 1 (Increase Life AutoRecovery + 8)</font>"; }
							elseif ($socket[$i]==23)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 1 (Maximum Life increase +4%)</font>"; }
							elseif ($socket[$i]==24)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 1 (Maximum Mana increase +4%)</font>"; }
							elseif ($socket[$i]==25)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 1 (Increase Mana AutoRecovery + 7)</font>"; }
							elseif ($socket[$i]==26)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 1 (Increase Maximum AG + 25)</font>"; }
							elseif ($socket[$i]==27)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 1 (Increase AG Amount + 3)</font>"; }
							elseif ($socket[$i]==29)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lighting Level 1 (Excellent damage increase +30)</font>"; }
							elseif ($socket[$i]==30)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 1 (Increase Excellent Damage + 15)</font>"; }
							elseif ($socket[$i]==31)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 1 (Increase Excellent Damage Success Rate + 10%)</font>"; }
							elseif ($socket[$i]==32)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 1 (Increase Critical Damage + 30)</font>"; }
							elseif ($socket[$i]==33)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 1 (Increase Critical Damage Success Rate + 8%)</font>"; }
							elseif ($socket[$i]==36)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ground Level 1 (Stamina increase +30)</font>"; }
							elseif ($socket[$i]==37)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ground Level 1 (Stamina increase +30)</font>"; }
							elseif ($socket[$i]==38)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==39)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==40)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==41)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==42)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==43)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==44)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==45)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==46)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==47)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==48)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==49)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==50)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==51)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 2 (Increase Damage/SkillPower (*lvl) + 30) </font>"; }
							elseif ($socket[$i]==52)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 2 (Increase Attack Speed) + 8)</font>"; }
							elseif ($socket[$i]==53)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 2 (Increase Maximum Damage/Skill Power + 40)</font>"; }
							elseif ($socket[$i]==54)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 2 (Increase Minimum Damage/Skill Power + 30)</font>"; }
							elseif ($socket[$i]==55)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 2 (Increase Damage/Skill Power + 30)</font>"; }
							elseif ($socket[$i]==56)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 2 (Slight AG reduction +50%)</font>"; }
							elseif ($socket[$i]==57)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==58)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==59)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==60)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==61)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 2 (Increase Defense Success Rate + 11%)</font>"; }
							elseif ($socket[$i]==62)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 2 (Increase Defense + 31)</font>"; }
							elseif ($socket[$i]==63)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 2 (Increase Defense Shield + 8%)</font>"; }
							elseif ($socket[$i]==64)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 2 (Damage reduction +3%)</font>"; }
							elseif ($socket[$i]==65)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 2 (Damage Reflections + 6%)</font>"; }
							elseif ($socket[$i]==66)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 2 (Stamina increase +308)</font>"; }
							elseif ($socket[$i]==67)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 2 (Increases + Rate of Life After Hunting + 49)</font>"; }
							elseif ($socket[$i]==68)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 2 (Increases + Rate of Mana After Hunting + 49)</font>"; }
							elseif ($socket[$i]==69)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 2 (Increase Skill Attack Power +38)</font>"; }
							elseif ($socket[$i]==70)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 2 (Increase Attack Success Rate + 26) </font>"; }
							elseif ($socket[$i]==71)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 2 (Item Durability Reinforcement + 31%)</font>"; }
							elseif ($socket[$i]==72)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 2 (Increase Life AutoRecovery + 9)</font>"; }
							elseif ($socket[$i]==73)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 2 (Maximum Life increase +5%)</font>"; }
							elseif ($socket[$i]==74)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 2 (Maximum Mana increase +5%)</font>"; }
							elseif ($socket[$i]==75)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 2 (Increase Mana AutoRecovery + 8)</font>"; }
							elseif ($socket[$i]==76)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 2 (Increase Maximum AG + 30)</font>"; }
							elseif ($socket[$i]==77)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 2 (Increase AG Amount + 5)</font>"; }
							elseif ($socket[$i]==78)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lighting Level 2 (Excellent damage increase +31)</font>"; }
							elseif ($socket[$i]==79)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lighting Level 2 (Excellent damage increase +31)</font>"; }
							elseif ($socket[$i]==80)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 2 (Increase Excellent Damage + 20)</font>"; }
							elseif ($socket[$i]==81)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 2 (Increase Excellent Damage Success Rate + 11%)</font>"; }
							elseif ($socket[$i]==82)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 2 (Increase Critical Damage + 35)</font>"; }
							elseif ($socket[$i]==83)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 2 (Increase Critical Damage Success Rate + 9%)</font>"; }
							elseif ($socket[$i]==84)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==85)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==86)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==87)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ground Level 2 (Stamina increase +31)</font>"; }
							elseif ($socket[$i]==88)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==89)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==90)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==91)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==92)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==93)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==94)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==95)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==96)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==97)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==98)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==99)  { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==100) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==101) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 3 (Increase Damage/SkillPower (*lvl) + 24) </font>"; }
							elseif ($socket[$i]==102) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 3 (Increase Attack Speed + 9)</font>"; }
							elseif ($socket[$i]==103) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 3 (Increase Maximum Damage/Skill Power + 35)</font>"; }
							elseif ($socket[$i]==104) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 3 (Increase Minimum Damage/Skill Power + 25)</font>"; }
							elseif ($socket[$i]==105) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 3 (Increase Damage/Skill Power + 25)</font>"; }
							elseif ($socket[$i]==106) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 3 (Slight AG reduction +42%)</font>"; }
							elseif ($socket[$i]==107) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==108) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==109) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==110) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==111) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 3 (Increase Defense Success Rate + 12%)</font>"; }
							elseif ($socket[$i]==112) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 3 (Increase Defense + 36)</font>"; }
							elseif ($socket[$i]==113) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 3 (Increase Defense Shield + 15%)</font>"; }
							elseif ($socket[$i]==114) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 3 (Damage reduction +4%)</font>"; }
							elseif ($socket[$i]==115) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 3 (Damage Reflections + 7%)</font>"; }
							elseif ($socket[$i]==116) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 3 (Stamina increase +308)</font>"; }
							elseif ($socket[$i]==117) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 3 (Increases + Rate of Life After Hunting + 10)</font>"; }
							elseif ($socket[$i]==118) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 3 (Increases + Rate of Mana After Hunting + 10)</font>"; }
							elseif ($socket[$i]==119) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 3 (Increase Skill Attack Power +45) </font>"; }
							elseif ($socket[$i]==120) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 3 (Increase Attack Success Rate + 30) </font>"; }
							elseif ($socket[$i]==121) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 3 (Item Durability Reinforcement + 34%)</font>"; }
							elseif ($socket[$i]==122) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 3 (Increase Life AutoRecovery + 13)</font>"; }
							elseif ($socket[$i]==123) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 3 (Maximum Life increase +6%)</font>"; }
							elseif ($socket[$i]==124) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 3 (Maximum Mana increase +6%)</font>"; }
							elseif ($socket[$i]==125) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 3 (Increase Mana AutoRecovery + 21)</font>"; }
							elseif ($socket[$i]==126) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 3 (Increase Maximum AG + 35)</font>"; }
							elseif ($socket[$i]==127) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 3 (Increase AG Amount + 7)</font>"; }
							elseif ($socket[$i]==128) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lighting Level 3 (Excellent damage increase +25)</font>"; }
							elseif ($socket[$i]==129) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lighting Level 3 (Excellent damage increase +12)</font>"; }
							elseif ($socket[$i]==130) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 3 (Increase Excellent Damage + 25)</font>"; }
							elseif ($socket[$i]==131) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 3 (Increase Excellent Damage Success Rate + 12%)</font>"; }
							elseif ($socket[$i]==132) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 3 (Increase Critical Damage + 35)</font>"; }
							elseif ($socket[$i]==133) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 3 (Increase Critical Damage Success Rate + 10%)</font>"; }
							elseif ($socket[$i]==134) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==135) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==136) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==137) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ground Level 3 (Stamina increase +32) </font>"; }
							elseif ($socket[$i]==138) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==139) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==140) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==141) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==142) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==143) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==144) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==145) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==146) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==147) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==148) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==149) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==150) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==151) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 4 (Increase Damage/SkillPower (*lvl) + 24) </font>"; }
							elseif ($socket[$i]==152) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 4 (Increase Attack Speed + 10)</font>"; }
							elseif ($socket[$i]==153) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 4 (Increase Maximum Damage/Skill Power + 40)</font>"; }
							elseif ($socket[$i]==154) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 4 (Increase Minimum Damage/Skill Power + 30)</font>"; }
							elseif ($socket[$i]==155) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 4 (Increase Damage/Skill Power + 30)</font>"; }
							elseif ($socket[$i]==156) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 4 (Slight AG reduction +43%)</font>"; }
							elseif ($socket[$i]==157) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==158) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==159) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==160) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==161) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 4 (Increase Defense Success Rate + 13%)</font>"; }
							elseif ($socket[$i]==162) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 4 (Increase Defense + 39)</font>"; }
							elseif ($socket[$i]==163) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 4 (Increase Defense Shield + 20%)</font>"; }
							elseif ($socket[$i]==164) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 4 (Damage reduction +7%)</font>"; }
							elseif ($socket[$i]==165) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 4 (Damage Reflections + 8%)</font>"; }
							elseif ($socket[$i]==166) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 4 (Stamina increase +308)</font>"; }
							elseif ($socket[$i]==167) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 4 (Increases + Rate of Life After Hunting + 11)</font>"; }
							elseif ($socket[$i]==168) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 4 (Increases + Rate of Mana After Hunting + 11)</font>"; }
							elseif ($socket[$i]==169) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 4 (Increase Skill Attack Power +50) </font>"; }
							elseif ($socket[$i]==170) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 4 (Increase Attack Success Rate + 35) </font>"; }
							elseif ($socket[$i]==171) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 4 (Item Durability Reinforcement + 36%)</font>"; }
							elseif ($socket[$i]==172) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 4 (Increase Life AutoRecovery + 16)</font>"; }
							elseif ($socket[$i]==173) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 4 (Maximum Life increase +7%)</font>"; }
							elseif ($socket[$i]==174) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 4 (Maximum Mana increase +7%)</font>"; }
							elseif ($socket[$i]==175) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 4 (Increase Mana AutoRecovery + 28)</font>"; }
							elseif ($socket[$i]==176) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 4 (Increase Maximum AG + 40)</font>"; }
							elseif ($socket[$i]==177) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 4 (Increase AG Amount + 10)</font>"; }
							elseif ($socket[$i]==178) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lighting Level 4 (Excellent damage increase +30)</font>"; }
							elseif ($socket[$i]==179) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lighting Level 4 (Excellent damage increase +30)</font>"; }
							elseif ($socket[$i]==180) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 4 (Increase Excellent Damage + 30)</font>"; }
							elseif ($socket[$i]==181) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 4 (Increase Excellent Damage Success Rate + 13%)</font>"; }
							elseif ($socket[$i]==182) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 4 (Increase Critical Damage + 40)</font>"; }
							elseif ($socket[$i]==183) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 4 (Increase Critical Damage Success Rate + 11%)</font>"; }
							elseif ($socket[$i]==184) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==185) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==186) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==187) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ground Level 4 (Stamina increase +33) </font>"; }
							elseif ($socket[$i]==188) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==189) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==190) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==191) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==192) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==193) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==194) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==195) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==196) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==197) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==198) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==199) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==200) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==201) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 5 (Increase Damage/SkillPower (*lvl) + 25) </font>"; }
							elseif ($socket[$i]==202) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 5 (Increase Attack Speed + 11)</font>"; }
							elseif ($socket[$i]==203) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 5 (Increase Maximum Damage/Skill Power + 50)</font>"; }
							elseif ($socket[$i]==204) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 5 (Increase Minimum Damage/Skill Power + 35)</font>"; }
							elseif ($socket[$i]==205) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 5 (Increase Damage/Skill Power + 35)</font>"; }
							elseif ($socket[$i]==206) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Fire Level 5 (Slight AG reduction +44%)</font>"; }
							elseif ($socket[$i]==207) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==208) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==209) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==210) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water(Stamina increase +30)</font>"; }
							elseif ($socket[$i]==211) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 5 (Increase Defense Success Rate + 14%)</font>"; }
							elseif ($socket[$i]==212) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 5 (Increase Defense + 42)</font>"; }
							elseif ($socket[$i]==213) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 5 (Increase Defense Shield + 30%)</font>"; }
							elseif ($socket[$i]==214) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 5 (Damage reduction +8%)</font>"; }
							elseif ($socket[$i]==215) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Water Level 5 (Damage Reflections + 9%)</font>"; }
							elseif ($socket[$i]==216) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 5 (Stamina increase +308)</font>"; }
							elseif ($socket[$i]==217) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 5 (Increases + Rate of Life After Hunting + 12)</font>"; }
							elseif ($socket[$i]==218) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 5 (Increases + Rate of Mana After Hunting + 12)</font>"; }
							elseif ($socket[$i]==219) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 5 (Increase Skill Attack Power +60) </font>"; }
							elseif ($socket[$i]==220) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 5 (Increase Attack Success Rate + 40) </font>"; }
							elseif ($socket[$i]==221) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ice Level 5 (Item Durability Reinforcement + 38%)</font>"; }
							elseif ($socket[$i]==222) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 5 (Increase Life AutoRecovery + 20)</font>"; }
							elseif ($socket[$i]==223) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 5 (Maximum Life increase +8%)</font>"; }
							elseif ($socket[$i]==224) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 5 (Maximum Mana increase +8%)</font>"; }
							elseif ($socket[$i]==225) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 5 (Increase Mana AutoRecovery + 35)</font>"; }
							elseif ($socket[$i]==226) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 5 (Increase Maximum AG + 50)</font>"; }
							elseif ($socket[$i]==227) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Wind Level 5 (Increase AG Amount + 15)</font>"; }
							elseif ($socket[$i]==228) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lighting Level 5 (Excellent damage increase +40)</font>"; }
							elseif ($socket[$i]==229) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lighting Level 5 (Excellent damage increase +40)</font>"; }
							elseif ($socket[$i]==230) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 5 (Increase Excellent Damage + 40)</font>"; }
							elseif ($socket[$i]==231) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 5 (Increase Excellent Damage Success Rate + 14%)</font>"; }
							elseif ($socket[$i]==232) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 5 (Increase Critical Damage + 50)</font>"; }
							elseif ($socket[$i]==233) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Lightning Level 5 (Increase Critical Damage Success Rate + 12%)</font>"; }
							elseif ($socket[$i]==234) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==235) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==236) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Not Working </font>"; }
							elseif ($socket[$i]==237) { $socketoption.="<br><font color=#80B2FF>Socket {$i}: Ground Level 5 (Stamina increase +34) </font>"; }
							elseif ($socket[$i]==255) { $socketoption.=""; }
							else{$socketoption = false;}						
						}
					}
				}
				if($socketoption){
					$socketoption	=	"<br><strong><u><font color=#FF19FF>Bonus Socket Option</font></u></strong>".$socketoption;
				}	
		    }						
		
        $output['srch_skill']  = $srch_skill;
        $output['srch_luck']   = $srch_luck;
        $output['clearname']   = $invview['Name'];
        $output['name']        = $itemname;
		$output['id']          = $level1;
		$output['type']        = $level2;
        $output['opt']         = $itemoption;
		$output['opts']        = $itm;
        $output['exl']         = $rowinfo  . $itemexl;
		$output['hex']         = substr($_item,0,4);
        $output['luck']        = $luck;
        $output['skill']       = $skill;
        $output['dur']         = "Durability:[". $itemdur ."/". $invview['Durability']."]</br>";
        $output['x']           = $invview['x'];
        $output['y']           = $invview['y'];
        $output['color']       = $c;
        $output['thumb']       = itemimage($AA, $BB, $CC,$anc);
		$output['sockets']     = $socketoption;
        $output['level']       = $itemlevel;
		$output['full_hex']    = $_item;
		$output['ids']         = $ids;
		$output['item_type']   = $rows['exeopt']; 
        $output['harmony']     = @$harmony_opt[$rows['harmony']][$harmonyoption]['name'];
        $output['harmony_lvl'] = @$harmony_opt[$rows['harmony']][$harmonyoption]['opt'][$harmonyvalue];
        $output['refinery']    = $refine;
		
		if(isset($_SESSION['dt_username'])){
		   if(check_admin($_SESSION['dt_username'])){
				   	$iteminfoadmin         = '<div style=color:#bdbdae;>Type: [<span style=\'font-weight:300;text-shadow:1px 1px #000;color:#FFF\'>'.$level1.'</span>] ID: [<span style=\'font-weight:300;text-shadow:1px 1px #000;color:#FFF\'>'.$level2.'</span>] Serial: [<span style=\'font-weight:300;text-shadow:1px 1px #000;color:#FFF\'>'.$serial.'</span>]</br>Item Hex '.$season_settings[0].'</br></div>';			  
		   }
		}
	
        $itemformat = '
		<div align=center style=\'background:#FF4000;cursor:pointer;border:2px solid #FF9326;border-radius:5px 5px 5px 5px;\'>
		<p style=\'font-weight:bold;font-size: 13px;\'>[Name] </p>
		[GM_Info]</br>
		[Item_Info] 
		[Durability]
		[ItemReq]
		[ItemFor]
		[Skill] 
		[Luck] 
		[Excellent]
		[Options]
		[Anc_opt] 
		[Ancient] 
		[Harmony]
		[Refinery]
		[Sockets]	
		</div>';
               
        if ($output['level']) { $plusche = '+' . $output['level'];}

		$overlib = str_replace('[Name]', '<span style=font-weight:900;color:' . $output['color'] . '>'.$output['name'] . ' ' . $plusche . ' </span>', addslashes($itemformat));
		
		if ($output['opt']) {$options = '<br><font color=#8CB0EA>' . $output['opt'] . '</font>';}
		
	    $overlib           = @str_replace('[Item_Info]',$addinfo, $overlib);
		$overlib	       = @str_replace('[Luck]','<font style=color:#8CB0EA>'.$output['luck'].'</font>', $overlib);
		$overlib	       = @str_replace('[Skill]','<font style=color:#8CB0EA>'.$output['skill'].'</font>', $overlib);		
	    $overlib           = @str_replace('[GM_Info]',$iteminfoadmin, $overlib); 	
        $overlib           = @str_replace('[Options]',$options, $overlib); 	
        $overlib           = @str_replace('[ItemReq]','<font style=color:#ff2626>'.$item_req.'</font>', $overlib);
        $overlib           = @str_replace('[ItemFor]','<font style=color:#bdbdae></br>'.$item_for_fix.'</font>', $overlib);				
		$overlib	       = @str_replace('[Sockets]','<font style=color:#FF19FF>'.$socketoption.'</font>', $overlib);
        $overlib	       = @str_replace('[Refinery]','<font style=color:#ffbf00>'.$output['refinery'].'</font>', $overlib);
		$overlib	       = @str_replace('[Harmony]','<font style=color:#ffc926>'.$output['harmony'].$output['harmony_lvl'].'</font>', $overlib);
		$overlib	       = @str_replace('[Excellent]','<font style=color:#8CB0EA>'.$output['exl'].'</font>', $overlib);
		$overlib           = @str_replace('[Durability]',$output['dur'],$overlib);
		$overlib           = @str_replace('[Anc_opt]',$itemanc,$overlib);
		$overlib           = @str_replace('[Ancient]',$anc_opt,$overlib);
		$output['overlib'] = $overlib;

        return $output;	
    }

 function smartsearch($whbin, $itemX, $itemY) {
        if (substr($whbin, 0, 2) == '0x') {
            $whbin = substr($whbin, 2);
        }
     if(season()){
		 
	    $item_config = season();
        $items = str_repeat('0', 120);
        $itemsm = str_repeat('1', 120);
        $i = 0;
        while ($i < 120) {
            $_item = substr($whbin, ($item_config[0] * $i), $item_config[0]);
            $level = substr($_item, 0, 1);
            $level2 = substr($_item, 1, 1);
            $level3 = substr($_item, 14, 2);
            $level1 = hexdec(substr($level, 0, 1));
            if (($level1 % 2) <> 0) {
                $level2 = "1" . $level2;
                $level1--;
            }
            if (hexdec($level3) >= 128) {
                $level1 += 16;
            }
            $level1 /= 2;
            $id = hexdec($level2);

            $result = mssql_query("select [x],[y],[Name] from [DTweb_JewelDeposit_Items] where [id]={$id} and [type]={$level1}");
            $res = mssql_fetch_array($result);


            $y = 0;
            while ($y < $res['y']) {
                $y++;
                $x = 0;
                while ($x < $res['x']) {
                    $items = substr_replace($items, '1', ($i + $x) + (($y - 1) * 8), 1);
                    $x++;
                }
            }
            $i++;
        }
        $y = 0;
        while ($y < $itemY) {
            $y++;
            $x = 0;
            while ($x < $itemX) {
                $x++;
                $spacerq[$x + (8 * ($y - 1))] = true;
            }
        }
        $walked = 0;
        $i = 0;
        while ($i < 120) {
            if (isset($spacerq[$i])) {
                $itemsm = substr_replace($itemsm, '0', $i - 1, 1);
                $last = $i;
                $walked++;
            }
            if ($walked == count($spacerq)) {
                $i = 119;
            }
            $i++;
        }
        $useforlength = substr($itemsm, 0, $last);
        $findslotlikethis = '/^' . str_replace('++', '+', str_replace('1', '+[0-1]+', $useforlength)). '/i';
        $i = 0;
        $nx = 0;
        $ny = 0;
        while ($i < 120) {
            if ($nx == 8) {
                $ny++;
                $nx = 0;
            }
            if ((preg_match($findslotlikethis, substr($items, $i, strlen($useforlength)))) && ($itemX + $nx < 9) && ($itemY + $ny < 16)) {
                return $i;
            }
            $i++;
            $nx++;
        }
        return 1337;
	  }
    }


	
function jw_deposit(){	
$jewels_name = "";
$jewels_column ="";
$jewels_hex = "";
$jewel_count = 0;
$k=0;
$jewel_full_hex  = "";
$jewels_bas = mssql_query("Select * from [DTweb_Deposit_Settings] where [active]='1'");
  $warehouse = market_w($_SESSION['dt_username']);
        for( $i= 0 ; $i < mssql_num_rows($jewels_bas); $i++ ){
			while($jewels_base = mssql_fetch_array($jewels_bas)){
				if(isset($_POST["type"])){
                    if ($_POST["type"] == $jewels_base['ItemFour']){
          	              $jewels_name    = $jewels_base['ItemName'];
          	              $jewels_column  = $jewels_base['ItemColumn'];
          	              $jewels_hex     = $jewels_base['ItemFour'];
						  $jewel_full_hex = $jewels_base['ItemHex'];
                    }	
                }	
		    }
		}
		foreach($warehouse as $item){
		  $k++;
		  $items = substr($item,0,4);
	        if($items == $jewels_hex){
		      $jewel_count++;
	        }			
	    }
     	
	return array($jewels_hex,$jewels_name,$jewels_column,$jewel_count,$jewel_full_hex,);
}

function market_w($account)
{
	if(season()){
	$item_conf = season();
	$items	   = all_items($account,$item_conf[1]);
    $output    = str_split($items,$item_conf[0]);
    return $output;
	}
	else{
		return false;
	}
}


function market_warehouse($account)
{
	if(season()){
	$output = array();	
	$item_conf = season();
	$items	= all_items($account,$item_conf[1]);
	$item_position	= -1;
	while($item_position < 119)
	{
		$item_position++;
		$item 	= ItemInfouser(substr($items,($item_conf[0] * $item_position), $item_conf[0]));
		if ($item)
		{
			$item['item_position'] = $item_position;
			$output[] = $item; 		
		}		
	}
	return $output;
	}
    else {
    	return false;
    }	
}

function getSerial() {
    return substr(md5(uniqid(mt_rand(), true)), 0, 8);
}


function decode_class($value){
      $class = array( 0 => "Dark Wizard", 1 => "Soul Master", 2 => "Grand Master", 3 => "Grand Master", 16 => "Dark Knight", 17 => "Blade Knight", 18 => "Blade Master", 19 => "Blade Master", 32 => "Fairy Elf", 33 => "Muse Elf", 34 => "High Elf", 35 => "High Elf", 48 => "Magic Gladiator", 50 => "Duel Master", 64 => "Dark Lord", 66 => "Lord Emperor", 80 => "Summoner", 81 => "Bloody Summoner", 82 => "Dimension Master", 83 => "Dimension Master" );
      return isset( $class[$value] ) ? $class[$value] : "Unknown";   
    }

function equipment($char){	
    if(!season()){
		return false;
	}
      $ver       = season();
	  $style2    = "";
      $char      = stripslashes($char);
      $char      = str_replace(";","",$char);
      $char      = str_replace("'","",$char);
      $inventory = mssql_fetch_array(mssql_query("SELECT * FROM Character WHERE Name='".$char."'"));
      $items     = all_items($char,$ver[2],"Character","Name","Inventory");

      if($inventory['Class'] >= 48 && $inventory['Class'] < 64) { $invimage = 'imgs/inventorymg.jpg';}
      else { $invimage = 'imgs/inventory.jpg';}

	  $output = " <div style = 'width:330px; height:750px; background:url(".$invimage.")'>";
	  
	      $output .= "<div style='position: absolute;height:200px;padding-top:80px;'>";
              //Imp
      {
      $item = substr($items,8*$ver[0],$ver[0]);
	       
      if(!iteminfouser($item)) { 
	       $output .= "";}
      else {
	 	 $item   = iteminfouser($item);
	     $output .= "<div style='position: absolute;margin-left:40px;margin-top:30px;'><img style= '' class=\"someClass\" title=\"<br>".$item['overlib']."\" src=".$item['thumb']."></div>"; }      } 
	  
             //Helm 
      {
      $item = substr($items,2*$ver[0],$ver[0]);
      if(!iteminfouser($item)) { $output .= ""; }
      else { 
	  $item   = iteminfouser($item);	
	  $output .= "<div style='position: absolute;margin-left:128px;'><img  style= '' class=\"someClass\" title=\"<br>".$item['overlib']."\" src=".$item['thumb']."></div>"; }
      }
	        //Wings
      {
      $item = substr($items,7*$ver[0],$ver[0]);
      if(!iteminfouser($item)) { $output .= ""; }
      else {
		   $item    = iteminfouser($item);	   
	       $output .= "<div style='position: absolute;margin-left:200px;'><img  style= 'max-width:120px' class=\"someClass\" title=\"<br>".$item['overlib']."\" src=".$item['thumb']."></div>"; }
      }
      $output .= "</div>";
	 
	 $output .= "<div style='position: absolute;height:200px;margin-top:160px;margin-left:10px'>";
	 
            //Left Hand
      {
      
      $item = substr($items,0*$ver[0],$ver[0]);
      if(!iteminfouser($item)) { $output .= ""; }
      else { $item   = iteminfouser($item); 
	  $output .= "<div style=' position: absolute;padding-left:20px;'><img style= 'max-width:80px' class=\"someClass\" title=\"<br>".$item['overlib']."\" src=".$item['thumb']."></div>"; }
      }	
           //Pendant
      {
      $item = substr($items,9*$ver[0],$ver[0]);
      if(!iteminfouser($item)) { $output .= ""; }
      else { $item   = iteminfouser($item); 
	  $output .= "<div style='position:absolute;margin-left:85px;'><img  style= '' class=\"someClass\" title=\"<br>".$item['overlib']."\" src=".$item['thumb']."></div>"; }
      }
          //Armor
      {
      $item = substr($items,3*$ver[0],$ver[0]);
      if(!iteminfouser($item)) { $output .= ""; }
      else { $item   = iteminfouser($item); 
	  $output .= "<div style='position:absolute;margin-left:122px;margin-top:10px'><img  style= 'max-width:80px' class=\"someClass\" title=\"<br>".$item['overlib']."\" src=".$item['thumb']."></div>"; }
      }      
          //Shield
      {
      $item = substr($items,1*$ver[0],$ver[0]);
      if(!iteminfouser($item)) { $output .= ""; }
      else { $item   = iteminfouser($item);

	  $output .= "<div style='position:absolute;margin-left:230px'><img style= 'max-width:80px' class=\"someClass\" title=\"<br>".$item['overlib']."\" src=".$item['thumb']."></div>"; }
      }
     $output .="</div>";

	 $output .= "<div style='width:300px; position: absolute;height:200px;margin-top:260px;'>";
          //Gloves
      {
      $item = substr($items,5*$ver[0],$ver[0]);
      if(!iteminfouser($item)) { $output .= ""; }
      else { $item   = iteminfouser($item); 
        $output .= "<div style='position:absolute;margin-left:25px;'><img style= '' class=\"someClass\" title=\"<br>".$item['overlib']."\" src=".$item['thumb']."></div>"; }
      }

          //Left Ring
      {
      $item = substr($items,10*$ver[0],$ver[0]);
      if(!iteminfouser($item)) { $output .= ""; }
      else { $item   = iteminfouser($item); 
        $output .= "<div style='position:absolute;margin-left:98px;margin-top:5px;'><img style= '' class=\"someClass\" title=\"<br>".$item['overlib']."\" src=".$item['thumb']."></div>"; }
      }	  
         //Pants
      {
      $item = substr($items,4*$ver[0],$ver[0]);
      if(!iteminfouser($item)) { $output .= ""; }
      else { $item   = iteminfouser($item); 
        $output .= "<div style='position:absolute;margin-left:132px;'><img style= '' class=\"someClass\" title=\"<br>".$item['overlib']."\" src=".$item['thumb']."></div>"; }
      }
         //Right Ring
      {
      $item = substr($items,11*$ver[0],$ver[0]);
      if(!iteminfouser($item)) { $output .= ""; }
      else { $item   = iteminfouser($item); 
        $output .= "<div style='position:absolute;margin-left:205px;margin-top:5px;'><img style= '' class=\"someClass\" title=\"<br>".$item['overlib']."\" src=".$item['thumb']."></div>"; }
      }      
         //Boots
      {
      $item = substr($items,6*$ver[0],$ver[0]);
      if(!iteminfouser($item)) { $output .= ""; }
      else { $item   = iteminfouser($item); 
        $output .= "<div style='position:absolute;margin-left:243px;'><img style= '' class=\"someClass\" title=\"<br>".$item['overlib']."\" src=".$item['thumb']."></div>"; }
      }	 
    $itemsa = substr($items, 384);
  	$output .= '<table style="margin-top:83px;margin-left:23px;">'; 
    $check = '011111111';
    $xx = 0;
    $yy = 1;
    $line = 1;
    $onn = 0;
    $i = -1;
    while ($i < 63) {
	$i++;
	if ($xx == 8) {
	    $xx = 1;
	    $yy++;
	}
	else
	$xx++;
$key = "";

	$TT = substr($check, $xx, 1);
	if ((round($i / 8) == $i / 8) && ($i != 0)) {
	$output .= "<td  width=\"35\" height=\"35\" align=center><b></b></td></tr><tr>";
	$line++;
	}
	$l = $i;
	$item2 = substr($itemsa, ($ver[0]* $i), $ver[0]);
	$item = ItemInfoUser(substr($itemsa, ($ver[0] * $i), $ver[0]));

	if (!$item['y'])
	    $InsPosY = 1;
	else
	    $InsPosY=$item['y'];

	if (!$item['x'])
	    $InsPosX = 1;
	else {
		
	    $InsPosX = $item['x'];
	    $xxx = $xx;
	    $InsPosXX = $InsPosX;
	    $InsPosYY = $InsPosY;
	    while ($InsPosXX > 0) {
		$check = substr_replace($check, $InsPosYY, $xxx, 1);
		$InsPosXX = $InsPosXX - 1;
		$InsPosYY = $InsPosY + 1;
		$xxx++;
	    }
	} 
	$item['name'] = addslashes($item['name']);
	if ($TT > 1)

	    $check = substr_replace($check, $TT - 1, $xx, 1);
	else {
	    unset($plusche, $rqs, $luck, $skill, $option, $exl);
	    if ($item['name']) {
		for($k = 1; $k < 5;++$k){
			$key .= $k;		
		}
            $output .= "<td  align=\"center\" colspan='" . $InsPosX . "' rowspan='" . $InsPosY . "' style='background:rgba(0,0,0,0.3);width:" . (35 * $InsPosX) . "px;height:" . (35 * $InsPosY - $InsPosY - 1) . "px;' > ";
	        $output .= "<a class=\"someClass\" title=\"<br>".$item['overlib']."\"  href=\"javascript:void(0)\" onclick=\"fireMyPopup{$i}()\" style='width:" . (35 * $InsPosX) . "px;height:" . (35 * $InsPosY - $InsPosY - 1) . "px;'><img style='width:" . (35 * $InsPosX) . "px;height:" . (35 * $InsPosY - $InsPosY - 1) . "px;' src='" . $item['thumb'] . "' class='m' /></td>";
	    }
		
		else {
			$output .= "<td colspan='0' rowspan='1' style='width:30px;height:30px;border:0px;margin:0px;padding:0px;'><div style='height: 35px;width: 35px;'></div></td>";

		}
	  }
	}
	
        $output .="</div>
           
		   <table style='width:193px;margin-left:88px;text-shadow:1px 1px #000000;font-size:11pt;font-weight:900;margin-top:20px;color:#e07525'><tr><tD style='text-align:right;padding:2px 2px;'>".number_format($inventory['Money'])."</td></tr></table>
         <div style='position:absolute;float:left;margin-left:27px;margin-top:10px'><a href='?p=accountedit&account='".$inventory['AccountID']."''><img onmouseover=\"this.src='imgs/w_button.jpg';\" onmouseout=\"this.src='imgs/w_buttona.jpg';\" src='imgs/w_buttona.jpg'/></a>
		 </div>
		 
	  </div>";
    return $output;
   }
}

?>