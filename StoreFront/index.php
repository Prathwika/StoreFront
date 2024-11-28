<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="styles.css">
    <script src="cart.js" defer></script>
</head>
<body>
    <!-- Promotions -->
    <section class="promotions">
        <div class="promotion-banner">
            <h2>Winter Sale - Up to 50% Off!</h2>
            <a href="#" class="btn-shop">Shop Now</a>
        </div>
    </section>

    <!-- Product Display -->
    <section class="product-display">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <div class="product">
                <img src="images/running-shoes.png" alt="Product 1">
                <h3>Running Shoes</h3>
                <p>₹4999</p>
                <button onclick="addToCart(1, 'Running Shoes', 4999)">Add to Cart</button>
            </div>
            <div class="product">
                <img src="images/workout-leggings.jpg" alt="Product 2">
                <h3>Workout Leggings</h3>
                <p>₹1999</p>
                <button onclick="addToCart(2, 'Workout Leggings', 1999)">Add to Cart</button>
            </div>
        </div>
    </section>

    <!-- Brands Slider -->
    <section class="brands-slider">
        <h2>Our Brands</h2>
        <div class="brands">
            <img src="https://example.com/brand1.jpg" alt="Brand 1">
            <img src="https://example.com/brand2.jpg" alt="Brand 2">
        </div>
    </section>

    <!-- Cart Icon -->
    <div id="cart-icon" class="cart-icon">
        <a href="cart.php">
            <img src="images/cart-icon.png" alt="Cart">
            <span id="cart-count">0</span>
        </a>
    </div>
</body>
</html>
