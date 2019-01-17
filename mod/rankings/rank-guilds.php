<?php

include("mod/rankings/rank_menu.php");
include("configs/config.php");

$set = web_settings();
   if(isset($_GET['guild'])){
$name = addslashes(urldecode($_GET['guild']));
$r = mssql_fetch_array(mssql_query("Select G_Name,G_Mark,G_Score,G_Master,G_Count,Resets From [Guild] Where [G_Name]='{$name}'"));
$r1 = mssql_fetch_array(mssql_query("Select G_Name from GuildMember where G_Name='{$name}'")); 
if (!$r['G_Name'] || !$r1['G_Name']) {
    echo("This guild was not found.");
} else {
    
?>

    <center><table width="250" border="1" style="border:1px solid #94350b"style="padding:5px 5px" >
        <tr >
            <td colspan="2" align='center'>
			   <div style="padding:10px 10px;"><?php echo GuildMark(bin2hex($r['G_Mark']), 200);?></div>
            </td>
        </tr>
        <tr >
            <td style="padding:5px 5px"   align="left" >NAME:</td>
            <td style="padding:5px 5px"   align="left"><b><?php echo $r['G_Name']; ?></td>
        </tr>   
        <tr >   
            <td style="padding:5px 5px"  align="left">POINTS</td>
            <td style="padding:5px 5px"  align="left"><?php echo (int) $r['G_Score']; ?></td>
        </tr>  
        <tr>   
            <td style="padding:5px 5px"  align="left">MASTER</td>
            <td style="padding:5px 5px"  align="left" ><a href="?p=user&character=<?php echo $r['G_Master']; ?>"><?php echo $r['G_Master']; ?></a></td>
        </tr>  
		<tr>   
            <td style="padding:5px 5px"  align="left">TOTAL RESETS</td>
            <td style="padding:5px 5px"  align="left" ><?php echo guild_res($r['G_Name']); ?></td>
        </tr>
    </table></center>


    <table class="table"  cellpadding="3" border="1"  align='center'>       
<tr><td colspan="200">
<div class="top_rank " style="text-align:center">Guild Info</div></div></tr>
        <tr class="title">
            <td  align="center" width="50">NR</td>
            <td align="center">Name</td>
			 <td align="center">Class</td>
            <td align="center">Level [Resets]</td>
			 <td align="center">Location</td>
            <td  align="center">Guild Rank</td>
            <td align="center">Status</td>
        </tr>
        <?php
$gq = mssql_query("Select G_Status,Name,G_Level,Resets from GuildMember where G_Name='".$r['G_Name']."' order by G_Status desc, resets desc");
 $i=0;
        while ($g = mssql_fetch_array($gq)) {
            $i++;

            if (mssql_num_rows(mssql_query("Select [GameIDC] From [MEMB_STAT], [AccountCharacter] Where [MEMB_STAT].[ConnectStat]=1 and [MEMB_STAT].[memb___id]=[AccountCharacter].[Id] and [AccountCharacter].[GameIDC]='{$g['Name']}'")) == 1) {
                $status = "Online";
            } else {
                $status = "Offline";
            }
            
            switch ($g['G_Status']) {
                case 128:
                    $gstatus = "<span style='color:#FF0000'> Guild Master</span>";
                    break;
                case 64:
                    $gstatus = "<span style='color:#990033'>Assistant Master</span>";
                    break;
                case 32:
                    $gstatus = "<span style='color:#FFCC33'>Battle Master</span>";
                    break;
                default:
                    $gstatus = "<span style='color:#99FF99'>Member</span>";
                    break;
            }
           $dets = mssql_fetch_array(mssql_query("Select * from Character where Name='".$g['Name']."'"));
            echo "<tr class='niki'>
                      <td align=center align=center >{$i}</td>
                      <td align=center   ><a href=\"?p=user&character={$g['Name']}\">{$g['Name']}</a></td>
	  	              <td align=center   >".char_class($dets['Class'])."</td>
                      <td align=center  align=center >{$dets['cLevel']}[{$dets['Resets']}]</td>
	                  <td align=center   >".de_map($dets['MapNumber'])."</td>
                      <td align=center width=\"140\">{$gstatus}</td>
                     <td align=center align=center >{$status}</td>
                  </tr>";
        }
      echo "
    </table>";
}


   }
   else{
   $page  = (isset($_GET['page']) &&  $_GET['page'] > 0) ? (int)$_GET['page'] : 1;
   if($set[14] > 0 ){
        $selecta = $set[14] * $set[15];
         $count = mssql_num_rows(mssql_query("Select TOP ". $selecta ." * from Guild"));	   
   }
   else{
         $count = mssql_num_rows(mssql_query("Select * from Guild"));	
   }
   
   $max_pages  = ceil($count/$set[15]);
   $offset     = ($set[15]) * ($page-1); 
   $select = mssql_query(pagination($offset, $set[15], '[G_Mark],[G_Name],[G_Master],[G_Score]', 'Guild', 'G_Score desc' ,'G_Score'));
   pagi_style("topguilds",$max_pages,$set[15]);

echo "

<table class='table'>
	<tbody>
	<tr class='titl'>
		<td>".phrase_id."</td>
		<td>".phrase_name."</td>
		<td>".phrase_master."</td>
		<td>".phrase_score."</td>
		<td>".phrase_members."</td>
		<td>".phrase_resets."</td>
	</tr>
";

		$i = 0;
		while($row = mssql_fetch_array($select)):
        $total_players  = mssql_num_rows(mssql_query("Select * from GuildMember where G_Name='".$row['G_Name']."'"));
        $logo           = urlencode(bin2hex($row['G_Mark']));
		$i++;
					if($row['G_Name'] <> NULL){
				$show_mark = "<a href='?p=topguilds&guild=".$row['G_Name']."'>".$row['G_Name']."</a>";
			}
			else{
				$show_mark = "-";
			}
	?>
	<tr>
		<td>
			<?php echo $i; ?>
		</td>
		<td >
			<div style="display:inline-block;"><?php echo $show_mark ?></div>
		</td>
		<td>
			<?php echo $row['G_Master']; ?>
		</td>
		<td>
			<?php echo $row['G_Score']; ?>
		</td>
		<td>
			<?php echo $total_players; ?>
		</td>
		<td>
			<?php echo guild_res($row['G_Name']); ?>
		</td>
	</tr>
	<?php endwhile; ?>
	</tbody>
</table>

<?php 
pagi_style("topguilds",$max_pages,$set[15]);
   }
?>