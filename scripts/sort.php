<?php
$tableArr = array('blog', 'burgg', 'comics', 'pain');
$remove = $_REQUEST['remove'];
$replace = $_REQUEST['replace'];
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'); ?>
<div class="mb5 mAuto bdrLtBrown bdrRound p10 w800 bgWhite">
	remove: [<?= $remove; ?>]<br/>
	replace with: [<?= $replace; ?>]
</div>
<?php
$con = mysql_connect('localhost', 'kittenb1_matt', 'uncannyx0545');
mysql_select_db('kittenb1_main', $con);

for($i=0; $i<sizeof($tableArr); $i++){
	echo '<div class="mAuto mb5 bdrLtBrown bdrRound p10 w800 bgWhite">';
		$nextTable = $tableArr[$i];
		$result = mysql_query("SELECT * FROM $nextTable ORDER BY uniqueID ASC", $con);
		$rowCount = mysql_num_rows($result);
		$num = 1;
		$tagArr = array();
		while($row = mysql_fetch_array($result)){
			$uniqueID = $row['uniqueID'];
			$title = $row['title'];
			$colorDisp = $row['colorDisp'];
			$bwDisp = $row['bwDisp'];
			$colorLink = $row['colorLink'];
			$bwLink = $row['bwLink'];
			$thumb = $row['thumb'];
			$author = $row['author'];
			$caption = $row['caption'];
			$date = $row['date'];
			$tags = $row['tags'];
			//echo $uniqueID . ': ' . $title . ' > ' . $num . '<br />';
			
			//COMPILE MASTER TAG LIST
			if($row['tags'] != NULL){
				$tags = $row['tags'];
				if($tags == $remove){
					echo $num . ': ' . $tags . '<br/>';
				}
				$lastComma = strrpos($tags, ',');
				if($lastComma+2 >= strlen($tags)){//strip comma (with one space) after last item
					$tags = substr_replace($tags, '', $lastComma);
				}
				if(strpos($tags, ',') != false){
					$nextComma = strpos($tags, ', ');
					for($count=0;$nextComma != false;$count++){
						$nextTag = substr($tags, 0, $nextComma);
						$tags = substr($tags, $nextComma);
						$tags = substr($tags, 2);
						$repeat = false;
						for($tagCount=0;$tagCount<sizeof($tagArr);$tagCount++){
							if($nextTag == $tagArr[$tagCount]){
								$repeat = true;
							}
						}
						if($repeat == false){
							array_push($tagArr, $nextTag);
						}
						$nextComma = strpos($tags, ', ');
					}
					$tags = str_replace(', ', '', $tags);
					$repeat = false;
					for($tagCount=0;$tagCount<sizeof($tagArr);$tagCount++){
						if($tags == $tagArr[$tagCount]){
							$repeat = true;
						}
					}
					if($repeat == false){
						array_push($tagArr, $tags);
					}
				}else{
					$repeat = false;
					for($tagCount=0;$tagCount<sizeof($tagArr);$tagCount++){
						if($tags == $tagArr[$tagCount]){
							$repeat = true;
						}
					}
					if($repeat == false){
						array_push($tagArr, $tags);
					}
				}
			}
			$recordArr = array();
			if($row['tags'] != NULL){
				$tags = $row['tags'];						
				$tags = rtrim($tags, ', ');
				$lastComma = strrpos($tags, ',');
				if($lastComma+2 >= strlen($tags)){//strip comma (with one space) after last item
					$tags = substr_replace($tags, '', $lastComma);
				}
				if(strpos($tags, ',') != false){
					$nextComma = strpos($tags, ', ');
					for($count=0;$nextComma != false;$count++){
						$nextTag = substr($tags, 0, $nextComma);
						$tags = substr($tags, $nextComma);
						$tags = substr($tags, 2);
						$repeat = false;
						for($tagCount=0;$tagCount<sizeof($recordArr);$tagCount++){
							if($nextTag == $recordArr[$tagCount]){
								$repeat = true;
							}
						}
						//REMOVE TAG 
						if($repeat == false && $nextTag != $remove){
							array_push($recordArr, $nextTag);
						}else{
							echo $num . ': ' . $tags . '<br/>';
							if($replace != NULL){
								array_push($recordArr, $replace);
							}
						}
						$nextComma = strpos($tags, ', ');
					}
					$tags = str_replace(', ', '', $tags);
					$repeat = false;
					for($tagCount=0;$tagCount<sizeof($recordArr);$tagCount++){
						if($tags == $recordArr[$tagCount]){
							$repeat = true;
						}
					}
					if($repeat == false){
						array_push($recordArr, $tags);
					}
				}else{
					$repeat = false;
					for($tagCount=0;$tagCount<sizeof($recordArr);$tagCount++){
						if($tags == $recordArr[$tagCount]){
							$repeat = true;
						}
					}
					if($repeat == false){
						array_push($recordArr, $tags);
					}
				}
			}	
			sort($recordArr);
			$tags = '';
			for($tagCount=0;$tagCount<sizeof($recordArr);$tagCount++){
				$tags .= $recordArr[$tagCount];
				if($tagCount != sizeof($recordArr)-1){
					$tags .= ', ';
				}
			}
			if($row['tags'] != $tags){
				echo $num . ': ' . $row['tags'] . ' > ' . $tags . '<br/>';
				mysql_query("UPDATE $nextTable SET tags='$tags' WHERE uniqueID='$uniqueID'");
			}
			$num++;
		}
		
		//DISPLAY MASTER TAG LIST
		sort($tagArr);
		$colHeight = sizeof($tagArr)/5;
		if($colHeight != floor($colHeight)){
			$colHeight = floor($colHeight)+1;
		}
		echo strtoupper($nextTable) . ' / records: ' . $rowCount . ' / tags: ' . sizeof($tagArr) . '<br/><br/>';
		echo '<div class="line">';
			echo '<div class="unit size1of5">';
			for($tagCount=0;$tagCount<sizeof($tagArr);$tagCount++){
				echo $tagArr[$tagCount] . '<br/>';
				if(($tagCount+1)%$colHeight == 0){
					echo '</div>';
					echo '<div class="unit size1of5">';
				}
			}
					echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}
?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'); ?>
