
<?php include('include/connection.php') ?>


<!DOCTYPE html>
<html>
<head>
	<title>Approval list..</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
</head>
<body>
	<div class="container" style="margin-top: 100px;">
			<h3 class="error-msg"><?php include('include/message.php'); ?></h3>
	
<?php
	$sql = "SELECT * FROM tem2";
	$result = $con->query($sql);
	if($result-> num_rows > 0 ){//Return the number of rows in result set
		while ($row = $result-> fetch_assoc()){//Fetch a result row as an associative array
			echo "
		<table class=\"table\">
		<tr>
			<th>Supplier Id</th>
			<th>Supplier Name</th>
			<th>Location</th>
			<th>Email</th>
			<th>Contact number</th>
			<th>Credit Period</th>
			<th>Remove</th>
			<th></th>
		</tr>


				<tr>
					<td>".$row['supplier_id']."</td>
					<td>".$row['supplier_name']."</td>
					<td>".$row['location']."</td>
					<td>".$row['email']."</td>
					<td>".$row['contact_no']."</td>
					<td>".$row['credit_period_allowed']."</td>
					<td>
								<form method=\"post\">
									<input type=\"hidden\" value=".$row['supplier_id']." name=\"remove\">
									<input class=\"btn btn-info\" type=\"submit\" name=\"del\" value=\"Yes\">
								</form>

					</td>
					<td>
								<form method=\"post\">
									<input type=\"hidden\" value=".$row['supplier_id']." name=\"rem\">
									<input class=\"btn btn-danger\" type=\"submit\" name=\"no\" value=\"No\">
								</form>

					</td>
				</tr>";
		}
	}else{
		echo "<script>alert('No Pending !')</script>";
	}
	
	
?>	
</table>
	</div>
</body>
</html>
<?php 
if (isset($_POST['del'])) {
	$sid = $_POST['remove'];
	//delete query from tem2 table
	$delete_query ="DELETE FROM tem2 WHERE supplier_id = '$sid' ";
	//Perform queries
	$delete_result = mysqli_query($con,$delete_query);

	$s_id = $_POST['remove'];
	//delete query from supplier table
	$delete_query2 ="DELETE FROM supplier WHERE supplier_id = '$s_id' ";
	//Perform queries
	$delete_result2 = mysqli_query($con,$delete_query2);

	if ($delete_result2) {
		echo "<script>alert('Decline Successfully')</script>";
		echo "<script>window.open('approvalListRemove.php','_self')</script>";
	}
	}

if (isset($_POST['no'])) {
	$id = $_POST['rem'];
	$no_query ="DELETE FROM tem2 WHERE supplier_id = '$id' ";
	$no_result = mysqli_query($con,$no_query);

	if ($no_result) {
		echo "<script>alert('Not Deleted')</script>";
		echo "<script>window.open('approvalListRemove.php','_self')</script>";
	}
}

?>
