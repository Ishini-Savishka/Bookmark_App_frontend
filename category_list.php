<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>

    <h2>Category List</h2>

    <?php
    // Check for success message
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo "<p style='color: green;'>New category added successfully!</p>";
    }
    ?>

    <table>
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Category Image</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database configuration
            $servername = "localhost:3308";
            $username = "root";
            $password = "ish@123";
            $database = "bookmark";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve data from the database
            $sql = "SELECT category_id, category_name, category_image FROM category";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["category_id"] . "</td>";
                    echo "<td>" . $row["category_name"] . "</td>";
                    echo "<td><img src='" . $row["category_image"] . "' style='max-width: 100px; max-height: 100px;'></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No categories found</td></tr>";
            }

            // Close connection
            $conn->close();
            ?>
        </tbody>
    </table>

</body>

</html>
