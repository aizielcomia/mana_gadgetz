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

// Fetch iPhone12 products from the database
$category = 'iPhone12';
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
<style>
    /* General Styles */
    .iphone-con h1 {
        text-align: center;
        margin-top: 20px;
        font-size: 2.5rem;
        color: #333;
    }

    p {
        text-align: center;
        font-size: 1rem;
        color: #666;
    }

    /* Product Container */
    /* Product Container */
/* Product Container */
.product-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 3 cards per row */
    gap: 20px;
    padding: 20px;
    max-width: 100%; /* Allowing full width for responsiveness */
    margin: 0 auto;
}


    /* Product Card */
    .product-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }

    /* Product Image */
    .product-card img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    /* Product Details */
    .product-details {
        padding: 15px;
    }

    .product-details h2 {
        font-size: 1.5rem;
        margin: 0 0 10px;
        color: #333;
        text-align: center;
    }

    .product-details p {
        font-size: 1rem;
        color: #666;
        margin: 0 0 10px;
    }

    .product-details .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
    }

    .product-details span {
        font-size: 1.4rem;
        color:rgb(0, 0, 0);
        font-weight: bold;
    }

    form {
        display: flex;
        gap: 70px;
        align-items: center;
    }

    /* Quantity Form Styles */
    .quantity-container {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .quantity-btn-add {
        font-size: 1.2rem;
        color: #fff;
        background-color:rgb(36, 180, 77);
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .quantity-btn-minus {
        font-size: 1.2rem;
        color: #fff;
        background-color:rgb(228, 14, 14);
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .quantity-btn:hover {
        background-color: #0056b3;
    }

    form input[type="number"] {
        width: 30px;
        text-align: center;
        padding: 5px;
        font-size: 1rem;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .add_to_cart {
        padding: 7px 15px;
    }

    form button {
        font-size: 1rem;
        color: #fff;
        background:rgb(108, 17, 141);
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    /* Styles for messages */
    .message {
        text-align: center;
        font-size: 1rem;
        color: #fff;
        background-color: #28a745;
        padding: 10px;
        border-radius: 5px;
        margin: 10px auto;
        max-width: 500px;
        display: none;
    }
    .error {
        background-color: #dc3545;
    }
</style>
<div class="iphone-con">
    <h1>iPhone 12 Products</h1>
    <?php if (isset($_SESSION['message']) || isset($_SESSION['error'])): ?>
        <div class="message <?= isset($_SESSION['error']) ? 'error' : '' ?>" id="flash-message">
            <?= $_SESSION['message'] ?? $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['message'], $_SESSION['error']); ?>
    <?php endif; ?>

    <div class="product-container">
        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $product) : ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="product-details">
                        <h2><?= htmlspecialchars($product['name']) ?></h2>
                        <p><?= htmlspecialchars($product['description']) ?></p>
                        <div class="price-row">
                            <span class="product-price">$<?= number_format($product['price'], 2) ?></span>
                            <form method="POST" class="quantity-form">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <div class="quantity-container">
                                    <button type="button" class="quantity-btn-minus" onclick="decrement(this)">-</button>
                                    <input type="number" name="quantity" value="1" min="1" required>
                                    <button type="button" class="quantity-btn-add" onclick="increment(this)">+</button>
                                </div>
                                <button type="submit" class="add_to_cart" name="add_to_cart">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No products available in this category.</p>
        <?php endif; ?>
    </div>
    <script>
        // Display the message and hide it after 3 seconds
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.style.display = 'block';
            setTimeout(() => {
                flashMessage.style.display = 'none';
            }, 3500);
        }

        function increment(button) {
            const input = button.previousElementSibling;
            if (input) {
                input.stepUp();
            }
        }

        function decrement(button) {
            const input = button.nextElementSibling;
            if (input && input.value > 1) {
                input.stepDown();
            }
        }
    </script>
</div>