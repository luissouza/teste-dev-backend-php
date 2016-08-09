<?php 
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT');

	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//Getting values
		$nome = $_POST['nome'];
		$login = strtolower ($_POST['username']);
		$senha = 'kikoDYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9mi'.$_POST['senha'];
	    $idioma = strtolower($_POST['idioma']);
	    $email = $_POST['email'];
	    $telefone = "+".$_POST['telefone'];
	    $estado = $_POST['estado'];
	    $pais = strtolower($_POST['pais']);
	    $cidade = $_POST['cidade'];
	   
	    $categoria = $_POST['categoria'];
	    $criacao = $_POST['criacao'];
	    $ativacao_status = $_POST['ativacao_status'];
	    $ativacao_token = $_POST['ativacao_token'];
		
		//Creating an sql query
		$sql = "INSERT INTO nl_usuarios(nome, login, senha, nivel, idioma, telefone, pais, cidade, estado, email, categoria, criacao, alteracao, ativacao_status, ativacao_token) 
							    VALUES ('$nome', '$login', '".sha1($senha)."', '2', '$idioma', '$telefone', '$pais', '$cidade', '$estado', '$email', 1, '1', '1', '1', '".rand()."')";
		
		//Importing our db connection script
		require_once('dbConnect.php');
		
		//Executing query to database
		if(mysqli_query($con,$sql)){
			//echo 'Usuário adicionado com sucesso!';
			echo 'ok';
			echo $sql;
		}else{
			echo 'erro';
			echo $sql;
		}
		
		//Closing the database 
		mysqli_close($con);
	}