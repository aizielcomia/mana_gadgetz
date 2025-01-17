<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('db.php');

// Check if the user is logged in
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null;

if (!$user_email) {
    $_SESSION['error'] = "You must be logged in to view your cart.";
    echo "<script>window.location.href = 'index.php';</script>";
    exit();
}

// Fetch cart items for the logged-in user
$stmt = $conn->prepare("SELECT cart.id, products.name, products.image, cart.quantity, products.price, cart.product_id
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

// Process the checkout when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Insert cart items into checkouts table
    if (!empty($cart_items)) {
        $stmt = $conn->prepare("INSERT INTO checkouts (user_email, product_id, quantity, price) VALUES (?, ?, ?, ?)");

        foreach ($cart_items as $item) {
            $stmt->bind_param("siii", $user_email, $item['product_id'], $item['quantity'], $item['price']);
            $stmt->execute();
        }
        $stmt->close();

        // Clear cart after checkout
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_email = ?");
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $stmt->close();

        // Redirect to order confirmation page or thank you page
        echo "<script>window.location.href = 'index.php?page=thanks';</script>";
        exit();
    } else {
        $_SESSION['error'] = "Your cart is empty.";
        echo "<script>window.location.href = 'index.php?page=cart';</script>";
        exit();
    }
}
?>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .cart-container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            display: flex;
            padding: 15px;
            border-bottom: 1px solid #eee;
            align-items: center;
        }

        .cart-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 8px;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-details h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .cart-item-details p {
            color: #777;
            margin: 5px 0;
        }

        .cart-item-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .quantity-input {
            width: 50px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
        }

        .remove-item {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
        }

        .remove-item:hover {
            background-color: #c0392b;
        }

        .cart-summary {
            margin-top: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-summary h2 {
            margin: 0 0 10px;
            font-size: 1.4rem;
        }

        .total-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #27ae60;
        }

        .checkout-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #27ae60;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
            font-size: 1rem;
            cursor: pointer;
        }

        .checkout-btn:hover {
            background-color: #2ecc71;
        }

        .empty-cart {
            text-align: center;
            padding: 20px;
            font-size: 1.2rem;
            color: #555;
        }

        .error-message {
            color: #e74c3c;
            font-size: 1.1rem;
            text-align: center;
        }
    </style>
    <h1>Your Shopping Cart</h1>

<?php if (isset($_SESSION['error'])): ?>
    <p class="error-message"><?= $_SESSION['error']; ?></p>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<div class="cart-container">
    <?php if (!empty($cart_items)) : ?>
        <?php foreach ($cart_items as $item) : ?>
            <div class="cart-item">
                <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                <div class="cart-item-details">
                    <h3><?= htmlspecialchars($item['name']) ?></h3>
                    <p>Price: $<?= number_format($item['price'], 2) ?></p>
                    <div class="cart-item-actions">
                        <input type="number" class="quantity-input" value="<?= $item['quantity'] ?>" min="1" disabled>
                        <form action="remove_from_cart.php" method="POST" style="display: inline;">
                            <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
                            <button type="submit" class="remove-item">Remove</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="cart-summary">
            <h2>Order Summary</h2>
            <p>Total Items: <?= count($cart_items) ?></p>
            <p class="total-price">Total Price: $<?= number_format($total_price, 2) ?></p>
            
            <!-- Checkout Form -->
            <form method="POST">
                <input type="hidden" name="total_price" value="<?= $total_price ?>">
                <input type="hidden" name="total_items" value="<?= count($cart_items) ?>">
                
                <button type="submit" class="checkout-btn">Proceed to Checkout</button>
            </form>
        </div>

    <?php else: ?>
        <div class="empty-cart">
            <p>Your cart is empty. Start shopping now!</p>
        </div>
    <?php endif; ?>
</div>