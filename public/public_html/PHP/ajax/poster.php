<?php

#############################
	$final_dir = 'uploaded_images/';
	$temp_dir =  'tempfiles/';
#############################

/******************************************************************************
 Lightloader - Image Uploader
 Copyright (C) 2007  Jeremy Nicoll

 This library is free software; you can redistribute it and/or
 modify it under the terms of the GNU Lesser General Public
 License as published by the Free Software Foundation; either
 version 2.1 of the License, or (at your option) any later version.

 This library is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 Lesser General Public License for more details.

 You should have received a copy of the GNU Lesser General Public
 License along with this library; if not, write to the Free Software
 Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA

 Please see lgpl.txt for a copy of the license - this notice and the file
 lgpl.txt must accompany this code.

 Please go to forums.SeeMySites.net for questions and support of this library.
 Go to www.ScriptSing.com for code updates.
*******************************************************************************/
	function escape($str) {
		if (is_numeric($str)) return $str;
		if (get_magic_quotes_gpc()) $str = stripslashes($str);
		return mysql_real_escape_string($str);
	}
	
	$id = '123456';
	
	require_once('../ll_iu/includes/LightLoader.php');
	require_once('../ll_iu/includes/ImageSizer.php');
	require_once('../ll_iu/includes/db_connect.php');
	
	
	$r = mysql_query("SELECT * FROM images WHERE poster_id=$id") or die(mysql_error());
	$data_array = array();
	
	$db_ids = array();
	foreach ($_LL_FILES['images'] as $image) {
		if ($image['db_id'] > 0) $db_ids[] = intval($image['db_id']);
	}
	var_dump($db_ids);
	
	for ($i=0; $row = mysql_fetch_assoc($r); $i++) {
		$data_array[intval($row['id'])] = $row;
		var_dump($row['id']);
		if (!in_array(intval($row['id']), $db_ids)) {
			unlink($final_dir.$row['filename'] . '.'.$row['extension']);
			unlink($final_dir.$row['filename'] . '_thumb.'.$row['extension']);
		}
	}


	mysql_query("DELETE FROM images WHERE poster_id='$id'") or die(mysql_error());
	
	$is = new ImageSizer($temp_dir); 
    
    $counter = 0;
    
    echo '<pre>';
    print "Uploaded files and their descriptions: \n";
    foreach ($_LL_FILES['images'] as $image) {
    	echo '<br/>'. var_dump($image) .'<br/>';
    	$description = escape($_POST['comments'][intval($image['index'])]);
    	
    	if ($image['db_id'] == 0) {
			$filename = $id.'_'.$counter.'_'.preg_replace('#[^a-z0-9]+#i', '_', $description);
			$tmp_name = preg_replace('#[^a-z0-9\.\-\_\s]+#i', '', $image['tmp_name']);
			$is->loadImage($tmp_name);
			$is->resizeImage(800, 600);  // People generally do not want images larger than this, you can remove this line if you want.
			$is->addWatermark('overlay.png');
			print $filename;
			$width = $is->getNewWidth();
			$height = $is->getNewHeight();
			$ext = $is->getNewType();
			
			$is->saveToFile( $final_dir . $filename.'.'.$ext );
			
			// Create thumbnail
			$is->resizeImage(50, 50); // The x and y are the MAXIMUM height and width with aspect ratio turned on.
			$is->saveToFile($final_dir . $filename .'_thumb.'.$ext);
			unlink($temp_dir . $tmp_name);
		} else {
			$t = $data_array[intval($image['db_id'])];
			echo '<pre>'. var_dump($data_array) . '</pre>';
			$filename = $t['filename'];
			$width = $t['width'];
			$height =$t['height'];
			$ext = $t['extension'];
		}
		
		$query = "INSERT INTO images SET poster_id=$id, filename='$filename', description='$description', width=$width, height = $height, extension='$ext', number=$counter";
		mysql_query($query) or die(mysql_error());
    	$counter++;
    }
    echo '</pre>';
	

?>