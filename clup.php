
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
    <a href="admin_page.php">
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
    

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "fc_2025";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $club_name = $_POST['club_name'];
    $club_image = $_POST['club_image'];


    $stmt = $conn->prepare("INSERT INTO club (Clubname, ClubImage) VALUES (?, ?)");//insertion des données sans validation ?
    $stmt->bind_param("ss", $club_name, $club_image);
 if ($stmt->execute ()) {
    echo 'ssss';
 }

}
$conn->close();
    
    

?>


<div class="info">

<table class="inf">
<tr>
    <th>club Name</th>
    <th>club Image</th>
    <th>Actions</th>
</tr>

<?php
include 'conn.php';

$sql="SELECT* FROM  club ";
$result = $conn->query($sql);
if (!$result) {
  die("connction failde :".$conn->connect_error);
  
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['ClubName']}</td>
                <td><img src='{$row['ClubImage']}' alt='Image' width='50px'></td>
                <td>
                         <a href='../modifer/edit_club.php?id={$row['ClubID']}' class='btn btn-warning'>Modifier</a>
                     <a href='../delete/delete_club.php?delete_id={$row['ClubID']}' class='btn btn-danger'>Supprimer</a>
                </td>
              </tr>";
    }
    	





} else {
    echo "<tr><td colspan='3'>No nationalities found</td></tr>";
}
?>




</body>
</html>

