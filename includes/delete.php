<!-- Footer -->
<?php include "../header.php" ?>

<?php
if (isset($_GET['delete'])) {
    $userid = $_GET['delete'];

    // Check if the user submitted a form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the submitted password is correct
        if ($_POST['password'] === "HowdyNeighbor") {
            // Password is correct, proceed with deletion
            // SQL query to delete data from the neighbors table where id = $userid
            $query = "DELETE FROM neighbors WHERE id = {$userid}";
            $delete_query = mysqli_query($conn, $query);

            // Display success message using JavaScript popup
            echo '<script>alert("Deletion successful!"); window.location.href = "home.php";</script>';
            exit(); // Ensure that no further code is executed after redirection
        } else {
            // Password is incorrect, display an error message
            echo '<script>alert("Incorrect password. Deletion canceled.");</script>';
        }
    }

    // Display the password input form
    echo '<form method="POST" action="">
            <label for="password">Enter Password:</label>
            <input type="password" name="password" required>
            <input type="submit" value="Delete">
          </form>';

    // Add a back button
    echo '<a href="../includes/home.php">Back to Home</a>';
}
?>

<!-- Footer -->
<?php include "../footer.php" ?>
