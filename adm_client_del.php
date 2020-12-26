<?php
session_start();

$id = $_GET["id"];

include_once "./conf/connection.php";

$sql = "delete from usuario where id = '" . $id . "'";
mysqli_query($conn, $sql);

?>
<script type="text/javascript">
	window.location = "adm_client.php";
</script>
<?php
?>