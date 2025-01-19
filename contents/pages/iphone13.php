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

// Fetch iPhone13 products from the database
$category = 'iPhone13';
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
    body {
        background: linear-gradient(135deg, #1e1e2e, #282843);
        color: #fff;
        margin: 0;
        padding: 0;
    }

    .iphone-con h1 {
        text-align: center;
        margin-top: 20px;
        font-size: 3rem;
        color: #ff9f43;
        text-shadow: 2px 2px 8px rgba(255, 159, 67, 0.7);
    }

    .iphone-con p {
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        font-size: 1rem;
        color: #ccc;
    }

    /* Product Container */
    .product-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .product-container {
            grid-template-columns: 1fr;
        }
    }

    /* Product Card */
    .product-card {
        background: linear-gradient(145deg, #33334d, #232333);
        border-radius: 12px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
    }

    /* Product Image */
    .product-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    /* Product Details */
    .product-details {
        padding: 15px;
        text-align: center;
    }

    .product-details h2 {
        font-size: 1.6rem;
        color: #ff9f43;
        margin: 0 0 10px;
        text-shadow: 1px 1px 5px rgba(255, 159, 67, 0.5);
    }

    .product-details p {
        font-size: 1rem;
        color: #aaa;
        margin-bottom: 15px;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px;
    }

    .product-price {
        font-size: 1.4rem;
        font-weight: bold;
        color: #74b9ff;
        text-shadow: 1px 1px 5px rgba(116, 185, 255, 0.7);
    }

    .price-row span {
        font-family: Arial, Helvetica, sans-serif;
    }

    .price-row form {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    /* Buttons */
    .add_to_cart {
        font-size: 1rem;
        color: #fff;
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .quantity-container {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .quantity-btn-add,
    .quantity-btn-minus {
        font-size: 1.2rem;
        color: #fff;
        background-color: #6c5ce7;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .quantity-btn-add:hover {
        background-color: #4e42a8;
    }

    .quantity-btn-minus:hover {
        background-color: #4e42a8;
    }

    .quantity-container input[type="number"] {
        width: 50px; /* Adjust the width of the input field */
        text-align: center;
        padding: 5px;
        font-size: 1rem;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .add_to_cart {
        background-color: #6c5ce7;
    }

    .quantity-btn-add:hover {
        background-color: #01a89c;
    }

    .quantity-btn-minus:hover {
        background-color: #b52020;
    }

    .add_to_cart:hover {
        background-color: #4e42a8;
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
    <h1>iPhone 13 Phones</h1>
    <?php if (isset($_SESSION['message']) || isset($_SESSION['error'])): ?>
        <div class="message <?= isset($_SESSION['error']) ? 'error' : '' ?>" id="flash-message">
            <?= $_SESSION['message'] ?? $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['message'], $_SESSION['error']); ?>
    <?php endif; ?>
    <div class="product-container">
        <!-- Dynamic Product Cards -->
        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $product) : ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="product-details">
                        <h2><?= htmlspecialchars($product['name']) ?></h2>
                        <p><?= htmlspecialchars($product['description']) ?></p>
                        <div class="price-row">
                            <span class="product-price">$<?= number_format($product['price'], 2) ?></span>
                            <form method="POST">
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