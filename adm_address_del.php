<?php
session_start();

$id = $_GET["id"];
$id_cliente = $_GET["idc"];

include_once "./conf/connection.php";

$sql = "delete from endereco where id = '" . $id . "'";
mysqli_query($conn, $sql);

?>
<script type="text/javascript">
	window.location = "adm_client_edit.php?id=<?php echo $id_cliente; ?>";
</script>
<?php
?>