<?php
	$host='localhost';
	$user='root';
	$password='';
	$database='homework';

	$con_db=new mysqli($host,$user,$password,$database);

	if($con_db->connect_errno)
	{
		echo "Error:".$con_db->errno." Message:".$con_db->error;
		exit();
	}
?>