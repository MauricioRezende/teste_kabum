<?php
$paginainterna = 1;
$perfis = ["adm"];
include("home.php");

include_once "./conf/connection.php";

$sql = "select
			id,
			nome,
			data_nascimento,
			cpf,
			rg,
			telefone,
			id_endereco,
			email,
			perfil
		from usuario
		where 
			perfil = 'cli' and
			id = '" . $_GET["id"] . "'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
	$id = $row['id'];
	$nome = utf8_encode($row['nome']);
	$data_nascimento = $row['data_nascimento'];
	$cpf = $row['cpf'];
	$rg = $row['rg'];
	$telefone = $row['telefone'];
	$id_endereco = $row['id_endereco'];
	$email = $row['email'];
}
// mysqli_close($conn);

?>
<div style="padding-left: 5%; padding-right: 5%;">
	<div class="center-align" >
		<h3>Editar cliente</h3>
	</div>
	<nav style="padding-left: 20px; border-radius: 10px;">
		<div class="nav-wrapper">
			<div class="col s12">
				<a href="home.php" class="breadcrumb">Home</a>
				<a href="adm_client.php" class="breadcrumb">Clientes</a>
				<span class="breadcrumb">Editar</span>
			</div>
		</div>
	</nav>
	<br />
	<form class="col s12" method="POST" action="">
		<div class="row">
			<div class="input-field col l6 m6 s12">
				<label for="nome">Nome</label>
				<input  id="nome" name="nome" type="text" class="" autocomplete="off" value="<?php if(isset($_POST["nome"])){echo $_POST["nome"]; }else{ echo $nome; }?>">
			</div>
			<div class="input-field col l6 m6 s12">
				<label for="email">E-mail</label>
				<input  id="email" name="email" type="text" class="" autocomplete="off" value="<?php echo $email; ?>" disabled>
			</div>
			<div class="input-field col l6 m6 s12">
				<label for="cpf">CPF</label>
				<input  id="cpf" name="cpf" type="text" class="" autocomplete="off" maxlength="14" value="<?php if(isset($_POST["cpf"])){echo $_POST["cpf"]; }else{ echo $cpf; }?>">
			</div>
			<div class="input-field col l6 m6 s12">
				<label for="rg">RG</label>
				<input  id="rg" name="rg" type="text" class="" autocomplete="off" maxlength="13" value="<?php if(isset($_POST["rg"])){echo $_POST["rg"]; }else{ echo $rg; }?>">
			</div>
			<div class="input-field col l6 m6 s12">
				<label for="telefone">Telefone</label>
				<input  id="telefone" name="telefone" type="text" class="" autocomplete="off" value="<?php if(isset($_POST["telefone"])){echo $_POST["telefone"]; }else{ echo $telefone; }?>" maxlength="12">
			</div>
			<div class="input-field col l6 m6 s12">
				<label for="data_nascimento">Data nascimento</label>
				<input  id="data_nascimento" name="data_nascimento" type="text" maxlength="10" class="" autocomplete="off" value="<?php if(isset($_POST["data_nascimento"])){echo $_POST["data_nascimento"]; }else{ echo $data_nascimento; }?>" maxlength="16">
			</div>
			<div class="input-field col l6 m6 s12">
				<label for="senha">Senha</label>
				<input  id="senha" name="senha" type="password" class="">
			</div>
			<div class="input-field col l6 m6 s12">
				<label for="confirmar_senha">Confirmar senha</label>
				<input  id="confirmar_senha" name="confirmar_senha" type="password" onchange="validar_senha()">
			</div>
			<p>* Se não preencher os campos de senha ela não será alterada.</p>
		</div>
		<?php
			if(isset($_POST["alterar"])){
				$erro = array();
				if($_POST["nome"] == ""){
					array_push($erro,"Preencha o campo Nome.");
				}
				if($_POST["data_nascimento"] == ""){
					array_push($erro,"Preencha o campo Nome.");
				}
				if($_POST["cpf"] == ""){
					array_push($erro,"Preencha o campo CPF.");
				}
				if($_POST["rg"] == ""){
					array_push($erro,"Preencha o campo RG.");
				}
				if($_POST["telefone"] == ""){
					array_push($erro,"Preencha o campo Telefone.");
				}
				if(isset($_POST["senha"]) && isset($_POST["confirmar_senha"])){
					if($_POST["senha"] != $_POST["confirmar_senha"]){
						array_push($erro,"As senhas precisam ser iguais.");		
					}
				}

				$cpf =str_replace(".", "", str_replace("-", "", $_POST["cpf"]));

			    $sql = "select NOME, PERFIL, CPF from USUARIO where REPLACE(REPLACE(CPF,'.',''),'-','') = '" . $cpf . "' and ID <> '" . $_GET["id"] . "'";
			    
			    $result = mysqli_query($conn, $sql);

			    while($row = mysqli_fetch_assoc($result)) {
			        $results = $row;
			    }

			    if(isset($results)) {
			    	array_push($erro,"CPF já cadastrado.");
			    }

				if(sizeof($erro) > 0){
					for ($i=0; $i < sizeof($erro); $i++) {
						echo '<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
								' . $erro[$i] . '
					            </div><br />';
					}
				}else{
					$sql = "update usuario set
								nome = '" . utf8_decode($_POST["nome"]) . "',
								data_nascimento = '" . $_POST["data_nascimento"] . "',
								cpf = '" . $_POST["cpf"] . "',
								rg = '" . $_POST["rg"] . "',
								telefone = '" . $_POST["telefone"] . "',
								data_hora = CURRENT_TIMESTAMP ";

								if(isset($_POST["senha"]) && $_POST["senha"] != "" && isset($_POST["confirmar_senha"]) && $_POST["confirmar_senha"] != ""){
									$sql .= ", senha = '" . md5($_POST["senha"]) . "'";
								}	

					$sql .=	"where ID = '" . $_GET["id"] . "'";
					mysqli_query($conn, $sql);
					?>
				    <script type="text/javascript">
						swal("Alterado com sucesso!").then((click) => {
						  if (click) {
						    window.location = "adm_client.php";
						  }
						});
				    </script>
				    <?php
				}
			}
		?>
		<div id="erro"></div>
		<div class="right-align">
			<button class="btn" type="submit" id="edit_client" name="alterar">Alterar</button>
			<a href="./adm_client.php" class="btn" style="background-color: gray;">Voltar</a>
		</div>
	</form>
	<div class="center-align" >
		<h3>Endereço</h3>
	</div>
	<a href="./adm_address_new.php?id=<?php echo $_GET["id"]; ?>" class="btn">Cadastrar</a>
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
			where id_usuario = '" . $_GET["id"] . "'";
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
							<a href="adm_address_edit.php?id=<?php echo $results['id']; ?>&idc=<?php echo $_GET["id"]; ?>"><i class="material-icons">edit</i></a>
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
		    window.location = "adm_address_del.php?id=" + codigo + "&idc=<?php echo $_GET["id"]; ?>";
		  }
		});
	}
</script>