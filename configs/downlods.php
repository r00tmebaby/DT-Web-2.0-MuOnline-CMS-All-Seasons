<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
include($_SERVER['DOCUMENT_ROOT']."/configs/config.php");
	// Downloads
	$option['downloads'] = array(
	
		array(
			'name' => 'MuDT Client',
			'hosted' => 'Dox BG',
			'size' => '250',
			'date' => '28/08/2010',
			'link' => '#downloads'
		),
		array(
			'name' => 'MuDT Patch',
			'hosted' => 'MediaFire',
			'size' => '20',
			'date' => '27/08/2010',
			'link' => '#downloads'
		),
		array(
			'name' => 'MuDT OLD Client',
			'hosted' => 'Dox BG',
			'size' => '250',
			'date' => '26/07/2010',
			'link' => '#downloads'
		),
		
	);
}