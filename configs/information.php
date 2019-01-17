<?php

@session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/configs/config.php");
require $_SERVER['DOCUMENT_ROOT']."/inc/modules_funcs.php";
	// Information
	$set = web_settings();
	lang();
	$option['information'] = array(
	
		array(
			'name' => phrase_server_name,
			'description' => $set[4]
		),
		array(
			'name' => phrase_server_version,
			'description' =>  $set[7]
		),
		array(
			'name' => phrase_server_experience,
			'description' =>  $set[9]
		),
		array(
			'name' => phrase_server_rate,
			'description' =>  $set[11]
		),
		array(
			'name' => '-',
			'description' => '-'
		),
		array(
			'name' => 'DROP Event',
			'description' => 'AUTO'
		),
		
	);
