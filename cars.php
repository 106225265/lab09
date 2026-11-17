<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Used Car Dealership</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: lightgray;
        }
    </style>
</head>
<body>

<h1>Used Car Dealership</h1>

<?php
require_once "settings.php";

$dbconn = mysqli_connect($host, $user, $pwd, $sql_db);

if ($dbconn) {
    $query = "SELECT * FROM cars";
    $result = mysqli_query($dbconn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Car ID</th><th>Make</th><th>Model</th><th>Price</th><th>Year</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['car_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['make']) . "</td>";
            echo "<td>" . htmlspecialchars($row['model']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
            echo "<td>" . htmlspecialchars($row['yom']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } elseif ($result) {
        echo "<p>There are no cars to display.</p>";
    } else {
        echo "<p>Unable to retrieve car records.</p>";
    }

    mysqli_close($dbconn);
} else {
    echo "<p>Unable to connect to the database.</p>";
}
?>

</body>
</html>