<?php
	
	require_once 'db.class.php';
	
	session_start();
	if( !isset($_SESSION['usuario']) ){
		header('Location: index.php');
	}
		
	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	
	$id_usuario = $_SESSION['id_usuario'];
	$id_seguido = $_POST['id_seguido'];
	
	$query = "INSERT INTO usuarios_seguidores(id_usuario, id_seguido) VALUES ($id_usuario, $id_seguido) ";
	
	$resultado = mysqli_query( $link, $query );
	
	if($resultado){
		
	}
	else{
		echo 'Erro ao consultar tweets no banco de dados.';
	}
	
	
	
?>
