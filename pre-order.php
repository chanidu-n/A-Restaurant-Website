<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "2000";
$dbname = "gallery_cafe";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
//if (!isset($_SESSION['user'])) {
    //echo '<script>alert("Please log in to make a preorder."); window.location.href = "Login.php";</script>';
    //exit();
//}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $order_details = $_POST["order_details"];
    $order_date = $_POST["order_date"];
    $order_time = $_POST["order_time"];

    $sql = "INSERT INTO pre_orders (name, email, phone, order_details, order_date, order_time) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $phone, $order_details, $order_date, $order_time);

    if ($stmt->execute()) {
        echo '<script>alert("Orderd  successfully!"); window.location.href = "user.html";</script>';
    
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
