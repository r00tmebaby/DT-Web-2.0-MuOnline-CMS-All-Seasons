<?php
@session_start();
include ($_SERVER['DOCUMENT_ROOT']."/configs/downlods.php");
	if(!empty($_SESSION['lang'])){
       $filename = $_SERVER['DOCUMENT_ROOT'].'/lang/'.$_SESSION['lang'].'.php';		
      if (file_exists($filename)){
		  require_once($filename);
	  }
	  else{
		 echo "This language file  doesn't exists";
	  }
    }
      else{
      	require_once($_SERVER['DOCUMENT_ROOT']."/lang/en.php");
      }	
?>
<table class="table">
	<tbody>
	<tr class="title">
		<td><?php echo phrase_name; ?></td>
		<td><?php echo phrase_host; ?></td>
		<td><?php echo phrase_size; ?></td>
		<td><?php echo phrase_date; ?></td>
		<td><?php echo phrase_link; ?></td>
	</tr>                         
	<?php
		foreach($option['downloads'] as $file):
	?>
	<tr>
		<td>
			<?php echo $file['name']; ?>
		</td>
		<td>
			<?php echo $file['hosted']; ?>
		</td>
		<td>
			<?php echo $file['size']; ?> MB
		</td>
		<td>
			<?php echo $file['date']; ?>
		</td>
		<td>
			<a href="<?php echo $file['link']; ?>" target="_blank"> <?php echo phrase_download?></a>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>