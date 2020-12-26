<?php
	if(!isset($_SESSION)){ 
        session_start();
    }
	
	$usuario = $_POST["usuario"];
	$senha = md5($_POST["senha"]);

	if(isset($usuario) && isset($senha)){

		include_once "./conf/connection.php";

		$sql = "select 
					id,
					nome,
					perfil
				from usuario 
				where 
					email = '" . $usuario . "' and
					senha = '" . $senha . "'";

		$result = mysqli_query($conn, $sql);

	    while($row = mysqli_fetch_assoc($result)) {
	    	$results = $row;

	    }
	    
		mysqli_close($conn);

		if (isset($results)){
			$_SESSION['id'] = $results['id'];
			$_SESSION['ultimoclick'] = time();
			$_SESSION['nome'] = utf8_encode($results['nome']);
			$_SESSION['perfil'] = $results['perfil'];
			?>
			<script type="text/javascript">
				window.location = "home.php";
		    </script>
			<?php
		}else{
			?>
			<script type="text/javascript">
				window.location = "index.php?erro=1";
		    </script>
			<?php
		}
	}else{
		?>
		<script type="text/javascript">
			window.location = "index.php?erro=1";
	    </script>
		<?php
	}
?>