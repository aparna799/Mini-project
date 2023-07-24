<?php
session_start();

include("config.php");
include("functions.php");

$user_data = check_login($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission
    $name = $_POST['name'];
    $location = $_POST['location'];
    $number = isset($_POST['number']) ? $_POST['number'] : '';
    $email = $_POST['email'];

    // Upload photo file
    $photo = $_FILES['photo'];
    $photo_name = $photo['name'];
    $photo_tmp_name = $photo['tmp_name'];
    $photo_error = $photo['error'];

    // Check if a photo was uploaded
    if ($photo_error === UPLOAD_ERR_OK) {
        // Specify the directory to store the uploaded photo
        $photo_directory = 'received/';

        // Generate a unique name for the photo
        $photo_path = $photo_directory . uniqid() . '_' . $photo_name;

        // Move the uploaded photo to the specified directory
        move_uploaded_file($photo_tmp_name, $photo_path);
    } else {
        // Handle the photo upload error
        $photo_path = '';
        // You can display an error message or take appropriate action based on the error code
    }

    // Perform any desired operations with the form data
    // For example, you can save it to a database
    $sql = "INSERT INTO seen_data (name, location, number, email, photo) VALUES ('$name', '$location', '$number', '$email', '$photo_path')";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the account page or any other page
        header("Location: account.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve the information from the URL
$email = $_GET['email'];
$name = urldecode($_GET['name']);
$location = urldecode($_GET['location']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Form Page</title>
</head>
<body>
  <div class="container">
    <h2>Seen Form</h2>
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
      </div>
      <div class="form-group">
  <label for="location">Location:</label>
  <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" required>
  <button onclick="getLocation()">Detect Location</button>
</div>

      <div class="form-group">
        <label for="number">Contact Number:</label>
        <input type="text" class="form-control" id="number" name="number" placeholder="Enter contact number">
      </div>
      <div class="form-group">
        <label for="photo">Photo:</label>
        <input type="file" class="form-control" name="photo">
      </div>
      <div class="form-group">
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email"  value="<?php echo $email; ?>" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
    function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
  const latitude = position.coords.latitude;
  const longitude = position.coords.longitude;
  const locationInput = document.getElementById("location");
  locationInput.value = latitude + ", " + longitude;
}

  </script>
</body>
</html>