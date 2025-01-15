<?php
session_start();
include('db.php'); // Include the database connection

// Generate a unique session ID if it doesn't exist
if (!isset($_SESSION['session_id'])) {
    $_SESSION['session_id'] = session_id();
}

$session_id = $_SESSION['session_id'];

// Fetch all items in the user's cart
$stmt = $db->prepare("SELECT cart.*, products.name, products.price, products.image FROM cart
                      JOIN products ON cart.product_id = products.id
                      WHERE cart.session_id = :session_id");
$stmt->bindParam(':session_id', $session_id);
$stmt->execute();
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            padding: 20px 0;
            background-color: #ffcc00;
            margin: 0;
            font-size: 2.5rem;
        }

        .cart-container {
            padding: 20px;
        }

        .cart-item {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .cart-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }

        .cart-item-details {
            flex-grow: 1;
        }

        .cart-item-details h3 {
            font-size: 1.4rem;
            margin: 0;
            color: #ff6600;
        }

        .cart-item-details p {
            font-size: 1.1rem;
            color: #555;
        }

        .cart-item-details p strong {
            font-weight: bold;
        }

        .cart-item-details .quantity {
            font-weight: bold;
            margin-top: 10px;
        }

        .checkout-btn {
            background-color: #ff6600;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.2rem;
            margin-top: 20px;
            display: block;
            text-align: center;
            width: 200px;
            margin: 0 auto;
        }

        .checkout-btn:hover {
            background-color: #e65c00;
        }

        .empty-cart {
            text-align: center;
            color: #ff6600;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <h1>Your Cart</h1>
    <div class="cart-container">
        <?php if ($cart_items): ?>
            <?php
            $total_price = 0;
            foreach ($cart_items as $item):
                ?>
                <div class="cart-item">
                    <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                    <div class="cart-item-details">
                        <h3><?= htmlspecialchars($item['name']) ?></h3>
                        <p><strong>Price:</strong> ₱<?= number_format($item['price'], 2) ?></p>
                        <p class="quantity"><strong>Quantity:</strong> <?= $item['quantity'] ?></p>
                        <p><strong>Total:</strong> ₱<?= number_format($item['price'] * $item['quantity'], 2) ?></p>
                    </div>
                </div>
                <?php
                $total_price += $item['price'] * $item['quantity'];
            endforeach;
            ?>
            <div class="cart-summary">
                <h3>Total: ₱<?= number_format($total_price, 2) ?></h3>
                <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
            </div>
        <?php else: ?>
            <p class="empty-cart">Your cart is empty.</p>
        <?php endif; ?>
    </div>
</body>
</html>
