<?php
$line = 0;
$file = fopen('billboards.txt', 'r') or exit('Unable to open file!');
while(!feof($file)){
	$font = 0;
	$row = str_replace("\n", '', fgets($file));
	$values = explode(' ', $row);
	$line++;
	if($line == 1){
		continue;
	} else if(is_array($values) && sizeof($values) > 1){
		$width = array_shift($values);
		$height = array_shift($values);
		$words = $values;
		$case = $line - 1;

		if(string_fits($width, $words)){
			$font = get_max_font($width, $height, strlen(implode('', $words)));
			while(!verify_font_size($width, $height, $words, $font) && $font > 1){
				$font--;
			}
		} 

		echo 'Case #'.$case.': '.$font."\n";
	}
}
fclose($file);

function verify_font_size($width, $height, $words, $font){
	$cols = floor($width/$font);
	$rows = floor($height/$font)-1;
	$tmp_cols = $cols;
	$tmp_rows = $rows;
	foreach($words as $key => $word){
		$strlen_word = strlen($word);
		if($strlen_word > $cols || ($tmp_rows == 0 && $tmp_cols < ($strlen_word+1))){
			return false;
		}
		if($tmp_cols == $cols && $tmp_cols >= $strlen_word){
			$tmp_cols -= $strlen_word;
		} else if($tmp_cols < $cols && $tmp_cols >= ($strlen_word+1)){
			$tmp_cols -= $strlen_word+1;
		} else {
			$tmp_cols = $cols - $strlen_word;
			$tmp_rows--;
		}
	}
	return true;
}

function string_fits($width, $words){
	foreach($words as $key => $word){
		if(strlen($word) > $width){
			return false;
		}
	}
	return true;
}

function get_max_font($width, $height, $strlen){
	$font = min($width, $height);
	$cols = floor($width/$font);
	$rows = floor($height/$font);

	while((($rows * $cols) < $strlen) && $font > 1){
		$font--;
		$cols = floor($width/$font);
		$rows = floor($height/$font);
	}
	return $font;
}
?>
