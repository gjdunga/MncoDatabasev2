<!-- Header -->
<?php include "../header.php"?>

<div class="container">
    <h1 class="text-center">Data</h1>
    <a href="create.php" class='btn btn-outline-dark mb-2'><i class="bi bi-person-plus"></i> Create New Neighbor</a>
    <a href="../report.html" class='btn btn-outline-success mb-2'><i class="bi bi-file-earmark-text"></i> Report</a>
    <!-- Add Refresh Button -->
    <a href="#" class='btn btn-outline-primary mb-2' onclick='location.reload();'><i class="bi bi-arrow-clockwise"></i> Refresh</a>
    <!-- Add Upper Back Button -->
    <a href="../index.php" class="btn btn-warning mb-2"> Back </a>
	Search:
<form method="post" action="search.php">
    <label for="firstname">First Name:</label>
    <input type="text" name="firstname" />
    <label for="lastname">Last Name:</label>
    <input type="text" name="lastname" />
    <button type="submit">Search</button>
</form>


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
                <?php
                $query = "SELECT * FROM neighbors ORDER BY id DESC"; // SQL query to fetch all table data in reverse order
                $view_users = mysqli_query($conn, $query); // sending the query to the database

                // displaying all the data retrieved from the database using while loop
                while ($row = mysqli_fetch_assoc($view_users)) {
                    $id = $row['id'];
                    $regdate = $row['regdate'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $streetaddress = $row['streetaddress'];

                    echo "<tr>";
                    echo " <th scope='row' >{$id}</th>";
                    echo " <td> {$regdate}</td>";
                    echo " <td>{$firstname} </td>";
                    echo " <td> {$lastname} </td>";
                    echo " <td> {$streetaddress}</td>";
                    echo " <td class='text-center'> <a href='view.php?user_id={$id}' class='btn btn-primary'> <i class='bi bi-eye'></i> View</a> </td>";
                    echo " <td class='text-center' > <a href='update.php?edit&user_id={$id}' class='btn btn-secondary'><i class='bi bi-pencil'></i> EDIT</a> </td>";
                    echo " <td  class='text-center'>  <a href='delete.php?delete={$id}' class='btn btn-danger'> <i class='bi bi-trash'></i> DELETE</a> </td>";
                    echo "<td class='text-center'>  <a href='mmo.php?id={$id}' class='btn btn-info'> <i class ='bi-check-circle'></i> MMO</a> </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
</div>

<!-- a BACK button to go to the index page -->
<div class="container text-center mt-5">
    <a href="../index.php" class="btn btn-warning mt-5"> Back </a>
</div>

<!-- Footer -->
<?php include "../footer.php" ?>
