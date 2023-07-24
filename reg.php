<?php
// Retrieve form data
$name = $_POST['name'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$password = $_POST['password'];

include('config.php');

// Prepare and execute the SQL statement
$stmt = $conn->prepare("INSERT INTO users (name, contact, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $contact, $email, $password);

if ($stmt->execute()) {
    $successMessage = "Data entered successfully!";
} else {
    $errorMessage = "Error: " . $stmt->error;
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Registration Success</title>
</head>
<body>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body text-center">
                <?php if (isset($successMessage)) { ?>
                    <h3 class="card-title">Registration Successful!</h3>
                    <p class="card-text"><?php echo $successMessage; ?></p>
                    <a href="login.html" class="btn btn-primary">Log In</a>
                <?php } elseif (isset($errorMessage)) { ?>
                    <h3 class="card-title">Registration Error!</h3>
                    <p class="card-text"><?php echo $errorMessage; ?></p>
                <?php } ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
