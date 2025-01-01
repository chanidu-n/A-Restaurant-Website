<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '2000', 'gallery_cafe');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['view'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $query = "SELECT * FROM reservation_form WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo '<h2>Your Reservations</h2>';
        echo '<table border="1"><tr><th>ID</th><th>Name</th><th>Email</th><th>People</th><th>Date</th><th>Time</th><th>Action</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['people'] . '</td>';
            echo '<td>' . $row['date'] . '</td>';
            echo '<td>' . $row['time'] . '</td>';
            echo '<td><a href="editreservation.php?edit=' . $row['id'] . '">Edit</a> | <a href="editreservation.php?delete=' . $row['id'] . '">Delete</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<script>alert("No reservations found for this email."); window.location.href = "editreservation.html";</script>';
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM reservation_form WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Reservation deleted successfully."); window.location.href = "editreservation.html";</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.location.href = "editreservation.html";</script>';
    }
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $query = "SELECT * FROM reservation_form WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Reservation</title>
            <link rel="stylesheet" href="reserve.css">
        </head>
        <body>
            <nav>
                <div class="logo">
                    <a href="index.html"><img src="img/Screenshot 2024-07-21 074157.png"></a>
                </div>
                <ul>
                    <li><a href="index.html" class="action">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="menu.html">Menu</a></li>
                    <li><a href="gallery.html">Special-Events</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="reserve.html">Reservations</a></li>
                    <li><a href="pre-order.html">Pre-Order</a></li>
                </ul>
                <div class="login">
                    <a href="Login.php">Login</a>
                </div>
            </nav>
            
            <div class="oder">
                <h1><span>Edit</span> Reservation</h1>
                <div class="oder_main">
                    <div class="oder_form">
                        <h2>Update Reservation</h2>
                        <form action="editreservation.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                            <label for="people">Number of People:</label>
                            <input type="text" id="people" name="people" value="<?php echo $row['people']; ?>" required>
                            <label for="date">Date:</label>
                            <input type="date" id="date" name="date" value="<?php echo $row['date']; ?>" required>
                            <label for="time">Time:</label>
                            <input type="time" id="time" name="time" value="<?php echo $row['time']; ?>" required>
                            <button type="submit" name="update">Update Reservation</button>
                        </form>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo '<script>alert("Reservation not found."); window.location.href = "editreservation.html";</script>';
    }
}

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $people = mysqli_real_escape_string($conn, $_POST['people']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $query = "UPDATE reservation_form SET name='$name', email='$email', people='$people', date='$date', time='$time' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Reservation updated successfully."); window.location.href = "editreservation.html";</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.location.href = "editreservation.html";</script>';
    }
}

mysqli_close($conn);
?>
