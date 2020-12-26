<!DOCTYPE html>
<html>
	<head>
	  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	  	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
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

			input.valid[type=password]:not(.browser-default){
				border-bottom: 1px solid #f25200;
			    -webkit-box-shadow: 0 1px 0 0 #f25200;
			    box-shadow: 0 1px 0 0 #f25200;
			}

			input.valid[type=text]:not(.browser-default){
				border-bottom: 1px solid #f25200;
			    -webkit-box-shadow: 0 1px 0 0 #f25200;
			    box-shadow: 0 1px 0 0 #f25200;
			}

			.btn{
				background: linear-gradient(0deg,#f25200 17%,#ff7630 49%,#ff8d05 54%,#ff9605 95%);
				font-weight: bolder;
			}
		</style>	
		<div class="container">
			<div class="container" style="padding-top: 15%;">
				<div class="container" style="border: solid 2px gray; border-radius: 20px; padding: 30px;">
					<form class="col s12" action="login.php" method="POST">
						<div class="row">
							<div class="center-align" style="font-size:25px;">Teste Kabum!</div>
							<div class="input-field col l12 m12 s12" >
								<i class="material-icons prefix" style="color:gray;">account_circle</i>
								<input id="usuario" name="usuario" type="text" class="validate">
								<label for="usuario">Usuário</label>
							</div>
							<div class="input-field col l12 m12 s12">
								<i class="material-icons prefix" style="color:gray;">lock</i>
								<input id="senha" name="senha" type="password" class="validate">
								<label for="senha">Senha</label>
							</div>
							<div class="input-field col l12 m12 s12 right-align">
								<button class="waves-effect waves-light btn">Entrar</button>
								<a href="cli_client_new.php" class="btn" style="background-color: #1e88e5;">CADASTRE-SE</a>
							</div>
						</div>
					</form>
					<?php 
					if(isset($_GET["erro"]) && $_GET["erro"] == 1){
				        echo '<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
								Usuário ou senha incorreto!
				             </div>';
					}elseif(isset($_GET["erro"]) && $_GET["erro"] == 2){
				        echo '<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
								Sua sessão expirou, faça login novamente!
				             </div>';
					}elseif(isset($_GET["erro"]) && $_GET["erro"] == 3){
				        echo '<div style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; border-radius: 5px; padding: 10px;">
								Acesso negado!
				             </div>';
					}
					?>
				</div>
			</div>
		</div>
	  	<script type="text/javascript" src="js/materialize.min.js"></script>
	</body>
</html>
