<?php
	$fp = fopen('../data/reports.csv', 'w');
	$fields = array(
		uniqid(),
		$_POST['why'],
		$_POST['what'],
		$_POST['latitude'],
		$_POST['longitude']
	);
	fputcsv($fp, $fields);
	fclose($fp);
?>