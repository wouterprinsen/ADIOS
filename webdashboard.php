
<?php
	 $focus=0;
     if(isset($_POST['btn_option1'])) {$focus=1;}
	 if(isset($_POST['btn_option2'])) {$focus=2;}
	 if(isset($_POST['btn_option3'])) {$focus=3;}
	 if(isset($_POST['btn_option4'])) {$focus=4;}
	 if(isset($_POST['btn_option5'])) {$focus=5;}

     if($focus==1)
	 {
	     $url="http://10.3.12.20:5000/option1";
		 $html=file_get_contents($url); 
	 }
	 if($focus==2)
	 {
	     $url="http://10.0.2.10:5000/option2";
		 $html=file_get_contents($url); 
	 }
	 if($focus==3)
	 {
	     $url="http://10.0.2.10:5000/option3";
		 $html=file_get_contents($url); 
	 }
	 if($focus==4)
	 {
	     $url="http://10.0.2.10:5000/option4";
		 $html=file_get_contents($url); 
	 }
	 if($focus==5)
	 {
	     $url="http://10.0.3.10:5000/option5";
		 $html=file_get_contents($url); 
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
        .content {
            flex: 1;
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .option-content {
            display: none;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #0066cc;
            color: white;
            border-radius: 5px;
            margin-top: 50vh;
            position: sticky;
        }
    </style>
</head>
<body>

<div class="content-wrapper">
    <div class="container">
        <div class="header">
            <h1>University of Tourism, Technology and Business Studies</h1>
            <h3>Learning Environment Request Dashboard</h3>
        </div>
        
        <section id="docker_option1">
            <div class="koptekst">Option 1: Start a standard Ubuntu container.</br> (docker run -d --name ubu01 ubuntu sleep 1d)</div>
            <div class="form" style="text-align: center; padding:5px;">
                <form method="POST" action="">
                    <input type="hidden" name="btn_option1" value="btn_option1">
                    <button type="submit" class="btn btn-primary">Start een leerlab</button>
                </form>
            </div>
            <div class="output" id="output_option1">
                <?php
                if(isset($_POST['btn_option1'])) {
                    $focus = 1;
                    $url = "http://10.3.12.20:5000/option1";
                    $html = file_get_contents($url);
                    echo $html; // Output fetched from Flask endpoint
                }
                ?>
            </div>
        </section>
        
        <!-- Dropdown menu for Docker images -->
        <section id="docker_images">
            <div class="option-bar">
                <form method="POST" action="">
                    <label for="imageSelect">Select Docker Image:</label>
                    <select id="imageSelect" name="image_name">
                        <?php foreach($images as $image): ?>
                            <option value="<?php echo $image; ?>"><?php echo $image; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Create Container</button>
                </form>
            </div>
            <div class="output" id="output_container">
                <?php
                if(isset($_POST['image_name'])) {
                    $image_name = $_POST['image_name'];
                    $url = "http://10.3.12.20:5000/api/start-container";
                    $data = http_build_query(array('image_name' => $image_name));
                    $options = array(
                        'http' => array(
                            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                            'method'  => 'POST',
                            'content' => $data
                        )
                    );
                    $context  = stream_context_create($options);
                    $result = file_get_contents($url, false, $context);
                    if ($result === FALSE) {
                        echo "Error communicating with Flask backend";
                    } else {
                        echo $result; // Output fetched from Flask endpoint
                    }
                }
                ?>
            </div>
        </section>
        
    </div>
</div>

<script>
    function showContent(optionId) {
        var contents = document.querySelectorAll('.option-content');
        contents.forEach(function(content) {
            content.style.display = 'none';
        });
        document.getElementById(optionId).style.display = 'block';
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
