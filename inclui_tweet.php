<?php
	
	session_start();
	
	require_once 'db.class.php';
	
	if( !isset($_SESSION['usuario']) ){
		header('Location: index.php');
		
	}
		
	$id_usuario = $_SESSION['id_usuario'];
	$texto_tweet = $_POST['texto_tweet'];
	
	if($id_usuario != '' && $texto_tweet != ''){
		$objDB = new db();
		$link = $objDB->conecta_mysql();
		
		$query = "insert into tweets (id_usuario, tweet) values ('$id_usuario', '$texto_tweet') ";
		mysqli_query( $link, $query );
		
	}
	
	
?>
