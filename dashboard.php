<!DOCTYPE html>
<html>
<head>
    <title>Image Selection</title>
</head>
<body>
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: index.html'); // Adjust as necessary
    exit;
}

// User is authenticated, proceed with dashboard content
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

?>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selected_image = $_POST["images"];
        echo "<p>You selected: $selected_image</p>";
        // Add your logic here to perform actions based on the selected image
    }
    ?>
</body>
</html>
