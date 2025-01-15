<?php
session_start();
include('db.php'); // Include the database connection

// Generate a session ID
$session_id = session_id();

// Check if a product ID is provided via GET
if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    $quantity = 1; // Default quantity

    // Fetch product details from the database
    $stmt = $db->prepare("SELECT * FROM products WHERE id = :product_id");
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the product exists
    if ($product) {
        // Check if the product is already in the cart
        $stmt = $db->prepare("SELECT * FROM cart WHERE session_id = :session_id AND product_id = :product_id");
        $stmt->bindParam(':session_id', $session_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();

        // If the product is already in the cart, update the quantity
        if ($stmt->rowCount() > 0) {
            $stmt = $db->prepare("UPDATE cart SET quantity = quantity + 1 WHERE session_id = :session_id AND product_id = :product_id");
            $stmt->bindParam(':session_id', $session_id);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->execute();
        } else {
            // If the product is not in the cart, insert a new row
            $stmt = $db->prepare("INSERT INTO cart (session_id, product_id, quantity) VALUES (:session_id, :product_id, :quantity)");
            $stmt->bindParam(':session_id', $session_id);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->execute();
        }

        // Redirect back to the cart page to see the updated cart
        header('Location: index.php?page=cart.php');
        exit();
    } else {
        // If the product doesn't exist, show an error message
        echo "Product not found.";
    }
} else {
    // If no product ID is provided, show an error message
    echo "Invalid request.";
}
?>
