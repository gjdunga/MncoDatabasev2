<?php include "../header.php"?>
<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
?>

<div class="container">
	<h1 class="text-center">Data </h1>
	<a href="create.php" class='btn btn-outline-dark mb-2'><i class="bi bi-person-plus"></i> Create New Neighbor</a><a href="../report.html" class='btn btn-outline-success mb-2'>
		<i class="bi bi-file-earmark-text"></i>
		Report
	</a>


	<table class="table table-striped table-bordered table-hover">
		<thead class="table-dark">
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Registration Date</th>
				<th scope="col">First Name</th>
				<th scope="col">Last Name</th>
				<th scope="col">Stret Address</th>
				
				<th scope="col" colspan="6" class="text-center">Operations</th>
			</tr>
		</thead>
		<tbody>
			<tr>

				<?php

				$query = "SELECT * FROM neighbors WHERE 1";

				if (!empty($firstname)) {
				$query .= " AND firstname LIKE '%$firstname%'";
				}

				if (!empty($lastname)) {
				$query .= " AND lastname LIKE '%$lastname%'";
				}
				echo "$firstname";
				echo "$lastname";
				echo "$query";
				$view_users = mysqli_query($conn, $query); // sending the query to the database

				//  displaying all the data retrieved from the database using while loop
				while ($row = mysqli_fetch_assoc($view_users)) {
					$id = $row['id'];
					$regdate = $row['regdate'];
					$firstname = $row['firstname'];
					$lastname = $row['lastname'];
					$streetaddress = $row['streetaddress'];
				//	$city = $row['city'];
				//	$state = $row['state'];
				//	$zip = $row['zip'];
				//	$isveteran = $row['isveteran'];
				//	$veterandep = $row['veterandep'];
				//	$shopperscard = $row['shopperscard'];
				//	$newneighbor = $row['newneighbor'];
				//	$hasbenefits = $row['hasbenefits'];
				//	$seniors = $row['seniors'];
				//	$adults = $row['adults'];
				//	$kids = $row['kids'];
				//	$cats = $row['cats'];
				//	$dogs = $row['dogs'];
				//	$ethnicity = $row['ethnicity'];

					echo "<tr>";
					echo " <th scope='row' >{$id}</th>";
					echo " <td> {$regdate}</td>";
					echo " <td>{$firstname} </td>";
					echo " <td> {$lastname} </td>";
					echo " <td> {$streetaddress}</td>";
				//	echo " <td> {$city}</td>";
				//	echo " <td>{$state} </td>";
				//	echo " <td> {$zip} </td>";
				//	echo " <td> {$isveteran}</td>";
				//	echo " <td> {$veterandep}</td>";
				//	echo " <td>{$shopperscard} </td>";
				//	echo " <td> {$newneighbor} </td>";
				//	echo " <td> {$hasbenefits}</td>";
				//	echo " <td> {$seniors}</td>";
				//	echo " <td>{$adults} </td>";
				//	echo " <td> {$kids} </td>";
				//	echo " <td>{$cats} </td>";
				//	echo " <td> {$dogs} </td>";
				//	echo " <td> {$ethnicity} </td>";

					echo " <td class='text-center'> <a href='view.php?user_id={$id}' class='btn btn-primary'> <i class='bi bi-eye'></i> View</a> </td>";

					echo " <td class='text-center' > <a href='update.php?edit&user_id={$id}' class='btn btn-secondary'><i class='bi bi-pencil'></i> EDIT</a> </td>";

					echo " <td  class='text-center'>  <a href='delete.php?delete={$id}' class='btn btn-danger'> <i class='bi bi-trash'></i> DELETE</a> </td>";

					echo "<td class='text-center'>  <a href='mmo.php?user_id={$id}' class='btn btn-info'> <i class ='bi-check-circle'></i> MMO</a> </td>";
					echo "</tr>";

		  }
				?>
			</tr>
		</tbody>
	</table>
</div>

<!-- a BACK button to go to the index page -->
<div class="container text-center mt-5">
	<a href="../index.php" class="btn btn-warning mt-5"> Back </a>
</div>

<!-- Footer -->
<?php include "../footer.php" ?>