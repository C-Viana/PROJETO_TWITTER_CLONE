<?php
	
	session_start();
	
	require_once 'db.class.php';
	
	$username = $_POST['usuario'];
	$userpass = md5( $_POST['senha'] );
	
	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	$query = "select id, usuario, email from usuarios where usuario = '$username' and senha = '$userpass'";
	$resultado = mysqli_query( $link, $query );
	
	
	if( $resultado ){
		$dados_usuario = mysqli_fetch_array($resultado);
		if( isset($dados_usuario['usuario']) ){
			$_SESSION['id_usuario'] = $dados_usuario['id'];
			$_SESSION['usuario'] = $dados_usuario['usuario'];
			$_SESSION['email'] = $dados_usuario['email'];
			header('Location: home.php');
		}
		else{
			header('Location: index.php?erro=1');
		}
	}
	else {
		echo 'Ocorreu algum problema ao consultar os dados. Contate ajuda do site.';
	}
	
	
	
	
	
	
?>
