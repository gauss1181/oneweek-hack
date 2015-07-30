<?php
	$fp = fopen('../data/reports.csv', 'a');
	$myid = uniqid();

	$uploadOk = 0;
	$target_file = basename($_FILES["picture"]["name"]);
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	$target_file = '';
	// Check if image file is a actual image or fake image
	if(isset($_FILES["picture"])) {
		$target_file = "/data/images/" . $myid . "." . $imageFileType;
	    $check = getimagesize($_FILES["picture"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    @move_uploaded_file($_FILES["picture"]["tmp_name"], '..' . $target_file);
		}
	}
	
	$fields = array(
		$myid,
		$_POST['why'],
		$_POST['what'],
		'point',
		$_POST['latitude'] . ',' . $_POST['longitude'],
		$target_file
	);
	fputcsv($fp, $fields);
	fclose($fp);
?>
