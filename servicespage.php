<?php
session_start();
include "db.php"; // Include DB connection

if(isset($_POST['submit_service'])) {

    $service  = $_POST['service_name'];
    $name     = $_POST['user_name'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $details  = $_POST['request_details'];

    $stmt = $conn->prepare(
        "INSERT INTO service_requests 
        (service_name, user_name, email, phone, request_details) 
        VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->bind_param("sssss", $service, $name, $email, $phone, $details);
    $stmt->execute();
    $stmt->close();

    $success = "Your service request has been submitted successfully!";
}

// Services List
$services = [
    [
        "title" => "Bike Repair & Maintenance",
        "image" => "images/repair.png",
        "desc"  => "Complete bike repair and maintenance services — from oil changes to brake adjustments and full engine overhauls."
    ],
    [
        "title" => "Spare Parts Installation",
        "image" => "images/cusomize.png",
        "desc"  => "Buy any spare part from us, and we’ll install it professionally at our workshop."
    ],
    [
        "title" => "Online Support",
        "image" => "images/contact.png",
        "desc"  => "Not sure which part fits your bike? Our experts are here to help you online."
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Our Services - Zum Zum Autos</title>
  <!-- Standard Bootstrap 5.3.3 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    /* Navbar override to keep custom style matching with bootstrap */
    nav .nav ul {
        margin-bottom: 0;
        padding-left: 0;
    }
    nav a {
        text-decoration: none;
    }
  </style>
</head>
<body>

<!-- FIXED: Added Universal Navbar -->
<nav>
    <div class="container-fluid d-flex justify-content-between align-items-center px-5" style="background:#fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); height: 80px;">
        <div>
            <img src="./images/logofinal.png" alt="Zum Zum Autos" height="60px">
        </div>

        <div class="nav">
            <ul class="d-flex gap-4 list-unstyled">
                <li><a href="index.php" class="fw-bold text-secondary">Home</a></li>
                <li><a href="productpage.php" class="fw-bold text-secondary">Products</a></li>
                <li><a href="servicespage.php" class="fw-bold text-secondary">Services</a></li>
                <li><a href="ContactUs.html" class="fw-bold text-secondary">Contact Us</a></li>
                <li><a href="cart.php" class="fw-bold text-secondary">Cart</a></li>
            </ul>
        </div>

        <div>
            <a href="productpage.php" class="btn text-white fw-bold" style="background-color: #FF5500;">Shop Online</a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <h1 class="text-center mb-4 fw-bold" style="color: #333;">Our Special Services</h1>
    
    <!-- Success Alert -->
    <?php if(isset($success)): ?>
      <div class="alert alert-success text-center my-3 mx-auto" style="max-width: 600px;">
        <?php echo $success; ?>
      </div>
    <?php endif; ?>

    <div class="d-flex flex-wrap justify-content-center gap-4 mt-4">
        <?php foreach($services as $s): ?>
          <div class="card shadow-sm border-0" style="width: 20rem; border-radius: 15px; overflow: hidden;">
            <img src="<?php echo $s['image']; ?>" class="card-img-top" alt="<?php echo $s['title']; ?>" style="height: 200px; object-fit: cover;">
            <div class="card-body d-flex flex-column justify-content-between">
              <div>
                <h5 class="card-title fw-bold" style="color: #FF5500;"><?php echo $s['title']; ?></h5>
                <p class="card-text text-muted" style="font-size: 14px;"><?php echo $s['desc']; ?></p>
              </div>
              <button 
                class="btn w-100 mt-3 text-white fw-bold"
                style="background-color: #FF5500; border-radius: 8px;"
                data-bs-toggle="modal"
                data-bs-target="#serviceModal"
                data-service="<?php echo $s['title']; ?>">
                Get Service Now
              </button>
            </div>
          </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" class="modal-content" style="border-radius: 15px;">

      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold">Request Service</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" name="service_name" id="service_name">

        <div class="mb-3">
          <label class="form-label fw-bold">Name</label>
          <input type="text" class="form-control" name="user_name" required style="border-radius: 8px;">
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Email</label>
          <input type="email" class="form-control" name="email" required style="border-radius: 8px;">
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Phone</label>
          <input type="text" class="form-control" name="phone" required style="border-radius: 8px;">
        </div>

        <div class="mb-3">
          <label class="form-label fw-bold">Service Details</label>
          <textarea 
            class="form-control" 
            name="request_details" 
            rows="3" 
            required
            style="border-radius: 8px;"
            placeholder="Describe your problem or service requirement"></textarea>
        </div>
      </div>

      <div class="modal-footer border-0">
        <button type="submit" name="submit_service" class="btn w-100 text-white fw-bold" style="background-color: #FF5500; border-radius: 8px;">
          Submit Request
        </button>
      </div>

    </form>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('serviceModal')
.addEventListener('show.bs.modal', function (event) {
    let button = event.relatedTarget;
    let service = button.getAttribute('data-service');
    document.getElementById('service_name').value = service;
});
</script>

</body>
</html>