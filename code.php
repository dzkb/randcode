<?php
/*
	RandomCode v1
	by Dzakub
	released under MIT License
*/
header ('Content-Type: image/png');
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
$file_content = file_get_contents("code.txt");
$codes = preg_split("/\/\/\@\/\//", $file_content);
$r = rand(1,count($codes)-1);
$lines = explode("\r\n", $codes[$r]);
$longest = 0;
foreach ($lines as $k => $v){
	if (strlen($v) > $longest){
		$longest = strlen($v);
	}
}

$im = @imagecreatetruecolor(30+6*$longest, 10+12*count($lines))
      or die('Cannot Initialize new GD image stream');
$text_color = imagecolorallocate($im, 0,255, 0);
foreach ($lines as $k => $v){
	imagestring($im, 2, 5, 12*$k,  $v, $text_color);
}
//imagestring($im, 2, 5, 5,  $codes[1], $text_color);
imagepng($im);
imagedestroy($im);
?>