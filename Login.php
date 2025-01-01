<?php



$conn = mysqli_connect('localhost', 'root', '2000', 'gallery_cafe');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $form_user_type = $_POST['user_type']; 

    $select = "SELECT * FROM user_form WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];
        $db_user_type = $row['user_type']; 

        if (password_verify($password, $hashed_password)) {
            if ($form_user_type === $db_user_type) { 
                //$_SESSION['user'] = $row;  //store user info
                
                $_SESSION['user_type'] = $db_user_type;
                if ($db_user_type === 'admin') {
                    header('Location: Admin.html');
                    exit();
                } else if ($db_user_type === 'user') {
                    header('Location: user.html');
                    exit();
                }
                else if ($db_user_type === 'operational staff') {
                    header('Location: operationalstaff.html');
                    exit();
                }
            } else {
                
                $error = 'User type mismatch!';
            }
        } else {
          
            $error = 'Incorrect password!';
        }
    } else {
       
        $error = 'User not found!';
    }
}

mysqli_close($conn);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Login Now</h3>
            <?php
            if (isset($error)) {
                echo '<p>' . $error . '</p>';
            }
            ?>
            <input type="text" name="username" required placeholder="Enter your username">
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <select name="user_type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="operational staff">Operational_satff</option>
            </select>
            <input type="submit" name="submit" value="Login" class="form-btn">
            <p>Don't have an account? <a href="Register.php">Register now</a></p>
        </form>
    </div>
</body>
</html>
