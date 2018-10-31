<?php 
	session_start();
	
	unset($_SESSION['username']);
	session_destroy();

	$uri .="/DiscountNews";
	header('Location: '.$uri.'/index.php'); 
 ?>