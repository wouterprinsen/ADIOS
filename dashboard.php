<?php
    $focus = 0;
    if (isset($_POST['btn_option1'])) {
        $focus = 1;
        $image_name = $_POST['docker_image'];
        $data = ['image_name' => $image_name];
        $url = 'http://10.3.12.20:5000/create_container';
        
        // Use cURL to send POST request to Flask application
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        // Execute the request
        $response = curl_exec($ch);
        curl_close($ch);
        
        // Handle response as needed
        $html = json_decode($response, true);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Learning Environment Request Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: hsl(210, 17%, 98%);
            background-size: contain;
        }
        .content-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
        }

        .header {
            background-color: #0066cc;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .option-bar {
            margin-top: 20px;
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .option-bar .btn {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="container">
            <div class="header">
                <h1>University Learning Environment Request Dashboard</h1>
            </div>
            <div class="option-bar">
                <form method="POST" action="" name="option1" id="option1">
                    <select id="docker_image" name="docker_image" required>
                        <option value="">Select Docker Image</option>
                        <?php
                            // Fetch Docker images from Flask endpoint
                            $url = 'http://10.3.12.20:5000/images';
                            $images_json = file_get_contents($url);
                            $images = json_decode($images_json, true);
                            
                            foreach ($images as $image) {
                                echo '<option value="' . $image['id'] . '">' . implode(', ', $image['tags']) . '</option>';
                            }
                        ?>
                    </select>
                    <input type="hidden" id="startcontainer1" name="startcontainer1" value="start_container1">
                    <input type="submit" value="Start een leerlab" name="btn_option1">
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
