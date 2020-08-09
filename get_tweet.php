<?php
	
	require_once 'db.class.php';
	
	session_start();
	if( !isset($_SESSION['usuario']) ){
		header('Location: index.php');
	}
		
	$objDB = new db();
	$link = $objDB->conecta_mysql();
	
	
	$id_usuario = $_SESSION['id_usuario'];
	
	$query = "SELECT DATE_FORMAT(t.data_inclusao, '%H:%i %d/%m/%Y') AS data_inclusao, t.tweet, u.usuario, t.id, t.id_usuario FROM tweets AS t 
		JOIN usuarios AS u 
		ON (t.id_usuario = u.id)
		WHERE id_usuario = $id_usuario 
		OR id_usuario IN (select id_seguido from usuarios_seguidores where id_usuario = $id_usuario )
		ORDER BY data_inclusao";
	
	$resultado = mysqli_query( $link, $query );
	
	if($resultado){
		while($registro = mysqli_fetch_array($resultado) ){
			echo "<a href'#' class='list-group-item' style='margin-bottom:5px;'>";
			
			echo($id_usuario == $registro['id_usuario']) ? "<p class='list-group-item-text pull-right'><button type='button' id='remove_tweet_$registro[id]' class='btn btn-danger btn_remove_tweet' data-id_btn='$registro[id]'>Excluir Tweet</button></p>" : '';
			
			echo "<h4 class='list-group-item-heading'>$registro[usuario] <small>$registro[data_inclusao]</small></h4>";
			echo "<p class='list-group-item-text'> $registro[tweet] </p>";
			echo "</a>";
			
		}
	}
	else{
		echo 'Erro ao consultar tweets no banco de dados.';
	}
	
	
	
?>