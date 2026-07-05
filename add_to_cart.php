<?php
session_start();

// Agar cart session pehle se nahi bana, to associate array banao
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Is mein ham 'product_id' => 'quantity' save karenge
}

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    if ($product_id > 0) {
        // Agar product pehle se cart mein hai, to us ki quantity barha do
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]++;
        } else {
            // Agar product pehle se nahi hai, to quantity 1 set kar do
            $_SESSION['cart'][$product_id] = 1;
        }
    }
}

// Product add karne ke baad seedha cart page par bhej do
header("Location: cart.php");
exit();
?>