<?php

include("configs/config.php");
include("mod/rankings/rank_menu.php");
$set = web_settings();

$pag  = (isset($_GET['page']) &&  $_GET['page'] > 0) ? (int)$_GET['page'] : 1;
$page  = (int)($pag);

   if($set[12] > 0 ){
        $selecta = $set[12] * $set[13];
         $count = mssql_num_rows(mssql_query("Select TOP ". $selecta ." * from EVENT_INFO where Point > 0"));	   
   }
   else{
         $count = mssql_num_rows(mssql_query("Select * from EVENT_INFO where Point > 0 "));	
   }
   
   $max_pages  = ceil($count/$set[13]);
   $offset     = ($set[13]) * ($page - 1); 
   $select     = mssql_query(pagination($offset, $set[13], '[CharacterName],[Point]', 'EVENT_INFO', ' Point desc' ,'CharacterName','Point > 0'));  
   pagi_style("topds",$max_pages,$set[13]);
  

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
		<td><?php echo phrase_top_bc_points?></td>
	</tr>
<?php
        $i = 0;
		while($row = mssql_fetch_array($select)):
		    $i++;			
            $rank      = $i+$offset;	
            $rows      = mssql_fetch_array(mssql_query("Select * from Character where Name='".$row['CharacterName']."'"));			
			$select_ip = mssql_fetch_array(mssql_query("Select * from [MEMB_STAT] where [memb___id] = '".$rows['AccountID']."'"));
			
			$char_class = char_class($rows['Class']);
			
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
			
		<?php echo $flags ?>	<a href="?p=user&character=<?php echo $rows['Name'] ?>"><?php echo $rows['Name']; ?></a>
		</td>
		<td>
			<?php echo $char_class; ?>
		</td>
		<td>
			<?php echo $rows['cLevel']; ?>
		</td>
		<td>
			<?php echo $rows['Resets']; ?>
		</td>
		<td>
			<?php echo de_map($rows['MapNumber']); ?>
		</td>

				<td>
			<?php echo ($row['Point']); ?>
		</td>

	</tr>

<?php endwhile; 

echo "</table>";

pagi_style("topds",$max_pages,$set[13]);


?>

