
<?php include("database_connection.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Budget App</title>
	<link rel="stylesheet" type="text/css" href="new_transaction.css">  
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
	<div class="transactionsimage">
	<h3><a>New Transaction</a></h3>
	
	

	<form method="POST">
		 <strong type="amount" >Amount of money:</strong>
		 <input type="Number"  name="money" step="0.01"><br><br>
		 <strong type="category">Category:</strong>
		 <select name="category">
		 <?php
			$qeury_c="SELECT * FROM `categories` ORDER BY `idCategory` ASC";//butun cateqoriyalar
			$ccategory=$con_db->query($qeury_c);
			while($conc=$ccategory->fetch_assoc())
			{
				extract($conc);
				echo "<option value='$idCategory'>$category</option>";	
		     }
		?>
		</select><br><br>

		<strong type="payment">Payment method:</strong> 
		<select name="method">
		<?php
			$qeury_p="SELECT * FROM `payments`";//butun payment
			$payment=$con_db->query($qeury_p);
			while($conc=$payment->fetch_assoc())
			{
				extract($conc);
				echo "<option value='$idPayment'>$paymentMethod</option>";

			}
		?>
		<select>
		<strong type="date">Date:</strong><br> 
		<input id="date" type='date' name="date"><br><br>
		<input type="submit" name="add" value="Add">
	</form>

	<?php
		if(isset($_POST['add']))
			{
				$amount=$con_db->real_escape_string($_POST['money']);
				$category=$con_db->real_escape_string($_POST['category']);
				$method=$con_db->real_escape_string($_POST['method']);
				$date=$con_db->real_escape_string($_POST['date']);
				if($amount!='' && $date!='')
				{
					//add edir
					$query="INSERT INTO `transactions` (`transactionAmount`, `transactionDate`, `idCategory`, `idPayment`) VALUES ('$amount', '$date', '$category', '$method')";
					$con_db->query($query);
					header('Location: transactions.php');
					exit;
				}
				else
				{
					echo "Give Valid Data";

				}
				
			}
	?>
</div>
</body>

</html>