<?php
include("mod/rankings/rank_menu.php");
$set = web_settings();
$page  = (isset($_GET['page']) &&  $_GET['page'] > 0) ? (int)$_GET['page'] : 1;
   if($set[16] > 0 ){
        $selecta = $set[16] * $set[17];
         $count = mssql_num_rows(mssql_query("Select TOP ". $selecta ." * from Character where PkCount > 0 and CtlCode = 0"));	   
   }
   else{
         $count = mssql_num_rows(mssql_query("Select * from Character where PkCount > 0 and CtlCode = 0"));	
   }
   
   $max_pages  = ceil($count/$set[17]);
   $offset     = ($set[17]) * ($page-1); 
   $select = mssql_query(pagination($offset, $set[17], '[Name],[cLevel],[Class],[AccountID],[Resets],[MapNumber],[MarryName],[CtlCode],[IsMarried],[Money],[PkCount]', 'Character', 'PkCount desc, pklevel desc' ,'PkCount','PkCount > 0 and CtlCode = 0'));
   pagi_style("topkillers",$max_pages,$set[17]);
  ?>
   

<table class='table'>
	<tbody>
	<tr class="title">
		<td><?php echo phrase_id?></td>
		<td><?php echo phrase_name?></td>
		<td><?php echo phrase_class?></td>
		<td><?php echo phrase_kills?></td>
		<td><?php echo phrase_pklevel?></td>
		<td><?php echo phrase_guild?></td>
		<td><?php echo phrase_location?></td>
	</tr>
	<?php
	include("configs/config.php");
	
		$i = 0;
		while($row = mssql_fetch_array($select)):
			$char_class = char_class($row['Class']);
			$pk_level = pk_level($row['PkLevel']);
			$i++;
		$mark  = mssql_fetch_array(mssql_query("Select G_Name from [GuildMember] where [Name] = '".$row['Name']."'"));
			$select_ip = mssql_fetch_array(mssql_query("Select * from [MEMB_STAT] where [memb___id] = '".$row['AccountID']."'"));

		if(strtolower(geoip_country_code_by_addr(geo_data(), $select_ip['IP'])) <> NULL){
			$flags = "<img width='20px' height='15px'src='http://flags.fmcdn.net/data/flags/normal/". strtolower(geoip_country_code_by_addr(geo_data(), $select_ip['IP'])).".png'/> ";
		}
		else{
			$flags = "";
		}
	?>
	<tr>
		<td>
			<?php echo $i; ?>
		</td>
		<td>
					<?php echo $flags ?>	<a href="?p=user&character=<?php echo $row['Name'] ?>"><?php echo $row['Name']; ?></a>
		</td>
		<td>
			<?php echo $char_class; ?>
		</td>
		<td>
			<?php echo $row['PkCount']; ?>
		</td>
		<td>
			<?php echo $pk_level; ?>
		</td>
						<td>
			<a href='?p=topguilds&guild=<?php echo $mark['G_Name']?>'><?php echo $mark['G_Name']?></a>
		</td>
				<td>
			<?php echo de_map($row['MapNumber']); ?>
		</td>
		
	</tr>
	<?php endwhile; ?>
	</tbody>
</table>

<?php
pagi_style("topkillers",$max_pages,$set[17]);
?>