<?php
$fh = fopen("scores.xml", 'w');
fwrite($fh, "<?xml version='1.0' encoding='utf-8'?><scores>");

for($i=0;$i<10;$i++){
	$name = 'name'.$i;
	$score = 'score'.$i;
	$date = 'date'.$i;
	fwrite($fh, "<entry><name>".$_GET[$name]."</name>");
	fwrite($fh, "<score>".$_GET[$score]."</score>");
	fwrite($fh, "<date>".$_GET[$date]."</date></entry>");
	echo $_GET[$name].": ".$_GET[$score]."<br />";
}

fwrite($fh, "</scores>");
fclose($fh);
?>