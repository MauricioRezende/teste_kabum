<?php
if($_SESSION['perfil'] == "adm"){
	include("menu_adm.php");
}else if($_SESSION['perfil'] == "cli"){
	include("menu_cli.php");
}

if(isset($paginainterna) && $paginainterna == 0){
	include("footer.php");
}else if(!isset($paginainterna)){
	include("footer.php");
}
?>