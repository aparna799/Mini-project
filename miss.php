<?php 
session_start();

	include("config.php");
	include("functions.php");

	$user_data = check_login($conn); 

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Find Missing Person</title>
  <style>
    .hero-section {
      height: 80vh;
    }
  </style>
</head>
<body style="background-color: black;">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Find MIssing Person</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item ">
          <a class="nav-link" href="index.html">Home</a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">About Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="account.php">Account</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="miss.php">Person Missing</a>
          </li>
      </ul>
    </div>
  </nav>


    <div class="container" style="color:aliceblue;">
        <h2>Missing Person Form</h2>
        <form method="post" action="process_registration.php" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Missing Person name">
    </div>
    <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" class="form-control" id="age" name="age" placeholder="Enter  age">
    </div>
    <div class="form-group">
        <label for="age">Email</label>
        <input type="text" class="form-control" id="age" name="email" value="<?php echo $user_data['email']; ?>" readonly >
    </div>
    <div class="form-group">
        <label for="photo">Photo:</label>
        <input type="file" class="form-control-file" id="photo" name="photo">
    </div>
    <div class="form-group">
        <label for="dress-color">Color of Dress:</label>
        <input type="text" class="form-control" id="dress-color" name="dress_color" placeholder="Enter color of dress">
    </div>
    <div class="form-group">
        <label for="location">Location:</label>
        <input type="text" class="form-control" id="location" name="location" placeholder="Enter your location">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

    </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
