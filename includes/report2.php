<?php include "../header.php" ?>

<?php

// Get the service date from the form
$service_date = $_POST['service_date'];

// Prepare SQL query
$sql = "
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
    (SELECT COUNT(*) FROM timestamps AS t1 WHERE t1.shopperid = t.shopperid) AS TotalRecords
FROM
    neighbors AS n
JOIN
    timestamps AS t ON n.id = t.shopperid
";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Execute the query
$stmt->execute();

// Bind the result
$result = $stmt->get_result();

// Output the report
echo "<h1>Report for All Service Dates</h1>";
echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Street Address</th>
        <th>City</th>
        <th>State</th>
        <th>ZIP</th>
        <th>Is Veteran</th>
        <th>Veteran Dep</th>
        <th>Shoppers Card</th>
        <th>New Neighbor</th>
        <th>Has Benefits</th>
        <th>Seniors</th>
        <th>Adults</th>
        <th>Kids</th>
        <th>Cats</th>
        <th>Dogs</th>
        <th>Ethnicity</th>
        <th>Timestamp</th>
        <th>Total Records</th>
      </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $key => $value) {
        echo "<td>" . $value . ",</td>";
    }
    echo "</tr>";
}
echo "</table>";

// Close connection
$conn->close();
?>
