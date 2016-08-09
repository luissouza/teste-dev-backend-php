<?php 
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT');
	header('Content-Type: text/html; charset=utf-8');
	
	$username = trim(mysql_escape_string($_GET['username']));
	
	if(isset($_GET["username"])) {
		require_once('dbConnect.php');
		$sql = "select * from nl_usuarios a where a.login = '$username' order by nome asc";
		$r = mysqli_query($con,$sql);
		$dados = mysqli_fetch_array($r);
		$result = array();
		
		
		array_push($result, array("login"=>$dados['login']));

		echo json_encode($result);
		
		mysqli_close($con); 

	}
?>