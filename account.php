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

    // Perform any desired operations with the form data
    // For example, you can save it to a database

    // Redirect back to the account page or any other page
    header("Location: account.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Account</title>
  <style>
    .hero-section {
      height: 80vh;
    }
    .card {
      margin-bottom: 20px;
      margin-top: 20px;
    }
  </style>
</head>
<body style="background-color: black;">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Find Missing Person</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.html">Home</a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">About Us</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="account.php">Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="miss.php">Person Missing</a>
        </li>
      </ul>
    </div>
  </nav>

  <section id="card-section">
    <div class="container">
      <h2 style="margin-top: 20px; color:aliceblue;">Missing Persons</h2>
      <div class="row">
        <?php  
        $sql = "SELECT * FROM registrations";
        $result = $conn->query($sql);

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
          // Output data of each row
          while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $age = $row['age'];
            $photo = $row['photo'];
            $dressColor = $row['dress_color'];
            $location = $row['location'];
            $email = $row['email'];

            ?>
            <div class="col-md-4">
              <div class="card">
                <img src="uploads/<?php echo $photo; ?>" width="200px" height="200px" class="card-img-top" alt="Photo 1">
                <div class="card-body">
                  <h5 class="card-title">Dress Color: <?php echo $dressColor; ?></h5>
                  <p class="card-text">Location: <?php echo $location ?></p>
                  <p class="card-text">Name : <?php echo $name; ?></p>
                </div>
                <a href="form_page.php?email=<?php echo $email; ?>&name=<?php echo urlencode($name); ?>&location=<?php echo urlencode($location); ?>">Seen</a>
              </div>
            </div>
            <?php 
          }
        } 
        ?>
      </div>
    </div>
  </section>


  <div class="container">
    <div class="card mt-4">
      <div class="card-header">
        Messages
      </div>
      <div class="card-body">
        <div class="alert alert-success" role="alert">
        <?php  
        $sql = "SELECT * FROM seen_data";
        $result = $conn->query($sql);

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
          // Output data of each row
          while ($row = $result->fetch_assoc()) {
           
            $name = $row['name'];
    
            $photo = $row['photo'];
            $number = $row['number'];

            $location = $row['location'];
            $emaiel = $row['email'];
            
            ?>
<table>
    <?php  if($row['email'] == $user_data['email']){ ?>
    
<td><?php echo $row['id'];?> | </td>
    <td><?php echo $name;?> | </td>
    <td><?php echo $location;?> | </td>
    <td><?php echo $number;?> | </td>
    <td><img src="<?php echo $photo;?>" width="100px"></td>
   
    <?php } ?>
</table>

<?php }} ?>
        </div>
      
      </div>
    </div>
  </div>
  <script>
        function runPythonFile() {
            // Use JavaScript to make an AJAX request to the server
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "app.py", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText); // Output the response from the Python file
                }
            };
            xhr.send();
        }
    </script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
