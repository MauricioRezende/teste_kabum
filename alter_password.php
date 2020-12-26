<?php
$paginainterna = 1;
$perfis = ["adm","cli"];
include("home.php");
?>
<div style="padding-left: 5%; padding-right: 5%;">
	<div class="center-align">
		<h3>Alterar senha</h3>
	</div>
	<form method="POST" action="">
		<div class="row">
			<div class="input-field col l6 m6 s12">
				<label for="senha">Senha</label>
				<input  id="senha" name="senha" type="password" class="">
			</div>
			<div class="input-field col l6 m6 s12">
				<label for="confirmar_senha">Confirmar senha</label>
				<input  id="confirmar_senha" name="confirmar_senha" type="password" onchange="validar_senha()">
			</div>
			<div class="right-align">
				<button class="btn" type="submit" id="botao" name="alterar">Alterar</button>
				<a href="./home.php" class="btn" style="background-color: gray !important; ">Voltar</a>
			</div>
		</div>
		<?php
		if(isset($_POST["alterar"])){
			$erro = array();
			if($_POST["senha"] == ""){
				array_push($erro,"Preencha o campo senha.");
			}
			if($_POST["confirmar_senha"] == ""){
				array_push($erro,"Preencha o campo Confirmar senha.");
			}
			if(isset($_POST["senha"]) && isset($_POST["confirmar_senha"])){
				if($_POST["senha"] != $_POST["confirmar_senha"]){
					array_push($erro,"As senhas precisam ser iguais.");		
				}
			}

			if(sizeof($erro) > 0){
				for ($i=0; $i < sizeof($erro); $i++) {
					echo '<br />
						<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
						' . $erro[$i] . '
			            </div>';
				}
			}else{
				include_once "./conf/connection.php";
				$sql = "update usuario set senha = '" . md5($_POST["senha"]) . "' where id = '" . $_SESSION["id"] . "'";

				mysqli_query($conn, $sql);

				mysqli_close($conn);

				?>
			    <script type="text/javascript">
			    	swal({						 
						  text: "Alterado com sucesso!",
					}).then((click) => {
					  if (click) {
					    window.location = "home.php";
					  }
					});
			    </script>
			    <?php
			}
		}
		?>
	</form>
</div>
<?php include("footer.php"); ?>