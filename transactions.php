<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="transactions.css">     
    <meta charset="utf-8">
   
</head>

</html>
<?php include("database_connection.php"); ?>
<h3> My Budget: </h3>
	<div class="general">
	<table class="title" id='shortlist'>
		<thead>
		<tr>
			 <th>ID Transaction</th>
			 <th>Amount of money</th>
			 <th>Date</th>
			 <th>Category</th>
			 <th>Payment Method</th>	
			 <th></th>
			 <th></th>
		</tr>
	</thead>
	<tbody>
	<?php  
	
		$display_table="
			 SELECT *
			 FROM `transactions`,`payments`,`categories`,`accounting` WHERE transactions.idCategory=categories.idCategory 
			 AND transactions.idPayment=payments.idPayment 
			 AND categories.idAccounting=accounting.idAccounting";
		 $display_result = $con_db->query($display_table);
		 $total=0;
		 while ($conc=$display_result->fetch_assoc())
		{
					extract($conc);
					$total=$total+$transactionAmount*$multiplierCoefficient;

					echo 
					"<tr>
					<td>$idTransaction</td>
					<td>$transactionAmount</td>
					<td>$transactionDate</td>
					<td>$category</td>
					<td>$paymentMethod</td>
					<td><div class='button_cont' align='center'><a class='edit' href='edit_transaction.php?id=$idTransaction' name='edit' class='button' target='_blank' rel='nofollow noopener'>Edit</a></div></td>
					<td><div class='button_cont' align='center'><a class='example_c delete' href='delete_transaction.php?id=$idTransaction' name='delete' rel='nofollow noopener'>Delete</a></div></td>
					</tr>";
		}
		echo "<h2>Money left: $total</h2>";
	?>
<div class="container">
	<ul>
	<li><a href="new_transaction.php"><button class="btn">Add new transaction</button>
</div></a></li>
</ul>
</div>
	</table>
	<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script> 
   $(function(){
   $("#shortlist").dataTable();
  })
</script>
</tbody>