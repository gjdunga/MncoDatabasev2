<?php include "../header.php"; ?>

<div class="container">
    <h1 class="text-center">MMO Check-In Entries</h1>

    <?php
    // Handle delete action if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_entry'])) {
        $entryId = $_POST['entry_id'];

        // Delete the entry with the specified ID
        $deleteEntryQuery = "DELETE FROM timestamps WHERE shopperid = ?";
        $stmt = mysqli_prepare($conn, $deleteEntryQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $entryId);
            $deleteSuccess = mysqli_stmt_execute($stmt);

            if ($deleteSuccess) {
                echo '<p class="text-success">Entry deleted successfully!</p>';
            } else {
                echo '<p class="text-danger">Error deleting entry.</p>';
            }
        } else {
            echo '<p class="text-danger">Error preparing statement for deletion.</p>';
        }
    }

    $getAllEntriesQuery = "
        SELECT
            n.id,
            n.firstname,
            n.lastname,
            n.streetaddress,
            n.city,
            n.state,
            n.zip,
            n.isveteran,
            n.veterandep,
            n.shopperscard,
            n.newneighbor,
            n.hasbenefits,
            n.seniors,
            n.adults,
            n.kids,
            n.cats,
            n.dogs,
            n.ethnicity,
            t.Timestamp,
            (SELECT COUNT(*) FROM neighbors AS n1 JOIN timestamps AS t1 ON n1.id = t1.shopperid) AS TotalRecords
        FROM
            neighbors AS n
        JOIN
            timestamps AS t ON n.id = t.shopperid
        ORDER BY n.id, t.Timestamp"; // Group by shopperid and order by timestamp

    $result = mysqli_query($conn, $getAllEntriesQuery);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Display entries in a table
            echo '<table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Shopper ID</th>';
            echo '<th>Name</th>';
            echo '<th>Timestamp</th>';
            echo '<th>Action</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            $currentShopperId = null;

            while ($row = mysqli_fetch_assoc($result)) {
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $entryId = $row['id'];
                $timestamp = $row['Timestamp'];

                if ($currentShopperId !== $entryId) {
                    // New shopperid, close previous table row and start a new one
                    if ($currentShopperId !== null) {
                        echo '</tr>';
                    }
                    echo '<tr>';
                    echo '<td>' . $entryId . '</td>';
                    echo '<td>' . $firstname . ' ' . $lastname . '</td>';
                    echo '<td>' . $timestamp . '</td>';
                    echo '<td>';
                    echo '<form method="post" action="entries.php" style="display: inline-block;">';
                    echo '<input type="hidden" name="entry_id" value="' . $entryId . '" />';
                    echo '<input type="submit" name="delete_entry" value="Delete" class="btn btn-danger" />';
                    echo '</form>';
                    echo '</td>';
                    $currentShopperId = $entryId;
                }

                // Additional rows for the same shopperid
            }

            // Close the last table row if there are entries
            if ($currentShopperId !== null) {
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No entries found.</p>';
        }
    } else {
        echo '<p class="text-danger">Error executing query: ' . mysqli_error($conn) . '</p>';
    }
    ?>
</div>

<!-- Footer -->
<?php include "../footer.php"; ?>
