<?php
session_start();


// Initialize the shopping cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle actions from AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    // Add product to cart
    if ($action === 'add') {
        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];
        $quantity = $_POST['quantity'];

        // Check if product already exists in cart
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = [
                'name' => $productName,
                'price' => $productPrice,
                'quantity' => $quantity,
            ];
        }
        echo json_encode(['success' => true, 'message' => 'Product added to cart!']);
    }

    // Remove product from cart
    if ($action === 'remove') {
        $productId = $_POST['product_id'];
        unset($_SESSION['cart'][$productId]);
        echo json_encode(['success' => true, 'message' => 'Product removed from cart!']);
    }

    // Update product quantity in cart
    if ($action === 'update') {
        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] = $quantity;
        }
        echo json_encode(['success' => true, 'message' => 'Cart updated!']);
    }

    exit();
}

// Display cart items
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $cartItems = $_SESSION['cart'];
    $total = 0;
    foreach ($cartItems as $id => $item) {
        $total += $item['price'] * $item['quantity'];
    }
    echo json_encode(['cart' => $cartItems, 'total' => $total]);
    exit();
}
?>
