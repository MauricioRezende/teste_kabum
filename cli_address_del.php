<?php
session_start();

$id = $_GET["id"];

include_once "./conf/connection.php";

$sql = "delete from endereco where id = '" . $id . "'";
mysqli_query($conn, $sql);

?>
<script type="text/javascript">
	window.location = "cli_address.php";
</script>
<?php
?>