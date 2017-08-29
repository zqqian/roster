<?php
$i=5;

// random algorithm
$remain_i=$i;
$a[$i];
$b[$i];
$iii=0;
for($ii=0;$ii<$i;$ii++){
	$a[$ii]=0;
}
while($remain_i--){
	
	
$randnum=rand(1,$remain_i+1);
//echo $randnum;
$nowi=0;
$nowii=0;
//echo $nowii;
while(1){
	
	if($a[$nowii]!=1){
		
		$nowi++;
		
	}
	
if($nowi==$randnum){
	$a[$nowii]=1;
	break;
}$nowii++;	
}

$b[$iii++]=$nowii;


}
var_dump($b);
?>
