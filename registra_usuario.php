<?php
	
	require_once 'db.class.php';
	
	
	$username = $_POST['usuario'];
	$usermail = $_POST['email'];
	$userpass = md5( $_POST['senha'] );
	
	$usuario_existe = false;
	$email_existe = false;
	
	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	
	//VERIFICA SE USUÁRIO JÁ EXISTE
	$query = "select * from usuarios where usuario = '$username' ";
	if( $resultado_id = mysqli_query( $link, $query ) ){
		$dados_usuario = mysqli_fetch_array($resultado_id);
		if( isset($dados_usuario['usuario'] ) ){
			$usuario_existe = true;
		}
	}
	
	//VERIFICA SE E-MAIL JÁ EXISTE
	$query = "select * from usuarios where email = '$usermail' ";
	if( $resultado_id = mysqli_query( $link, $query ) ){
		$dados_usuario = mysqli_fetch_array($resultado_id);
		if( isset($dados_usuario['email'] ) ){
			$email_existe = true;
		}
	}
	
	if( $usuario_existe || $email_existe ){
		$retorno = '';
		if($usuario_existe)
			$retorno.="erro_usuario=1&";
		if($email_existe)
			$retorno.="erro_email=1&";
		header('Location: inscrevase.php?' . $retorno );
		die();
	}
	
	
	
	//CADASTRA USUÁRIO
	$query = "insert into usuarios(usuario, email, senha) values('$username', '$usermail', '$userpass')";
	
	if( mysqli_query( $link, $query ) ){
		echo 'Usuário cadastrado com sucesso';
	}
	else {
		echo 'Erro ao cadastrar usuário.';
	}
	
	
	
	
	
?>
