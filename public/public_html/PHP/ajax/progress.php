<?php
/******************************************************************************
 Lightloader
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
	
	$tempdir = 'tempfiles/';
	if (isset($_POST['id'])) {
    	$id = preg_replace('#[^a-zA-Z0-9\-\_]+#', '', $_POST['id']);
		$filepath = $tempdir . $id . '_progress';
		if (file_exists($filepath)) print file_get_contents($filepath);
		else print '{"percent" : 0}';
	}
?>