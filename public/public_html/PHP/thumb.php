<?php

header("Content-type: image/jpeg");

//Create Thumbnail Image
$image = imagecreatefromjpeg("$_GET[src]");								// Uploaded file location
$image_width=imagesx($image);													// Get Photo width
$image_height=imagesy($image);													// Get Photo height
	
if ($_GET['display'] == "thumb")												// Gallery size image
{				
$thumb_width = 105;																
$thumb_height = 72;
$img_quality = 100;
}
else if($_GET['display'] == "cover")											// View Size Image
{																				
$thumb_width = 160;																
$thumb_height = 120;	
$img_quality = 100;																
}
																	
			 
$height_ratio = round($thumb_height / $image_height, 2);						// Calculate height shrink ratio
$width_ratio = round($thumb_width / $image_width, 2) ;							// Calculate width shrink ratio
			
			
if ($image_height <= $thumb_height && $image_width <= $thumb_width) 		
{
$thumbnail_width = $image_width;												//Keep original width		
$thumbnail_height = $image_height;												//Keep original height
}
else if ($image_height > $thumb_height || $image_width > $thumb_width)
{
		
	if ( $image_height > $thumb_height && $image_width < $thumb_width )		
	{
				
	$thumbnail_width = $image_width * $height_ratio;							// shrink width 
	$thumbnail_height = $image_height * $height_ratio;							// shrink height
	}
	else if ($image_width > $thumb_width && $image_height < $thumb_height )
	{
	//echo "here";
	$thumbnail_width = $image_width * $width_ratio;								// shrink width 
	$thumbnail_height = $image_height * $width_ratio;							// shrink height
	}
	else //($origh > $thumb_height && $origw > $thumb_width)
	{
	$thumbnail_width = $image_width * $height_ratio;							// shrink width 
	$thumbnail_height = $image_height * $height_ratio;							// shrink height	
	}	
}

$thumbnail = imagecreatetruecolor($thumbnail_width,$thumbnail_height);
if($_GET['display'] == "square") 
{
	
	if ($image_height <= $image_width){ $sample = $image_width / 2; } else { $sample = $image_height / 2;}
	$thumbnail = imagecreatetruecolor(90,90);
	imagecopyresized($thumbnail,$image,0,0,0,0,90,90,$sample,$sample); 
}
else 
{ 
	$thumbnail = imagecreatetruecolor($thumbnail_width,$thumbnail_height);
	imagecopyresized($thumbnail,$image,0,0,0,0,$thumbnail_width,$thumbnail_height,$image_width,$image_height); 
}
imagejpeg($thumbnail,NULL,$img_quality);
imagedestroy($thumbnail);

?>