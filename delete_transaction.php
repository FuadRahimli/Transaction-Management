<?php include("database_connection.php"); 

	$get_id=$_GET['id'];
	$trans_del="DELETE FROM `transactions` WHERE idTransaction=$get_id";
	$con_db->query($trans_del);
	header("Location: transactions.php");
?>