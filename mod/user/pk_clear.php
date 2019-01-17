<?php

if(isset($_POST['pkclear']))
{
	$store = do_pk_clear();
	show_messages($store);
}

$zen_type = '';
if($option['pkc_zen_type'] === 1)
{
	$zen_type = 'PK '.phrase_level.' * ';
}
?>

<form  name="<?php echo form_enc()?>" class="form" method="post">
	<ul style="width:62%;">
		<li>
			<span><?php echo phrase_character ?>: </span>
			<select name="character" id="character">
				<option value="">-</option>
				<?php
					$query = mssql_query("SELECT TOP 10 * FROM Character WHERE AccountID='" . $_SESSION['dt_username'] . "' ORDER BY GrandResets DESC, Resets DESC, cLevel DESC");

					while($row = mssql_fetch_array($query)):
					$pk_level = pk_level($row['PkLevel']);
				?>
				<option value="<?php echo $row['Name']; ?>"> <?php echo $row['Name']; ?>: [<?php echo $pk_level; ?>]</option>
				<?php endwhile; ?>
			</select>
			<input  class="button" name="pkclear" type="submit" value="<?php echo phrase_clear_character?>" />
		</li>
	</ul>
</form>
<br />
<table class="table">
	<tbody>
		<tr class="title">
			<td><?php echo phrase_cost?></td>
		</tr>
		<tr>
			<td><?php echo $zen_type .' ' . number_format($option['pkc_zen']) . phrase_zen?></td>
		</tr>
	</tbody>
</table>
