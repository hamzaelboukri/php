<?php
$club = '';
$club_name = '';
$club_image = '';
include "../conn.php";


?>
<?php
    // else {
    //     $club_name = $_POST['club_name'];
    //     $club_image = $_POST['club_image'];

    //     $sql = "INSERT INTO Club (Clubname, ClubImage) VALUES (?, ?)";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("ss", $club_name, $club_image);
    //     $stmt->execute();

    //     header('Location: ../clup.php');
    //     exit;
    // }


// $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
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
            <li><a href="index.php"><img src="../img/home.png" alt="club" width="30px" height="30px"> Home</a></li>
            <li><a href="admin_page.php"><img src="../img/icone.png" alt="club" width="30px" height="30px"> Statistics</a></li>
            <li><a href="clup.php"><img src="../img/clup.png" alt="club" width="30px" height="30px"> Add Club</a></li>
            <li><a href="ntc.php"><img src="../img/clup.png" alt="club" width="30px" height="30px"> Nationalities</a></li>
            <li><a>Settings</a></li>
        </ul>
    </div>

    <form method="GET">
        <?php 
        include "../conn.php";
        if (isset($_GET['id'])) { 
            $club = $_GET['id'];
            $sql = "SELECT * FROM club WHERE ClubID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $club);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
    
            if (!$row) {
                header('Location: ../clup.php');
                exit;
            }
            $club_name =$row['ClubName'] ?? '';
            $club_image = $row['ClubImage'] ?? '';
            $update_sql = "UPDATE club SET ClubName = ?, ClubImage = ? WHERE ClubID = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("ssi", $club_name, $club_image, $club);
            $update_stmt->execute();
            header('Location: ../clup.php');

            
             ?>
            
            <input type="hidden" name="ClubID" value="<?php echo $row['ClubID']; ?>">
        <?php } ?>

        <label for="club_name">Club Name:</label><br>
        <input type="text" id="club_name" name="club_name" placeholder="Enter club name" required value="<?php echo $club_name ?>"><br>

        <label for="club_image">Image URL:</label><br>
        <input type="url" id="club_image" name="club_image" placeholder="Enter image URL" required value="<?php echo $club_image ?>"><br><br>

        <button type="submit"><?php echo isset($row) ? 'Update Club' : 'Add Club'; ?></button>
    </form>
</div>

<?php 
$conn->close();
?>
</body>
</html>
