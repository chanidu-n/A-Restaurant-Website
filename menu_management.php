<?php
session_start();

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '2000', 'gallery_cafe');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image'];

    $sql = "INSERT INTO menu_items (title, price, category, image) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sdss', $title, $price, $category, $image);
    mysqli_stmt_execute($stmt);

    header("Location: menu_management.php");
    exit();
}

// Read
$sql = "SELECT * FROM menu_items";
$result = mysqli_query($conn, $sql);
$menuItems = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_POST['image'];

    $sql = "UPDATE menu_items SET title = ?, price = ?, category = ?, image = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sdssi', $title, $price, $category, $image, $id);
    mysqli_stmt_execute($stmt);

    header("Location: menu_management.php");
    exit();
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM menu_items WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    header("Location: menu_management.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu</title>
   
    <link rel="stylesheet" href="menu_management.css">

</head>
<body>

<h1>Manage Menu Items  </h1>

<!-- Create Form -->
<h2>Add New Item</h2>
<form action="menu_management.php" method="post">
    <label for="title">Title:</label>
    <input type="text" name="title" required>
    
    <label for="price">Price:</label>
    <input type="number" name="price" step="0.01" required>
    
    <label for="category">Category:</label>
    <select name="category" required>
        <option value="Starters">Starters</option>
        <option value="Signature_Dishes">Signature Dishes</option>
        <option value="Beverages">Beverages</option>
        <option value="Desserts">Desserts</option>
        <option value="Offers">Offers</option>
    </select>
    
    <label for="image">Image</label>
   
    <input type="file" accept="image/png, image/jpeg, image/jpg" name="image"required >
    
    <button type="submit" name="create">Add Item</button>
</form>

<!-- Read Items -->
<h2>Existing Menu Items</h2>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menuItems as $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item['title']); ?></td>
            <td><?php echo htmlspecialchars($item['price']); ?></td>
            <td><?php echo htmlspecialchars($item['category']); ?></td>
            <td><img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" width="100"></td>
            <td>
                <a href="menu_management.php?edit=<?php echo $item['id']; ?>">Edit</a>
                <a href="menu_management.php?delete=<?php echo $item['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (isset($_GET['edit'])): 
    $id = $_GET['edit'];
    $sql = "SELECT * FROM menu_items WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $item = mysqli_fetch_assoc($result);
?>

<!-- Update Form -->
<h2>Edit Item</h2>
<form action="menu_management.php" method="post">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($item['id']); ?>">
    
    <label for="title">Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($item['title']); ?>" required>
    
    <label for="price">Price:</label>
    <input type="number" name="price" step="0.01" value="<?php echo htmlspecialchars($item['price']); ?>" required>
    
    <label for="category">Category:</label>
    <select name="category" required>
        <option value="Starters" <?php if ($item['category'] == 'Starters') echo 'selected'; ?>>Starters</option>
        <option value="Signature_Dishes" <?php if ($item['category'] == 'Signature_Dishes') echo 'selected'; ?>>Signature Dishes</option>
        <option value="Beverages" <?php if ($item['category'] == 'Beverages') echo 'selected'; ?>>Beverages</option>
        <option value="Desserts" <?php if ($item['category'] == 'Desserts') echo 'selected'; ?>>Desserts</option>
        <option value="Offers" <?php if ($item['category'] == 'Offers') echo 'selected'; ?>>Offers</option>
    </select>
    
    <label for="image">Image URL:</label>
    <input type="text" name="image" value="<?php echo htmlspecialchars($item['image']); ?>" required>
    
    <button type="submit" name="update">Update Item</button>
</form>

<?php endif; ?>

</body>
</html>
