<?php

makeImageF("Life in PHP.","CENTURY.TTF");

function makeImageF($text, $font="CENTURY.TTF", $W=200, $H=20, $X=0, $Y=0, $fsize=18, $color=array(0x0,0x0,0x0), $bgcolor=array(0xFF,0xFF,0xFF)){
       
    $im = @imagecreate($W, $H)
        or die("Cannot Initialize new GD image stream");
       
    $background_color = imagecolorallocate($im, $bgcolor[0], $bgcolor[1], $bgcolor[2]);        //RGB color background.
    $text_color = imagecolorallocate($im, $color[0], $color[1], $color[2]);            //RGB color text.
           
    imagettftext($im, $fsize, $X, $Y, $fsize, $text_color, $font, $text);
   
   // header("Content-type: image/gif");               
    //return imagegif($im);
}


/*
It is easy and simple example to convert Text to Image with selected font.
It helps me to display Bangla text as image when users have no installed bangla font.

I hope it can help you too!

*/

//Kip the font file together or write proper location.

?>