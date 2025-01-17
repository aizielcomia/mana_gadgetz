<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../../db.php');

// Check if the user is logged in
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null;

if (!$user_email) {
    $_SESSION['error'] = "You must be logged in to proceed with checkout.";
    echo "<script>window.location.href = 'index.php';</script>";
    exit();
}

// Fetch cart items for the logged-in user
$stmt = $conn->prepare("SELECT cart.id, products.name, products.image, cart.quantity, products.price 
                        FROM cart 
                        JOIN products ON cart.product_id = products.id 
                        WHERE cart.user_email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Calculate total price
$total_price = 0;
foreach ($cart_items as $item) {
    $total_price += $item['quantity'] * $item['price'];
}

// Insert items into checkouts table
if (!empty($cart_items)) {
    $stmt = $conn->prepare("INSERT INTO checkouts (user_email, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    
    foreach ($cart_items as $item) {
        $stmt->bind_param("siii", $user_email, $item['id'], $item['quantity'], $item['price']);
        $stmt->execute();
    }
    $stmt->close();
    
    // Clear cart after checkout
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_email = ?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $stmt->close();
    
    // Redirect to order confirmation page
    echo "<script>window.location.href = 'order_confirmation.php';</script>";
    exit();
} else {
    $_SESSION['error'] = "Your cart is empty.";
    echo "<script>window.location.href = 'cart.php';</script>";
    exit();
}
?>
