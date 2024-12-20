<?php
include 'conn.php';

$sql = "SELECT * FROM player NATURAL JOIN nationality";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
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
                     <button>Supprimer</button>
                 </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='13'>No players found</td></tr>";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $nationality = $_POST['nationality'];
    $photo_url = $_POST['photo'];
    $club = $_POST['club'];
    $position = $_POST['position'];
    $pace = (int)$_POST['pace'];
    $shooting = (int)$_POST['shooting'];
    $passing = (int)$_POST['passing'];
    $dribbling = (int)$_POST['dribbling'];
    $defending = (int)$_POST['defending'];
    $physical = (int)$_POST['physical'];
    $flag_url = $_POST['flag'];
    $rating = (int)$_POST['rating'];

    $stmt = $conn->prepare("INSERT INTO player (name, nationality, photo_url, club, position, pace, shooting, passing, dribbling, defending, physical, flag_url, rating) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiiiiisssi", $name, $nationality, $photo_url, $club, $position, $pace, $shooting, $passing, $dribbling, $defending, $physical, $flag_url, $rating);

    if ($stmt->execute()) {
        echo "Player added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
