<?php
session_start();

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Agar cart session maujood hai aur us mein yeh product ID hai
    if (isset($_SESSION['cart'][$product_id])) {
        // Direct key ko unset kar do, poora product cart se khatam ho jayega
        unset($_SESSION['cart'][$product_id]);
    }
}

// Wapis cart page par bhej do
header("Location: cart.php");
exit();
?>