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
            alert(data.message); // Display success message
            fetchCart(); // Fetch updated cart details
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

// Fetch cart items and update cart icon or display
function fetchCart() {
    fetch('cart.php')
        .then((response) => response.json())
        .then((data) => {
            // Update the cart count in the UI
            document.getElementById('cart-count').innerText = Object.keys(data.cart).length;
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}

// Call fetchCart on page load to update cart count
window.onload = fetchCart;
