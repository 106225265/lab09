<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
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

<h1>Car Search Results</h1>

<?php
require_once "settings.php";

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    echo "<p>Database connection failed.</p>";
} else {

    if (isset($_GET['model']) && trim($_GET['model']) !== '') {

        $model = mysqli_real_escape_string($conn, $_GET['model']);

        $sql = "SELECT * FROM cars WHERE model LIKE '%$model%'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {

            echo "<table>";
            echo "<tr><th>ID</th><th>Make</th><th>Model</th><th>Price</th><th>Year</th></tr>";

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
            echo "<p>🚫 No matching cars found.</p>";
        } else {
            echo "<p>Search query failed.</p>";
        }

    } else {
        echo "<p>Please enter a model to search.</p>";
    }

    mysqli_close($conn);
}
?>

<p><a href="search_form.php">Search Again</a></p>

</body>
</html>