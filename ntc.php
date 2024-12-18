<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>FC 2025 Squad Builder</title>
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
            <li><a href="index.php"><img src="./img/home.png" alt="club" width="30px" height="30px"> Home</a></li>
            <li><a href="admin_page.php"><img src="./img/icone.png" alt="club" width="30px" height="30px"> Statistics</a></li>
            <li><a href="clup.php"><img src="./img/clup.png" alt="club" width="30px" height="30px"> Add Club</a></li>
            <li><a href="ntc.php"><img src="./img/clup.png" alt="club" width="30px" height="30px"> Nationalities</a></li>
            <li><a>Settings</a></li>
        </ul>
    </div>

    <!-- Form to add nationality -->
    <form method="POST">
        <label for="Nationalities">Nationalities:</label><br>
        <input type="text" id="Nationalities" name="Nationalities" placeholder="Enter Nationalities" required><br><br>

        <label for="Nationalities_image">Image URL:</label><br>
        <input type="url" id="Nationalities_image" name="Nationalities_image" placeholder="Enter image URL" required><br><br>

        <button type="submit">Add Nationalities</button>
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
        $ntc_name = $_POST['Nationalities'];
        $ntc_image = $_POST['Nationalities_image'];

        if (empty($ntc_name) || empty($ntc_image)) {
            echo "<p>Please fill in both fields.</p>";
        } else {
            $stmt = $conn->prepare("INSERT INTO nationality (NationalityName, NationalityImage) VALUES (?, ?)");
            $stmt->bind_param("ss", $ntc_name, $ntc_image);
          if($stmt->execute()){
                echo "<p>Nationality added successfully!</p>";
            } else {
                echo "<p>Error adding nationality. Please try again.</p>";
            }
            $stmt->close();
        }

    }
    $conn->close();
    ?>



<div class="info">

<table class="inf">
<tr>
    <th>Nationality Name</th>
    <th>Nationality Image</th>
    <th>Actions</th>
</tr>

<?php
include 'conn.php';

$sql="SELECT* FROM  nationality ";
$result = $conn->query($sql);
if (!$result) {
  die("connction failde :".$conn->connect_error);
  
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['NationalityName']}</td>
                <td><img src='{$row['NationalityImage']}' alt='Image' width='50px'></td>
                <td>
                    <button>Modifier</button>
                    <button>Supprimer</button>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No nationalities found</td></tr>";
}
?>




</div>

</div>

</body>
</html>
