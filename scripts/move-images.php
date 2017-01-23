<?php
$files = array();

$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
mysql_select_db('kittenb1_main', $con);
$posts = mysql_query("SELECT * FROM blog ORDER BY uniqueID ASC", $con);
while($post = mysql_fetch_array($posts)){
	$body = $post['body'];
	preg_match_all('#/blog/full/([^"]*)"#', $body, $matches);
	if(count($matches[1]) > 0){
		for($i=0; $i <count($matches[1]); $i++){
			array_push($files, $matches[1][$i]);
		}
	}
}

echo 'found ' . count($files) . ' files.<br/><br/>';
for($i=0; $i<count($files); $i++){
	echo 
	'<a href="/blog/full/' . $files[$i] . '" target="_blank">' . $files[$i] . '</a>' .
	' >>> ' . 
	'<a href="/blog/new-full/' . $files[$i] . '" target="_blank">' . $files[$i] . '</a>' . 
	'<br/>';
	//rename('blog/full/' . $files[$i], 'blog/new-full/' . $files[$i]);
}
?>
