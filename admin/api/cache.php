<?php

function clearCache()
{
	global $d;
	header('Content-type: application/json');
	//The name of the folder.
	$folder = __ROOT_PATH . '/tmp/html';

	//Get a list of all of the file names in the folder.
	$files = glob($folder . '/*');

	//Loop through the file list.
	foreach ($files as $file) {
		//Make sure that this is a file and not a directory.
		if (is_file($file)) {
			//Use the unlink function to delete the file.
			unlink($file);
		}
	}

	// Flush mem cache
	$d->clearMemCached();

	echo json_encode(['status' => 'success']);
}

function clearCacheImage()
{
	header('Content-type: application/json');
	//The name of the folder.
	$folder = sys_get_temp_dir();
	// $folder = __ROOT_PATH . '/cache';

	//Get a list of all of the file names in the folder.
	$files = glob($folder . '/*.timthumb.cache');

	//Loop through the file list.
	foreach ($files as $file) {
		//Make sure that this is a file and not a directory.
		if (is_file($file)) {
			//Use the unlink function to delete the file.
			unlink($file);
		}
	}

	echo json_encode(['status' => 'success', 'folder' => $folder]);
}
