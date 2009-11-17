<?php 
/***** upload_action.php ****************************************
*																* 
* This is the file to upload jpeg images to the server and      *
* put the basic information about the file into the database    *
*                                                               *
* Date Modified: 12/30/08										*
* Created By: Michael J. Pisula	[www.michaelpisula.com]			*
*																*
****************************************************************/

session_start();																											// Open Session 
include("db_connect.php");

																															// Database connection script

foreach($_FILES['upload']['error'] as $key => $error)																  
{//F
	if ($error == UPLOAD_ERR_OK)																							// Check if a file was submitted (if its not do nothing)
	{ //A
		$file_size = trim($_FILES['upload']['size'][$key]);																	// Set the file size 
		$file_name = trim($_FILES['upload']['name'][$key]);																	// Set the file name 
		$temp_file_name =  trim($_FILES['upload']['tmp_name'][$key]);														// Set the temporary file name
		$extension = strtolower(strrchr($file_name,"."));																	// Get the file extension
		$upload_dir = "uploads/";																							// Upload directory (Be sure to	end with /)	
	
		switch ($_POST['upload_type']) 
		{
			case "gallery":
    			$ext_allowed = array('.jpeg','.jpg','.JPEG','.JPG');														// jpegs valid for gallery uploads
				$location = "photo_info.php";																				// Page to redirect to after picture uploaded.
				$fp = fopen("uploads/upload_data/count.txt","rb") or problem("Can't open count.txt for reading!");			// Open counter file		
				$count=fread($fp,100);																						// Read counter file
				fclose($fp);																								// Close counter file
				$max_file_size = 1000000; //1MB																				// Max file size in bytes	
				$new_file_name = $count . $extension;																		// from counter file and existing extension
				$year = date("Y");	
			break;
	
			case "profile":
				$rand_num = mt_rand(10000,99999);																			// Generate random number	
				$spoon1 = mt_rand(0, 25);																					// Generate random number to use for random letter
				$spoon2 = mt_rand(0, 25);																					// Generate random number to use for random letter
				$alphabetSoup = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';																// String of the alphabet
				$randomLetter1 = $alphabetSoup[$spoon1];																	// Generate first random letter	
				$randomLetter2 = $alphabetSoup[$spoon2];																	// Generate second random letter																	
				$new_file_name = $randomLetter1. $rand_num . $randomLetter2 . $extension;									// Create new filename from randum number and two random letters
    			$ext_allowed = array('.jpeg','.jpg','.JPEG','.JPG');														// jpegs valid for gallery uploads for profile uploads
				$max_file_size = 250000;																					// Max file size in bytes		
				$location = "account.php";																					// Page to redirect to after picture uploaded.
    		break;
		}
		if ($file_size <= $max_file_size)
		{//z
			if (in_array($extension, $ext_allowed, false)) 																	// If the file's extension is valid 
			{//G																	
				if (is_uploaded_file($temp_file_name))    																	// If upload is successful continue
				{//B
					if (move_uploaded_file($temp_file_name,$upload_dir . $new_file_name)) 									// If file is saved continue
					{//C
						switch ($_POST['upload_type']) 
						{
						case "gallery":
						$query = sprintf("INSERT INTO pic (pictureid,pictureuserid,picturefile,picturethumb,pictureyear) 
									  VALUES ('%s','%s','%s','%s','%s')",
										$count, 
										$_SESSION['user'],
										$new_file_name,
										$thumb_file_name,
										$year);
						query_db($query);																					// Insert Photo Info into DB
						$photo_array[] = $count; 																			// Keep track of files uploaded for information page
						$count++;																							// Increment counter
						$fp = fopen("uploads/upload_data/count.txt","wb") or problem("Can't open count.txt for writing!");	// Open counter file
						fputs($fp,$count);																					// Write to counter file
						fclose($fp); 																						// Close counter file
						break;
					
						case "profile":
						$query = "UPDATE member SET `photo` = '$new_file_name' WHERE memberid = $_SESSION[user]";
						query_db($query); 
						break;
						}
					}//C
					else
					{//D
						$error_array[$key] = "$file_name CANT BE SAVED";
					}//D
				}//B
				else
				{//E
					$error_array[$key] = "$file_name CANT BE UPLOADED";
				}//E
			}//G
			else
			{//H 
				$error_array[$key] = "$file_name was not a JPEG";
			}//H
		}//z
		else
		{
			$error_array[$key] = "$file_name was too large.";
		}
	
	}//A

}//F
$_SESSION['error_array'] = $error_array;																					// Collect errors into array
$_SESSION['photo_array'] = $photo_array;  																					// Collect file names uploaded into session
header("location:$location");		  																						// Redirect to next page	

?>