<?php

if(isset($_POST['addstats']))
{
	$store = do_add_stats();
	show_messages($store);
}
$set = web_settings();
$has_dl = 'style="display:none"';
if($set[7] === "99t")
{
	$has_dl = '';
}

?>
<form  name="<?php echo form_enc()?>" class="form" method="post">
	<ul>
		<li>
			<label for="character"><?php echo phrase_character?>: </label>
			<select name="character" id="character">
				<option value="">-</option>
				<?php
					$query = mssql_query("SELECT TOP 10 * FROM Character WHERE AccountID='" . $_SESSION['dt_username'] . "' ORDER BY GrandResets DESC, Resets DESC, cLevel DESC");

					while($row = mssql_fetch_array($query)):
				?>
				<option value="<?php echo $row['Name']; ?>"> <?php echo $row['Name']; ?>: [<?php echo $row['LevelUpPoint']; ?>]</option>
				<?php endwhile; ?>
			</select>
		</li>
		<li>
			<label for="str"><?php echo phrase_strenght?>: </label>
			<input id="str" name="str" type='number' min ="1" max="32767" maxlength="5" />
		</li>
		<li>
			<label for="vit"><?php echo phrase_vitality?>: </label>
			<input id="vit" name="vit" type='number' min ="1" max="32767" maxlength="5" />
		</li>
		<li>
			<label for="agi"><?php echo phrase_agility?>: </label>
			<input id="agi" name="agi" type='number' min ="1" max="32767" maxlength="5" />
		</li>
		<li>
			<label for="ene"><?php echo phrase_energy?>: </label>
			<input id="ene" name="ene" type='number' min ="1" max="32767" maxlength="5" />
		</li>
		<li <?php echo $has_dl; ?>>
			<label for="com"><?php echo phrase_command?>: </label>
			<input id="com" name="com" type='number' min ="1" max="32767" maxlength="5" />
		</li>
		<li class="buttons">
			<input name="addstats" type="submit" onclick="statsadd()" value="<?php echo phrase_add_stats?>" />
			<input type="reset" value="<?php echo phrase_clear?>" />
		</li>
	</ul>
</form>
<br />
<table class="table">
	<tbody>
		<tr class="title">
			<td><?php echo phrase_max_stats?></td>
		</tr>
		<tr>
			<td><?php echo $option['as_max_stats']; ?></td>
		</tr>
	</tbody>
</table>

