<?php
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '2000', 'gallery_cafe');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check user role
// Uncomment and adjust this if you want to restrict access to admins only
// if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
//     echo '<script>alert("Access denied."); window.location.href = "Login.php";</script>';
//     exit();
// }

// Handle Create Pre-Order
if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $order_details = mysqli_real_escape_string($conn, $_POST['order_details']);
    $order_date = mysqli_real_escape_string($conn, $_POST['order_date']);
    $order_time = mysqli_real_escape_string($conn, $_POST['order_time']);

    $query = "INSERT INTO pre_orders (name, email, phone, order_details, order_date, order_time) VALUES ('$name', '$email', '$phone', '$order_details', '$order_date', '$order_time')";
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Pre-order added successfully."); window.location.href = "manage_preorders.php";</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.location.href = "manage_preorders.php";</script>';
    }
}

// Handle Edit Pre-Order
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $order_details = mysqli_real_escape_string($conn, $_POST['order_details']);
    $order_date = mysqli_real_escape_string($conn, $_POST['order_date']);
    $order_time = mysqli_real_escape_string($conn, $_POST['order_time']);

    $query = "UPDATE pre_orders SET name='$name', email='$email', phone='$phone', order_details='$order_details', order_date='$order_date', order_time='$order_time' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Pre-order updated successfully."); window.location.href = "manage_preorders.php";</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.location.href = "manage_preorders.php";</script>';
    }
}

// Handle Delete Pre-Order
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    $query = "DELETE FROM pre_orders WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("Pre-order deleted successfully."); window.location.href = "manage_preorders.php";</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.location.href = "manage_preorders.php";</script>';
    }
}

// Fetch all pre-orders
$query = "SELECT * FROM pre_orders";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Pre-Orders</title>
    <link rel="stylesheet" href="reserve.css">
</head>
<body>
    
    <h1>Manage Pre-Orders</h1>

    <!-- Create Pre-Order Form -->
    <h2>Create New Pre-Order</h2>
    <form action="manage_pre_orders.php" method="post">
        <input type="hidden" name="add" value="true">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>
        <label for="order_details">Order Details:</label>
        <textarea id="order_details" name="order_details" required></textarea>
        <label for="order_date">Order Date:</label>
        <input type="date" id="order_date" name="order_date" required>
        <label for="order_time">Order Time:</label>
        <input type="time" id="order_time" name="order_time" required>
        <button type="submit">Create Pre-Order</button>
    </form>

    <!-- Display Pre-Orders -->
    <h2>Pre-Orders List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Order Details</th>
            <th>Order Date</th>
            <th>Order Time</th>
            <th>Actions</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['phone'] . '</td>';
                echo '<td>' . $row['order_details'] . '</td>';
                echo '<td>' . $row['order_date'] . '</td>';
                echo '<td>' . $row['order_time'] . '</td>';
                echo '<td>
                        <a href="manage_preorders.php?edit=' . $row['id'] . '">Edit</a> | 
                        <a href="manage_preorders.php?delete=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this pre-order?\')">Delete</a>
                      </td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="8">No pre-orders found.</td></tr>';
        }
        ?>
    </table>

    <!-- Edit Pre-Order Form -->
    <?php
    if (isset($_GET['edit'])) {
        $id = mysqli_real_escape_string($conn, $_GET['edit']);
        $query = "SELECT * FROM pre_orders WHERE id='$id'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            ?>
            <h2>Edit Pre-Order</h2>
            <form action="manage_pre_orders.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="update" value="true">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                <label for="order_details">Order Details:</label>
                <textarea id="order_details" name="order_details" required><?php echo $row['order_details']; ?></textarea>
                <label for="order_date">Order Date:</label>
                <input type="date" id="order_date" name="order_date" value="<?php echo $row['order_date']; ?>" required>
                <label for="order_time">Order Time:</label>
                <input type="time" id="order_time" name="order_time" value="<?php echo $row['order_time']; ?>" required>
                <button type="submit">Update Pre-Order</button>
            </form>
            <?php
        } else {
            echo '<p>Pre-order not found.</p>';
        }
    }
    ?>

</body>
</html>

<?php
mysqli_close($conn);
?>
