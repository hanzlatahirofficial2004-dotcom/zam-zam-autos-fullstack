<?php
session_start();
include "db.php";

$cart = $_SESSION['cart'] ?? [];
$products = [];
$totalItems = 0;

if (!empty($cart)) {
    // Associative array ki keys nikalni hain jo asal mein Product IDs hain
    $product_ids = array_keys($cart);
    $ids = implode(",", $product_ids);
    
    $sql = "SELECT * FROM products WHERE id IN ($ids)";
    $result = $conn->query($sql);
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
}

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Your Cart - Zum Zum Autos</title>
<link rel="stylesheet" href="style.css">
<style>
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

/* Navbar */
nav {
    background-color: #fff;
    padding: 15px 50px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    position: sticky;
    top: 0;
    z-index: 100;
}

nav .nav ul {
    display: flex;
    gap: 30px;
    list-style: none;
}

nav .nav ul li a {
    text-decoration: none;
    font-weight: bold;
    color: #444;
}

nav .nav ul li a:hover {
    color: #FF5500;
}

.btn {
    padding: 10px 20px;
    background-color: #FF5500;
    border: none;
    border-radius: 8px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    text-decoration: none;
}

.btn:hover {
    background-color: #e65c00;
}

/* Cart layout */
.cart-wrapper {
    display: flex;
    justify-content: space-between;
    max-width: 1200px;
    margin: 30px auto;
    gap: 20px;
}

/* Products on left */
.cart-products {
    flex: 2;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Individual Product Card */
.cart-row {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    padding: 20px;
    display: flex;
    gap: 20px;
    align-items: center;
    transition: transform 0.2s;
}

.cart-row:hover {
    transform: translateY(-5px);
}

.cart-row img {
    width: 150px;
    height: 150px;
    object-fit: contain;
    border-radius: 12px;
}

.cart-info {
    flex-grow: 1;
}

.cart-info h2 {
    font-size: 18px;
    margin: 0 0 5px 0;
}

.cart-info p {
    font-size: 14px;
    color: #555;
    margin: 0 0 5px 0;
}

.cart-qty {
    font-size: 14px;
    color: #333;
    background: #eee;
    padding: 4px 10px;
    border-radius: 5px;
    display: inline-block;
    margin-bottom: 5px;
}

.cart-price {
    font-weight: bold;
    color: #FF5500;
    display: block;
}

/* Remove button */
.remove-btn {
    background: #ff4c3b;
    color: #fff;
    padding: 8px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    white-space: nowrap;
}

.remove-btn:hover {
    background: #e63c2a;
}

/* Payment summary on right */
.cart-summary-card {
    flex: 1;
    background: linear-gradient(135deg, #FF5500, #FF9C4A);
    padding: 25px;
    border-radius: 20px;
    color: #fff;
    font-weight: bold;
    font-size: 18px;
    text-align: center;
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    height: fit-content;
}

.cart-summary-card h2 {
    font-size: 22px;
    margin-bottom: 15px;
}

.cart-summary-card p {
    margin: 10px 0;
    display: flex;
    justify-content: space-between;
}

.cart-summary-card button {
    margin-top: 15px;
    padding: 12px 25px;
    width: 100%;
    font-size: 16px;
    border-radius: 10px;
    border: none;
    background-color: #fff;
    color: #FF5500;
    cursor: pointer;
    font-weight: bold;
}

.cart-summary-card button:hover {
    background-color: #f1f1f1;
}

/* Empty cart message */
.empty-cart {
    text-align: center;
    font-size: 20px;
    margin-top: 50px;
}
</style>
</head>
<body>

<nav>
   <div>
      <img src="./images/logofinal.png" alt="" height="50px">
   </div>
   <div class="nav">
      <ul>
         <li><a href="index.php">Home</a></li>
         <li><a href="productpage.php">Products</a></li>
         <li><a href="servicespage.php">Services</a></li> <!-- FIXED: Changed from .html to .php -->
         <li><a href="ContactUs.html">Contact Us</a></li>
         <li><a href="cart.php">Cart</a></li>
      </ul>
   </div>
   <div>
      <a href="productpage.php" class="btn">Shop Online</a>
   </div>
</nav>

<h1 class="cart-title" style="text-align:center; margin-top:30px;">🛒 Your Shopping Cart</h1>

<?php if(empty($products)): ?>
    <p class="empty-cart">Your cart is empty</p>
<?php else: ?>
<div class="cart-wrapper">
    <div class="cart-products">
        <?php 
        foreach($products as $p): 
            $pid = $p['id'];
            $qty = $cart[$pid]; // Session se is product ki quantity nikalen
            $subtotal = $p['price'] * $qty; // Subtotal for this product
            $total += $subtotal; // Add to Grand Total
            $totalItems += $qty; // Total quantity count
        ?>
            <div class="cart-row">
                <img src="images/<?php echo $p['image']; ?>" alt="<?php echo $p['product_name']; ?>">
                <div class="cart-info">
                    <h2><?php echo $p['product_name']; ?></h2>
                    <p><?php echo $p['description']; ?></p>
                    <div class="cart-qty">Quantity: <strong><?php echo $qty; ?></strong></div>
                    <span class="cart-price">Price: Rs. <?php echo number_format($p['price'], 2); ?></span>
                    <span class="cart-price" style="color:#333; font-size:14px;">Subtotal: Rs. <?php echo number_format($subtotal, 2); ?></span>
                </div>
                <a href="remove_from_cart.php?id=<?php echo $p['id']; ?>" class="remove-btn">Remove</a>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="cart-summary-card">
        <h2>Order Summary</h2>
        <p><span>Total Items:</span> <span><?php echo $totalItems; ?></span></p>
        <p><span>Total Payment:</span> <span>Rs. <?php echo number_format($total, 2); ?></span></p>
        <button onclick="alert('Proceeding to payment gateway...')">Pay Now</button>
    </div>
</div>
<?php endif; ?>

</body>
</html>