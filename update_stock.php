<?php
$conn = new mysqli("localhost", "root", "", "zumzumautos");
if ($conn->connect_error) die("Database Error");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['product_id']);
    $new_stock = intval($_POST['stock_value']);
    
    // Database mein stock update karne ki query
    $stmt = $conn->prepare("UPDATE products SET stock = ? WHERE id = ?");
    $stmt->bind_param("ii", $new_stock, $id);
    
    if ($stmt->execute()) {
        // Update karne ke baad wapas home page par redirect
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating stock.";
    }
}
?>