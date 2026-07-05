<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "zumzumautos");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data safely
    $name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert data
    $sql = "INSERT INTO contact_messages (full_name, email, phone, message)
            VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message Sent Successfully'); window.location.href='ContactUs.html';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
