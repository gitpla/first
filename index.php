<?php

//die('test_13');
	$host  = $_SERVER['HTTP_HOST'];
	$extra = 'fairypass';//
	header("Location: http://$host/$extra");
	exit;
?>
