<ul id="slide-out" class="sidenav sidenav-fixed">
	<li>
		<div class="user-view center-align">
			<img src="img/avatar.png" alt="avatar" class="responsive-img" style="max-height: 150px;">
		</div>
	</li>
	<li>
		<div class="center-align" >
			<b><?php echo $_SESSION["nome"]; ?></b>
		</div>
	</li>
	<li><div class="divider"></div></li>
	<li>
		<div class="center-align">
			<a class="subheader" style="color:black;"><b>Menu</b></a>		
		</div>
	</li>
	<li><a class="waves-effect" href="alter_password.php">Alterar senha</a></li>
	<li><a class="waves-effect" href="adm_client.php">Clientes</a></li>
	<li><a class="waves-effect" href="logout.php">Sair</a></li>
</ul>
<nav>
	<a href="#" id="nav-menu" data-target="slide-out" class="sidenav-trigger"><i class="material-icons" style="color:white;">menu</i></a>
	<div class="center-align" style="font-size: 25px;">
		Teste kabum!
	</div>
</nav>
