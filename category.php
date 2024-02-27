<?php
// Database configuration
$servername = "localhost:3308";
$username = "root";
$password = "ish@123";
$database = "bookmark";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $categoryName = $_POST["categoryName"];
    $categoryImage = $_FILES["categoryImage"]["name"]; // Get the filename of the uploaded image

    // Specify the absolute path of the uploads directory
    $targetDir = __DIR__ . "/uploads/"; // Specify the absolute path where you want to store the uploaded images
    $targetFilePath = $targetDir . basename($categoryImage);

    // Move the uploaded file
    if (move_uploaded_file($_FILES["categoryImage"]["tmp_name"], $targetFilePath)) {
        // Prepare SQL statement
        $sql = "INSERT INTO category (category_name, category_image) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $categoryName, $targetFilePath);

        // Execute SQL statement
        if ($stmt->execute()) {
            // Redirect back to the category list page with success message
            header("Location: category_list.php?success=1");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Failed to move uploaded file.";
    }
}

// Close connection
$conn->close();
?>
