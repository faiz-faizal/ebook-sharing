<?php include './template/header.php'; 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ebooksharing";

//create connection
$conn= mysqli_connect($servername,$username,$password,$dbname);

$query = "SELECT* FROM FEEDBACK";
$result = mysqli_query($conn, $query);

if ($result) //true
{
	//echo "success";
	//$fetch = mysqli_fetch_array($qr);
}

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="container">
<h4>Feedback From The Users</h4>
<table class="table table-striped">
<thead>
	<tr>
		<th>NAME</th>
		<th>EMAIL</th>
		<th>MESSAGE</th>
		<th>ACTION</th>
	</tr>
</thead>

<?php 
	while($row = mysqli_fetch_array($result))
	{
		$nme = $row['FED_NAME'];
		$emil = $row['FED_EMAIL'];
		$mssg = $row['FED_MSG'];

		?>
		<tbody>
			<tr>
				<td><?php echo $nme ?></td>
				<td><?php echo $emil ?></td>
				<td><?php echo $mssg ?></td>
				<td><a class="btn btn-warning" href="delete.php?X=<?php echo $emil ?>">Delete</a></td>
				
			</tr>
		</tbody>
<?php	}
?>	


</table>

<?php include './template/footer.php'; ?>