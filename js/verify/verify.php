<?php

//Captcha Settings
    $option['verify_img']         = $_SERVER['DOCUMENT_ROOT']."/themes/aion/images/verify.png";	// Captcha Background image path (Change it if you use different te template from aion)
	$option['verify_chars']       = 5;                         // How many characters  
	$option['verify_width']       = 100;                       // Image width !Importnant
	$option['verify_height']      = 40;                        // Image height !Important
	$option['verify_font_size']   = 20;                        // Captcha Font size
	$option['verify_font_color']  = array(255,255,255);        // Color in RGB format
	$option['verify_font_angle']  = 0;                        // Text Rotatation 0=OFF  -/+360


$possible = '1234567890';

$str = '';
$i = 0;
while ($i < $option['verify_chars']) { 
  $str .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
  $i++;
}
$_SESSION['verify'] = $str;
$image = imagecreatefrompng($option['verify_img']);
$textcolor = imagecolorallocate($image, $option['verify_font_color'][0],$option['verify_font_color'][1],$option['verify_font_color'][2]);
$font = "verify.ttf"; 
$box = imagettfbbox($option['verify_font_size'], $option['verify_font_angle'], $font, $_SESSION['verify']);
$x = (int)($option['verify_width'] - $box[4]) / 2;
$y = (int)($option['verify_height'] - $box[5]) / 2;
imagettftext($image, $option['verify_font_size'], $option['verify_font_angle'], $x, $y, $textcolor, $font, $_SESSION['verify']);

header("Content-type: image/png");
imagepng($image);
imagedestroy ($image);
?>