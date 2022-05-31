
<link rel="stylesheet" type="text/css" href="edit_transaction.css"> 
<?php include("database_connection.php") ?>
<?php 	
	$id=$_GET['id'];
	$query="SELECT *
	FROM `transactions`,`payments`,`categories` 
	WHERE transactions.idCategory=categories.idCategory AND transactions.idPayment=payments.idPayment AND idTransaction=$id";
	$result=$con_db->query($query);
	while($conc=$result->fetch_assoc())
	{
		extract($conc);
	}
	$selected_category=$category;
	$selected_payment=$paymentMethod;
	?>
<div class=editimage>
	<strong class="header">Edit your transaction</strong>
<form method="POST">
          
         <strong type="amount">Amount of money:</strong>	
        <?php
		echo "<input type='Number' name='money' step='0.01' value='$transactionAmount'><br><br>";
		echo "<strong>Category:</strong> <select name='category'>";
				$qeury_c="SELECT * FROM `categories` ORDER BY `idCategory` ASC";
				$ccategory=$con_db->query($qeury_c);
				while($conc=$ccategory->fetch_assoc())
				{
					extract($conc);
					if($category==$selected_category){
						echo "<option selected value='$idCategory'>$category</option>";
					}
					else
					{
						echo "<option value='$idCategory'>$category</option>";
					}
				}
			?>
		</select><br><br>
		<strong type="payment">Payment method:</strong> 
		<select name="method">
			<?php
				$qeury_p="SELECT * FROM `payments`";
				$payment=$con_db->query($qeury_p);
				while($conc=$payment->fetch_assoc())
				{
					extract($conc);
					if($selected_payment=$paymentMethod)
					{
						echo "<option selected value='$idPayment'>$paymentMethod</option>";
					}
					else
					{
						echo "<option value='$idPayment'>$paymentMethod</option>";
					}
				}
			?>
		<select><br><br>
		<strong type="date">Date:</strong><br> 
		<?php echo "<input id='date' type='date' name='date' value=$transactionDate><br><br>"?>
		<input  type="submit" name="edit" value="Edit">
	</form>
</div>
	<?php
		if(isset($_POST['edit']))
		{
			$amount=$con_db->real_escape_string($_POST['money']);
			$category=$con_db->real_escape_string($_POST['category']);
			$payment=$con_db->real_escape_string($_POST['method']);
			$date=$con_db->real_escape_string($_POST['date']);
			//edit edir
			$sql="
			UPDATE `transactions` 
			SET `transactionAmount` = '$amount', `transactionDate` = '$date',`idCategory`='$category',`idPayment`='$payment' 
			WHERE `transactions`.`idTransaction` = $idTransaction;";
			$con_db->query($sql);
			header('Location:transactions.php');
		}
	?>