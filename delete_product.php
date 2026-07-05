<?php
$conn = new mysqli("localhost", "root", "", "zumzumautos");
if ($conn->connect_error) die("Database Error");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Database se product delete karne ki query
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        // Delete karne ke baad wapas home page par bhej dega
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting product.";
    }
}
?>