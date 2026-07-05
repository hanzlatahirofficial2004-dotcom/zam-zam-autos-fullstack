<?php
$conn = new mysqli("localhost", "root", "", "zumzumautos");
if ($conn->connect_error) die("Database Error");

// NOTE: Make sure your 'products' table has 'id' and 'stock' columns
$products = $conn->query("SELECT * FROM products LIMIT 6");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zum Zum Autos</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header>
  <div class="container">
    <div>
      <img src="./images/logofinal.png" height="140">
    </div>

    <div class="nav">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="productpage.php">Products</a></li>
        <li><a href="servicespage.html">Services</a></li>
        <li><a href="ContactUs.html">Contact us</a></li>
        <li><a href="cart.php">cart</a></li>
      </ul>
    </div>

    <div>
      <a href="productpage.php"><button class="btn">Shop Online</button></a>
    </div>

    <div class="hero">
      <div>
        <h1>Pakistan’s Largest Motorcycle Spare Parts Manufacturer</h1>
        <p>23+ years of trust • 250,000+ partners</p>
      </div>
      <div>
        <a href="servicespage.html"><button class="btn">Explore More!</button></a>
      </div>
    </div>
  </div>
</header>

<section class="container2nd">
  <section class="about-section">
    <div class="about-left">
      <h3 class="highlight">| About Us</h3>
      <h2><span class="highlight">Crafting</span> Your Dream Custom <span class="highlight">Motorcycle</span></h2>
      <p>
        With over 23 years of trust, Zum Zum Autos has been the most reliable 
        partner in motorcycle spare parts manufacturing and auto solutions.
      </p>
      <button class="btn">Learn More</button>

      <div class="stats">
        <div class="stat">
          <h3>1000+</h3>
          <p>Happy Customers</p>
        </div>
        <div class="stat">
          <h3>1000+</h3>
          <p>Bike Modifications</p>
        </div>
        <div class="stat">
          <h3>23+</h3>
          <p>Years Experience</p>
        </div>
      </div>
    </div>

    <div class="about-right">
      <img src="./images/cyc.png" alt="Motorcycle" />
    </div>
  </section>
</section>

<h1 class="h2 highlight">Our Popular Products</h1>

<main>
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

        <img class="img1" src="images/<?php echo $p['image']; ?>">

        <h2><?php echo $p['product_name']; ?></h2>
        <p><?php echo $p['description']; ?></p>
        <strong>Rs. <?php echo $p['price']; ?></strong>
        
        <p class="stock-status">Stock: <?php echo $p['stock']; ?> units available</p>

        <div>
          <a href="add_to_cart.php?id=<?php echo $p['id']; ?>">
            <button class="btn">Buy Now</button>
          </a>
        </div>
      </div>
    <?php endwhile; ?>

  </div>

  <div class="btncontainer">
    <a href="productpage.php">
      <button class="btn">Explore More Products!</button>
    </a>
  </div>
</main>

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

<footer>
 <div class="footercotainer">
    <div class="textset">
      <img src="images/logofinal.png" alt="" height="140px" width="200px">
      <p>Over 23 years of unwavering trust from more than 250,000 partners across 5 countries, driven by a dedicated workforce of over 5,000 Crownians.</p>
    </div>

    <div class="textset">
      <h3 class="highlight">Businesses</h3>
      <p>Crown Motorcycle Parts<br>Crown Solar Energy<br>Crown Holdings Industrial Hub<br>Crown Electric Mobility<br>Crownsoft International<br>Crown Motorcycles</p>
    </div>
    
    <div class="textset">
      <h3 class="highlight">About Crown</h3>
      <p>About us</p>
      <p>Messages</p>
      <p>Events</p>
      <p>Tours</p>
    </div>

    <div class="textset">
      <h3 class="highlight">Support</h3>
      <p>Contact us</p>
      <p>Become a Vendor</p>
      <p>Become a Dealer</p>
    </div>
  </div>
</footer>

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
    if(currentStock < 0) currentStock = 0; 
    document.getElementById('modalStockDisplay').innerText = currentStock;
    document.getElementById('modalStockInput').value = currentStock;
}

window.onclick = function(event) {
    let modal = document.getElementById('stockModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>