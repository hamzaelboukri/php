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
    

    <div class ="info">
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
    <!-- add nationality -->

    <select name="NationalityID"  required>
    <option value="">Select Nationality</option>

       <?php
include 'conn.php';
    $sql="SELECT * FROM nationality";

    $result = $conn->query($sql);

if ($result->num_rows > 0) {

  while ($row = $result->fetch_assoc()) {

    echo "<option value='" . $row['NationalityID'] . "'>" . $row['NationalityName'] . "</option>";
  }
}
$conn->close();

    ?>
</select>
    
    <input type="url" name="photo" id="photo" placeholder="Image URL" required>
  
<!-- add club -->

<select name="ClubID" required>
    <option value="">Select club</option>

    <?php
include 'conn.php';

                  $sql = "SELECT * FROM club";
                  $result = $conn->query($sql);
                  while ($row = $result->fetch_assoc()) {
                      echo "<option value='" . $row['ClubID'] . "'>" . $row['ClubName'] . "</option>";
                  }
                ?>
</select>

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
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fc_2025";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT 
player.*,
nationality.NationalityName,
club.ClubName
FROM 
player
LEFT JOIN nationality ON player.NationalityID = nationality.NationalityID
LEFT JOIN club ON player.ClubID = club.ClubID";

$result = $conn->query($sql);



if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                 <td>{$row['Name']}</td>
                 <td>{$row['Position']}</td>
                 <td>{$row['Rating']}</td>
                 <td>{$row['Pace']}</td>
                 <td>{$row['Shooting']}</td>
                 <td>{$row['Passing']}</td>
                 <td>{$row['Dribbling']}</td>
                 <td>{$row['Defending']}</td>
                 <td>{$row['Physical']}</td>
                 <td><img src='{$row['ImagePlayer']}' alt='Photo' width='50px'></td>
                 <td><img src='{$row['FlagURL']}' alt='Flag' width='30px'></td>
                 <td>" . ($row['ClubName'] ?? 'N/A') . "</td>
                 <td>
                     <a href='../modifer/edit_plyer.php?id={$row['PlayerID']}' class='btn btn-warning'>Modifier</a>
                     <a href='../delete/delete_player.php?delete_id={$row['PlayerID']}' class='btn btn-danger'>Supprimer</a>
                 </td>
              </tr>";
    }
}


 

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $nationality = $_POST['NationalityID'];
    $photo_url = $_POST['photo'];
    $club = $_POST['ClubID'];
    $position = $_POST['position'];
    $pace = (int)$_POST['pace'];
    $shooting = (int)$_POST['shooting'];
    $passing = (int)$_POST['passing'];
    $dribbling = (int)$_POST['dribbling'];
    $defending = (int)$_POST['defending'];
    $physical = (int)$_POST['physical'];
    $flag_url = $_POST['flag'];
    $rating = (int)$_POST['rating'];

    $stmt = $conn->prepare("INSERT INTO player (Name, NationalityID, ImagePlayer, ClubID, Position, Pace, Shooting, Passing, Dribbling, Defending, Physical, FlagURL, Rating) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissiiiiiiisi", $name, $nationality, $photo_url, $club, $position, $pace, $shooting, $passing, $dribbling, $defending, $physical, $flag_url, $rating);
    $stmt->execute();
    
    $stmt->error;
    
    $stmt->close();
}
?>

                       
                      
                           



</table>

</div> 



<!-- link bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
<script src="js.js">






</script>

</body>
</html>

