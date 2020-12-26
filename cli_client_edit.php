<?php
$paginainterna = 1;
$perfis = ["cli"];
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
			id = '" . $_SESSION["id"] . "'";
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
?>

<div style="padding-left: 5%; padding-right: 5%;">
	<div class="center-align" >
		<h3>Alterar dados</h3>
	</div>
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

				$cpf =str_replace(".", "", str_replace("-", "", $_POST["cpf"]));

			    $sql = "select nome, perfil, cpf from usuario where replace(replace(cpf,'.',''),'-','') = '" . $cpf . "' and id <> '" . $_SESSION["id"] . "'";
			    
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
								telefone = '" . $_POST["telefone"] . "'
								where ID = '" . $_SESSION["id"] . "'";
					mysqli_query($conn, $sql);
					?>
				    <script type="text/javascript">
						swal("Alterado com sucesso!").then((click) => {
						  if (click) {
						    window.location = "home.php";
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
			<a href="./home.php" class="btn" style="background-color: gray;">Voltar</a>
		</div>
	</form>
	<div class="row"></div>
</div>
<?php include("footer.php"); ?>