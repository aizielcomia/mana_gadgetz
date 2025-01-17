<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('db.php');

// Check if the user is logged in and if they are an admin
if (!isset($_SESSION['user_email']) || $_SESSION['user_email'] != 'admin@managadgetz.com') {
    echo "<script>window.location.href = '../index.php';</script>";
    exit();
}

// Fetch the list of products if the user is an admin
if ($conn) {
    $products = [];
    $result = $conn->query("SELECT * FROM products");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    } else {
        die("Error fetching products: " . $conn->error);
    }
} else {
    die("Database connection error.");
}

// Handle product deletion
if (isset($_POST['delete_product'])) {
    $product_id = $conn->real_escape_string($_POST['product_id']);

    // Delete the product from the database
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        echo "<script>alert('Product deleted successfully.'); window.location.href = 'index.php';</script>";
        exit();
    } else {
        $_SESSION['error'] = "Error deleting product: " . $stmt->error;
    }

    $stmt->close();
}
?>
