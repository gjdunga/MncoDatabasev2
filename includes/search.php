<?php
include "../header.php";
$originalFirstname = $_POST['firstname'];
$originalLastname = $_POST['lastname'];
?>

<div class="container">
    <?php echo "Searching for: {$originalFirstname}, {$originalLastname}"; ?>
    <h1 class="text-center">Data </h1>
    <a href="create.php" class='btn btn-outline-dark mb-2'><i class="bi bi-person-plus"></i> Create New Neighbor</a>
    <a href="../report.html" class='btn btn-outline-success mb-2'>
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
                <th scope="col">Street Address</th>

                <th scope="col" colspan="6" class="text-center">Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM neighbors WHERE 1";

            if (!empty($originalFirstname)) {
                $query .= " AND firstname LIKE '%$originalFirstname%'";
            }

            if (!empty($originalLastname)) {
                $query .= " AND lastname LIKE '%$originalLastname%'";
            }

            $view_users = mysqli_query($conn, $query);

            // Displaying all the data retrieved from the database using while loop
            while ($row = mysqli_fetch_assoc($view_users)) {
                $id = $row['id'];
                $regdate = $row['regdate'];
                $dbFirstname = $row['firstname'];
                $dbLastname = $row['lastname'];
                $streetaddress = $row['streetaddress'];

                echo "<tr>";
                echo " <th scope='row' >{$id}</th>";
                echo " <td> {$regdate}</td>";
                echo " <td>{$dbFirstname} </td>";
                echo " <td> {$dbLastname} </td>";
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
<?php
include "../footer.php";
?>
