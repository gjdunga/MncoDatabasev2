<?php include "../header.php"; ?>

<?php
// Initialize variables for messages
$successMessage = '';
$errorMessage = '';

// Retrieve the id from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Assuming you have a table 'users' to get first and last name
    $getUserQuery = "SELECT firstname, lastname FROM neighbors WHERE id = ?";
    $stmt = mysqli_prepare($conn, $getUserQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $userData = mysqli_fetch_assoc($result);
            $firstname = $userData['firstname'];
            $lastname = $userData['lastname'];

            if (isset($_POST['submit'])) {
                $currentTimestamp = date('Y-m-d H:i:s');
                $query = "INSERT INTO timestamps (shopperid, Timestamp) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $query);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ss", $id, $currentTimestamp);
                    $insertTimestampWithShopperID = mysqli_stmt_execute($stmt);

                    if ($insertTimestampWithShopperID) {
                        $successMessage = 'User recorded successfully!';
                        $showAlert = true; // Set the variable to true to trigger the alert
                    } else {
                        $errorMessage = 'Error recording timestamp with user.';
                        // Log detailed error for yourself, don't expose it to the user.
                    }
                } else {
                    $errorMessage = 'Error preparing statement for timestamp insertion.';
                    // Log detailed error for yourself.
                }
            }

            // Display the user name
            $shopper_name = $firstname . ' ' . $lastname;
        } else {
            $errorMessage = 'User not found.';
        }
    } else {
        $errorMessage = 'Error preparing statement for user retrieval.';
        // Log detailed error for yourself.
    }
} else {
    // Handle the case when 'id' is not provided in the URL
    $errorMessage = 'User not provided.';
}
?>

<div class="container">
    <h1 class="text-center">MMO Check-In</h1>
    <?php if ($errorMessage): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
    <?php if ($successMessage): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $successMessage; ?>
        </div>
        <!-- JavaScript for the alert and redirection -->
        <script>
            setTimeout(function () {
                alert('User recorded successfully!');
                window.location.href = 'https://mm.myneighborscupboard.org/includes/home.php';
            }, 100);
        </script>
    <?php endif; ?>

    <p>Are you checking in this person?</p>

    <form action="mmo.php?id=<?php echo $id; ?>" method="post">
        <!-- Hidden input to pass the user_id -->
        <input type="hidden" name="id" value="<?php echo $id; ?>" />

        <div class="form-group">
            <label>User Name:</label>
            <p><?php echo $shopper_name; ?></p>
            <!-- Display the user name -->
        </div>

        <div class="form-group">
            <input type="submit" name="submit" value="Correct" class="btn btn-primary" />
            <a href="home.php" class="btn btn-warning">Back</a>
        </div>
    </form>
</div>

<!-- Footer -->
<?php include "../footer.php" ?>
