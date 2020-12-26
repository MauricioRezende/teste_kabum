<?php
	header('Content-type: text/html; charset=UTF-8');

	include_once "./conf/connection.php";

	$id_estado = $_GET["id_estado"];

	$cidades = array();

	$sql = "select 
				id_cidade,
				nome
			from cidade
			where 
				estado_id_estado = '" . $id_estado . "'
			order by nome";

	$res = mysqli_query($conn, $sql);

	echo "<option value=''></option>";
	
	while ( $row = mysqli_fetch_assoc($res)){
		echo "<option value='" . $row['id_cidade'] . "'>" . utf8_encode(ucwords(strtolower($row['nome']))) . "</option>";
	}
?>