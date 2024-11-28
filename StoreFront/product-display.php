<?php
// Fetch product data from your API (same as before)
$products = [
    [
        'id' => 1,
        'name' => 'Performance T-Shirt',
        'price' => 999,
        'images' => ['image1.jpg', 'image2.jpg'],
        'description' => 'High-quality performance T-shirt.',
    ],
    [
        'id' => 2,
        'name' => 'Running Shoes',
        'price' => 2999,
        'images' => ['shoe1.jpg', 'shoe2.jpg'],
        'description' => 'Comfortable and lightweight running shoes.',
    ],
];

// Fetch the cart data (for displaying cart items)
$cartItems = [];
if (isset($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // Function to add product to cart using AJAX
        function addToCart(productId, productName, productPrice) {
            fetch('cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    action: 'add',
                    product_id: productId,
                    product_name: productName,
                    product_price: productPrice,
                    quantity: 1, // Default quantity
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    alert(data.message);
                    // Optionally update the cart display
                    fetchCart();
                });
        }

        // Function to remove product from cart
        function removeFromCart(productId) {
            fetch('cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    action: 'remove',
                    product_id: productId,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    alert(data.message);
                    // Optionally update the cart display
                    fetchCart();
                });
        }

        // Fetch cart items and update cart icon or display
        function fetchCart() {
            fetch('cart.php')
                .then((response) => response.json())
                .then((data) => {
                    document.getElementById('cart-count').innerText = Object.keys(data.cart).length;

                    // Update cart display (you can display cart items in a modal or a sidebar)
                    let cartItemsHTML = '';
                    let total = 0;
                    for (let productId in data.cart) {
                        const item = data.cart[productId];
                        cartItemsHTML += `
                            <div class="cart-item">
                                <h3>${item.name}</h3>
                                <p>Price: ₹${item.price}</p>
                                <p>Quantity: ${item.quantity}</p>
                                <button onclick="removeFromCart(${productId})">Remove</button>
                            </div>
                        `;
                        total += item.price * item.quantity;
                    }

                    document.getElementById('cart-items').innerHTML = cartItemsHTML;
                    document.getElementById('cart-total').innerText = 'Total: ₹' + total;
                });
        }

        // Call fetchCart on page load to update cart count and items
        window.onload = fetchCart;
    </script>
</head>
<body>
    <header>
        <h1>Product Display</h1>
        <div class="cart-icon">
            🛒 <span id="cart-count">0</span>
        </div>
    </header>

    <main>
        <div class="products">
            <?php foreach ($products as $product) { ?>
                <div class="product">
                    <h2><?php echo $product['name']; ?></h2>
                    <img src="<?php echo $product['images'][0]; ?>" alt="<?php echo $product['name']; ?>">
                    <p>Price: ₹<?php echo $product['price']; ?></p>
                    <p><?php echo $product['description']; ?></p>
                    <button onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo $product['name']; ?>', <?php echo $product['price']; ?>)">
                        Add to Cart
                    </button>
                </div>
            <?php } ?>
        </div>

        <!-- Cart display -->
        <div id="cart-display">
            <h2>Your Cart</h2>
            <div id="cart-items"></div>
            <div id="cart-total"></div>
        </div>
    </main>
</body>
</html>
