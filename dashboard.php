<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: loginpage.php'); // Adjust as necessary
    exit;
}

// User is authenticated, proceed with dashboard content
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Labs Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Add your custom CSS here */
        #docker_option1 {
            padding: 20px;
        }
        .form {
            margin-top: 20px;
        }
        .koptekst {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected image
    $selectedImage = $_POST['selectedImage'];
}

// Fetch Docker images
$images = [];
exec("docker image ls --format '{{.Repository}}'", $images);

// Generate dropdown options
function generateDropdownOptions($images) {
    $dropdownOptions = "";
    foreach ($images as $image) {
        $dropdownOptions .= "<option value=\"$image\">$image</option>";
    }
    return $dropdownOptions;
}
$dropdownOptions = generateDropdownOptions($images);
?>
<section id="docker_option1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="koptekst">Start a Learning Lab</div>
                <form method="POST" action="" name="option1" id="option1">
                    <input type="hidden" id="startcontainer1" name="startcontainer1" value="startcontainer1">
                    <div class="mb-3">
                        <select class="form-select" id="image-select" name="selectedImage">
                            <option value="">Select an image...</option>
                            <?= $dropdownOptions ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btn_container">Start a learlinglab</button>
                </form>
                <div class="output mt-3">
                    <?php
                        if ($focus == 1) {
                            echo("$html");
                        } else {
                            echo("output");
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
