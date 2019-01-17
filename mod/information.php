<?php

@session_start();
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
<div class="box">
	<div class="boxTitle title"><?php echo phrase_information ?></div>
	<div class="boxBody" style="padding: 2px;">
		<table class='table' style="width:550px;margin-right:20px;">
			<tbody>
			<?php
			include($_SERVER['DOCUMENT_ROOT']."/configs/information.php");
				foreach($option['information'] as $info):
			?>
			<tr>
				<td class="tdTitle">
					<?php echo $info['name']; ?>
				</td>
				<td>
					<?php echo $info['description']; ?>
				</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>