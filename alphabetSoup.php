<?php
$hackercup = array('H','A','C','K','E','R','U','P');
$line = 0;
$file = fopen('alphabetSoup.txt', 'r') or exit('Unable to open file!');
while(!feof($file)){
	$row = fgets($file);
	$letters = array();
	$line++;
	if($line == 1){
		continue;
	} else if(strlen($row) > 0){
		foreach($hackercup as $key => $letter){
			$count = substr_count($row, $letter);
			if($letter == 'C'){
				$count = floor($count/2);
			}
			$letters[$letter] = $count;
		}

		$min = min($letters);
		$num = $line-1;
		echo 'Case #'.$num.': '.$min."\n";
		//print_r($letters);
	}
}
fclose($file);
?>
