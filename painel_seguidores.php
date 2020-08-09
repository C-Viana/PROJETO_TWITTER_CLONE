
<?php
	require_once 'db.class.php';
	
	session_start();
	
	if( !isset($_SESSION['usuario']) ){
		header('Location: index.php');
	}
	
	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	$id_usuario = $_SESSION['id_usuario'];
	
	//quantidade de seguidores
	
	$query = "SELECT COUNT(*) AS qtd_seguidores FROM usuarios_seguidores WHERE id_seguido = $id_usuario";
	$resultado = mysqli_query( $link, $query );
	
	if($resultado) { 
		$registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC );
		echo $registro['qtd_seguidores'];
	}
	else{
		echo 'ERRO AO EXECUTAR QUERY';
	}
	
	
?>