<table border=1>
<?php
for ($i=0;$i<10;$i++){
	echo "<tr><td>".$i."</td>";
	for ($j=1;$j<10;$j++){
		if ($i==0)
			echo "<td>".$j."</td>";
		else echo "<td>".$j*$i."</td>";
	}
	echo "</tr>";
}
echo "<br>";
function F($x){
    if ($x>0){
        $div=$x/8;
		$mod=$div%8;
    }
    return $mod;                          
}
$x = F(10);
echo $x;
?>
</table>