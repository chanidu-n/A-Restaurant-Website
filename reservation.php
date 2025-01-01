<?php
session_start(); // Start the session

$conn = mysqli_connect('localhost', 'root', '2000', 'gallery_cafe');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in
//if (!isset($_SESSION['user'])) {
    //echo '<script>alert("Please log in to make a reservation."); window.location.href = "Login.php";</script>';
    //exit();
//}

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['people']) && isset($_POST['date']) && isset($_POST['time'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $people = mysqli_real_escape_string($conn, $_POST['people']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);

    $insert = "INSERT INTO reservation_form (name, email, people, date, time) VALUES ('$name', '$email', '$people', '$date', '$time')";
    if (mysqli_query($conn, $insert)) {
        echo '<script>alert("Reservation submitted successfully!"); window.location.href = "Reserve.html";</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.location.href = "Reserve.html";</script>';
    }
}

mysqli_close($conn);
?>
