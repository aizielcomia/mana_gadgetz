<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../../db.php');

// Ensure the user is logged in
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null;
if (!$user_email) {
    echo json_encode(['success' => false, 'message' => 'You must be logged in to update your cart.']);
    exit();
}

if (isset($_POST['cart_id']) && isset($_POST['quantity'])) {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    // Update the quantity of the product in the cart
    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ? AND user_email = ?");
    $stmt->bind_param("iis", $quantity, $cart_id, $user_email);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Quantity updated successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update quantity.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data.']);
}
?>
