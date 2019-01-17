<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
function clean_var($var=NULL) {
$newvar = @preg_replace('/[^a-zA-Z0-9\_\-\.]/', '', $var);
if (@preg_match('/[^a-zA-Z0-9\_\-\.]/', $var)) { }
return $newvar;
}

function items_names($filename='mod/admin/includes/items/item.txt') {

$handle = fopen("$filename", "r");

while (!feof($handle)) {

   $userinfo = fscanf($handle, "%s\t%s\t%s\t%s\t%s\t%s\t%[a-zA-Z0-9\" ]\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\t%s\n");
   if ($userinfo) {
	  
     list ($index,$x,$y,$a,$sirial,$drop,$name,$level,$DamMin,$DamMax,$Speed,$Dur,$MagDur,$str,$agi,$dw,$bk,$elf,$mg) = $userinfo;
 	$index = preg_replace('/[^0-9]/', '', $index);
	//if (!preg_match("/\/\//i", $index)) { continue; }
	if (!$name) { $loop = ((int)$index * 32); } else {
	
	$add = $loop + $index;
	
	if ($add >= 256) { $add = $add; }
	//$hex = strtoupper(str_pad(dechex($add), 2 , "0", STR_PAD_LEFT));
		$hex = strtoupper(sprintf("%02x",$add));
	$name = preg_replace('/[^a-zA-Z0-9\ \-]/', '', $name);
	$item[$hex] = array('name' => $name, 'x' => $x, 'y'=>$y,
		'level' => $level, 'DamMin' => $DamMin,'DamMax' => $DamMax, 'str' => $str,
	'agi' =>$agi,'dw' =>$dw,'elf' =>$elf,
	'bk' =>$bk,'mg' =>$mg);
	}
   }

}
fclose($handle);
return $item;
}

function item_cut($string, $begin, $shortlength, $number=1)
{      
       $length = strlen($string);
       if($length > ($shortlength * $number))
       {
               $end = $begin + $shortlength;
               $flag = 0;
               for($x=$begin; $x < $end; $x++)
               {
                       if(@ord($string[$x]) <= 120) { $flag++;  }
               }
               if($flag%2==1)
               {	
                       $end++;
               }
               $first_part = substr($string, 0, $end);
               $last_part = substr($string, $end);
               $newstring = $first_part. " " .$last_part;
               $number++;
		
	       return item_cut($newstring, $end+1, $shortlength, $number);
		
       }
       else
       {
	return $string;
	
       }
}

function left ($str, $howManyCharsFromLeft)
{
  return substr ($str, 0, $howManyCharsFromLeft);
}

function right ($str, $howManyCharsFromRight)
{
  $strLen = strlen ($str);
  return substr ($str, $strLen - $howManyCharsFromRight, $strLen);
}

function mid ($str, $start, $howManyCharsToRetrieve = 0)
{
  $start--;
  if ($howManyCharsToRetrieve === 0)
   $howManyCharsToRetrieve = strlen ($str) - $start;

  return substr ($str, $start, $howManyCharsToRetrieve);
}
function exc_weapon($ee) {
$exc_option = "";
if ($ee >= 32) { $exc_option .= "[ExcDmg+10%]/[IncHP+4%]<br>"; $ee=$ee-32; }
if ($ee >= 16) { $exc_option .= "[IncDmg+level/20]/[IncMana4%]<br>"; $ee=$ee-16; }
if ($ee >= 8) { $exc_option .= "[IncDmg+2%]/[DmgDec+4%]</option><br>"; $ee=$ee-8; }
if ($ee >= 4) { $exc_option .= "[IncSpeed +7]/[Reflect+5%]<br>"; $ee=$ee-4; }
if ($ee >= 2) { $exc_option .= "[IncLife+life/8][DefSucRate+10%]<br>"; $ee=$ee-2; }
if ($ee >= 1) { $exc_option .= "[IncMana+mana/8][IncZen+40%]<br>"; $ee=$ee-1; }

return $exc_option;
}


function optioner($IOP,$EOP) {
$bb = hexdec($IOP);
$option = '';
$opt   ='';
$io = 0;
$luck ="";
$skill ="";
$dur ="";
$option2= "";
$level ="";
$levelout="";
if ($EOP >= 64) { $opt = "+16"; $EOP=$EOP-64; 
	           $io = 4; }
if ($EOP >= 1) { $option2 .= " EXC ITEM " . exc_weapon($EOP); }
if ($bb >= 128) { 
	$bb =$bb-128; 
	$skill = 'on';
}
if ($bb > 0) { 
	$bb = $bb/8; 
	$level = intval($bb)==0 ? "+0" : "+".intval($bb); 
	$levelout = intval($bb)==0 ? '0' : intval($bb);
	$bb = round(($bb-intval($bb))*8);
if ($bb >= 4) { 
	$bb = $bb-4;   //luck
	$luck = 'on';
	}
 }
if ($bb == 1 ) { 
	$opt = $io != 4 ? "+4" : "+20"; 
	$io = $io != 4 ? 1 : 5; }
elseif ($bb == 2) {
	 $opt = $io != 4 ? "+8" : "+24"; 
	$io = $io != 4 ? 2 :6; }
elseif ($bb == 3) { 
	$opt = $io != 4 ? "+12" : "+28"; 
	$io = $io != 4 ? 3: 7;  }
$option=$level . $opt. ($luck == 'on' ? "+luck" : '') .  ($skill == 'on' ? "+skill" : '');
$options = array($option,$option2,$levelout,$io,$skill,$luck,$EOP);
return $options;
}
}
?>