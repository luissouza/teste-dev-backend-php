<?php 
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT');
	header('Content-Type: text/html; charset=utf-8');


	require_once('dbConnect.php');
	
	$id_contato = $_GET['id'];

	$sql = "SELECT a. * , UPPER( a.nome ) nome_usuario, b.nome_pais, c.descricao descricao_categoria, d.descricao_idioma
			FROM nl_usuarios a, nl_pais b, nl_categoria c, nl_idioma d
			WHERE a.nome IS NOT NULL 
			AND a.nome !=  ''
			AND a.nome !=  'null'
			AND UPPER( a.pais ) = UPPER( b.sigla_pais ) 
			AND UPPER( a.idioma ) = UPPER( d.sigla_idioma ) 
			AND a.categoria = c.id_categoria
			AND a.id = $id_contato
			ORDER BY nome ASC ";


	$r = mysqli_query($con,$sql);
	
	$result = array();
	


while($row = mysqli_fetch_array($r)){
		
		//Pushing name and id in the blank array created 
		array_push($result,array(
			"id"=>$row['id'],
			"nome"=> utf8_encode($row['nome_usuario']),
			"login"=> utf8_encode($row['login']),
			"idioma"=>$row['idioma'],
			"telefone"=>$row['telefone'],
            "pais"=> utf8_encode($row['pais']),
            "nome_pais"=> utf8_encode($row['nome_pais']),
			"cidade"=> utf8_encode($row['cidade']),
			"estado"=>$row['estado'],
			"email"=> utf8_encode($row['email']),
			"descricao_idioma"=> utf8_encode($row['descricao_idioma']),
			"descricao_categoria"=> utf8_encode($row['descricao_categoria']),
			"categoria"=> utf8_encode($row['categoria'])
		));
	}
	

	echo json_encode($result);
	
	mysqli_close($con);


	?>