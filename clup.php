
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>
<body>
    
<header>
    <h1>FC 2025 Squad Builder</h1>
    <button id="button1" onclick="showPage('login')">Login</button>
  </header>
  <div class="admin-page">
    <div class="sidebar">
      <h2>Dashboard</h2>
      <ul>
      <li>
    <a href="index.php">
        <img src="./img/home.png" alt="club" width="30px" height="30px"> Home
    </a>
</li>
<li>
    <a href="stc.php">
        <img src="./img/icone.png" alt="club" width="30px" height="30px"> Statistics
    </a>
</li>
<li>
    <a href="clup.php">
        <img src="./img/clup.png" alt="club" width="30px" height="30px"> Add Club
    </a>
</li>
<li>
    <a href="ntc.php">
        <img src="./img/clup.png" alt="club" width="30px" height="30px"> Nationalities
    </a>
</li>


        <li><a>Settings</a></li>
      </ul>
    </div>



    <form  method="POST">
        <label for="club_name">Club Name:</label><br>
        <input type="text" id="club_name" name="club_name" placeholder="Enter club name" required><br><br>

        <label for="club_image">Image URL:</label><br>
        <input type="url" id="club_image" name="club_image" placeholder="Enter image URL" required><br><br>

        <button type="submit">Add Club</button>
    </form>


    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $club_name = $_POST['club_name'];
    $club_image = $_POST['club_image'];


    $stmt = $conn->prepare("INSERT INTO club (clubname, clubimag) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $imageURL);

 
}
$conn->close();
    if (!empty($club_name) && !empty($club_image)) {
        echo "Club Name: " . htmlspecialchars($club_name) . "<br>";
        echo "Image URL: <img src='" . htmlspecialchars($club_image) . "' alt='Club Image' width='100px'>";
    }

?>

</body>
</html>

