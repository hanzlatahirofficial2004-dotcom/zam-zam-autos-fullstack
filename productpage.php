<?php
session_start();
include "db.php"; // Include DB connection
$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Our Products - Zum Zum Autos</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<nav>
    <div class="container">
        <div>
            <img src="./images/logofinal.png" alt="Zum Zum Autos" height="140px">
        </div>

        <div class="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="productpage.php">Products</a></li>
                <li><a href="servicespage.php">Services</a></li>
                <li><a href="ContactUs.html">Contact us</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </div>

        <div>
            <a href="productpage.php">
                <button class="btn">Shop Online</button>
            </a>
        </div>
    </div>
</nav>

<h1 class="h2 highlight" style="text-align:center; margin-top: 30px; margin-bottom: 30px;">Our Products</h1>

<div class="container">
    <div class="container2">
        <?php while($p = $products->fetch_assoc()): ?>
            <div class="box1" style="position: relative;">
                
                <div class="admin-actions">
                    <button type="button" class="edit-btn" onclick="openStockModal(<?php echo $p['id']; ?>, <?php echo $p['stock']; ?>, '<?php echo addslashes($p['product_name']); ?>')">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    
                    <a href="delete_product.php?id=<?php echo $p['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this product?')">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>

                <img class="img1" src="images/<?php echo $p['image']; ?>" alt="<?php echo $p['product_name']; ?>">
                <h2><?php echo $p['product_name']; ?></h2>
                <p><?php echo $p['description']; ?></p>
                <strong>Rs. <?php echo number_format($p['price'], 2); ?></strong>
                
                <p class="stock-status">Stock: <?php echo $p['stock']; ?> units available</p>

                <div>
                    <a href="add_to_cart.php?id=<?php echo $p['id']; ?>">
                        <button class="btn">Buy Now</button>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<div id="stockModal" class="modal">
  <div class="modal-content">
    <span class="close-modal" onclick="closeStockModal()">&times;</span>
    <h2 id="modalProductName">Edit Stock</h2>
    
    <form action="update_stock.php" method="POST">
      <input type="hidden" id="modalProductId" name="product_id">
      <input type="hidden" id="modalStockInput" name="stock_value">

      <div class="stock-counter">
        <button type="button" class="counter-btn" onclick="changeStock(-1)"><i class="fas fa-minus-circle"></i></button>
        <span id="modalStockDisplay">0</span>
        <button type="button" class="counter-btn" onclick="changeStock(1)"><i class="fas fa-plus-circle"></i></button>
      </div>
      
      <p class="units-text">units available</p>
      <button type="submit" class="save-stock-btn">Save Stock</button>
    </form>
  </div>
</div>

<script>
let currentStock = 0;

function openStockModal(id, stock, name) {
    currentStock = parseInt(stock);
    document.getElementById('modalProductId').value = id;
    document.getElementById('modalStockInput').value = currentStock;
    document.getElementById('modalStockDisplay').innerText = currentStock;
    document.getElementById('modalProductName').innerText = "Edit Stock — " + name;
    document.getElementById('stockModal').style.display = 'block';
}

function closeStockModal() {
    document.getElementById('stockModal').style.display = 'none';
}

function changeStock(val) {
    currentStock += val;
    if(currentStock < 0) currentStock = 0; // Stock minus me na jaye
    document.getElementById('modalStockDisplay').innerText = currentStock;
    document.getElementById('modalStockInput').value = currentStock;
}

// Agar modal box se bahar screen par kahin click ho to close ho jaye
window.onclick = function(event) {
    let modal = document.getElementById('stockModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>