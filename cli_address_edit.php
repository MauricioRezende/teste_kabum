<?php
$paginainterna = 1;
$perfis = ["cli"];
include("home.php");

include_once "./conf/connection.php";

$sql = "select
			id,
			id_usuario,
			id_cidade,
			id_estado,
			bairro,
			rua,
			numero,
			complemento
		from endereco
		where 
			id = '" . $_GET["id"] . "'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
	$id = $row['id'];
	$id_usuario = $row['id_usuario'];
	$id_cidade = $row['id_cidade'];
	$id_estado = $row['id_estado'];
	$bairro = utf8_encode($row['bairro']);
	$rua = utf8_encode($row['rua']);
	$numero = $row['numero'];
	$complemento = utf8_encode($row['complemento']);
}

?>

<div style="padding-left: 5%; padding-right: 5%;">
	<div class="center-align">
		<h3>Editar endereço</h3>
	</div>
	<form class="col s12" method="POST" action="">
		<div class="row">
			<div class="col l6 m6 s12">
				<label for="estado">Estado:</label>
				<select name="estado" id="estado" class="browser-default">
					<option value=""></option>
					<?php
						
						$sql = "select
									id_estado,
									sigla,
									nome
								from estado
								order by sigla";
						$res = mysqli_query($conn, $sql);
						while ( $row = mysqli_fetch_assoc( $res ) ) {
							if($row["id_estado"] == $id_estado){
								echo '<option value="'.$row['id_estado'].'" selected>'. utf8_encode(ucwords(strtolower($row['nome']))).'</option>';
							}else{
								echo '<option value="'.$row['id_estado'].'">'. utf8_encode(ucwords(strtolower($row['nome']))).'</option>';
							}
							
						}
					?>
				</select>
			</div>
			<div class="col l6 m6 s12">
				<label for="">Cidade:</label>
				<select name="cidade" id="cidade" class="browser-default">
					<?php
						$sql = "select
									id_cidade,
									nome
								from cidade
								where id_cidade = '" . $id_cidade . "'";
						$res = mysqli_query($conn, $sql);
						while ( $row = mysqli_fetch_assoc( $res ) ) {
							echo '<option value="'.$row['id_cidade'].'">'. utf8_encode(ucwords(strtolower($row['nome']))).'</option>';
						}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="input-field col l6 m6 s12">
				<label for="bairro">Bairro</label>
				<input  id="bairro" name="bairro" type="text" class="" autocomplete="off" maxlength="150" value="<?php if(isset($_POST["bairro"])){echo $_POST["bairro"]; }else{ echo $bairro; }?>">
			</div>
			<div class="input-field col l6 m6 s12">
				<label for="rua">Rua</label>
				<input  id="rua" name="rua" type="text" class="" autocomplete="off" maxlength="150" value="<?php if(isset($_POST["rua"])){echo $_POST["rua"]; }else{ echo $rua; }?>">
			</div>
			<div class="input-field col l6 m6 s12">
				<label for="numero">Número</label>
				<input  id="numero" name="numero" type="number" class="" autocomplete="off" value="<?php if(isset($_POST["numero"])){echo $_POST["numero"]; }else{ echo $numero; }?>" maxlength="5">
			</div>
			<div class="input-field col l6 m6 s12">
				<label for="complemento">Complemento</label>
				<input  id="complemento" name="complemento" type="text" maxlength="10" class="" autocomplete="off" value="<?php if(isset($_POST["complemento"])){echo $_POST["complemento"]; }else{ echo $complemento; }?>" maxlength="16">
			</div>
		</div>
		<?php
			if(isset($_POST["alterar"])){
				$erro = array();
				if($_POST["estado"] == ""){
					array_push($erro,"Preencha o campo Estado.");
				}
				if($_POST["cidade"] == ""){
					array_push($erro,"Preencha o campo Cidade.");
				}
				if($_POST["bairro"] == ""){
					array_push($erro,"Preencha o campo Bairro.");
				}
				if($_POST["rua"] == ""){
					array_push($erro,"Preencha o campo Rua.");
				}
				if($_POST["numero"] == ""){
					array_push($erro,"Preencha o campo Número.");
				}

				if(sizeof($erro) > 0){
					for ($i=0; $i < sizeof($erro); $i++) {
						echo '<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
								' . $erro[$i] . '
					            </div><br />';
					}
				}else{
					
					$sql = "update endereco set
								id_cidade = '" . $_POST["cidade"] . "',
								id_estado = '" . $_POST["estado"] . "',
								bairro = '" . utf8_decode($_POST["bairro"]) . "',
								rua = '" . utf8_decode($_POST["rua"]) . "',
								numero = '" . $_POST["numero"] . "',
								complemento = '" .utf8_decode($_POST["complemento"]) . "'
							where
								id = '" . $_GET["id"] . "';";
					
					mysqli_query($conn, $sql);
					?>
				    <script type="text/javascript">
						swal("Alterado com sucesso!").then((click) => {
						  if (click) {
						    window.location = "cli_address.php";
						  }
						});
				    </script>
				    <?php
				}
			}
		?>
		<div id="erro"></div>
		<div class="right-align">
			<button class="btn" type="submit" id="botao" name="alterar">Alterar</button>
			<a href="./cli_address.php" class="btn" style="background-color: gray;">Voltar</a>
		</div>
	</form>
	<div class="row"></div>
</div>

<?php include("footer.php"); ?>