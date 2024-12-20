<?php
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    include "../conn.php";

    $sql = "DELETE FROM club WHERE ClubID = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $delete_id);
        if ($stmt->execute()) {
            echo "<script>alert('Player deleted successfully!'); window.location.href = 'admin_page.php';</script>";
        } else {
            echo "<script>alert('Error deleting player!'); window.location.href = 'admin_page.php';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Database error. Please try again later.'); window.location.href = 'admin_page.php';</script>";
    }

    $conn->close();
} else {
    echo "<script>alert('No player ID found.'); window.location.href = 'admin_page.php';</script>";
}
?>