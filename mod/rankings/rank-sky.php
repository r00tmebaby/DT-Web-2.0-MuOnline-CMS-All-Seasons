<?php

include("configs/config.php");
include("mod/rankings/rank_menu.php");
$set = web_settings();

$pag  = (isset($_GET['page']) &&  $_GET['page'] > 0) ? (int)$_GET['page'] : 1;
$page  = (int)($pag);

   if($set[12] > 0 ){
        $selecta = $set[12] * $set[13];
         $count = mssql_num_rows(mssql_query("Select TOP ". $selecta ." * from Character where CtlCode= 0 and SkyEventWins > 0"));	   
   }
   else{
         $count = mssql_num_rows(mssql_query("Select * from Character where CtlCode= 0 and SkyEventWins > 0"));	
   }
   
   $max_pages  = ceil($count/$set[13]);
   $offset     = ($set[13]) * ($page - 1); 
   $select     = mssql_query(pagination($offset, $set[13], '[Name],[cLevel],[Class],[AccountID],[Resets],[MapNumber],[MarryName],[CtlCode],[SkyEventWins],[IsMarried],[Money],[QuestNumber]', 'Character', 'SkyEventWins desc, resets desc, cLevel desc' ,'name','CtlCode = 0 and SkyEventWins > 0'));  
   pagi_style("topsky",$max_pages,$set[13]);
  

?>

<table class='table'>
	<tbody>
	<tr class="title">
		<td><?php echo phrase_id?></td>
		<td><?php echo phrase_name?></td>
		<td><?php echo phrase_class?></td>
		<td><?php echo phrase_level?></td>
		<td><?php echo phrase_resets?></td>
		<td><?php echo phrase_location?></td>
		<td><?php echo phrase_wins?></td>
	</tr>
<?php
        $i = 0;
		while($row = mssql_fetch_array($select)):
		    $i++;			
            $rank =$i+$offset;		
			$select_ip = mssql_fetch_array(mssql_query("Select * from [MEMB_STAT] where [memb___id] = '".$row['AccountID']."'"));
			$char_class = char_class($row['Class']);
		if(strtolower(geoip_country_code_by_addr(geo_data(), $select_ip['IP'])) <> NULL){
			$flags = "<img width='20px' height='15px'src='http://flags.fmcdn.net/data/flags/normal/". strtolower(geoip_country_code_by_addr(geo_data(), $select_ip['IP'])).".png'/> ";
		}
		else{
			$flags = "";
		}
	?>
	<tr>
		<td>
			<?php echo $rank; ?>
		</td>
		<td>
			
		<?php echo $flags ?>	<a href="?p=user&character=<?php echo $row['Name'] ?>"><?php echo $row['Name']; ?></a>
		</td>
		<td>
			<?php echo $char_class; ?>
		</td>
		<td>
			<?php echo $row['cLevel']; ?>
		</td>
		<td>
			<?php echo $row['Resets']; ?>
		</td>
		<td>
			<?php echo de_map($row['MapNumber']); ?>
		</td>
				<td>
			<?php echo ($row['SkyEventWins']); ?>
		</td>
	</tr>

<?php endwhile; 

echo "</table>";

pagi_style("topsky",$max_pages,$set[13]);


?>

