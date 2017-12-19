<?php include './template/header.php'; 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ebooksharing";

//create connection
$conn= mysqli_connect($servername,$username,$password,$dbname);

$query = "SELECT* FROM USERS";
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
<h4>Manage Users</h4>
<table class="table table-striped">
<thead>
	<tr>
		<th>MATRIC ID</th>
		<th>NAME</th>
		<th>USERNAME</th>
		<th>EMAIL</th>
		<th>ACTION</th>
	</tr>
</thead>

<?php 
	while($row = mysqli_fetch_array($result))
	{
		$id = $row['USER_ID'];
		$nme = $row['USER_FNAME'];
		$usrn = $row['USER_USERN'];
		$email = $row['USER_EMAIL'];

		?>
		<tbody>
			<tr>
				<td><?php echo $id ?></td>
				<td><?php echo $nme ?></td>
				<td><?php echo $usrn ?></td>
				<td><?php echo $email ?></td>
				<td><a class="btn btn-warning" href="deleteUsers.php?X=<?php echo $id ?>">Delete</a></td>
				
			</tr>
		</tbody>
<?php	}
?>	


</table>
</div>


<?php include './template/footer.php'; ?>