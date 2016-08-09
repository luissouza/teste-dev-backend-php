<?php 

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT');
	header('Content-Type: text/html; charset=utf-8');
	
	@$username = trim(mysql_escape_string($_POST['username']));
	@$senha = trim(mysql_escape_string($_POST['senha']));


	
	if(isset($_GET["username"])) {
		require_once('dbConnect.php');
		$senha_md5 = sha1('kikoDYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9mi'.$senha);
		$sql = "select * from nl_usuarios a where a.login = '$username' and a.senha = '$senha_md5' order by nome asc";
		$r = mysqli_query($con,$sql);
		$dados = mysqli_fetch_array($r);
		$senha_bd = $dados['senha'];
		$result = array();
		
		
		array_push($result, array("login"=>$dados['login']));

			if((sha1('kikoDYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9mi'.$senha) == $senha_bd)) { 
		
				@session_start('logado');
				$_SESSION['sessao'] = session_id();
				
				$_SESSION['ip'] = getenv("REMOTE_ADDR");
				$_SESSION['tempo'] = strtotime('NOW');
				$_SESSION['id_usuario'] = $dados['login'];
				
				$sql_del = "DELETE FROM nl_usuarios_online WHERE id_usuario = '".$_SESSION['id_usuario']."'";
				$res_del = mysqli_query($con, $sql_del) or die ("Problemas na query 2<P>". mysql_error());
				
				$sql = "INSERT INTO nl_usuarios_online (IP, TEMPO, ID_SESSAO, data, id_usuario)
						VALUES ('".getenv("REMOTE_ADDR")."', ".strtotime('NOW')." , '".$_SESSION['sessao']."', NOW(), '".$_SESSION['id_usuario']."')";   
				$res = mysqli_query($con, $sql) or die ("Problemas na query 3<P>". mysql_error()); 

				
			} 
			
		echo json_encode($result);
		
		mysqli_close($con); 
	}
?>