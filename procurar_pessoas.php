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
	}
	else{
		echo 'ERRO AO EXECUTAR QUERY';
	}
	
	//quantidade de seguidores
	$qtd_seguidores = 0;
	$query = "SELECT COUNT(*) AS qtd_seguidores FROM usuarios_seguidores WHERE id_seguido = $id_usuario";
	$resultado = mysqli_query( $link, $query );
	
	if($resultado) { 
		$registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC );
		$qtd_seguidores = $registro['qtd_seguidores'];
	}
	else{
		echo 'ERRO AO EXECUTAR QUERY';
	}
	
?>

<!DOCTYPE HTML>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">

		<title>Twitter clone</title>
		
		<!-- jquery - link cdn -->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

		<!-- bootstrap - link cdn -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		
		<script type="text/javascript">
			$(document).ready(function() {
				
				$('#btn_procurar_pessoa').click(function(){
					
					if( $('#nome_pessoa').val().length > 0){
						$.ajax({
							url: 'get_pessoas.php',
							method: 'post',
							data: $('#form_procurar_pessoas').serialize(), //{ texto_tweet: $('#texto_tweet').val() },
							success: function(data){
								$('#pessoas').html(data);
								
								$('.btn_seguir').click( function(){
									var id_usuario = $(this).data('id_usuario');
									
									$('#btn_seguir_'+id_usuario).hide();
									$('#btn_remover_'+id_usuario).show();
									
									$.ajax({
										url:'seguir.php',
										method:'post',
										data:{id_seguido:id_usuario},
										success: function(data){
											atualizapainelSeguidores();
											//alert('Seguindo usuário');
										}
									});
								});
								
								$('.btn_remover').click( function(){
									var id_usuario = $(this).data('id_usuario');
									
									$('#btn_seguir_'+id_usuario).show();
									$('#btn_remover_'+id_usuario).hide();
									
									$.ajax({
										url:'deixar_seguir.php',
										method:'post',
										data:{id_remover:id_usuario},
										success: function(data){
											atualizapainelSeguidores();
											//alert('Deixando usuário');
										}
									});
								});
								
							}
						});
					}
					
				});
				
				
				function atualizapainelSeguidores(){
					//Atualizando quantidade de TWEETS
						$.ajax({
							url: 'painel_seguidores.php',
							method: 'post',
							success: function(data){
								$('#followers_number').html(data);
								//alert(data);
							}
						});
				}
				
				atualizapainelSeguidores();
				
			});
		</script>
		
	</head>

	<body>

		<!-- Static navbar -->
	    <nav class="navbar navbar-default navbar-static-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <img src="imagens/icone_twitter.png" />
	        </div>
	        
	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="home.php">HOME</a></li>
				<li><a href="sair.php">SAIR</a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>


	    <div class="container">

	    	<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4> <?= $_SESSION['usuario']; ?> </h4>
						<?= $_SESSION['email']; ?>
						<hr/>
						
						<div class="col-md-6" >
							Tweets<br/> <?= $qtd_tweets; ?>
						</div>
						<div class="col-md-6" >
							Seguidores<br/> <?= $qtd_seguidores; ?>
						</div>
						
					</div>
				</div>
			</div>
			
			
	    	<div class="col-md-6">
	    		
				<div class="panel panel-default">
					<div class="panel-body">
						
						<form id="form_procurar_pessoas" class="input-group" >
							<input type="text" class="form-control" id="nome_pessoa" name="nome_pessoa" width="auto" placeholder="Quem você quer procurar?" maxlength="140">
							<span class="input-group-btn" >
								<button class="btn btn-default" id="btn_procurar_pessoa" name="btn_tweet" type="button"> Procurar </button>
								
							</span>
						</form>
						
					</div>
				</div>
				
				<div id="pessoas" class="list-group" >
					
				</div>
				
				
			</div>
			
			
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						
					</div>
				</div>
			</div>
			
			
			
		</div>


	    </div>
	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
	</body>
</html>