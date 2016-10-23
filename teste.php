<?php
	$im = imagecreatefrompng('media/images/14-151476848200');
	$size = min(imagesx($im), imagesy($im));
	$im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $size, 'height' => $size]);
	if ($im2 !== FALSE) {
	    imagepng($im2, 'media/images/14-151476848200');
	}
?>
