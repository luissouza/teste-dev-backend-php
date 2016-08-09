<?php 
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT');

	if($_SERVER['REQUEST_METHOD']=='POST') {
		
		//Getting values
		$id = $_POST['id-edit'];
		$nome = $_POST['nome-edit'];
		$categoria = $_POST['categoria-edit'];
	    $idioma = strtolower($_POST['idioma-edit']);
	    $email = $_POST['email-edit'];
	    $telefone = "+".$_POST['telefone-edit'];
	    $estado = $_POST['estado-edit'];
	    $pais = strtolower($_POST['pais-edit']);
	    $cidade = $_POST['cidade-edit'];

							    $sql = "UPDATE nl_usuarios 
									    SET nome = '$nome', 
									  	    categoria ='$categoria', 
									   		idioma    ='$idioma', 
									   		email     ='$email',
									   		telefone  ='$telefone',
									   		estado    ='$estado',
									   		pais      ='$pais',
									   		cidade    ='$cidade'
									   	WHERE id='$id'";
		
		//Importing our db connection script
		require_once('dbConnect.php');
		
		//Executing query to database
		if(mysqli_query($con,$sql)){
			//echo 'Usuário adicionado com sucesso!';
			echo 'ok';
			//echo $sql;
		}else{
			echo 'erro';
			//echo $sql;
		}
		
		//Closing the database 
		mysqli_close($con);
	}