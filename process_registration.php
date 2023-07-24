<?php
// Retrieve form data

include('config.php');
$name = $_POST['name'];
$age = $_POST['age'];
$dressColor = $_POST['dress_color'];
$location = $_POST['location'];
$email = $_POST['email'];

// Handle file upload
$photoTmp = $_FILES['photo']['tmp_name'];
$photoExt = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
$photoName = $name . '.' . $photoExt; // Set the photo name as the value from the name field

$uploadDirectory = 'uploads/';
$photoPath = $uploadDirectory . $photoName; // Set the path to store the uploaded photo with the generated file name

move_uploaded_file($photoTmp, $photoPath); // Move the uploaded photo to the designated path

// Insert data into the MySQL table
$sql = "INSERT INTO registrations (name, age, email, photo, dress_color, location) VALUES ('$name', $age, '$email', '$photoName', '$dressColor', '$location')";

if ($conn->query($sql) === TRUE) {
    // Display success message and registration details
    echo "<h2>Details Recieved Successful!</h2>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Age:</strong> $age</p>";
    echo "<p><strong>Color of Dress:</strong> $dressColor</p>";
    echo "<p><strong>Location:</strong> $location</p>";
    echo "<p><strong>Uploaded Photo:</strong></p>";
    echo "<img src='$photoPath' alt='Uploaded Photo'>";

    // Add the Go Back button to redirect to account.php
    echo "<button onclick='goBack()'>Go Back</button>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<script>
    function goBack() {
        window.location.href = 'account.php';
    }
</script>
