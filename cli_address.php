<?php
$paginainterna = 1;
$perfis = ["cli"];
include("home.php");

include_once "./conf/connection.php";

?>
<div style="padding-left: 5%; padding-right: 5%;">
	<div class="center-align" >
		<h3>Endereço</h3>
	</div>
	<a href="./cli_address_new.php" class="btn">Cadastrar</a>
	<br /><br />
	<?php

	$sql = "select
				e.id,
				c.nome as cidade,
				es.nome as estado,
				e.bairro,
				e.rua,
				e.numero,
				e.complemento
			from endereco e
			left outer join cidade c on c.id_cidade = e.id_cidade
			left outer join estado es on es.id_estado = e.id_estado
			where id_usuario = '" . $_SESSION["id"] . "'";
	$result = mysqli_query($conn, $sql);

	?>
	<table class="responsive-table">
		<thead>
			<tr>
				<th>Estado</th>
				<th>Cidade</th>
				<th>Bairro</th>
				<th>Rua</th>
				<th>Número</th>
				<th>Complemento</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>
		<?php
		    while($row = mysqli_fetch_assoc($result)) {
		    	$results = $row;
		    	echo '<tr>
		    			<td>' . utf8_encode(ucwords(strtolower($results['estado']))) . '</td>
		    			<td>' . utf8_encode(ucwords(strtolower($results['cidade']))) . '</td>
						<td>' . utf8_encode($results['bairro']) . '</td>
						<td>' . utf8_encode($results['rua']) . '</td>
						<td>' . $results['numero'] . '</td>
						<td>' . utf8_encode($results['complemento']) . '</td>';
						?>
						<td>
							<a href="cli_address_edit.php?id=<?php echo $results['id']; ?>"><i class="material-icons">edit</i></a>
						</td>
						<td>
							<a href="#" onclick='msgDelete(<?php echo $results['id']; ?>);'><i class="material-icons">delete</i></a>
						</td>
						<?php
				echo '</tr>';
		    }
			mysqli_close($conn);
		
			if(!isset($results)){
				echo "<tr><td colspan='8'>Nenhum endereço cadastrado.</td></tr>";
			}
		?>
		<tbody>
	</table>
	<br /><br />
</div>

<?php include("footer.php"); ?>

<script type="text/javascript">
	function msgDelete(codigo){
		return swal({						 
			  text: "Realmente deseja apagar?",
			  buttons: ["Cancelar", "Apagar"],
			  dangerMode: true,
		}).then((willDelete) => {
		  if (willDelete) {
		  	console.log("redirect");
		    window.location = "cli_address_del.php?id=" + codigo;
		  }
		});
	}
</script>