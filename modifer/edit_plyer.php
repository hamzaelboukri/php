<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $player_id = $_GET['id'];

    $sql = "SELECT * FROM player WHERE PlayerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $player_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $player = $result->fetch_assoc();

    if (!$player) {
        echo "Player not found.";
        exit;
    }
} else {
    echo "No player ID provided.";
    exit;
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

    $update_sql = "UPDATE player SET Name = ?, NationalityID = ?, ImagePlayer = ?, ClubID = ?, Position = ?, Pace = ?, Shooting = ?, Passing = ?, Dribbling = ?, Defending = ?, Physical = ?, FlagURL = ?, Rating = ? WHERE PlayerID = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sissiiiiiiisii", $name, $nationality, $photo_url, $club, $position, $pace, $shooting, $passing, $dribbling, $defending, $physical, $flag_url, $rating, $player_id);

    if ($stmt->execute()) {
        echo "Player updated successfully!";
    } else {
        echo "Error updating player: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Edit Player</title>
</head>
<body>
    <h1>Edit Player</h1>
    <form method="POST">
        <input type="text" name="name" value="<?php echo $player['Name']; ?>" placeholder="Name" required>
        <select name="NationalityID" required>
            <option value="">Select Nationality</option>
            <?php
            $nationalities_sql = "SELECT * FROM nationality";
            $result = $conn->query($nationalities_sql);
            while ($row = $result->fetch_assoc()) {
                $selected = $row['NationalityID'] == $player['NationalityID'] ? 'selected' : '';
                echo "<option value='" . $row['NationalityID'] . "' $selected>" . $row['NationalityName'] . "</option>";
            }
            ?>
        </select>
        <input type="url" name="photo" value="<?php echo $player['ImagePlayer']; ?>" placeholder="Image URL" required>
        <select name="ClubID" required>
            <option value="">Select Club</option>
            <?php
            $clubs_sql = "SELECT * FROM club";
            $result = $conn->query($clubs_sql);
            while ($row = $result->fetch_assoc()) {
                $selected = $row['ClubID'] == $player['ClubID'] ? 'selected' : '';
                echo "<option value='" . $row['ClubID'] . "' $selected>" . $row['ClubName'] . "</option>";
            }
            ?>
        </select>
        <input type="text" name="position" value="<?php echo $player['Position']; ?>" placeholder="Position">
        <input type="number" name="pace" value="<?php echo $player['Pace']; ?>" placeholder="Pace" min="1" max="100" required>
        <input type="number" name="shooting" value="<?php echo $player['Shooting']; ?>" placeholder="Shooting" min="1" max="100" required>
        <input type="number" name="passing" value="<?php echo $player['Passing']; ?>" placeholder="Passing" min="1" max="100" required>
        <input type="number" name="dribbling" value="<?php echo $player['Dribbling']; ?>" placeholder="Dribbling" min="1" max="100" required>
        <input type="number" name="defending" value="<?php echo $player['Defending']; ?>" placeholder="Defending" min="1" max="100" required>
        <input type="number" name="physical" value="<?php echo $player['Physical']; ?>" placeholder="Physical" min="1" max="100" required>
        <input type="url" name="flag" value="<?php echo $player['FlagURL']; ?>" placeholder="Flag URL" required>
        <input type="number" name="rating" value="<?php echo $player['Rating']; ?>" placeholder="Rating" required>
        <button type="submit">Update Player</button>
    </form>
</body>
</html>
