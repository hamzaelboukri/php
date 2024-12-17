<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "players";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
              
        if($password==$user['password']) {
            if ($user['role'] == 'user') {
                header('Location: user_page.php');
                exit;
            } else {
                header('Location: admin_page.php'); 
                exit;
            }
     
            
    }
  }
    $stmt->close();
    $conn->close();
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Login</title>
</head>
<body>
  <header>
    <h1>FC 2025 Squad Builder</h1>
    <button id="button1" onclick="showPage('page')">Login</button>
  </header>

<div class="validation page">
    <form id="loginForm" method="POST" >
      <input type="email" name="email" id="email" placeholder="Enter email" required>
      <input type="password"name="password" id="password" placeholder="Enter password" required>
      <button type="submit">Login</button>
    </form>


  <script src="js.js"></script>
</body>
</html>
