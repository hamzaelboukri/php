<?php
include 'conn.php';

$nationality_id = '';
$nationality_name = '';
$nationality_image = '';

if (isset($_GET['id'])) {
    $nationality_id = $_GET['id'];
    $sql = "SELECT * FROM nationality WHERE NationalityID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $nationality_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row) {
        $nationality_name = $row['NationalityName'];
        $nationality_image = $row['NationalityImage'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nationality_id = $_POST['nationality_id'];
    $nationality_name = $_POST['nationality_name'];
    $nationality_image = $_POST['nationality_image'];

    $check_sql = "SELECT NationalityID FROM nationality WHERE NationalityName = ? AND NationalityID != ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("si", $nationality_name, $nationality_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        echo "Error: Nationality name already exists.";
    } else {
        $update_sql = "UPDATE nationality SET NationalityName = ?, NationalityImage = ? WHERE NationalityID = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssi", $nationality_name, $nationality_image, $nationality_id);
        if ($update_stmt->execute()) {
            header('Location: ../ntc.php');
            exit;
        } else {
            echo "Error updating record.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Edit Nationality</title>
</head>
<body>
<header>
    <h1>Edit Nationality</h1>
</header>
<form method="POST">
    <input type="hidden" name="nationality_id" value="<?php echo $nationality_id; ?>">
    <label for="nationality_name">Nationality Name:</label><br>
    <input type="text" id="nationality_name" name="nationality_name" value="<?php echo $nationality_name; ?>" required><br><br>
    <label for="nationality_image">Image URL:</label><br>
    <input type="url" id="nationality_image" name="nationality_image" value="<?php echo $nationality_image; ?>" required><br><br>
    <button type="submit">Update Nationality</button>
</form>
</body>
</html>
