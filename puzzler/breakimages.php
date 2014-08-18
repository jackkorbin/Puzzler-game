<?php

$targ_w = $targ_h = 150;
$jpeg_quality = 50;

$k = 9;

while( $k-- ){
    $src = "puzzleimages/".$k."/puzzle.jpg";

    $y = 0;
    $y2 = 150;
    $x = 0;
    $x2 = 150;

    $i = 3;
    $name = 0;
    while( $i-- ){
        $j = 3;

        while( $j-- ){


            $img_r = imagecreatefromjpeg($src);
            $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

            imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$targ_w,$targ_h);

            //header('Content-type: image/jpeg');
            imagejpeg($dst_r,'puzzleimages/'.$k.'/'.++$name.'.jpg', $jpeg_quality);

            $x += 150;
            $x2 += 150;

        }


        $y += 150;
        $y2 += 150;
        $x = 0;
        $x2 = 150;

    }
}

    
?>