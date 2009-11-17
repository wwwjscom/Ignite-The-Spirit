<?php 
/***** upload_action.php ****************************************
*																* 
* This is the file to upload jpeg images to the server and      *
* put the basic information about the file into the database    *
*                                                               *
* Date Modified: 1/5/09											*
* Created By: Michael J. Pisula	[www.michaelpisula.com]			*
*																*
****************************************************************/

/***** TO-DO List ***********************************************
*																*
* 1. Return errors to the user									*
* 2.															*
*																*
*																*
*																*
****************************************************************/

function upload_photo ($file_error, $file_size, $file_name, $temp_file_name, $year, $first_name, $last_name, $type)
{				
	if ($file_error == 0)																										// Check if a file was submitted (if its not do nothing)
	{ //A
		$extension = strtolower(strrchr($file_name,"."));																		// Get the file extension
		$ext_allowed = array('.jpeg','.jpg','.JPEG','.JPG','gif','GIF');														// jpeg and gif are  valid for photo uploads
		$upload_dir = "../images/calendar/";																					// Upload directory (Be sure to	end with /)	
		$max_file_size = 1000000; //1MB																							// Max file size in bytes	
		$new_file_name = $year."_".$first_name."_".$last_name."_".$type.$extension;												// Set the new file name
		
		if ($file_size <= $max_file_size)																						//Check if file size is smaller than the max file size
		{//B
			if (in_array($extension, $ext_allowed, false)) 																		// If the file's extension is valid 
			{//C																	
				if (is_uploaded_file($temp_file_name))    																		// If upload is successful continue
				{//E
					if (move_uploaded_file($temp_file_name,$upload_dir . $new_file_name)) 										// If file is saved continue
					{//G
						
						return $new_file_name;	
			
					}//G
					else
					{//H
						$error_array[$key] = "$file_name CANT BE SAVED";
					}//H
				}//E
				else
				{//F
					$error_array[$key] = "$file_name CANT BE UPLOADED";
				}//F
			}//C
			else
			{//D
				$error_array[$key] = "$file_name was not a JPEG";
			}//D
		}//B
		else
		{
			$error_array[$key] = "$file_name was too large.";
		}
	
	}//A
	$_SESSION['error_array'] = $error_array;																					// Collect errors into a session array
	
}
?>