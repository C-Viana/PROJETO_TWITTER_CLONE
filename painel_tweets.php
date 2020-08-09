
<?php
	require_once 'db.class.php';
	
	session_start();
	
	if( !isset($_SESSION['usuario']) ){
		header('Location: index.php');
	}
	
	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	$id_usuario = $_SESSION['id_usuario'];
	
	//quantidade de tweets
	$qtd_tweets = 0;
	$query = "SELECT COUNT(*) AS qtd_tweets FROM tweets WHERE id_usuario = $id_usuario";
	$resultado = mysqli_query( $link, $query );
	
	if($resultado) { 
		$registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC );
		$qtd_tweets = $registro['qtd_tweets'];
		echo $qtd_tweets;
	}
	else{
		echo 'ERRO AO EXECUTAR QUERY';
	}
	
	
	
?>