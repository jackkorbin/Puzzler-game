<?php
$url = 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xap1/v/t1.0-1/p200x200/548412_147785902099377_260065314_n.jpg?oh=5c97dcd58931398e501666daee4c4ae8&oe=5457AC73&__gda__=1414911437_494ad1af138ee7670f89f4a6ba8b6d06';

$data = file_get_contents($url);
$fileName = 'fb_profilepic.jpg';
$file = fopen($fileName, 'w+');
fputs($file, $data);
fclose($file);
?>