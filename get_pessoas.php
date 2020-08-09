<?php
	
	require_once 'db.class.php';
	
	session_start();
	if( !isset($_SESSION['usuario']) ){
		header('Location: index.php');
	}
		
	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	
	$nome_pessoa = $_POST['nome_pessoa'];
	$id_usuario = $_SESSION['id_usuario'];
	
	//$query = "SELECT * FROM usuarios WHERE usuario LIKE '%$nome_pessoa%' AND id <> $id_usuario ";
	
	$query = 
	"SELECT u.*, us.* FROM usuarios AS u 
	LEFT JOIN usuarios_seguidores AS us
	ON( us.id_usuario = $id_usuario AND u.id = us.id_seguido)
	WHERE u.usuario LIKE '%$nome_pessoa%' AND u.id <> $id_usuario;";
	
	$resultado = mysqli_query( $link, $query );
	
	if($resultado){
		while($registro = mysqli_fetch_array($resultado) ){
			
			echo "<a href'#' class='list-group-item' style='margin-bottom:5px;'>"; 
			
			$esta_seguindo = isset($registro['id_seguido']) && !empty($registro['id_seguido']) ? true : false;
			$btn_seguir_control = 'none';
			$btn_remove_control = 'none';
			
			if($esta_seguindo){
				$btn_seguir_control = 'none';
				$btn_remove_control = 'block';
			}
			else{
				$btn_seguir_control = 'block';
				$btn_remove_control = 'none';
			}
			
			echo "<p class='list-group-item-text pull-right'> 
				<button type='button' class='btn btn-default btn_seguir' 
				id='btn_seguir_$registro[id]' style='display: $btn_seguir_control;' data-id_usuario='$registro[id]'>
				Seguir</button> </p>";
			
			echo "<p class='list-group-item-text pull-right'> 
				<button type='button' class='btn btn-primary btn_remover' 
				id='btn_remover_$registro[id]' style='display: $btn_remove_control;' data-id_usuario='$registro[id]'>
				Remover</button> </p>";
			
			//echo "<div class='clearfix'></div>";
			echo "<strong>$registro[usuario] </strong><br/>";
			echo "<small>$registro[email] </small>";
			echo "</a>";
			
		}
	}
	else{
		echo 'Erro ao consultar pessoas no banco de dados.';
	}
	
	
	
?>
