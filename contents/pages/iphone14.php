<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('db.php');

// Ensure the user is logged in
if (!isset($_SESSION['user_email'])) {
    $_SESSION['error'] = "You must be logged in to add products to the cart.";
    echo "<script>window.location.href = 'index.php?page=login';</script>";
    exit;
}

$user_email = $_SESSION['user_email'];

// Fetch iPhone14 products from the database
$category = 'iPhone14';
$stmt = $conn->prepare("SELECT * FROM products WHERE category = ?");
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);

// Handle "Add to Cart" functionality
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Insert product into the cart
    $stmt = $conn->prepare("INSERT INTO cart (user_email, product_id, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $user_email, $product_id, $quantity);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Product added to cart!";
    } else {
        $_SESSION['error'] = "Failed to add product to cart.";
    }
    $stmt->close();
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPhone14 Products</title>
    <style>
                /* General Styling */
                body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #333;
            margin: 20px 0;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-details {
            padding: 15px;
        }

        .product-details h2 {
            font-size: 1.2rem;
            margin: 0;
            color: #333;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        .product-details p {
            font-size: 0.9rem;
            color: #555;
            margin: 10px 0;
            height: 40px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .product-details span {
            font-weight: bold;
            font-size: 1.1rem;
            color: #6f42c1;
        }

        .add-to-cart {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background: #6f42c1;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background 0.3s ease;
        }

        .add-to-cart:hover {
            background: #543d8a;
        }
    </style>
</head>
<body>
    <h1>iPhone14 Products</h1>
    <?php if (isset($_SESSION['message'])): ?>
        <p><?= $_SESSION['message']; ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php elseif (isset($_SESSION['error'])): ?>
        <p><?= $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="product-container">
        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $product) : ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="product-details">
                        <h2><?= htmlspecialchars($product['name']) ?></h2>
                        <p><?= htmlspecialchars($product['description']) ?></p>
                        <span>$<?= number_format($product['price'], 2) ?></span>
                        <!-- Product Display Form -->
                        <form method="POST">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <input type="number" name="quantity" value="1" min="1" required>
                            <button type="submit" name="add_to_cart">Add to Cart</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No products available in this category.</p>
        <?php endif; ?>
    </div>
</body>
</html>
