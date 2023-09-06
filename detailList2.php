<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Items</title>
</head>
<body>
    <h1>List of Items</h1>
    <ul>
        <?php
        include_once __DIR__ . '/../vendor/database/database.php'; // Include the database connection file

        // Query to select data from the 'items' table
        $sql = "SELECT title, detail FROM tutorials WHERE package_id=4";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<li><strong>" . $row["name"] . "</strong>: " . $row["detail"] . "</li>";
            }
        } else {
            echo "No items found.";
        }

        $conn->close(); // Close the database connection
        ?>
    </ul>
</body>
</html>
