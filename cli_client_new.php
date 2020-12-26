<!DOCTYPE html>
<html lang="pt-br">
  	<head>
  		<?php header('Content-type: text/html; charset=UTF-8'); ?>
	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	  	<script src="js/sweetalert.min.js"></script>
	  	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	    <title>Teste Kabum</title>
  	</head>
  	<body>
  		<style>

			header, body {
				background: linear-gradient(100deg,rgba(238,244,255,0) .47%,rgba(84,110,164,.2) 99.53%);
			}
			html{
				color:  gray;
			}
			.input-field input[type=text]:focus{
				border-bottom:1px solid #f25200 !important;
			    box-shadow: 0 1px 0 0 #f25200 !important;
			}

			.input-field input[type=password]:focus{
				border-bottom:1px solid #f25200 !important;
			    box-shadow: 0 1px 0 0 #f25200 !important;
			}
			input[type=text]:not(.browser-default):focus:not([readonly])+label{
				color: gray !important;
			}

			input[type=password]:not(.browser-default):focus:not([readonly])+label{
				color: gray !important;
			}
			.btn{
				background: linear-gradient(0deg,#f25200 17%,#ff7630 49%,#ff8d05 54%,#ff9605 95%);
				font-weight: bolder;
			}
			button:disabled {
			  	background: #dddddd;
			}
			.swal-button{
				background-color: #f25200 !important;
			}
		</style>
		<div class="container" style="padding-top: 5%;">
			<div class="container" style="border: solid 2px gray; border-radius: 20px; padding: 30px;">
				<div style="font-size: 25px;" class="center-align">Cadastro de cliente</div>
				<form class="col s12" method="POST" action="">
					<div class="row">
						<div class="input-field col l6 m6 s12">
							<label for="nome">Nome</label>
							<input  id="nome" name="nome" type="text" class="" autocomplete="off" value="<?php if(isset($_POST["nome"])){echo $_POST["nome"]; }?>">
						</div>
						<div class="input-field col l6 m6 s12">
							<label for="email">E-mail</label>
							<input  id="email" name="email" type="text" class="" autocomplete="off" value="<?php if(isset($_POST["email"])){echo $_POST["email"]; }?>">
						</div>
						<div class="input-field col l6 m6 s12">
							<label for="cpf">CPF</label>
							<input  id="cpf" name="cpf" type="text" class="" autocomplete="off" onchange="validar_cpf();" onclick="validar_cpf()" maxlength="14" value="<?php if(isset($_POST["cpf"])){echo $_POST["cpf"]; }?>">
						</div>
						<div class="input-field col l6 m6 s12">
							<label for="rg">RG</label>
							<input  id="rg" name="rg" type="text" class="" autocomplete="off" maxlength="13" value="<?php if(isset($_POST["rg"])){echo $_POST["rg"]; }?>">
						</div>
						<div class="input-field col l6 m6 s12">
							<label for="telefone">Telefone</label>
							<input  id="telefone" name="telefone" type="text" class="" autocomplete="off" value="<?php if(isset($_POST["telefone"])){echo $_POST["telefone"]; }?>" maxlength="16">
						</div>
						<div class="input-field col l6 m6 s12">
							<label for="data_nascimento">Data nascimento</label>
							<input  id="data_nascimento" name="data_nascimento" type="text" maxlength="10" class="" autocomplete="off" value="<?php if(isset($_POST["data_nascimento"])){echo $_POST["data_nascimento"]; }?>" maxlength="16">
						</div>
						<div class="input-field col l6 m6 s12">
							<label for="senha">Senha</label>
							<input  id="senha" name="senha" type="password" class="">
						</div>
						<div class="input-field col l6 m6 s12">
							<label for="confirmar_senha">Confirmar senha</label>
							<input  id="confirmar_senha" name="confirmar_senha" type="password" onchange="validar_senha()">
						</div>
					</div>
					<?php
						if(isset($_POST["cadastrar"])){
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
							if($_POST["email"] == ""){
								array_push($erro,"Preencha o campo E-mail.");
							}
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

							$cpf =str_replace(".", "", str_replace("-", "", $_POST["cpf"]));
    
						    include_once "./conf/connection.php";
						    $sql = "select nome, perfil, cpf from usuario where replace(replace(cpf,'.',''),'-','') = '" . $cpf . "'";
						    
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
								$sql = "insert into usuario (nome,data_nascimento,cpf,rg,telefone,email,senha,perfil) 
										values(	'" . utf8_decode($_POST["nome"]) . "',
												'" . $_POST["data_nascimento"] . "',
												'" . $_POST["cpf"] . "',
												'" . $_POST["rg"] . "',
												'" . $_POST["telefone"] . "',
												'" . $_POST["email"] . "',
												'" . md5($_POST["senha"]) . "',
												'cli');";
								mysqli_query($conn, $sql);
								?>
							    <script type="text/javascript">
									swal("Cadastrado com sucesso!", "Você já pode fazer login em nosso site.").then((click) => {
									  if (click) {
									    window.location = "index.php";
									  }
									});
							    </script>
							    <?php
							}
						}
					?>
					<div id="erro"></div>
					<div class="right-align">
						<button class="btn" type="submit" id="botao" name="cadastrar" disabled="disabled">Cadastrar</button>
						<a href="./index.php" class="btn" style="background-color: gray;">Voltar</a>
					</div>
				</form>
			</div>
		</div>
		<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
	  	<script type="text/javascript" src="js/materialize.min.js"></script>
		<script type="text/javascript" src="js/jquery.mask.js"></script>
		<script type="text/javascript" src="js/scripts.js"></script>
		<script>
			var inputs = $('input').on('keyup', verificar_inputs);
			function verificar_inputs() {
			    const preenchidos = inputs.get().every(({value}) => value)
			    $('button').prop('disabled', !preenchidos);
			}
		</script>	
  	</body>
</html>