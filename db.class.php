<?php
	
	
	class db {
		
		//host
		private $host = 'localhost';
		//porta
		private $port = '3306';
		//usuário
		private $usuario = 'root';
		//senha
		private $senha = '';
		//banco de dados
		private $database = 'twitter_clone';
		
		
		
		public function conecta_mysql(){
			$conn = mysqli_connect( $this->host, $this->usuario, $this->senha, $this->database, $this->port );
			mysqli_set_charset($conn, 'utf8');
			//verificar conexão
			if( mysqli_connect_errno() ){
				echo 'Erro ao conectar com o banco de dados '.mysqli_connect_errno();
			}
			return $conn;
		}
		
		public function login(){
			
		}
		
		
	}
	
	
	
?>

