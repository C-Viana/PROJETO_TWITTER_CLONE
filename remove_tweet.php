<?php
	
	require_once 'db.class.php';
	
	session_start();
	if( !isset($_SESSION['usuario']) ){
		header('Location: index.php');
	}
		
	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	
	$id_usuario = $_SESSION['id_usuario'];
	$id_btn = $_POST['id_button'];
	
	$query = "DELETE FROM tweets WHERE id = $id_btn";
	
	//echo $query;
	
	$resultado = mysqli_query( $link, $query );
	
	/*
	if($resultado){
		while($registro = mysqli_fetch_array($resultado) ){
			
			
		}
	}
	else{
		echo 'Erro ao consultar tweets no banco de dados.';
	}
	*/
	
	
?>