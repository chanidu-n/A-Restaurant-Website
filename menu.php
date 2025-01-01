<?php


session_start();

$conn = mysqli_connect('localhost', 'root', '2000', 'gallery_cafe');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="menu.css">
</head>
<body>

    <!--Navigation Bar-->
    <nav>
        <div class="logo">
            <a href="index.php"><img src="img/Screenshot 2024-07-21 074157.png" alt="Gallery Cafe Logo"></a>
        </div>

        <ul>
            <li><a href="index.html" class="action">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="gallery.html">Special Events</a></li>
            <li><a href="blog.html">Blog</a></li>
            <li><a href="reserve.html">Reservations</a></li>
            <li><a href="pre-order.html">Pre-Order</a></li>
        </ul>

        <div class="login">
            <a href="login.php">Login</a>
        </div>
    </nav>

    <!--Banner-->
    <div class="banner_bg">
        <h1>Our<span>Menu</span></h1>
    </div>

    <!-- Search Bar -->
    <div class="search-bar-wrapper">
        <input type="text" id="search-bar" placeholder="Search menu items...">
    </div>

    <div class="container">
        <div class="filter-wrapper">
            <!--Filter buttons--> 
            <div class="filter_button">
                <button class="filter-active" data-name="All_Categories">All Categories</button>      
                <button data-name="Starters">Starters</button>      
                <button data-name="Signature_Dishes">Signature Dishes</button>      
                <button data-name="Beverages">Beverages</button>      
                <button data-name="Desserts">Desserts</button>      
                <button data-name="Offers">Offers</button>
            </div>
        </div>

        <!--Menu items-->
        <div class="menu">

            <!--Signature Dishes-->
            <div class="itemBox" data-name="Signature_Dishes">
                <img src="img/special-dish-banner.jpg" alt="Smoky Grilled Chicken"/>
                <div class="item-body">
                    <h6 class="item-title">Smoky Grilled Chicken</h6>
                    <p class="item-price">LKR.1000.00</p>
                    <button class="add-to-basket" data-item="Smoky Grilled Chicken" onclick="addToBasket('Smoky Grilled Chicken',1000.00)" data-price="1000">Add to cart</button>
                </div>
            </div>
            <div class="itemBox" data-name="Signature_Dishes">
                <img src="img/gallery_5.jpg" alt="Double chicken cheesy Pizza"/>
                <div class="item-body">
                    <h6 class="item-title">Double Chicken Cheesy Pizza</h6>
                    <p class="item-price">LKR.2300.00</p>
                    <button class="add-to-basket" data-item="Double Chicken Cheesy Pizza" data-price="2300">Add to cart</button>
                </div>
            </div>
            <div class="itemBox" data-name="Signature_Dishes">
                <img src="img/kottu.avif" alt="Gallery special chicken Koththu"/>
                <div class="item-body">
                    <h6 class="item-title">Gallery Special Chicken Koththu</h6>
                    <p class="item-price">LKR.1200.00</p>
                    <button class="add-to-basket" data-item="Gallery Special Chicken Koththu" data-price="1200">Add to cart</button>
                </div>
            </div>
            <div class="itemBox" data-name="Signature_Dishes">
                <img src="img/burg(2).jpeg" alt="Classic Beef Burger"/>
                <div class="item-body">
                    <h6 class="item-title">Classic Beef Burger</h6>
                    <p class="item-price">LKR.750.00</p>
                    <button class="add-to-basket" data-item="Classic Beef Burger" data-price="750">Add to cart</button>
                </div>
            </div>

            <!--Starters-->
            <div class="itemBox" data-name="Starters">
                <img src="img/Fry-Sauce-2.jpg" alt="French Fries"/>
                <div class="item-body">
                    <h6 class="item-title">French Fries</h6>
                    <p class="item-price">LKR.500.00</p>
                    <button class="add-to-basket" data-item="French Fries" data-price="500">Add to cart</button>
                </div>
            </div>
            <div class="itemBox" data-name="Starters">
                <img src="img/event-3.jpg" alt="Chicken Soup"/>
                <div class="item-body">
                    <h6 class="item-title">Chicken Soup</h6>
                    <p class="item-price">LKR.300.00</p>
                    <button class="add-to-basket" data-item="Chicken Soup" data-price="300">Add to cart</button>
                </div>
            </div>
            <div class="itemBox" data-name="Starters">
                <img src="img/gallery_4.jpg" alt="Fish Roll"/>
                <div class="item-body">
                    <h6 class="item-title">Fish Roll</h6>
                    <p class="item-price">LKR.150.00</p>
                    <button class="add-to-basket" data-item="Fish Roll" data-price="150">Add to cart</button>
                </div>
            </div>

            <!--Beverages-->
            <div class="itemBox" data-name="Beverages">
                <img src="img/pexels-rahulp9800-2559025.jpg" alt="Iced Coffee"/>
                <div class="item-body">
                    <h6 class="item-title">Iced Coffee</h6>
                    <p class="item-price">LKR.200.00</p>
                    <button class="add-to-basket" data-item="Iced Coffee" data-price="200">Add to cart</button>
                </div>
            </div>
            <div class="itemBox" data-name="Beverages">
                <img src="img/service-3.jpg" alt="Fresh Juice"/>
                <div class="item-body">
                    <h6 class="item-title">Fresh Juice</h6>
                    <p class="item-price">LKR.350.00</p>
                    <button class="add-to-basket" data-item="Fresh Juice" data-price="350">Add to cart</button>
                </div>
            </div>
            <div class="itemBox" data-name="Beverages">
                <img src="img/menu_11.jpg" alt="Chocolate Mocha"/>
                <div class="item-body">
                    <h6 class="item-title">Chocolate Mocha</h6>
                    <p class="item-price">LKR.600.00</p>
                    <button class="add-to-basket" data-item="Chocolate Mocha" data-price="600">Add to cart</button>
                </div>
            </div>
            <div class="itemBox" data-name="Beverages">
                <img src="img/gallery_49.jpg" alt="Milkshake"/>
                <div class="item-body">
                    <h6 class="item-title">Milkshake</h6>
                    <p class="item-price">LKR.450.00</p>
                    <button class="add-to-basket" data-item="Milkshake" data-price="450">Add to cart</button>
                </div>
            </div>

            
            <!--Desserts-->
            <div class="itemBox" data-name="Desserts">
                <img src="img/gallery_31.webp" alt="Doughnut"/>
                <div class="item-body">
                    <h6 class="item-title">Doughnut</h6>
                    <p class="item-price">LKR.250.00</p>
                    <button class="add-to-basket" data-item="Doughnut" data-price="250">Add to cart</button>
                </div>
            </div>
            <div class="menu">
    <!-- Desserts -->
    <div class="itemBox" data-name="Desserts">
        <img src="img/gallery_37.jpg" alt="Chocolate Cake"/>
        <div class="item-body">
            <h6 class="item-title">Chocolate Cake</h6>
            <p class="item-price">LKR.550.00</p>
            <button class="add-to-basket" data-item="Chocolate Cake" data-price="550">Add to cart</button>
        </div>
    </div>
    <div class="itemBox" data-name="Desserts">
        <img src="img/gallery_19.jpg" alt="Ice Cream"/>
        <div class="item-body">
            <h6 class="item-title">Ice Cream</h6>
            <p class="item-price">LKR.400.00</p>
            <button class="add-to-basket" data-item="Ice Cream" data-price="400">Add to cart</button>
        </div>
    </div>

    <!-- Dynamic Items from Database -->
    <?php
        // Connect to the database
        $conn = mysqli_connect('localhost', 'root', '2000', 'gallery_cafe');
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch menu items from the database
        $sql = "SELECT * FROM menu_items";
        $result = mysqli_query($conn, $sql);
        $menuItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
    ?>
    
    <?php foreach ($menuItems as $item): ?>
    <div class="itemBox" data-name="Signature_Dishes">
        <img src="img/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>"/>
        <div class="item-body">
            <h6 class="item-title"><?php echo htmlspecialchars($item['title']); ?></h6>
            <p class="item-price">LKR.<?php echo htmlspecialchars($item['price']); ?></p>
            <button class="add-to-basket" data-item="<?php echo htmlspecialchars($item['title']); ?>" data-price="<?php echo htmlspecialchars($item['price']); ?>">Add to cart</button>
        </div>
    </div>
    <?php endforeach; ?>

    <!-- Offers -->
    <div class="itemBox" data-name="Offers">
        <img src="img/IMG-20240730-WA0013.jpg" alt="Family Meal Deal"/>
        <div class="item-body">
            <h6 class="item-title">Family Meal Deal</h6>
            <p class="item-price">LKR.2000.00</p>
            <button class="add-to-basket" data-item="Family Meal Deal" data-price="2000">Add to cart</button>
        </div>
    </div>
    <div class="itemBox" data-name="Offers">
        <img src="img/about-banner.png" alt="Buy One Get One Free"/>
        <div class="item-body">
            <h6 class="item-title">Buy One Get One Free</h6>
            <p class="item-price">LKR.800.00</p>
            <button class="add-to-basket" data-item="Buy One Get One Free" data-price="800">Add to cart</button>
        </div>
    </div>
</div>

        

        <div class="basket">
            <h2>Basket</h2>
            <ul class="basket-items">
                <!-- Items will be added here dynamically -->
            </ul>
            <p class="total-price">Total: LKR 0.00</p>
            <a href="checkout.html" class="checkout-button">Go to Checkout</a>
        </div>
    </div>




    <!--Footer-->
    <footer>
        <div class="footer_main">
            <div class="footer_tag">
                <h2>Location</h2>
                <p>No 65,<br> De Silva Road,<br> Colombo 4,<br> Sri Lanka.</p>
            </div>
            <div class="footer_tag">
                <h2>Contact</h2>
                <p>+94 12345678</p>
                <p>+94 38 987654</p>
                <p>theGallerycafe@gmail.com</p>
            </div>
            <div class="footer_tag">
                <h2>Our Services</h2>
                <p>Parking Space</p>
                <p>Online Reservations</p>
                <p>24 x 7 Service</p>
                <i class="far fa-credit-card"></i>
            </div>
            <div class="footer_tag">
                <h2>Follows</h2>
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin-in"></i>
            </div>
        </div>
        <p class="end">All rights Reserved<span><i class="fa-solid fa-"></i> The Gallery Cafe </span></p>
    </footer>
    
</body>
</html>
