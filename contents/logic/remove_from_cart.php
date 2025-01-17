<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../../db.php');

// Ensure the user is logged in
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null;
if (!$user_email) {
    $_SESSION['error'] = "You must be logged in to manage your cart.";
    echo "<script>window.location.href = 'index.php';</script>";
    exit();
}

// Remove Item from Cart
if (isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];
    
    // Delete the item from the cart
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_email = ?");
    $stmt->bind_param("is", $cart_id, $user_email);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Item removed from cart.";
    } else {
        $_SESSION['error'] = "Failed to remove item from cart.";
    }
    $stmt->close();
}

// Increment Quantity in Cart
if (isset($_POST['increment_quantity'])) {
    $cart_id = $_POST['cart_id'];

    // Update the quantity of the product in the cart
    $stmt = $conn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE id = ? AND user_email = ?");
    $stmt->bind_param("is", $cart_id, $user_email);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Item quantity updated.";
    } else {
        $_SESSION['error'] = "Failed to update item quantity.";
    }
    $stmt->close();
}

// Redirect back to the cart page
echo "<script>window.location.href = '../../index.php?page=cart';</script>";
exit();
?>
