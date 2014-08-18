<?php

$k = 9;

while( $k-- ){

    $location = 'puzzleimages/'.$k.'/puzzle.jpg';
    $info = getimagesize($location); 
    if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($location); 
    elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($location); 
    elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($location);
    imagejpeg($image, "puzzleimages/".$k."/puzzle.jpg", 60);
}

?>