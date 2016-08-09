<?php 
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT');
	header('Content-Type: text/html; charset=utf-8');

	

	require_once('dbConnect.php');

	$sql = "select b.nome_pais, count(*) quantidade
			  from nl_usuarios a, nl_pais b
			 where a.nome is not null
			   and a.nome != ''
			   and a.nome != 'null'
			   AND UPPER(a.pais) = UPPER(b.sigla_pais)
			 group by a.pais
			 order by b.nome_pais";


	$r = mysqli_query($con,$sql);
	$result = array();
	
	while($row = mysqli_fetch_array($r)) {
		array_push($result,array(
            "nome_pais"=> utf8_encode($row['nome_pais']),
			"quantidade"=> utf8_encode($row['quantidade']))
		);
	}

	echo json_encode($result);
	mysqli_close($con);

?>