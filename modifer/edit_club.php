<?php
include '../conn.php';

$club_id = '';
$club_name = '';
$club_image = '';

if (isset($_GET['id'])) {
    $club_id = $_GET['id'];

    $sql = "SELECT * FROM club WHERE ClubID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $club_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $club_name = $row['ClubName'];
        $club_image = $row['ClubImage'];
    } else {
        echo "Club not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['club_id'])) {
        $club_id = $_POST['club_id'];
        $club_name = $_POST['club_name'];
        $club_image = $_POST['club_image'];

        $update_sql = "UPDATE club SET ClubName = ?, ClubImage = ? WHERE ClubID = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssi", $club_name, $club_image, $club_id);

        if ($update_stmt->execute()) {
            header('Location: ../clup.php');
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">

    <title>E</title>
</head>
<body>
    <form method="POST">
        <input type="hidden" name="club_id" value="<?php echo $club_id; ?>">
        <label for="club_name">Club Name:</label><br>
        <input type="text" id="club_name" name="club_name" value="<?php echo $club_name; ?>" required><br><br>

        <label for="club_image">Club Image URL:</label><br>
        <input type="url" id="club_image" name="club_image" value="<?php echo $club_image; ?>" required><br><br>

        <button type="submit">Update Club</button>
    </form>
</body>
</html>
