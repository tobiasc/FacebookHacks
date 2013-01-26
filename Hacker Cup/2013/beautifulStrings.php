<?php
$line = 0;
$file = fopen('beautifulStrings.txt', 'r') or exit('Unable to open file!');
while(!feof($file)){
	$row = trim(fgets($file));
	$line++;
	if($line == 1){
		continue;
	} else if($row != ''){
		$matches = array();
		$characters = array();
		$row = strtolower($row);
		preg_match_all('/([a-z]{1})/', $row, $matches);
		if(isset($matches[1]) && sizeof($matches[1]) > 0){
			foreach($matches[1] as $key => $char){
				if(!isset($characters[$char])){
					$characters[$char] = 0;
				}
				$characters[$char]++;
			}
		}
		arsort($characters);
		$maxNumber = 0;
		$charVal = 26;
		foreach($characters as $char => $number){
			$maxNumber += $number * $charVal;
			$charVal--;
		}
		$num = $line-1;
		echo 'Case #'.$num.': '.$maxNumber."\n";
	}
}
fclose($file);
?>
