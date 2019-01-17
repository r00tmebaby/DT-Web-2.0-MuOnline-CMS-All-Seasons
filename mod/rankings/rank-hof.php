<?php

include("configs/config.php");
include("mod/rankings/rank_menu.php");
$set = web_settings();

$pag  = (isset($_GET['page']) &&  $_GET['page'] > 0) ? (int)$_GET['page'] : 1;
$page  = (int)($pag);

   if($set[12] > 0 ){
        $selecta = $set[12] * $set[13];
         $count = mssql_num_rows(mssql_query("Select TOP ". $selecta ." * from Character where CtlCode= 0"));	   
   }
   else{
         $count = mssql_num_rows(mssql_query("Select * from Character where CtlCode= 0"));	
   }
   
   $max_pages  = ceil($count/$set[13]);
   $offset     = ($set[13]) * ($page - 1); 
   $select     = mssql_query(pagination($offset, $set[13], '[Name],[cLevel],[hof_wins],[Class],[AccountID],[Resets],[MapNumber],[MarryName],[CtlCode],[IsMarried],[Money]', 'Character', 'hof_wins desc, resets desc,cLevel desc' ,'name','CtlCode = 0 and hof_wins > 0'));  
   pagi_style("hof",$max_pages,$set[13]);
   

?>

<table class='table'>
	<tbody>
	<tr class="title">
		<td><?php echo phrase_id?></td>
		<td><?php echo phrase_name?></td>
		<td><?php echo phrase_class?></td>
	    <td><?php echo  phrase_resets . phrase_level  ?></td>	
		<td><?php echo phrase_guild?></td>
		<td><?php echo phrase_location?></td>
		<td><?php echo phrase_hof_wins?></td>
	</tr>
<?php
        $i = 0;
		while($row = mssql_fetch_array($select)):
		    $i++;			
            $rank =$i+$offset;	
			$char_class = char_class($row['Class']);
			$check_guild  = mssql_fetch_array(mssql_query("Select * from [GuildMember] where [name] = '".$row['Name']."'"));
			$mark         = mssql_fetch_array(mssql_query("Select [g_name],[g_mark] from [Guild] where [g_name]='{$check_guild['G_Name']}'"));

		    if($row['hof_wins'] >=5){$hof = '<img width="15px" src= "imgs/hof/5.png"/>';}
			elseif($row['hof_wins'] == 4){$hof = '<img width="15px" src= "imgs/hof/4.png"/>';}
			elseif($row['hof_wins'] == 3){$hof = '<img width="15px" src= "imgs/hof/3.png"/>';}
			elseif($row['hof_wins'] == 2){$hof = '<img width="15px" src= "imgs/hof/2.png"/>';}
			elseif($row['hof_wins'] == 1){$hof = '<img width="15px" src= "imgs/hof/1.png"/>';}
			else{$hof= "";}
			if($mark['g_name'] <> NULL){
				$show_mark = "<a href='?p=topguilds&guild=".$mark['g_name']."'>".$mark['g_name']."</a>";
			}
			else{
				$show_mark = "-";
			}
	?>
	<tr>
		<td>
			<?php echo $rank; ?>
		</td>
		<td width="120px">
			<a href="?p=user&character=<?php echo $row['Name'] ?>"><?php echo $hof ." \n" . $row['Name']; ?></a>
		</td>
		<td>
			<?php echo $char_class; ?>
		</td>
		<td>
			<span class='text-danger'><?php echo "[" . $row['Resets']."]</span><span class='text-info'>[".$row['cLevel'] ."]"; ?></span>
		</td>

		<td style="text-align:center;">
			<?php echo $show_mark?>
		<td>
			<?php echo de_map($row['MapNumber']); ?>
		</td>
		<td>
			<?php echo $row['hof_wins']; ?>
		</td>
	</tr>

<?php endwhile; 

echo "</table>";

pagi_style("hof",$max_pages,$set[13]);


?>

