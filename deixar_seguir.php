<?php
	
	require_once 'db.class.php';
	
	session_start();
	if( !isset($_SESSION['usuario']) ){
		header('Location: index.php');
	}
	
	$id_usuario = $_SESSION['id_usuario'];
	$id_remover = $_POST['id_remover'];
	
	if($id_usuario == '' || $id_remover == ''){
		die();
	}
	
		
	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	
	$query = "DELETE FROM usuarios_seguidores
			WHERE id_usuario = $id_usuario AND id_seguido = $id_remover";
	
	$resultado = mysqli_query( $link, $query );
	
	if($resultado){
		
	}
	else{
		echo 'Erro ao consultar tweets no banco de dados.';
	}
	
	
	
?>
