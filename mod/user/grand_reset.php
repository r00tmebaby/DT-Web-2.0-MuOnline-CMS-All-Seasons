<?php

if(isset($_POST['greset']))
{
	$store = do_grand_reset();
	show_messages($store);
}
?>

<form  name="<?php echo form_enc()?>" class="form" action="?p=grandreset" method="post">
	<ul >
		<li>
			<span><?php echo phrase_character ?>: </span>
			<select name="character" id="character">
				<option value="">-</option>
				<?php
					$query = mssql_query("SELECT TOP 10 * FROM Character WHERE AccountID='" . $_SESSION['dt_username'] . "' ORDER BY GrandResets DESC, Resets DESC, cLevel DESC");

					while($row = mssql_fetch_array($query)):
				?>
				<option value="<?php echo $row['Name']; ?>"> <?php echo $row['Name']; ?>: [<?php echo $row['cLevel']; ?>][<?php echo $row['Resets']; ?>]</option>
				<?php endwhile; ?>
			</select>
			<input  class="button" name="greset" type="submit" value="<?php echo phrase_reset_character?>" />
		</li>
	</ul>
</form>
<br />
<table class="table">
	<tbody>
		<tr>
			<td class="tdTitle"><?php echo phrase_cost?></td>
			<td><?php echo number_format($option['gr_zen']); ?> <?php echo phrase_zen?></td>
		</tr>
		<tr>
			<td class="tdTitle"><?php echo phrase_level?></td>
			<td><?php echo $option['gr_level']; ?></td>
		</tr>
		<tr>
			<td class="tdTitle"><?php echo phrase_resets?></td>
			<td><?php echo $option['gr_resets']; ?></td>
		</tr>
		<tr>
			<td class="tdTitle"><?php echo phrase_max_grand_resets?></td>
			<td><?php echo $option['gr_max_resets']; ?></td>
		</tr>
		<tr>
			<td class="tdTitle"><?php echo phrase_rewards?></td>
			<td><?php echo "x". $option['gr_reward'] ."\n" .  $option['gr_reward_name']; ?></td>
		</tr>
	</tbody>
</table>
