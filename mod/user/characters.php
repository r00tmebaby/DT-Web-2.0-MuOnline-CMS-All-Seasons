<?php

	$query = mssql_query("SELECT TOP 10 * FROM Character WHERE AccountID='" . $_SESSION['dt_username'] . "' ORDER BY GrandResets DESC, Resets DESC, cLevel DESC");

	while($row = mssql_fetch_array($query)):
		$char_class = char_class($row['Class']);
		$pk_level = pk_level($row['PkLevel']);
?>

<table class="table">
	<tbody >
		<tr class="title">
			<td><?php echo phrase_name?></td>
			<td><?php echo phrase_class?></td>
			<td><?php echo phrase_level?></td>
			<td><?php echo phrase_resets?></td>
			<td><?php echo phrase_gresets?></td>
			<td><?php echo phrase_pk?></td>
		</tr>
		<tr>
			<td>
				<?php echo $row['Name']; ?>
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
				<?php echo $row['GrandResets']; ?>
			</td>
			<td>
				<?php echo $pk_level; ?>
			</td>
		</tr>
		<tr class="title">
			<td><?php echo phrase_strenght?></td>
			<td><?php echo phrase_vitality?></td>
			<td><?php echo phrase_agility?></td>
			<td><?php echo phrase_energy?></td>
			<td><?php echo phrase_points?></td>
			<td><?php echo phrase_zen?></td>
		</tr>
		<tr>
			<td>
				<?php echo $row['Strength']; ?>
			</td>
			<td>
				<?php echo $row['Vitality']; ?>
			</td>
			<td>
				<?php echo $row['Dexterity']; ?>
			</td>
			<td>
				<?php echo $row['Energy']; ?>
			</td>
			<td>
				<?php echo $row['LevelUpPoint']; ?>
			</td>
			<td>
				<?php echo number_format($row['Money']); ?>
			</td>
		</tr>
	</tbody>
</table>
<?php endwhile; ?>
