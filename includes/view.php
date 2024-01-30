<!-- Header -->
<?php  include '../header.php'?>

<h1 class="text-center">Neighbor Details</h1>
  <div class="container">
	<table class="table table-striped table-bordered table-hover">
	  <thead class="table-dark">
		<tr>
		 <th  scope="col">ID</th>
			 <th  scope="col">Registration Date</th>
			 <th  scope="col">First Name</th>
			 <th  scope="col">Last Name</th>
			 <th  scope="col">Stret Address</th>
			 <th  scope="col">City</th>
			 <th  scope="col">State</th>
			 <th  scope="col">Zip</th>
			 <th  scope="col">Is a Veteran</th>
			 <th  scope="col">Veteran Dependants</th>
			 <th  scope="col">Shoppers Cards</th>
			 <th  scope="col">New Neighbor</th>
			 <th  scope="col">Has Benefits </th>
			 <th  scope="col">Seniors</th>
			 <th  scope="col">Adults</th>
			 <th  scope="col">Kids</th>
			 <th  scope="col">Cats</th>
			 <th  scope="col">Dogs</th>
			 <th  scope="col">ethnicity</th>
		</tr>  
	  </thead>
		<tbody>
		  <tr>
			   
		  <?php
			  //  first we check using 'isset() function if the variable is set or not'
			  //Processing form data when form is submitted
			  if (isset($_GET['user_id'])) {
				  $userid = $_GET['user_id'];

				  // SQL query to fetch the data where id=$userid & storing data in view_user
				  $query="SELECT * FROM neighbors WHERE id = {$userid} ";
				  $view_users= mysqli_query($conn,$query);

				  while($row = mysqli_fetch_assoc($view_users))
				  {
					$id = $row['id'];
					$regdate = $row['regdate'];
					$firstname = $row['firstname'];
					$lastname = $row['lastname'];
					$streetaddress = $row['streetaddress'];
					$city = $row['city'];
					$state = $row['state'];
					$zip = $row['zip'];
					$isveteran = $row['isveteran'];
					$veterandep = $row['veterandep'];
					$shopperscard = $row['shopperscard'];
					$newneighbor = $row['newneighbor'];
					$hasbenefits = $row['hasbenefits'];
					$seniors = $row['seniors'];
					$adults = $row['adults'];
					$kids = $row['kids'];
					$cats = $row['cats'];
					$dogs = $row['dogs'];
					$ethnicity = $row['ethnicity'];
					echo "<tr>";
					echo " <th scope='row' >{$id}</th>";
					echo " <td> {$regdate}</td>";
					echo " <td>{$firstname} </td>";
					echo " <td> {$lastname} </td>";
					echo " <td> {$streetaddress}</td>";
					echo " <td> {$city}</td>";
					echo " <td>{$state} </td>";
					echo " <td> {$zip} </td>";
					echo " <td> {$isveteran}</td>";
					echo " <td> {$veterandep}</td>";
					echo " <td>{$shopperscard} </td>";
					echo " <td> {$newneighbor} </td>";
					echo " <td> {$hasbenefits}</td>";
					echo " <td> {$seniors}</td>";
					echo " <td>{$adults} </td>";
					echo " <td> {$kids} </td>";
					echo " <td>{$cats} </td>";
					echo " <td> {$dogs} </td>";
					echo " <td> {$ethnicity} </td>";
				  }
				}
		  ?>
		  </tr>  
		</tbody>
	</table>
  </div>

   <!-- a BACK Button to go to pervious page -->
  <div class="container text-center mt-5">
	<a href="home.php" class="btn btn-warning mt-5"> Back </a>
  </div>

<!-- Footer -->
<?php include "../footer.php" ?>