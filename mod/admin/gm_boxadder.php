<?php
//////////////////////////////
// GM Box Adder //////////////
//  by r00tme   //////////////
//////////////////////////////
// 05/07/2015   //////////////
////////////////////DT web 2.0 
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{

$error = array();

$gmuser = $_SESSION['dt_username'];
$check_gm = check_admin($gmuser);


if(check_admin($gmuser) !=null){
	$gm_info = check_admin($gmuser);

if ($gm_info[1] < 3){
$check = mssql_num_rows(mssql_query("Select * From [DTweb_GM_Box_Inventory] Where [memb___id]='{$_SESSION['dt_username']}'"));
   if ($check == 0) {
       mssql_query("INSERT INTO [DTweb_GM_Box_Inventory]([memb___id], [box1], [box2], [box3], [box4], [box5],gm_level)
                    VALUES('{$_SESSION['dt_username']}', 0, 0, 0, 0, 0,'".$check_gm[1]."')");
   }

if ((isset($_POST['add_box'])) && (isset($_POST['box'])) && (isset($_POST['count']))) {
    $is_online = mssql_fetch_array(mssql_query("Select connectstat from memb_stat where memb___id ='{$gmuser}'"));
    $requestedItems = (int) $_POST['count'];
	$select = switch_box($_POST['box'], $gmuser);

	if(!isset($_POST['clear_inv']))
	{
        if(empty($requestedItems)){
			$error[] = "<div class='error'>". phrase_box_adder_error ."</div>"; 
		}
		elseif ($is_online['connectstat'] != 0){
		    $error[] = "<div class='error'>". phrase_leave_the_game ."</div>";
		}
		elseif($requestedItems > $select[4]){
			$error[] = "<div class='error'>". phrase_box_adder_error2 .$select[3]. phrase_box_adder_error2_1 ."</div>";
		}
		elseif($requestedItems > $select[5]){
			$error[] = "<div class='error'>". phrase_box_adder_error3 .$select[3]. phrase_box_adder_error3_1 .$option['GM_'.$gm_info[1].'_box'.$select[3].'']. phrase_box_adder_error3_2 .$select[6]."</div>"; 
		} 
        elseif($requestedItems > $option["GM_".$gm_info[1]."_box".$select[3].""]){
			$error[] = "<div class='error'> ". phrase_box_adder_error4 .$option['GM_'.$gm_info[1].'_box'.$select[3].'']."</div>"; 
		}
	    elseif((smartsearch(all_items($_SESSION['dt_username'],2400), 1, 1)) == 1337){
		$error[]= "<div class='error'>". phrase_box_adder_error5 ." <span class='bold'>{$requestedItems}x{$select[1]}</span>". phrase_box_adder_error5_1 ."</div><br/>";
        }
	    else
		{
		 $erris = 1;
		 $m = 0;
		 for($k=0;$k<$requestedItems;$k++){					
					 $slot  = smartsearch(all_items($_SESSION['dt_username'],4400), 1, 1);
					 if($slot <> 1337){
						$test  = $slot * 20; 
						$mynewitems  = substr_replace(all_items($_SESSION['dt_username'],4400), $select[0], ($test), 20);  
                        mssql_query("Update [warehouse] set [Items]=0x" . $mynewitems . " where [AccountId]='".$gmuser."'");					                     
                        $erris = 0;
						$m++;	
					 }				
                   else{
                     	$erris = 1;
                   }    			   
	    }
		 $column = $select[2];
		 $bank = $select[4];
	     if($erris == 0){
			 $update_column = $column . "+". $requestedItems;
			 $update_bank = $bank - $requestedItems;
			 mssql_query("Update DTweb_GM_Box_Adder_Logs set {$column} = {$update_column} where end_date ='".gm_box_timer($gmuser)."'");
		     mssql_query("Update DTweb_GM_Box_Inventory set {$column} = {$update_bank} where memb___id ='".$gmuser."'");
			 echo "<div class='success'>". phrase_box_adder_success ."<span class='bold'>{$requestedItems} x </span><img style='position:absolute;' src='imgs/items/boxes/".$select[3].".gif' style='border:1px solid #000' width='26px'/><span style='margin-left:5px;'>". phrase_box_adder_success2 ."</span></div><br/>";
		 }
		 else{
			 $update_column = $column . "+". $m;
			 $update_bank = $bank - $m;
			 mssql_query("Update DTweb_GM_Box_Adder_Logs set {$column} = {$update_column} where end_date ='".gm_box_timer($gmuser)."'");
		     mssql_query("Update DTweb_GM_Box_Inventory set {$column} = {$update_bank} where memb___id ='".$gmuser."'");		   
		     echo "<div class='success'>". phrase_box_adder_success ."<span class='bold'>{$m} x </span><img style='position:absolute;' src='imgs/items/boxes/".$select[3].".gif' style='border:1px solid #000' width='26px'/><span style='margin-left:5px;'>". phrase_box_adder_success2 ."</span></div><br/>";
	        }
		}
	       if (count($error) > 0)
	          {
                  foreach ($error as $v) 
	          	{
                      echo $v . "<br>";
                  }
              }
    }
	else{
		gm_cl_warehouse($gmuser,$_POST['clear_inv']);
	}
}
$check_box_bank = mssql_query("Select * from [DTweb_GM_Box_Adder_Logs] where account='".$gmuser."' and end_date = '".gm_box_timer($gmuser)."'");
$check_total_bank = mssql_query("Select * from [DTweb_GM_Box_Inventory] where [memb___id]='".$gmuser."'");
$check_box  = mssql_fetch_array(mssql_query("Select * from [DTweb_GM_Box_Adder_Logs] where account='".$gmuser."' and end_date = '".gm_box_timer($gmuser)."'"));
$box1="";$box2="";$box3="";$box4="";$box5="";$bank2="";$bank3="";$bank4="";$bank5="";$bank1="";
                 while($box_output = mssql_fetch_array($check_box_bank)){
          	                        $box1 .=$box_output['box1'];
                                        $box2 .=$box_output['box2'];
					$box3 .=$box_output['box3'];
					$box4 .=$box_output['box4'];
					$box5 .=$box_output['box5'];	
                 }	
		while($bank_output = mssql_fetch_array($check_total_bank)){
          	                        $bank1 .=$bank_output['box1'];
                                        $bank2 .=$bank_output['box2'];
					$bank3 .=$bank_output['box3'];
					$bank4 .=$bank_output['box4'];
					$bank5 .=$bank_output['box5'];
                 }		 
				 
echo"
<center>
<tr> 
		<td>
			<table width='93%'>
				<td class='title' align='center'><h3 class='textmod'>". phrase_box_adder ."</h3></td>
			</table>
		</td>
	</tr>
</br>                                                                                 

<div style='width:500px' class='box_bank'>
		          
	    <div id='tab'text-shadow:1px 1px #fffs;background:#1A1715;padding:10px 10px; margin-bottom:5px;'>
		  <h5>". phrase_hello ."<span style='color:orange;text-shadow:0.4px 0.4px #000; font-height:600;'>".$gmuser."</span>". phrase_box_adder_info2 ."</span></h5>
		  <div style='text-align:center'>
		  ". phrase_box_adder_info ."
		      <img src='imgs/items/box1.gif' width='26px'/> x <span style='color:#FDFDFF;'>".$bank1."</span> 
              <img src='imgs/items/box2.gif' width='26px'/> x <span style='color:#FDFDFF;'>".$bank2."</span> 
              <img src='imgs/items/box3.gif' width='26px'/> x <span style='color:#FDFDFF;'>".$bank3."</span> 
              <img src='imgs/items/box4.gif' width='26px'/> x <span style='color:#FDFDFF;'>".$bank4."</span> 
              <img src='imgs/items/box5.gif' width='26px'/> x <span style='color:#FDFDFF;'>".$bank5."</span>
			  </br></br>
		   </div>
			  </br></br>
       <label style='color:#FF7E00'>". phrase_box_adder_info3 .box_counter($check_box['end_date'])."</label>
           <form class='form'style='width:500px' method='post'>
               <input type='number' min='1' placeholder='Max 120' max='120' style='margin-top:10px;color:#000;padding:5px 5px;width:80px;height:25px' name='count' size='3' maxlength='2' />
                      <select name='box' style='border-radius:2px;height:35px'>
                          <option value='1'>Box of Kundun +1</option>
                          <option value='2'>Box of Kundun +2</option>
                          <option value='3'>Box of Kundun +3</option>
                          <option value='4'>Box of Kundun +4</option>
                          <option value='5'>Box of Kundun +5</option>
                      </select>
                <input type='hidden' value='submited' name='add_box' />
                <input type='submit' style='height:28px' value='". phrase_update ."'/>
       	        <input type='submit' style='height:28px' value='". phrase_clear_inventory ."' name='clear_inv' />
            </form>
          
              <img src='imgs/items/box1.gif'/> x <span style='color:#93FF26'>".$box1."</span> / <span style='color:#EF430E;font-weight:600'>".$option['GM_'.$gm_info[1].'_box1']."</span>
              <img src='imgs/items/box2.gif'/> x <span style='color:#93FF26'>".$box2."</span> / <span style='color:#EF430E;font-weight:600'>".$option['GM_'.$gm_info[1].'_box2']."</span>
              <img src='imgs/items/box3.gif'/> x <span style='color:#93FF26'>".$box3."</span> / <span style='color:#EF430E;font-weight:600'>".$option['GM_'.$gm_info[1].'_box3']."</span>
              <img src='imgs/items/box4.gif'/> x <span style='color:#93FF26'>".$box4."</span> / <span style='color:#EF430E;font-weight:600'>".$option['GM_'.$gm_info[1].'_box4']."</span>
              <img src='imgs/items/box5.gif'/> x <span style='color:#93FF26'>".$box5."</span> / <span style='color:#EF430E;font-weight:600'>".$option['GM_'.$gm_info[1].'_box5']."</span>	
</center>";                                                         
  }
  else{
	  echo "You are the administrator, this module is only for GM's. </br> If you want to see how it works setup your GM level to 2 or 1";
  }
}
else{
	header("Location:?p=home");	
}
}
?>