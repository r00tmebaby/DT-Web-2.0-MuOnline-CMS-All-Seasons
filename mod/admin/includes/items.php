<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
function array_count_values_multidim($a,$out=false) {

	$itemsa = season();
  if ($out===false) $out=array();
  if (is_array($a)) {
   foreach($a as $e)
     $out=array_count_values_multidim($e,$out);
  }
  else {
   if (array_key_exists($a,$out) && strlen($a) == $itemsa[0])
     $out[$a]++;
   else
     $out[$a]=1;
  }
  return $out;
} 
function item_name_array($newitem,$item_names) {
	$option = array();
	$itemsa = season();
$items = item_cut(strtoupper($newitem),0,$itemsa[0]);
$dur=0;
$serial="";
$num = 0;
$item= array();
$items = preg_split('/ /', $items, -1,PREG_SPLIT_NO_EMPTY);
//$item['count'] = count($items);
$ac = array_count_values_multidim($items);
foreach ($ac as $res => $value ) {
	$num = $res;
	$item_num = left($num,2);
	$ee = hexdec(mid($num,15,2));
	if ($item_num == 'FF' || $item_num == '') { continue; }
	if ($ee >= 128) { $ee = $ee - 128; $item_num = '1'.$item_num; }
	$option = optioner(mid($num,3,2),$ee);
	$durability = mid($num,3,2);
	$serial = mid($num,7,8);
	$item[] = array('NAME'=>'['.$item_num . '] '.$item_names[$item_num]['name'], 'count'=>$value, 'OPTIONS'=>$option[0], 'OPTIONS2'=>$option[1],
			'DUR'=>$dur, 'SERIAL' => $serial, 'ITEM_CODE' => $num, 'short_code'=>$item_num,'x'=>$item_names[$item_num]['x'],'y'=>$item_names[$item_num]['y'],'type');
}

return $item;
}


function vault_insert($warehouse1,$itemsave,$names) {

	$itemsa = season();
$vault_spots = array();
$vault = array();
$x = 0;
$col = 0;
	$newitem = item_name_array($itemsave,$names);
	
    $item_y = $newitem[0]['y'];
 	$item_x = $newitem[0]['x'];
    
$arr = array();
$row = -1;
for($x=0; $x<120; ++$x)
{
	if($x%8==0) 
	{
	++$row;
	}
	$col = $x%8;

 if(isset($vault_spots[$x]) == 0)
 {

  $item = substr($warehouse1,$x*$itemsa[0],$itemsa[0]);
  
  if($item == str_repeat('F',$itemsa[0]) OR empty($item))
  {
    $itemx = 1;
    $itemy = 1;
    $arr[$row][$col] = 0;
  }
  else
  {
	
    $newitem = item_name_array($item,$names);
    $itemy = $newitem[0]['y'];
    $itemx = $newitem[0]['x'];
    for($z=0 ;$z<$itemy; ++$z)
	{
	for($a=0 ;$a<$itemx; ++$a)
	 {
	 $pos = $x+$a+$z*8;
	 $vault_spots[$pos] = 1;
	 $pos2 = $row+$z;
	 $pos3 = $col+$a;
	 $arr[$pos2][$pos3] = 1;
	 }
	}
  }
}
}
$ya = 0;
$xa = 0;
for($y=0; $y<15; ++$y)
{
for($x=0; $x<8; ++$x)
{
$spot_found = false;
	if($arr[$y][$x] != 1)
	{
		
	$spot_found = true;
		for($ya=$y; $ya<($item_y+$y); ++$ya)
		for($xa=$x; $xa<($item_x+$x); ++$xa)
		{
			if($arr[$ya][$xa] != 0 OR !isset($arr[$ya][$xa]))
			{
				$spot_found = false;
			break;
			}
		}
	}
if($spot_found) {
	$zapiszx = $x; 
	$zapiszy = $y;
	break;
}

}
if(isset($zapiszx)) break;


}

if(isset($zapiszx))
{
$itemsave = strtoupper($itemsave);

for($x=0; $x<120; ++$x) {
	$warearr[$x] = substr($warehouse1, $x*$itemsa[0], $itemsa[0]); 
}
$x = $zapiszy*8+$zapiszx;
$warearr[$x] = $itemsave;

$vault_new = implode('',$warearr);

return $vault_new;
} else { return "Error"; }
}

}
?>