<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script type="text/javascript">$(document).ready(function(){$("[title]").easyTooltip();});</script>
	<script type="text/javascript" src="js/easyTooltip.js"></script>
	<script type="text/javascript" src="js/overlib.js"></script>
	
<?php   
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
//||||||||Options|||||||||||||||||////////
//--  *3 Levels for Access               --------------//
//--  *GM Box Adder                      --------------//
//--  *Edit Res, Set Vip, Quests, Maps   --------------//
//--  *Item Adder - thanks to Damian     --------------//
//--  *GM Adder/Edit                     --------------//
//--  *Clear Zen                         --------------//
//--  *Clear Warehouse                   --------------//
//--  *Delete Inventory Items            --------------//
//--  *Delete Warehouse Items            --------------//
//--  *Show Item Serial                  --------------//
/////////////////////////////////////////
$logged = $_SESSION['dt_username'];

if (check_admin($logged) != null){
include('configs/config.php');
include("mod/admin/includes/damian.php");
include("mod/admin/includes/items.php");

	$messagess         = array();
	$i                 = 0;	
    $page              = (isset($_GET['page']) &&  $_GET['page'] > 0) ? (int)$_GET['page'] : 1;
    $pages             = (isset($_GET['pages']) &&  $_GET['pages'] > 0) ? (int)$_GET['pages'] : 1;
    $pages1            = $pages-1; 
    $pages             = $page-1;
    $offset            = $option['top_acc'] * $pages;
    $offset1           = $option['top_char'] * $pages1;
	$search_pagi_acc   = pagination($offset,$option['top_acc'], 'memb___id,memb__pwd,bloc_code' ,'MEMB_INFO','memb___id','memb___id');
    $search_pagi_char  = pagination($offset1,$option['top_char'], 'Life,Mana,Money,PkCount,GrandResets,AccountID,Name,MapNumber,MapPosX,MapPosY,LevelUpPoint,Resets,Dexterity,Strength,Vitality,Energy,IsVip, cLevel,Class' ,'Character','name','name');
    $ниво              = '';
    $admins_level      = 0 ;
    $msg               = '';
	$gm_info           = check_admin($logged);
	$gm_name           = $gm_info[0]; 
	$gm_level          = $gm_info[1];
	$gm_ip             = $gm_info[2];
    $message           = array();
	$input_acc         = "";
	$input_chars       = "";
	$gm_select0        = "";
	$gm_select1        = "";
	$sel_map0          = "";$sel_map1="";$sel_map2="";$sel_map3="";$sel_map4="";$sel_map5="";$sel_map6="";$sel_map7="";$sel_map8="";$sel_map9="";$sel_map10="";$sel_map11="";$sel_map12="";$sel_map13="";$sel_map14="";$sel_map15="";$sel_map16="";$sel_map17="";$sel_map18="";$sel_map19="";$sel_map20="";$sel_map21="";$sel_map22="";$sel_map23="";$sel_map24="";$sel_map25="";$sel_map26="";
    $sel_class1        = ""; $sel_class2       = ""; $sel_class3        = ""; $sel_class4        = ""; $sel_class5        = ""; $sel_class6        = "";
	if($gm_level == 2)
        {
        	$admins_level = 2;
	  	    $ниво = 'Trusted GM ';
			$права = 'You have a rights for all features</br>';
			$form = '';		  
        }
		
	elseif($gm_level == 1)
        {
        	$admins_level = 1;
	  	    $ниво = 'Beginner GM';
			$права = 'You Do NOT have a rights for all features';
			$form = '';
        }
	elseif($gm_level > 3)
        {
			$input_acc    = "<input style='width:80px' class='button' type='submit' name='gm_acc_btn' value='GM Acc'>";
        	$input_chars  = "<input style='width:80px' class='button' type='submit' name='gm_char_btn' value='GM Char'>";
			$admins_level = 10;
	  	    $ниво  = 'the Administrator';
			$права = 'You have a rights to edit account/character details';
			$form  = "<input";
        }
		
	else
        {
            die("Something is wrong, please contact the administrators");
        }

		
	if ((isset($_POST['char_btn']) && (empty($_POST['char_search']))))
	    {
        	$msg = "<div class='real'>Please, type at least 2 letters from character name</div>";$error =1;	
        }
		
	if ((isset($_POST['acc_btn']) && (empty($_POST['acc_search']))))
	    {
        	$msg = "<div class='real'>Please, type at least 2 letters from account name</div>";$error =1;		
        }

?>

<div class='charshav'>
<SCRIPT type="text/javascript" src="js/overlib.js"></SCRIPT> 
  <div ><h3 class='title textmod'>Search for Account or Character</h3> </div>
 <div class='full_title' style='margin:20px 20px;'><center> Welcome <?php echo $gm_name . ", you are ".$ниво." </br>". $права;?> </div></center>
	  <div style='float:left; margin-bottom:30px'>           
           <table class='title fix_1' width='240'>
		      <form method='post'>	
                  <tr >
				         <td style='padding:5px 5px;font-size:12pt;' colspan='2'>Search for Account</td></tr>
				    <tr >
                      <td><input style='color:black;text-align:center;height:30px;width:100px'placeholder='Type account name' minlength='2' name='acc_search' type='text'/></td>
                      <td><select style='height:40px;width:100px;padding:5px 5px;margin-top:6px;' name='acc_type'>
                          <option style='color:#444;height:30px;'selected disabled>Choose Type</option>
                          <option value='1'> Full</option>
                          <option value='2'> Partial </option>    
				           </select>
						</td>
					</tr>
                   <tr>
				       <td><input style='width:80px' class='button' type='submit' name='acc_btn' value='Search'></td>
					   <td ><?php echo $input_acc?></td>
				    </tr>
					   <tr>
			           <td colspan='2' align='center'><a href='?p=accountedit&page=1'> Show All Accounts</a></td>
					   </tr>
			   </form>
		</table>
    </div>

		  <div style='float:right; margin-bottom:30px'>        
           <table class='title fix_1' width='240'>
		      <form method='post'>	
                  <tr >
				         <td style='padding:5px 5px;font-size:12pt;' colspan='2'>Search for Character</td></tr>
				    <tr >
                      <td><input style='color:black;height:30px;width:100px;text-align:center;'placeholder='Type character name' minlength='2' name='char_search' type='text'/></td>
                      <td><select style='height:40px;width:100px;padding:5px 5px;margin-top:6px;' name='char_type'>
                          <option style='color:#444;'selected disabled>Choose Type</option>
                          <option value='1'> Full</option>
                          <option value='2'> Partial</option>    
				           </select>
						</td>
					</tr>
                   <tr>
				       <td><input style='width:80px' class='button' type='submit' name='char_btn' value='Search'></td>
					   <td><?php echo $input_chars?></td>
					   </tr><tr>
			           <td colspan='2' align='center'><a href='?p=accountedit&pages=1'> Show All Characters</a></td>
					   </tr>
			   </form>
		</table>
   </div> 
<?php 
if($admins_level == 10){
// Search GM Characters 
    if (isset($_POST['gm_char_btn'])){      
	               $all_gms = mssql_query("Select * from Character where ctlcode= 8 order by name desc");
		          if(mssql_num_rows($all_gms) !=0){
                       echo "
		                   <table width='400px' border='1'>
		                    <tr class='title'>		
		        		       <td>#</td>
		        		       <td>Character</td>
		        		       <td>Account</td>
		        		       <td width='20px'>GM Level</td>
		        		   "; 

		               while($gm_info = mssql_fetch_array($all_gms)){
		        	     $nbr++;
		        	      $check_level = check_admin($gm_info['AccountID']);
				      		switch($check_level[1]){
				              case 666: $spec_color = '#8c4600';  $level = "Administrator";    break;
				              case 2:   $spec_color = '#663300';  $level = "Trusted GM";  break;
				              case 1:   $spec_color = '#402000';  $level = "Beginner GM"; break;
                              default:	break;						  
							  }
		        	  echo "
		        	        <tr style='text-shadow:1px 1px #000000;color:#fff;background:".$spec_color.";'>
		        	            <td>".$nbr."</td>
		        				<td><a href=?p=accountedit&character=".$gm_info['Name'].">".$gm_info['Name']."</a></td>
		        				<td>".$gm_info['AccountID']."</td>
		        				<td>".$level."</td>
		        			</tr>";
		          }
		         echo "</table></div>";
              }
			  echo "<div style='margin-top:250px;'> No GM accounts</div></br>";
	}
// Search GM Accounts 			  
	if (isset($_POST['gm_acc_btn'])){
		   
	      $all_gms = mssql_query("Select * from DTweb_GM_Accounts order by gm_level desc");
		  
           echo "
		           <table style='text-shadow:1px 1px #000000;font-size:12pt;'width='100%' border='1'>
		            <tr style='font-size:10pt;' class='title'>
					
				       <td>#</td>
				       <td>Name</td>
				       <td>IP</td>
				       <td>GM Level</td>
				    </tr>"; 
		   while($gm_info = mssql_fetch_array($all_gms)){
			   $nbr++;			   
			   switch($gm_info['gm_level']){
				   case 666: $spec_color = '#8c4600'; $level = "Administrator";    break;
				   case 2:   $spec_color = '#663300'; $level = "Trusted GM";  break;
				   case 1:   $spec_color = '#402000'; $level = "Beginner GM"; break;	   			   
			                 
			   }             
			  echo "
			        <tr style='text-shadow:1px 1px #000000;color:#fff;background:".$spec_color.";'>
			            <td >".$nbr."</td>
						<td><a href=?p=accountedit&account=".$gm_info['name'].">".$gm_info['name']."</a></td>
						<td>".$gm_info['ip']."</td>
						<td>".$level."</td>
					</tr>";
		  }
		 echo "</table>";
        }

}
/////////////////////////////		
// Search All Accounts/////********************************************************************************************************
//////+ Pagination/////////// 

if((isset($_GET['page'])) and !isset($_POST['char_btn']) and !isset($_POST['acc_btn'])and !isset($_POST['gm_acc_btn'])){
        $result = mssql_query($search_pagi_acc);
	

	   if ($option['user_pass_show'] == 1)
	   {
		   $td  = '<td align=center>Password</td>';
	   }
	   else
	   {		   
		   $td = ''; 
	   }   
       		echo '         
        			  <table width="100%" border="1" style="border:2px solid #444; font-size:10pt;">
                         <tr><td colspan = 12 class="full_title title">Search Account Results </td></tr>					  
                         <tr  class="title">					 
                              <td align=center>#</td>
						      <td align=center>Account</td>
                              <td align=center>Last Played Character</td>
                              <td align=center>Email</td>
                              '.$td.'
                              <td align=center>Last Game Login Time</td>
							  <td align=center>Last Game Login IP</td> 
						      <td align=center>Last Web Login Time</td>
							  <td align=center>Last Web Login IP</td>                  
					     </tr>';           
	   $rank = 0;
       while($row = mssql_fetch_array($result)) {
			   $memb_info  = mssql_fetch_array(mssql_query("Select * from Memb_info where [memb___id] = '".$row['memb___id']."'"));
			   $played     = mssql_fetch_array(mssql_query("Select GAMEIDC from AccountCharacter where [id] = '".$row['memb___id']."'"));
			   $memb_stat  = mssql_fetch_array(mssql_query("Select * from memb_stat where [memb___id] = '".$row['memb___id']."'"));
			   $last_web   = mssql_fetch_array(mssql_query("Select account,login,logout,ip from [DTweb_Login_Logs] where [account] = '".$row['memb___id']."'"));
				 
				    if($last_web['login'] == null){
				    	$web_info = '<center>----</center>';
				    }
				    else {
				    	$web_info = server_time($last_web['login']) ;
				    }
	               if ($option['user_pass_show'] == 1){
		           	 $td1 = '<td align=left>'.$memb_info['memb__pwd'].'</td>';
		           	 }
	               else{
		           	 $td1 = '';
		           	 }
	 
			if($played['GAMEIDC'] == null){			
			   $infos = '----';
			}
			else{	
				$infos= $played['GAMEIDC'];			
			}
			if($memb_stat['IP'] == null){
			    $memb_stat['IP'] = '<center><font color="#646473">----</font></center>';
			}
			else{
				$memb_stat['IP'] = $memb_stat['IP'];
			}
			
			$rank++;
            $num = $rank + $offset; 
            echo   "
			              <tr>
                             <td align=center>".$num." </td>
					         <td  align=center><a href=?p=accountedit&account=".$row['memb___id'].">".$row['memb___id']."</a></td>
                             <td  align=center><a href=?p=accountedit&character=".$played['GAMEIDC'].">".$infos."</a></td>
				             <td  align=center>".$memb_info['mail_addr']."</td>
                             ".$td1."
                             <td  align=center>".$memb_info['out__days']."</td>
							 <td  align=center>".$memb_stat['IP']."</td>
							 <td  align=center>".$web_info."</td>
							 <td  align=center>".$memb_stat['IP']."</td>
                         </tr>";
	     }
$count = mssql_num_rows(mssql_query("Select * from MEMB_INFO "));
		$max_page= ceil($count/$option['top_acc']);
		$next = $page+1;
			$prev = $page-1;
			if ($prev == 0){
					$prev =1;
				}
			if ($next >= $max_page){
					$next = $max_page;
				}
				if ($page == 1){
					$show = "<!--";
					$end = "-->";
				}
				else{
					$show = "";
					$end = "";
				}
					if($page == 1){
							$first_page  = "<span class='bold4'>First Page</span>";	 
							}
					if ($page != 1 ){
							$first_page = "";
							}
					if ($page == $max_page){
							$last_page = "<span class='bold4'>Last Page</span>";
							}
					if($page != $max_page){
							$last_page = "";
							}
			echo "</table>";
			
			
			echo " 
			<center>
			     <div>
			     	<span><a href='?p=accountedit&page=1'> << </a></span>
			     	<span><a href='?p=accountedit&page=".$prev."'>&lt;</a></span>
			     	<span class='active'><a href='?p=accountedit&page=".$page."'>".$page."</a></span>
			     	<span><a href='?p=accountedit&page=".$next."'>&gt;</a></span>
			     	<span><a href='?p=accountedit&page=".$max_page."'> >> </a></span>
			     </div>
			</center>";
		
}

/////////////////////////////		
// Search All Characters/////********************************************************************************************************
//////+ Pagination/////////// 

  if((isset($_GET['pages'])) and !isset($_POST['char_btn']) and !isset($_POST['acc_btn']) and !isset($_POST['gm_acc_btn'])){
        $result = mssql_query($search_pagi_char);
        $count = mssql_num_rows(mssql_query("Select * from Character "));
        $rank = 0;
	   if ($option['user_pass_show'] == 1){
		   $td  = '<td align=center>Password</td>';
	   }
   
       		echo '       
        			  <table width="600px" border="1" style="border:2px solid #444; font-size:10pt;">
                         <tr><td colspan = 16 class="full_title title">Search Character Results </td></tr>					  
                         <tr align="center" class="title">
						 		 <td  class="title">&#35;</td>  
						         <td  class="title">Character</td>   
								 <td  class="title">Account</td>   
                                 <td  class="title">Resets</td>        							  
                                 <td  class="title">Level</td>          							  
                                 <td  class="title">Class</td>          							  
                                 <td  class="title">Location</td>							     							  
                                 <td  class="title">VIP</td>           							  
                                 <td  class="title">Str</td>      							  
                                 <td  class="title">Dex</td>       							  
                                 <td  class="title">Vit</td>      							  
                                 <td  class="title">Ene</td>        							        							  
                                 <td  class="title">Points</td>         							  								 
                                 <td  class="title">Status</td> 							        							     
					     </tr>';
        
		   
       while($char_info = mssql_fetch_array($result)) {
		     
		    $status = mssql_fetch_array(mssql_query("Select ConnectStat from MEMB_STAT where memb___id='".$char_info['AccountID']."'"));
			
            if ($status[0] == 0) {
                $status[0] = 'Offline';
            }
            if ($status[0] == 1) {
                $status[0] = 'Online';
            }
			if($char_info['IsVip'] == 1){
				$date = server_time($char_info['IsVip']);
				$is_vip = "VIP until:". $date;
			}
			else{
			    $is_vip = '----';	
			}
			
			$rank++;
            $num = $rank + $offset1; 
            echo "  <tr>
                        <td align=center>".$num." </td>
					    <td align=left><a href=?p=accountedit&character=".$char_info['Name'].">".$char_info['Name']."</a></td>
						<td align='center'><a href=?p=accountedit&account=".$char_info['AccountID'].">".$char_info['AccountID']."</a></td>
                        <td align='center'>".$char_info['Resets']."</td>							 
                        <td align='center'>".$char_info['cLevel']."</td>							 
                        <td align='center'>".char_class($char_info['Class'])."</td>							 
                        <td align='center'>".de_map($char_info['MapNumber'])."</br> ".$char_info['MapPosX']." - ".$char_info['MapPosY']."</td>							 						 
                        <td align='center'>".$is_vip."</td>							 
                        <td align='center'>".$char_info['Strength']."</td>							 
                        <td align='center'>".$char_info['Dexterity']."</td>							 
                        <td align='center'>".$char_info['Vitality']."</td>							 
                        <td align='center'>".$char_info['Energy']."</td>							 					 
                        <td align='center'>".$char_info['LevelUpPoint']."</td>							 									 
                        <td align='center'>".$status[0]."</td>							 								 
                    </tr>";
	     }		
		
		$max_pages= ceil($count/$option['top_char']);
        $pages = $_GET['pages'];
		$next = $pages+1;
        $prev = $pages-1;
			if ($prev == 0){
					$prev =1;
				}
			if ($next >= $max_pages){
					$next = $max_pages;
				}
				if ($pages == 1){
					$show = "<!--";
					$end = "-->";
				}
				else{
					$show = "";
					$end = "";
				}
					if($pages == 1){
							$first_page  = "<span class='bold4'>First Page</span>";	 
							}
					if ($pages != 1 ){
							$first_page = "";
							}
					if ($pages == $max_pages){
							$last_page = "<span class='bold4'>Last Page</span>";
							}
					if($pages != $max_pages){
							$last_page = "";
							}
			echo "</table>";
			echo "<center>";
			echo  $first_page. $show . $last_page. $end. " 
			 <div>
				<a href='?p=accountedit&pages=1'> << </a>
				<a href='?p=accountedit&pages=".$prev."'>&lt;</a>
				<a class='active'><a href='?p=accountedit&pages=".$pages."'>".$pages."</a>
				<a href='?p=accountedit&pages=".$next."'>&gt;</a>
				<a href='?p=accountedit&pages=".$max_pages."'> >> </a>
			 </div>
			</center>";

}

/////////////////////////////		
// Search Accounts///////////********************************************************************************************************
////Exact/Partial////////////
/////////////////////////////

if(isset($_POST['acc_btn']) and isset($_POST['acc_search']))
	 {
        $search_acc =  clean_post($_POST['acc_search']);
        $search_exact = "SELECT memb___id,memb__pwd from MEMB_INFO where memb___id ='".$search_acc."'";
        $search_partial = "SELECT memb___id,memb__pwd from MEMB_INFO where memb___id LIKE '%".$search_acc."%'";
    
    if (isset($_POST['acc_type']) == 1 && $error !=1) {
        $result = mssql_query($search_exact);
		
    } 
	elseif(isset($_POST['acc_type']) == 2 && $error !=1){
        $result = mssql_query($search_partial);
	
    } 
	elseif(isset($_POST['acc_search'])&& $error !=1){
        $result = mssql_query($search_partial);
	
    } 
	else{
		echo $msg;
	}
	
	
	if($error !=1){
		echo '   
		         <center>
		           <table style="margin-bottom:20px" width=600 border="1" cellspacing="0" "> 				
                    <tr class="title">
                        <td align=center>#</td>
						<td align=center>Account</td>
						<td colspan = "50" align=center>Characters</td>
                    </tr>';
            $rank = 0;
	if($error !=1){	
       while($row = mssql_fetch_array($result)) {
		   $look  = mssql_query("Select name from Character where [AccountID] = '".$row['memb___id']."'");
		   $rank++;

		    echo"<tr>
                 <td align=center>".$rank." </td>
				 <td align=center><a href=?p=accountedit&account=".$row['memb___id'].">".$row['memb___id']."</a></td>";		     
		   while($ee_chars = mssql_fetch_array($look)){
              echo "<td align=center><a href=?p=accountedit&character=".$ee_chars['name'].">".$ee_chars['name']."</a></td>";			   
		   }  
		 }
          echo "</tr></table>";
       }
	}
}
/////////////////////////////		
// Search Characters/////////********************************************************************************************************
////Exact/Partial////////////
/////////////////////////////
			
if(isset($_POST['char_btn']) and isset($_POST['char_search']))
	   {
           $char_search =  clean_post($_POST['char_search']);
           $search_exact = "SELECT * from Character where name='".$char_search."'";
           $search_partial = "SELECT * from Character where name LIKE '%".$char_search."%'";
   
    if ((($_POST['char_type']) == 1) && $error !=1) {
        $result = mssql_query($search_exact);
		
    } 
	elseif((($_POST['char_type']) == 2) && $error !=1){
        $result = mssql_query($search_partial);
	
    } 
	elseif(isset($_POST['char_search'])&& $error !=1){
        $result = mssql_query($search_partial);
	
    } 
	else{
		echo $msg;
	} 
   
   if($error !=1){
        echo '  <center>
		           <table style="margin-bottom:20px" width=600 border="1" cellspacing="0" ">                
                    <tr class="title">
                        <td align=center>&#35;</td>
                        <td align=center>Character</td>
						<td align=center>Account</td>
                        <td align=center>Level</td>
                        <td align=center>Resets</td>
                        <td align=center>Class</td>
                        <td align=center>Status</td>
                    </tr>';
           $rank = 0;
		   if($error !=1){
       while($row = mssql_fetch_array($result)) {
			$rank++;
            $status = mssql_fetch_array(mssql_query("Select ConnectStat from MEMB_STAT where memb___id='".$row['AccountID']."'"));
			
            if ($status['ConnectStat'] == 0) {
                $status['ConnectStat'] = 'Offilne';
            }
            if ($status['ConnectStat'] == 1) {
                $status['ConnectStat'] = '<Online';
            }

            echo "<tr>
                      <td align=center>".$rank." </td>
                      <td align=center><a href=?p=accountedit&character=".$row['Name'].">".$row['Name']."</a></span></td>
                      <td align=center><a href=?p=accountedit&account=".$row['AccountID'].">".$row['AccountID']."</a></span></td>
				      <td align=center>".$row['cLevel']."</td>
                      <td align=center>".$row['Resets']."</td>
                      <td align=center>".char_class($row['Class'])."</td>
                      <td width=60 height=30 align=center>".$status['ConnectStat']."</td>
                  </tr>";
	     }
		
            echo "</table></center>";
      
		   }
       }
	}    
////////////////////////		
// Rendering Account////********************************************************************************************************
////// Warehosue ///////
////////////////////////  
 
    if(isset($_GET['account'])){

            $account       = strip($_GET['account']);
            $acc_cr        = mssql_fetch_array(mssql_query("Select * from MEMB_CREDITS where [memb___id] = '".$account."'"));
            $acc_res       = mssql_query("Select * from DTweb_JewelDeposit where [memb___id] = '".$account."'");   
            $acc_chars     = mssql_query("Select * from character where [accountID] = '".$account."'"); 
		    $acc_zen       = mssql_fetch_array(mssql_query("Select zen from DTweb_Bank where [memb___id] = '".$account."'")); 
			$memb_info     = mssql_fetch_array(mssql_query("Select * from Memb_info where [memb___id] = '".$account."'"));
			$played        = mssql_fetch_array(mssql_query("Select GAMEIDC from AccountCharacter where [id] = '".$account."'"));
			$memb_stat     = mssql_fetch_array(mssql_query("Select * from memb_stat where [memb___id] = '".$account."'"));
			$last_web      = mssql_fetch_array(mssql_query("Select * from [DTweb_login_logs] where [account] = '".$account."' order by id desc"));
  			$status        = mssql_fetch_array(mssql_query("Select ConnectStat from MEMB_STAT where memb___id='".$account."'"));		
			$box_bank      = mssql_query("Select * from [DTweb_GM_Box_Inventory] where [memb___id] = '".$account."'");
			$char_name     = null;
			$acc_resources = null;			
			
			if($acc_zen['zen'] == null){
				mssql_query("Insert into DTweb_Bank (memb___id,zen) VALUES ('".$account."','0')");
			}
            switch($status[0]){
            case 1: $statusa = 'Online'; break;	
            case 0: $statusa = 'Offline'; break;
            }
		    while($chars = mssql_fetch_array($acc_chars))
		    {
			$char_name .= "<a href='?p=accountedit&character=". $chars['Name']."'>" . $chars['Name'] . "</a> |" ;   					   
		    }
			
			while($acc_ress = mssql_fetch_array($acc_res))
		    {	
//Rendering Admin Account Form		
			    if($admins_level == 10)
			        {
			        $acc_resources .= "
					<table >
					  <tr>
					     <td style='text-align:right'>Bless:</td>
			             <td><input class='new_input' name='bless' type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='padding:5px 5px;height:20px;width:50px;color:white' value='".$acc_ress[1]."'/></td>
				         <td style='text-align:right'>Soul:</td>     
					     <td><input class='new_input' name='soul'  type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='padding:5px 5px;height:20px;width:50px;color:white' value='".$acc_ress[2]."'/></td> 
					 </tr>
					 
					 <tr>
					     <td style='text-align:right'>Chaos:</td> 
						 <td><input class='new_input' name='chaos' type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='padding:5px 5px;height:20px;width:50px;color:white' value='".$acc_ress[3]."' /></td>  
					     <td style='text-align:right'>Life:</td>    
						 <td><input  class='new_input' name='life'  type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='padding:5px 5px;height:20px;width:50px;color:white' value='".$acc_ress[4]."'/>  					 
					 </tr>
					 <tr>    
						 <td style='text-align:right'>Stone:</td>    
						 <td><input class='new_input' name='stone' type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='padding:5px 5px;height:20px;width:50px;color:white' value='".$acc_ress[13]."'/> 
					     <td style='text-align:right'>Rena:</td>     
						 <td><input class='new_input' name='rena'  type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='padding:5px 5px;height:20px;width:50px;color:white' value='".$acc_ress[14]."'/></td>
					 </tr>
					 <tr>
					    <td style='text-align:right'>Creation:</td> 
					    <td><input class='new_input' name='crea'  type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='padding:5px 5px;height:20px;width:50px;color:white' value='".$acc_ress[5]."'/></td>
                    </tr>
                   </table>					
					";	
			        }
                else
			        {			
			        $acc_resources .= "<div style='float:left;text-align:left;'>Bless: ".$acc_ress[1]." </br> Soul: ".$acc_ress[2]." </br> Chaos: ".$acc_ress[3]." </br> Life: ".$acc_ress[4]." </br> Creation: ".$acc_ress[5]." </br> Stone: ".$acc_ress[13]." </br> Rena: ".$acc_ress[14]."</br></div>" ;
		            }
			}
			
			if($last_web == null)
				    {
				    	$web_info_date = '<center>----</center>';
						$web_info_ip ='<center>----</center>';
				    }
				    else 
				    {
						$web_info_ip = $last_web['ip'];
				    	$web_info_date = server_time($last_web['login']) ;
				    }
	                if (($option['user_pass_show'] == 1) && ($admins_level < 3))
			         {
		           	 $td1 = '<tr><td class="title">Account Password</td><td align=left>'.$memb_info['memb__pwd'].'</td></tr>';
		           	 }
	                elseif($admins_level == 10)
				     {
		           	 $td1 = 
					 '				 
					 <tr><td style="text-align:right" class="title">Account Password</td><td align=left><input onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="'.$memb_info['memb__pwd'].'" style=";color:white;padding:5px 5px;height:20px" class="new_input" type="text" name="password"/></td></tr>
					 <tr><td style="text-align:right" class="title">Secret Question</td><td align=left><input id="secure" value="'.$memb_info['fpas_ques'].'" style=";color:white;padding:5px 5px;height:20px" class="new_input" type="text" name="fques" /></td></tr>
					 <tr><td style="text-align:right" class="title">Secret Answer</td><td align=left><input value="'.$memb_info['fpas_answ'].'" style=";color:white;padding:5px 5px;height:20px" class="new_input" type="text" name="fpass"/></td></tr>
					 '; 	 
					 }
					 else
					 {
					 $td1 = '';	 
					 }
	 
			if($played['GAMEIDC'] == null)
			{			
			   $played['GAMEIDC'] == null;
			   $infos = '----';
			}
			else
			{	
				$infos= $played['GAMEIDC'];			
			}
			if($memb_stat['IP'] == null)
			{
			    $memb_stat['IP'] = '<center>----</center>';
			}
			else
			{
				$memb_stat['IP'] = $memb_stat['IP'];
			}
			
if($admins_level == 10)
    {
		$box_bank_res = "";
            $checks = check_admin($account);
            $gm_level = $checks[1];
            $gm_ipcur = $checks[2];
			
   		    if(check_admin($account) != null){
				if((mssql_num_rows($box_bank)) == 0){
					mssql_query("Insert into DTweb_GM_Box_Inventory ([memb___id],box1,box2,box3,box4,box5,gm_level) VALUES ('".$account."','0','0','0','0','0',".$gm_level.")");
				}
				$box_bank_res = "";
				while($check_bank = mssql_fetch_array($box_bank)){
					
			        $box_bank_res .= "
					<tr><td style='text-align:right' class='title'>GM Box</td>
					<td>
					<table>
					  <tr>
					     <td style='text-align:right'>Box +1:</td>
			             <td><input class='new_input' name='box1' type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='padding:5px 5px;height:20px;width:50px;color:white' value='".$check_bank['box1']."'/></td>
				         <td style='text-align:right'>Box +2:</td>     
					     <td><input class='new_input' name='box2'  type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='padding:5px 5px;height:20px;width:50px;color:white' value='".$check_bank['box2']."'/></td> 
					 </tr>
					 
					 <tr>
					     <td style='text-align:right'>Box +3:</td> 
						 <td><input class='new_input' name='box3' type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='padding:5px 5px;height:20px;width:50px;color:white' value='".$check_bank['box3']."' /></td>  
					     <td style='text-align:right'>Box +4:</td>    
						 <td><input  class='new_input' name='box4'  type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='padding:5px 5px;height:20px;width:50px;color:white' value='".$check_bank['box4']."'/>  					 
					 </tr>
					 <tr>    
						 <td style='text-align:right'>Box +5:</td>    
						 <td><input class='new_input' name='box5' type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='padding:5px 5px;height:20px;width:50px;color:white' value='".$check_bank['box5']."'/> 
					 </tr>
			
                   </table>	
                  </td></tr>				   
					";	
					}
			}
			$gm_def0 = "";$gm_def1="";$gm_def2="";$gm_def3="";
            switch($gm_level){
				case 0:$gm_def0 = 'selected';   break;
				case 1:$gm_def1 = 'selected';   break;
				case 2:$gm_def2 = 'selected';   break;
				case 666:$gm_def3 = 'selected'; break;
			}

             
		   echo "
		
			 <form class='form' style='height:850px;' method='post'>
			
	     	<table width='250' cellpadding='6' align='left' border='1' >
			        <tr><td align='left'colspan='2'>
			            <div style='display:inline;'>
                            <input style='width:64px;font-size:10px;color:white;' type='submit' name='save_acc' value='Save'/>  		
			        		<input style='width:64px;font-size:10px;color:white;' type='submit' name='clear_wh' value='Cl  Wh'/>  
                            <input style='width:64px;font-size:10px;color:white;' type='submit' name='clear_zen' value='Cl  Zen'/> 
                            <input style='width:64px;font-size:10px;color:white;' type='submit' name='switch_session' value='Switch'/>
			            </div>
                    </td><tr>
					   <tr><td style='text-align:right' class='title'>Account</td><td><a href='?p=accountedit&account=".$account."'>".$account."</a></td></tr>
			           <tr><td style='text-align:right' class='title'>Status</td><td>".$statusa."</td></tr>	
					   <tr><td style='text-align:right' class='title'>GM Rank</td><td>
					        <select style='width:120px' name='gm_make'>
					         <option ".$gm_def0." value='0'>Not GM</option>
					         <option ".$gm_def1." value='1'>Beginner GM</option>
							 <option ".$gm_def2." value='2'>Trusted GM</option>
							 <option ".$gm_def3." value='666'>Administrator</option>
						    </select>
							<input name='delete_gm' value='Delete' style='height:30px;width:60px' type='submit'/></br>
							Set IP <input name='gm_ip' value='".$gm_ipcur."' style='height:20px;width:120px' type='text'/>
							 </td></tr>	
					   <tr><td style='text-align:right' class='title'>Characters</td><td>".$char_name."</td></tr>
					   <tr><td style='text-align:right' class='title'>Credits</td><td align='left'><input class='new_input' type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;height:20px' name='credits' value='".$acc_cr['credits']."'/></td></tr>
					   <tr><td style='text-align:right' class='title'>Resources</td><td>".$acc_resources."</td></tr>
					   ".$box_bank_res."
					   <tr><td style='text-align:right' class='title'>Zen</td><td align='left'><input style='width:200px;color:white;padding:5px 5px;height:20px' type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='bank_zen' value='".$acc_zen['zen']."'/></td></tr>
				       <tr><td style='text-align:right' class='title'>E-mail</td><td align=left><input class='new_input' id='mysecure' style='color:white;padding:5px 5px;height:20px' type='text' name='mail_adr' value='".$memb_info['mail_addr']."'/></td></tr>
                       ".$td1."
					   <tr><td></td></tr>
                       <tr><td style='text-align:right' class='title'>Last game login</td><td align=left>".$memb_info['out__days']."</td></tr>
					   <tr><td style='text-align:right' class='title'>Last game login IP</td> <td align=left>".$memb_stat['IP']."</td></tr>
					   <tr><td style='text-align:right' class='title'>Last web login</td><td align=left>".$web_info_date."</td></tr>
					   <tr><td style='text-align:right' class='title'>Last web login IP</td>   <td align=left>".$web_info_ip ."</td></tr> 		
					   </form>				   
					  </table>";

				if(isset($_POST['switch_session'])){
					$_SESSION['dt_username'] = $account;
					$_SESSION['dt_password'] = $memb_info['memb__pwd'];
					refresh();
				}
				
				if(isset($_POST['clear_wh'])){				
					gm_cl_warehouse($account,$_POST['clear_wh']);
					$messagess[] = "".$account." warehouse was cleared";
					
				}
				
				elseif(isset($_POST['clear_zen'])){
					
					mssql_query("Update DTweb_Bank set zen = 0 where memb___id = '".$account."'");
					mssql_query("Update Character set money = 0 where [AccountID] = '".$account."'");
					mssql_query("Update warehouse set money = 0 where [AccountID] = '".$account."'");
					$messagess[] = $account . " Bank, Warehouse and Characters Zen was cleared";	
				}
				
				elseif(isset($_POST['delete_gm'])){
                   mssql_query("Delete from DTweb_GM_Accounts where name='".$account."'");
				   $messagess[] .= $account . "was deleted from the GM list";	
                   echo "<script>setTimeout(\"location.href = '?p=accountedit&account=".$account."';\",0);</script>";				   
				}
				
				elseif(isset($_POST['save_acc']))
				{	
				mssql_query("Update Memb_Credits set credits='".(int)$_POST['credits']."' where [memb___id] = '{$account}'");
				mssql_query("Update DTweb_JewelDeposit set 
				            bless     ='".(int)$_POST['bless'].  "', 
				            soul      ='".(int)$_POST['soul'].   "',
						    chaos     ='".(int)$_POST['chaos'].  "',
						    life      ='".(int)$_POST['life'].   "',
						    creation  ='".(int)$_POST['crea'].   "',
						    stone     ='".(int)$_POST['stone'].  "',
						    rena      ='".(int)$_POST['rena'].   "'
						    where [memb___id] = '{$account}' "
							);
				mssql_query("Update DTweb_Bank set zen='".clean_post($_POST['bank_zen'])."' where [memb___id] = '{$account}'");
				mssql_query("Update [MEMB_INFO] set mail_addr='".strip($_POST['mail_adr'])."',[memb__pwd]='".strip($_POST['password'])."', [fpas_ques]='".strip($_POST['fques'])."',[fpas_answ]='".strip($_POST['fpass'])."' where [memb___id] = '{$account}'");
                mssql_query("Update DTweb_GM_Box_Inventory set box1='".clean_post($_POST['box1'])."', box2='".clean_post($_POST['box2'])."', box3='".clean_post($_POST['box3'])."', box4='".clean_post($_POST['box4'])."', box5='".clean_post($_POST['box5'])."' where [memb___id] = '{$account}'");
				if((mssql_num_rows(mssql_query("Select * from DTweb_GM_Accounts where name='".$account."'"))) > 0){
				mssql_query("Update DTweb_GM_Accounts set gm_level = '".clean_post($_POST['gm_make'])."', ip= '".clean_post($_POST['gm_ip'])."'where name='".$account."'");
				}
				else{
				mssql_query("Insert into DTweb_GM_Accounts (name,gm_level,ip) values ('".$account."', '".$_POST['gm_make']."','".$_POST['gm_ip']."')");
				}
				$messagess[] = "".$account." information was succesfully saved";	
				echo "<script>setTimeout(\"location.href = '?p=accountedit&account=".$account."';\",500);</script>";				
			    }
				
		foreach($messagess as $shos)
		{
			echo $shos;
		}
//End				

// Start Item Adder
function items_category() {
If(!isset($_GET['category'])){
$category="Swords";}
else{
$category=clean_post(stripslashes($_GET['category']));}
$place="mod/admin/includes/items/".$category.".txt";
if (!is_file("$place")) { exit();} 

$handle = fopen("$place", "r");
while (!feof($handle)) {
   $userinfo = fscanf($handle, "%s\t%s\t%s\t%s\t%s\t%s\t%[a-zA-Z0-9\" ]\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\n");
   if ($userinfo) {
     list ($index,$x,$y,$a,$sirial,$drop,$name,$level,$DamMin,$DamMax,$Speed,$Dur,$MagDur,$str,$agi,$dw,$bk,$elf,$mg) = $userinfo;
 	$index = preg_replace('/[^0-9]/', '', $index);
	//if (!preg_match("/\/\//i", $index)) { continue; }
	if (!$name) { $loop = ($index * 32); } else {
	
	$add = $loop + $index;
	
	if ($add >= 256) { $add = $add; }
	//$hex = strtoupper(str_pad(dechex($add), 2 , "0", STR_PAD_LEFT));
		$hex = strtoupper(sprintf("%02x",$add));
	$name = preg_replace('/[^a-zA-Z0-9\ \-]/', '', $name);
	$item[$hex] = array('name' => $name, 'x' => $x, 'y'=>$y,
		'level' => $level, 'DamMin' => $DamMin,'DamMax' => $DamMax, 'str' => $str,
	'agi' =>$agi,'dw' =>$dw,'elf' =>$elf,
	'bk' =>$bk,'mg' =>$mg);
	}
  }
}
fclose($handle);
return $item;
}

$item_names = items_names();
$items_category = items_category();
If(!isset($_GET["category"])){
$kategoriq="Swords";}
else{
$kategoriq=clean_post(stripslashes($_GET["category"]));}
$type='1';
If($kategoriq=="Swords" or $kategoriq=="Axes" or $kategoriq=="Maces" or $kategoriq=="Spears" or $kategoriq=="Bows" or $kategoriq=="Staffs" or $kategoriq=="Pendants"){
$type='2';}
If($kategoriq=="Wings_Cape"){
$type='3';}

$cols1="";$cols2="";$cols3="";$cols4="";$cols5="";$cols6="";$cols7="";$cols8="";$cols9="";$cols10="";$cols11="";$cols12="";$cols13="";$cols14="";$cols15="";$cols16="";
		    switch($kategoriq){
	            	  case "Swords": $cols1 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Axes": $cols2 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Maces": $cols3 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Spears": $cols4 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Bows": $cols5 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Staffs": $cols6 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Helmets": $cols7 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Armors": $cols8 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Gloves": $cols9 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Pants": $cols10 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Boots": $cols11 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Shields": $cols12 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Rings": $cols13 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Pendants": $cols14 = "style='font-weight:600;color:#FFFFF2'"; break;
	            	  case "Wings_Cape": $cols15 = "style='font-weight:600;color:#FFFFF2'"; break;
                      case "item": $cols16 = "style='font-weight:600;color:#FFFFF2'"; break;					  
	              }
echo"
	 <div class='fix_2' style='font-size:10pt;width:300px;margin-bottom:10px;float:right;'>
		<a ".$cols1." href='?p=accountedit&account=".$account."'>Swords</a> |
		<a ".$cols2." href='?p=accountedit&account=".$account."&category=Axes'>Axes</a> |
		<a ".$cols3." href='?p=accountedit&account=".$account."&category=Maces'>Maces</a> |
		<a ".$cols4." href='?p=accountedit&account=".$account."&category=Spears'>Spears</a> |
		<a ".$cols5." href='?p=accountedit&account=".$account."&category=Bows'>Bows/X-Bows</a> |
		<a ".$cols6." href='?p=accountedit&account=".$account."&category=Staffs'>Staffs</a> |
		<a ".$cols7." href='?p=accountedit&account=".$account."&category=Helmets'>Helmets</a>  |
		<a ".$cols8." href='?p=accountedit&account=".$account."&category=Armors'>Armors</a> | 
		<a ".$cols9." href='?p=accountedit&account=".$account."&category=Gloves'>Gloves</a>  |
		<a ".$cols10." href='?p=accountedit&account=".$account."&category=Pants'>Pants</a>  |
		<a ".$cols11." href='?p=accountedit&account=".$account."&category=Boots'>Boots</a> |
		<a ".$cols12." href='?p=accountedit&account=".$account."&category=Shields'>Shields</a>  |
		<a ".$cols13." href='?p=accountedit&account=".$account."&category=Rings'>Rings</a>  |
		<a ".$cols14." href='?p=accountedit&account=".$account."&category=Pendants'>Pendants</a>  |
		<a ".$cols15." href='?p=accountedit&account=".$account."&category=Wings_Cape'>Wings, Cape</a> |
		<a ".$cols16." href='?p=accountedit&account=".$account."&category=item'>All Items</a> 
	 </div>
<div class='fix_3' style='margin-top:80px;'>
<form style='display:inline;width:250px;' name='additem' method='post'>
<select class='editbox' name=item_ids>
 <option selected disabled> Item</option>";
foreach ($items_category as $items => $value) { 
echo "<option value='".$items."'>".$value['name']."  </option>";
}
echo "</select></td>

        <td><select class='editbox' name='level'>
          <option disabled selected> Lvl </option> 
	      <option value=0> 0</option>
	      <option value=1> +1</option> 	
	      <option value=2> +2</option>	
	      <option value=3> +3</option>
	      <option value=4> +4</option>	
	      <option value=5> +5</option>
	      <option value=6> +6</option>
	      <option value=7> +7</option>
	      <option value=8> +8</option>
	      <option value=9> +9</option>
	      <option value=10> +10</option>
	      <option value=11> +11</option>
	      <option value=12> +12</option>
	      <option value=13> +13</option>
	   </select></td>


      <td><select class='editbox' name=option>
	  <option disabled selected> Opt </option> 
	      <option value=0> 0</option> 	
          <option value=1> +4</option>	
	      <option value=2> +8</option>
	      <option value=3> +12</option>
	      <option value=4> +16</option> 	
          <option value=5> +20</option> 
          <option value=6> +24</option> 
          <option value=7> +28</option> 
	    </select></td>

      <td><select class='editbox' name='luck'>
          <option disabled selected>Luck</option>
          <option value='0'>No</option>
          <option value='1'>Yes</option>
      </select></td>
	  <td>
      <select class='editbox' name='skill'>
          <option disabled selected>Skill</option>
          <option value='0'>No</option>
          <option value='1'>Yes</option>
      </select></td></tr></table>";
If($type==1){
   echo"
    <table class='left_table' align='left'>
	    <tr><td><input class=login_checkbox type='checkbox' value=1 name=op1></td><td align='left'> [IncZen+40%] </td></tr>
        <tr><td><input class=login_checkbox type='checkbox' value=2 name=op2></td><td align='left'> [DefSucRate+10%]</td></tr>
        <tr><td><input class=login_checkbox type='checkbox' value=4 name=op3></td><td align='left'> [Reflect+5%]</td></tr>
    </table>
    <table class='left_right' align='right'>
       <tr><td><input class=login_checkbox type='checkbox' value=8 name=op4></td> <td align='left'> [DmgDec+4%]</td></tr>
       <tr><td><input class=login_checkbox type='checkbox' value=16 name=op5></td><td align='left'> [IncMana4%]</td></tr>
       <tr><td><input class=login_checkbox type='checkbox' value=32 name=op6></td><td align='left'> [IncHP+4%] </td></tr>
    </table>";
}

If($type==2){
	echo"
    <table align='left'>
        <tr><td><input class=checkbox type='checkbox' value=1 name=op1></td><td align='left'> [IncMana+mana/8] </td></tr>
        <tr><td><input class=checkbox type='checkbox' value=2 name=op2></td><td align='left'> [IncLife+life/8] </td></tr>
        <tr><td><input class=checkbox type='checkbox' value=4 name=op3></td><td align='left'> [IncSpeed +7]    </td></tr>
    </table>
    <table align='right'>
        <tr><td><input class=checkbox type='checkbox' value=8 name=op4 ></td><td align='left'> [IncDmg+2%]       </td></tr>
        <tr><td><input class=checkbox type='checkbox' value=16 name=op5></td><td align='left'> [IncDmg+level/20] </td></tr>
        <tr><td><input class=checkbox type='checkbox' value=32 name=op6></td><td align='left'> [ExcDmg+10%]      </td></tr>
    </table>";
}

If($type==3){
echo"
    <table align='left'>
        <tr><td><input class=checkbox type='checkbox' value=1 name=op1>  </td><td align='left'> [IncHP+50] </td></tr>
        <tr><td><input class=checkbox type='checkbox' value=2 name=op2>  </td><td align='left'> [IncMana+50] </td></tr>
    </table>                                                             
    <table align='right'>                                               
        <tr><td><input class=checkbox type='checkbox' value=4 name=op3>  </td><td align='left'> [Ignoring 3%] </td></tr>
        <tr><td><input class=checkbox type='checkbox' value=8 name=op4>  </td><td align='left'> [IncMaxAG+50] </td></tr>
        <tr><td><input class=checkbox type='checkbox' value=16 name=op5> </td><td align='left'> [IncSpeed+5] </td></tr>
    </table>
";
}

echo"
<center>
<input onkeydown='if(event.keyCode==13)return false;' type=hidden value='".$account."' name=mu_account>
<input type=submit style='margin:5px 5px' onClick='return amisure();' value='Add Item' name=add_item></form>
</center>
";

if (isset($_POST['item_ids']) && isset($_POST['add_item'])) {

echo"<Br>";

if(isset($_POST['EO'])){$EO = $_POST['EO'];}else{$EO = 0;}
if(isset($_POST['level'])){$level = $_POST['level'];}else{$level = 0;}
if(isset($_POST['option'])){$option = $_POST['option'];}else{$option = 0;}
if(isset($_POST['dur'])){$dur = $_POST['dur'];}else{$dur = 0;}
if(isset($_POST['skill'])){$skill = $_POST['skill'];}else{$skill = 0;}
if(isset($_POST['luck'])){$luck = $_POST['luck'];}else{$luck = 0;}

$item_id   = hexdec($_POST['item_ids']) ;
$item_ids   = hexdec($_POST['item_ids']) ;
if ($item_id > 255)  {
			$EO += 128;
			$item_id =  $item_id- 256;
	}

if ($dur > 255 || $dur == 0) { $dur = 150; }
$IO = $level * 8;
if ($option < 4) {	
	$IO += $option;
} else {	$EO += 64; 
	 $IO += ($option-4); }
if ($skill == 1) { $IO += 128; }
if ($luck == 1) { $IO += 4; }
$new_serial = itemSerial(8);
if(isset($_POST['op1'])){$opt1 = 1;}else{$opt1=0;}
if(isset($_POST['op2'])){$opt2 = 2;}else{$opt2=0;}
if(isset($_POST['op3'])){$opt3 = 4;}else{$opt3=0;}
if(isset($_POST['op4'])){$opt4 = 8;}else{$opt4=0;}
if(isset($_POST['op5'])){$opt5 = 16;}else{$opt5=0;}
if(isset($_POST['op6'])){$opt6 = 32;}else{$opt6=0;}
$EO += $opt1+$opt2+$opt3+$opt4+$opt5+$opt6;

	$item_conf = season();
	if($item_conf[0] === 20){
		$hex1  = sprintf("%02X%02X%02X%08s%02X%04s",$item_id,$IO,$dur,$new_serial,$EO,0000);
	}
	else{
		$FF = sprintf("%02X", $type);
		$hex1  = sprintf("%02X%02X%02X%08s%02X%04s",$item_ids,$IO,$dur,$new_serial,$EO,0000);
	}
	$new_warehouse = str_repeat("F",$item_conf[1]);

 

$checkitem = mssql_fetch_array(mssql_query("Select count(*) as count from [warehouse] where [accountid] = '".$account."'"));
if($checkitem['count'] == 0){
	$update_empty = mssql_query('Insert into [warehouse] ([AccountID],[Items],[Money]) Values("'.$_POST['mu_account'].'",0x'.$new_warehouse.',"0")');
    echo "<script>alert('This user did not have a warehouse and it was created. Now you can add items!');</script>";
}
else{
	$vault = mssql_fetch_array(mssql_query("Select [items] from [warehouse] where [accountid] = '".$account."'"));
	$vault['items'] = strtoupper(bin2hex($vault['items']));
	$item_new = vault_insert($vault['items'],$hex1,$item_names);
	if ($item_new != 'Error') {	
	$data_enc = json_encode(array($account,$hex1));
	$update_vault= mssql_query("Update [warehouse] set [items]=0x".$item_new." where [accountid]='".$_POST['mu_account']."'");
	mssql_query("Insert into [DTweb_GM_Modules_Logs] ([module], [date], [gm_name], [ip],[data] ) values ('ItemAdder', '".time()."', '".$logged."', '".ip2long(ip())."','".$data_enc."')");
	  refresh();
	  } 
	}
  }
}		
	else{
		 echo " 
			      <div style='width:290px'>			  
			        <table width=280 cellpadding='6' align='left' border='1' >
			           <tr class='title'>
					   <tr><td class='title'>Account</td><td><a href='?p=accountedit&account=".$account."'>".$account."</a></td></tr>
			           <tr><td class='title'>Character</td><td>".$char_name."</td></tr>
					   <tr><td class='title'>Credits</td><td>".$acc_cr['credits']."</td></tr>
					   <tr><td class='title'>Resources</td><td>".$acc_resources."</td></tr>
					   <tr><td class='title'>Zen</td><td>".$acc_zen['zen']."</td></tr>
				       <tr><td class='title'>E-mail</td><td align=left>".$memb_info['mail_addr']."</td></tr>
                       ".$td1."
                       <tr><td class='title'>Last game login</td><td align=left>".$memb_info['out__days']."</td></tr>
					   <tr><td class='title'>Last game login IP</td> <td align=left>".$memb_stat['IP']."</td></tr>
					   <tr><td class='title'>Last web login</td><td align=left>".$web_info_date."</td></tr>
					   <tr><td class='title'>Last web login IP</td>   <td align=left>".$web_info_ip ."</td></tr>  
					</table>
				</div>";
			}
				if($admins_level >= 2) { 
    				echo gm_warehouse($account,$admins_level);               					
				}							
		} 

////////////////////////		
// Rendering Character//********************************************************************************************************
////// Inventory ///////
//////////////////////// 	
	  
if(isset($_GET['character'])){
	        $character     = strip($_GET['character']);	
           	$char_info     = mssql_fetch_array(mssql_query("Select Life,Mana,QuestNumber, Money,PkCount,GrandResets,AccountID,Name,MapNumber,MapPosX,MapPosY,LevelUpPoint,Resets,Dexterity,Strength,Vitality,Energy,IsVip, cLevel,Class,hof_wins,VipExpirationTime,Ctlcode from Character where name = '".$character."'"));
			$all_chars     = mssql_query("Select Name from Character where accountid = '".$char_info['Name']."'");
			$status        = mssql_fetch_array(mssql_query("Select ConnectStat from MEMB_STAT where memb___id='".$char_info['AccountID']."'"));		
			$char_name     = null;
			$acc_cr        = null;
			$acc_resources = null;
			$acc_zen       = null;
            switch($status[0]){
            case 1: $statusa = 'Online'; break;	
            case 0: $statusa = 'Offline'; break;
            }
			switch($char_info['MapNumber']){
				case 0: $sel_map0 = 'selected'; break;
				case 1: $sel_map1 = 'selected'; break;
				case 2: $sel_map2 = 'selected'; break;
				case 3: $sel_map3 = 'selected'; break;
				case 4: $sel_map4 = 'selected'; break;
				case 6: $sel_map6 = 'selected'; break;
				case 7: $sel_map7 = 'selected'; break;
				case 8: $sel_map8 = 'selected'; break;
				case 9: $sel_map9 = 'selected'; break;
				case 10: $sel_map10 = 'selected'; break;
				case 11: $sel_map11 = 'selected'; break;
				case 12: $sel_map12 = 'selected'; break;
				case 13: $sel_map13 = 'selected'; break;
				case 14: $sel_map14 = 'selected'; break;
				case 15: $sel_map15 = 'selected'; break;
				case 16: $sel_map16 = 'selected'; break;
				case 17: $sel_map17 = 'selected'; break;
				case 18: $sel_map18 = 'selected'; break;
				case 19: $sel_map19 = 'selected'; break;
				case 20: $sel_map20 = 'selected'; break;
				case 21: $sel_map21 = 'selected'; break;
				case 22: $sel_map22 = 'selected'; break;
				case 23: $sel_map23 = 'selected'; break;
				case 24: $sel_map24 = 'selected'; break;
				case 55: $sel_map25 = 'selected'; break;
				case 31: $sel_map26 = 'selected'; break;
			}
			switch($char_info['Class']){
				case 1:  $sel_class1  = 'selected'; break;
				case 16: $sel_class2  = 'selected'; break;
				case 17: $sel_class3  = 'selected'; break;
				case 33: $sel_class4  = 'selected'; break;
				case 48: $sel_class5  = 'selected'; break;
				case 64: $sel_class6  = 'selected'; break;
				
			}
			switch ($char_info['IsVip']){
				case 1: $date = server_time($char_info['VipExpirationTime']); $is_vip = "VIP until:". $date; $insert = 0; break;
				case 0: $is_vip = 'Not VIP member'; $insert = 1; break;
			}
			switch($char_info['Ctlcode']){
				case 0: $gmstatus = 'Not GM';$gm_select0 = 'selected'; break;
				case 8: case 32:$gmstatus = 'GM';$gm_select1 = 'selected';break;
			}
			if($admins_level >= 2){
				
    				$trs = "<td rowspan='50'>".equipment($character) ."</td>";               		                       
			}
			
// Rendering Admin Character 			
			 if($admins_level == 10)
            { 

//Character Admin Edit Form
			    echo " 
                
				 <form class='form' method = 'post'>
				    <input type='submit' value='Save' name='save_char'/>
			        <table width='100%' border='1' style='border:1px solid #804526;line-height:20px;font-size:10pt;padding:15px 5px;'>  					         
							 <tr><td style='text-align:right' class='title'>Account</td>            <td align='left'style='padding:5px 5px;'><a href='?p=accountedit&account=".$char_info['AccountID']."'>".$char_info['AccountID']."</a></td><td rowspan='100'>&nbsp&nbsp&nbsp</td>".$trs."</tr>
			                 <tr><td style='text-align:right' class='title'>Status</td>             <td align='left'style='padding:5px 5px;'>".$statusa."</td></tr>
							 <tr><td style='text-align:right' class='title'>Character</td>         <td align='left'style='padding:5px 5px;'>". $character."</td></tr>
					         <tr><td style='text-align:right' class='title'>GM Rank</td>         <td align='left'style='padding:5px 5px;'>
							     <select name='gm'>								
									 <option ".$gm_select0." value='0'>Not GM</option>
							         <option ".$gm_select1." value='8'>GM</option>
							     </select>
							 </td></tr>
							 <tr><td style='text-align:right' class='title'>Grand Resets</td>       <td align='left'style='padding:5px 5px;'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='grand_resets' type='text' value='".$char_info['GrandResets']."' /></td></tr>
					         <tr><td style='text-align:right' class='title'>Resets</td>             <td align='left'style='padding:5px 5px;'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='resets'       type='text' value='".$char_info['Resets']."' /></td></tr>
					         <tr><td style='text-align:right' class='title'>Levels</td>             <td align='left'style='padding:5px 5px;'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='clevel'       type='text' value='".$char_info['cLevel']."' /></td></tr>
					         <tr><td style='text-align:right' class='title'>Class</td>              <td align='left'style='padding:5px 5px;'>
							 <select name='classa'>
								<option ".$sel_class1." value='1'>SM</option>
								<option ".$sel_class2." value='16'>DK</option>
								<option ".$sel_class3." value='17'>BK</option>
								<option ".$sel_class4." value='33'>ME</option>
								<option ".$sel_class5." value='48'>MG</option>
								<option ".$sel_class6." value='64'>DL</option>

							 </select>
							 </td></tr>
					         <tr><td style='text-align:right' class='title'>Location</td>           <td align='left'style='padding:5px 5px;'>
							 <select name='map_select'>

							     <option ".$sel_map0." value='0'>Lorencia </option>
                                 <option ".$sel_map1." value='1'>Dungeon</option>
                                 <option ".$sel_map2." value='2'>Davias</option>
                                 <option ".$sel_map3." value='3'>Noria</option>
                                 <option ".$sel_map4." value='4'>Lost Tower</option>
                                 <option ".$sel_map6." value='6'>Arena</option>
                                 <option ".$sel_map7." value='7'>Atlans</option>
                                 <option ".$sel_map8." value='8'>Tarkan</option>
                                 <option ".$sel_map9." value='9'>Devil Square</option>
                                 <option ".$sel_map10." value='10'>Icarus</option>
                                 <option ".$sel_map11." value='11'>Blood castle 1</option>
							     <option ".$sel_map12." value='12'>Blood castle 2</option>
							     <option ".$sel_map13." value='13'>Blood castle 3</option>
							     <option ".$sel_map14." value='14'>Blood castle 4</option>
								 <option ".$sel_map15." value='15'>Blood castle 5</option>
								 <option ".$sel_map16." value='16'>Blood castle 6</option>
								 <option ".$sel_map17." value='17'>Blood castle 7</option>
								 <option ".$sel_map18." value='18'>Chaos castle 1</option>
								 <option ".$sel_map19." value='19'>Chaos castle 2</option>
								 <option ".$sel_map20." value='20'>Chaos castle 3</option>
								 <option ".$sel_map21." value='21'>Chaos castle 4</option>
								 <option ".$sel_map22." value='22'>Chaos castle 5</option>
								 <option ".$sel_map23." value='23'>Chaos castle 6</option>
								 <option ".$sel_map24." value='24'>Kalima</option>
								 <option ".$sel_map25." value='55'>Valery Of Loren</option>
								 <option ".$sel_map26." value='31'>Land of Trial</option>
							   </select>	
							 </br>
							 <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='map_x' value='".$char_info['MapPosX']."' type='text'/>
						   X <input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='map_y' value='".$char_info['MapPosY']."' type='text' /></td></tr>

					         <tr><td style='text-align:right' class='title'>VIP</td>                <td align='left'style='padding:5px 5px;'>
							    <select name='vip'>
							       <option disabled selected value='1'>".$is_vip."</option>
							       <option value='+1 day'> +1 Day</option>
							       <option value='+3 day'> +3 Days</option>
							       <option value='+7 day'> +7 Days</option>
							       <option value='+2 weeks'> +14 Days</option>
							       <option value='+1 month'> +30 Days</option>
							  	   <option value='+3 months'> +60 Days</option>
							  	   <option value='+6 months'> +120 Days</option>
							  	   <option value='+1 year'> +365 Days</option>
							    </select>
							 </td></tr>
					         <tr><td style='text-align:right' class='title'>Strenght</td>           <td align='left'style='padding:5px 5px;'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='strenght' type='text' value='".$char_info['Strength']."' /></td></tr>
					         <tr><td style='text-align:right' class='title'>Agility</td>            <td align='left'style='padding:5px 5px;'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='dexterity' type='text' value='".$char_info['Dexterity']."' /></td></tr>
					         <tr><td style='text-align:right' class='title'>Vitality</td>           <td align='left'style='padding:5px 5px;'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='vitality' type='text' value='".$char_info['Vitality']."' /></td></tr>
					         <tr><td style='text-align:right' class='title'>Energy</td>             <td align='left'style='padding:5px 5px;'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='energy' type='text' value='".$char_info['Energy']."' /></td></tr>
					         <tr><td style='text-align:right' class='title'>Zen</td>                <td align='left'style='padding:5px 5px;'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='money' type='text' value='".$char_info['Money']."' /></td></tr>
					         <tr><td style='text-align:right' class='title'>Life</td>               <td align='left'style='padding:5px 5px;'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='life' type='text' value='".$char_info['Life']."' /></td></tr>
					         <tr><td style='text-align:right' class='title'>Mana</td>               <td align='left'style='padding:5px 5px;'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='mana' type='text' value='".$char_info['Mana']."' /></td></tr>
					         <tr><td style='text-align:right' class='title'>Points</td>             <td align='left'style='padding:5px 5px;'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='levelup' type='text' value='".$char_info['LevelUpPoint']."' /></td></tr>
					         <tr><td style='text-align:right' class='title'>Quest Nr</td>           <td align='left'style='padding:5px 5px;'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='quest_nr' type='text' value='".$char_info['QuestNumber']."' /></td></tr>			
				           	<tr><td style='text-align:right' class='title'>HOF Wins</td>        <td align='left'style='padding:5px 5px;'><input onkeypress='return event.charCode >= 48 && event.charCode <= 57' style='color:white;padding:5px 5px;width:80px;height:20px' name='hof_wins' type='text' value='".$char_info['hof_wins']."' /></td></tr>	   
						</table></form>";	
				
			    if(isset($_POST['save_char'])){			          	
					mssql_query("Update Character set 
					Resets       = '".clean_post($_POST['resets'])."',
                    Clevel       = '".clean_post($_POST['clevel'])."', 
                    Class        = '".clean_post($_POST['classa'])."', 
                    Life         = '".clean_post($_POST['life'])."', 
					CtlCode      = '".clean_post($_POST['gm'])."',
  					Mana         = '".clean_post($_POST['mana'])."',              
                    QuestNumber  = '".clean_post($_POST['quest_nr'])."', 
                    Money        = '".clean_post($_POST['money'])."',  
 					GrandResets  = '".clean_post($_POST['grand_resets'])."',                 
                    MapNumber    = '".clean_post($_POST['map_select'])."', 
                    MapPosX      = '".clean_post($_POST['map_x'])."', 
                    MapPosY      = '".clean_post($_POST['map_y'])."', 
					LevelUpPoint = '".clean_post($_POST['levelup'])."', 
					Dexterity    = '".clean_post($_POST['dexterity'])."', 
					Strength     = '".clean_post($_POST['strenght'])."', 
					Vitality     = '".clean_post($_POST['vitality'])."', 
					hof_wins     = '".clean_post($_POST['hof_wins'])."', 
					Energy       = '".clean_post($_POST['energy'])."'
					where name='".$character."'");
					
					if(isset($_POST['vip'])){
						switch($insert){
							case 1: mssql_query("Update Character set IsVip = 1, VipExpirationTime = '". strtotime(''.clean_post($_POST['vip']).'', time())."' where name='".$character."'"); break;
						    case 0: $new_time = strtotime("".clean_post($_POST['vip'])."",$char_info['VipExpirationTime']);mssql_query("Update Character set VipExpirationTime = '".$new_time."' where name='".$character."'"); break;
						}
					  refresh();
					}
					refresh();
			     }	
			}
				
				else {
				echo "
			        <table style='line-height:20px;font-size:10pt;padding:15px 5px;'border='1'>  
					         <tr><td style='text-align:right' class='title'>Account</td>             <td align='left'style='padding:5px 5px;'><a href='?p=accountedit&account=".$char_info['AccountID']."'>".$char_info['AccountID']."</a></td>".$trs."</tr>
			                 <tr><td style='text-align:right' class='title'>Characters</td>              <td align='left'style='padding:5px 5px;'>". $character."</td></tr>
					         <tr><td style='text-align:right' class='title'>Grand Resets</td>       <td align='left'style='padding:5px 5px;'>".$char_info['GrandResets']."</td></tr>
					         <tr><td style='text-align:right' class='title'>Resets</td>             <td align='left'style='padding:5px 5px;'>".$char_info['Resets']."</td></tr>
					         <tr><td style='text-align:right' class='title'>Levels</td>               <td align='left'style='padding:5px 5px;'>".$char_info['cLevel']."</td></tr>
					         <tr><td style='text-align:right' class='title'>Class</td>               <td align='left'style='padding:5px 5px;'>".char_class($char_info['Class'])."</td></tr>
					         <tr><td style='text-align:right' class='title'>Location</td>     <td align='left'style='padding:5px 5px;'>".de_map($char_info['MapNumber'])." - ".$char_info['MapPosX']." - ".$char_info['MapPosY']."</td></tr>
					         <tr><td style='text-align:right' class='title'>Kills</td>           <td align='left'style='padding:5px 5px;'>".de_kills($char_info['PkCount'])."</td></tr>
					         <tr><td style='text-align:right' class='title'>VIP</td>                <td align='left'style='padding:5px 5px;'>".$is_vip."</td></tr>
					         <tr><td style='text-align:right' class='title'>Strenght</td>           <td align='left'style='padding:5px 5px;'>".$char_info['Strength']."</td></tr>
					         <tr><td style='text-align:right' class='title'>Agility</td>            <td align='left'style='padding:5px 5px;'>".$char_info['Dexterity']."</td></tr>
					         <tr><td style='text-align:right' class='title'>Vitality</td>           <td align='left'style='padding:5px 5px;'>".$char_info['Vitality']."</td></tr>
					         <tr><td style='text-align:right' class='title'>Energy</td>             <td align='left'style='padding:5px 5px;'>".$char_info['Energy']."</td></tr>
					         <tr><td style='text-align:right' class='title'>Zen</td>                <td align='left'style='padding:5px 5px;'>".$char_info['Money']."</td></tr>
					         <tr><td style='text-align:right' class='title'>Life</td>              <td align='left'style='padding:5px 5px;'>".$char_info['Life']."</td></tr>
					         <tr><td style='text-align:right' class='title'>Mana</td>               <td align='left'style='padding:5px 5px;'>".$char_info['Mana']."</td></tr>
					         <tr><td style='text-align:right' class='title'>Points</td>              <td align='left'style='padding:5px 5px;'>".$char_info['LevelUpPoint']."</td></tr>
					         <tr><td style='text-align:right' class='title'>Quest Nr</td>        <td align='left'style='padding:5px 5px;'>".$char_info['QuestNumber']."</td></tr>

					         <tr><td style='text-align:right' class='title'>Status</td>      <td align='left'style='padding:5px 5px;'>".$status['ConnectStat']."</td></tr>							             
						</table>";	
				}
            } 

        }
else{
	header ("Location:?p=home");
}
   
	 
}
  
   ?>
   </div>

<style>
.editbox{
	width:55px;
	font-size:11px;
}
	input[type=checkbox]:checked
{
	background:#d54a11;
}
	input[type=checkbox]:not(:checked)
{
	background:#180700;
}

.real{
	margin-top:250px;
}
</style>
