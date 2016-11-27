<?php
$my_img = imagecreate( 200, 80 );
$background = imagecolorallocate( $my_img, 0, 0, 255 );
$text_colour = imagecolorallocate( $my_img, 255, 255, 0 );
$line_color = imagecolorallocate( $my_img, 128, 255, 0 );
imagestring( $my_img, 4, 30, 25, "thesitewizard.com", $text_colour );
imagesetthickness ( $my_img, 5 );
imageline( $my_img, 30, 45, 165, 45, $line_color );

//header( "Content-type: image/png" );



imagepng( $my_img ,"new_image.png");
imagedestroy( $my_img );


// output the image.



?> 

<img src="new_image.png"  alt="Created image." border='1' align="left">