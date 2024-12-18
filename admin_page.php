<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">

  <!-- link bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
   <title>Dashboard</title>
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
    

    
      <button type="button" class="btn btn-success" onclick="toggleAddPlayerForm()" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Add Player
                </button>

                <!-- Modal -->
                <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Etrer PALYER

                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                            <div class="add-player">
  <h1>Add a Player</h1>
  <form id="playerForm" method="POST">
    <input type="text" name="name" id="name" placeholder="Name" required>
    <select name="nas">

    <?php
include 'conn.php';
    $sql="SELECT * FORM nationality";
    $result = $conn->query($sql);
if (!$result) {
  die("connction failde :".$conn->connect_error);
  
}
while ($row = $result->fetch_assoc()) {
  echo "<option value='" . $row['NationalityID'] . "'>" . $row['NationalityName'] . "</option>";
}
    ?>

</select>
    
    <input type="url" name="photo" id="photo" placeholder="Image URL" required>
    <input type="text" name="club" id="club" placeholder="Club" required>
    <input type="text" name="position" id="Position" placeholder="Position" >
    <input type="number" name="pace" id="pace" placeholder="Pace" min="1" max="100" required>
    <input type="number" name="shooting" id="shooting" placeholder="Shooting" min="1" max="100" required>
    <input type="number" name="passing" id="passing" placeholder="Passing" min="1" max="100" required>
    <input type="number" name="dribbling" id="dribbling" placeholder="Dribbling" min="1" max="100" required>
    <input type="number" name="defending" id="defending" placeholder="Defending" min="1" max="100" required>
    <input type="number" name="physical" id="physical" placeholder="Physical" min="1" max="100" required>
    <input type="url" name="flag" id="flag" placeholder="Flag URL" required>
    <input type="number" name="rating" id="rating" placeholder="Rating" required>
    <button type="submit">Add Player</button>

  </form>
</div>

                               
                            </div>
                       

                        </div>
                    </div>
                </div>
                <!--fin modal  -->

    <table class="inf">





    <tr>
                                <th>Nom</th>
                                <th>Position</th>
                                <th>Rating</th>
                                <th>Pace</th>
                                <th>Shooting</th>
                                <th>Passing</th>
                                <th>Dribbling</th>
                                <th>Defending</th>
                                <th>Physical</th>
                                <th>Photo</th>
                                <th>Flag</th>
                                <th>Club</th>
                                <th>Action</th>
                            </tr>
                      
                            </div> 

                            
                         
    
    <?php

//get dtat from table

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "fc_2025";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql="SELECT* FROM player";
$result = $conn->query($sql);
if (!$result) {
  die("connction failde :".$conn->connect_error);
  
}

while($row=$result->fetch_assoc()){

  if ($result->num_rows>0) {
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
                 <td>{$row['name']}</td>
                      <td>{$row['position']}</td>
                      <td>{$row['rating']}</td>
                      <td>{$row['pace']}</td>
                      <td>{$row['shooting']}</td>
                      <td>{$row['passing']}</td>
                      <td>{$row['dribbling']}</td>
                      <td>{$row['defending']}</td>
                      <td>{$row['physical']}</td>
                      <td><img src='{$row['photo_url']}' alt='Photo' width='50px'></td>
                      <td><img src='{$row['flag_url']}' alt='Flag' width='30px'></td>
                      
                      <td>{$row['club']}</td>
                      <td>
                          <button>Modifier</button>
                          <button >Supprimer</button>
                      </td>
                  </tr>";
    }
  }
}

  ?>
    </table>









<?php




$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "fc_2025";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"]=="POST") {
 

  $name = $_POST['name'];
  $nationality = $_POST['nationality'];
  $photo_url = $_POST['photo'];
  $club = $_POST['club'];
  $position=$_POST['position'];
  $pace = $_POST['pace'];
  $shooting = $_POST['shooting'];
  $passing = $_POST['passing'];
  $dribbling = $_POST['dribbling'];
  $defending = $_POST['defending'];
  $physical = $_POST['physical'];
  $flag_url = $_POST['flag'];
  $rating = $_POST['rating'];

  $sql = "INSERT INTO player (name, nationality, photo_url, club, pace, shooting, passing, dribbling, defending, physical, flag_url, rating) 
      VALUES ('$name',
       '$nationality',
       '$photo_url', 
       '$club',
       '$pace',
       '$shooting',
       '$passing',
       '$dribbling',
       '$defending', 
       '$physical',
       '$flag_url',
       '$rating')";
  
  if ($conn->query($sql) === TRUE) {
      echo "gg";
  } else {
      echo "rr: " . $sql . "<br>" . $conn->error;
  }
}

?>



<!-- link bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
<script src="js.js">






</script>

</body>
</html>

