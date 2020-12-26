<?php
$paginainterna = 1;
$perfis = ["adm"];
include("home.php");
?>
<div style="padding-left: 5%; padding-right: 5%;">
	<div class="center-align">
		<h3>Clientes</h3>
	</div>
	<nav style="padding-left: 20px; border-radius: 10px;">
		<div class="nav-wrapper">
			<div class="col s12">
				<a href="home.php" class="breadcrumb">Home</a>
				<span class="breadcrumb">Clientes</span>
			</div>
		</div>
	</nav>
	<br />
	<a href="./adm_client_new.php" class="btn">Cadastrar</a>
	<br /><br />
	<?php
	include_once "./conf/connection.php";
	$sql = "select
				u.id as id,
				u.nome,
				u.data_nascimento,
				u.cpf,
				u.rg,
				u.telefone,
				u.email,
                count(e.id_usuario) as cont
			from usuario u
            	left outer join endereco e on e.id_usuario = u.id
			where 
				perfil = 'cli'
			group by u.id";
	$result = mysqli_query($conn, $sql);

	?>
	<table class="responsive-table highlight">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>CPF</th>
				<th>E-mail</th>
				<th>Visualizar</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
		</thead>
		<tbody>			
		<?php
			$cont = 0;
			$aux_cliente = null;
		    while($row = mysqli_fetch_assoc($result)) {
		    	$aux_cliente = $row;
		    	
		    	$descricao_modal = "<b>Nome : </b>" . utf8_encode($row['nome']) . " <br />
									<b>Data de nascimento : </b>" . $row['data_nascimento'] . " <br />
									<b>CPF : </b>" . $row['cpf'] . " <br />
									<b>RG : </b>" . $row['rg'] . " <br />
									<b>Telefone : </b>" . $row['telefone'] . " <br />
									<b>E-mail : </b>" . $row['email'] . " <br />";

				$sql2 = "select
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
						where id_usuario = '" . $row['id'] . "'";
				
				$query2 = mysqli_query($conn, $sql2);

				$descricao_modal .= "<h5 class='center-align'>Endereço(s)</h5>";

				$aux_endereco = null;

				while($row2 = mysqli_fetch_assoc($query2)) {
					$aux_endereco = $row2;
					$cont2 = 1;
					$descricao_modal .= "<br /><hr />
										<b>Estado : </b>" . utf8_encode(ucwords(strtolower($row2['estado']))) .  " <br />
	    								<b>Cidade : </b>" . utf8_encode(ucwords(strtolower($row2['cidade']))) .  " <br />
										<b>bairro : </b>" . utf8_encode($row2['bairro']) .  " <br />
										<b>Rua : </b>" . utf8_encode($row2['rua']) .  " <br />
										<b>Número : </b>" . $row2['numero'] .  " <br />
										<b>Complemento : </b>" . utf8_encode($row2['complemento']) .  " <br />";
					$cont2++;
				}

				if(!isset($aux_endereco)){

					$descricao_modal .=  "Nenhum endereço cadastrado.";
				}

		    	echo '<tr>
		    			<td>' . $row['id'] . '</td>
						<td>' . utf8_encode($row['nome']) . '</td>
						<td>' . $row['cpf'] . '</td>
						<td>' . $row['email'] . '</td>';
						?>
						<td>
							<a href="#modal<?php echo $cont; ?>" class="modal-trigger" ><i class="material-icons">search</i></a>
						</td>
						<td>
							<a href="adm_client_edit.php?id=<?php echo $row['id']; ?>"><i class="material-icons">edit</i></a>
						</td>
						<?php

						if($row['cont'] == 0){
						?>
							<td><a href="#" onclick='msgDelete(<?php echo $row['id']; ?>);'><i class="material-icons">delete</i></a></td>
						<?php
						}else{
						?>
							<td><a href="#" onclick='msgNaoDeletar();'><i class="material-icons">delete</i></a></td>
						<?php
						}
				echo '</tr>';

				modal($cont, "Cliente", $descricao_modal);
				$cont++;
		    }
			mysqli_close($conn);
		
			if(!isset($aux_cliente)){
				echo "<tr><td colspan='7'>Nenhum cliente cadastrado.</td></tr>";
			}
		?>
		<tbody>
	</table>

	<script type="text/javascript">
		function msgDelete(codigo){
			return swal({						 
				  text: "Realmente deseja apagar?",
				  buttons: ["Cancelar", "Apagar"],
				  dangerMode: true,
			}).then((willDelete) => {
			  if (willDelete) {
			  	console.log("redirect");
			    window.location = "adm_client_del.php?id=" + codigo;
			  }
			});
		}

		function msgNaoDeletar(){
			return swal("Não pode ser apagado por que há endereço cadastrado para esse usuário!", "Apague o endereço e tente excluir o usuário novamente.").then((value) => { });
		}
	</script>
</div>

<?php include("footer.php"); ?>

<?php 
	function modal($id, $titulo, $detalhe){
		echo '
		<div id="modal' . $id . '" class="modal">
			<div class="modal-content">
				<h5 class="center-align">' . nl2br($titulo) . '</h5>
				<hr />
				<p>' . nl2br($detalhe) . '</p>
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
			</div>
		</div>';
	}
?>