<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
include('db.php');

// Check if the user is logged in
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : null;

if (!$user_email) {
    $_SESSION['error'] = "You must be logged in to view your orders.";
    echo "<script>window.location.href = 'index.php';</script>";
    exit();
}

// Fetch the most recent checkout details for the logged-in user
$stmt = $conn->prepare("SELECT checkouts.id, checkouts.product_id, checkouts.quantity, checkouts.price, checkouts.order_date, products.name 
                        FROM checkouts 
                        JOIN products ON checkouts.product_id = products.id 
                        WHERE checkouts.user_email = ? 
                        ORDER BY checkouts.order_date DESC");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$order_items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<style>
    .thank-you-container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }
    
    .thank-you-container h1 {
        font-size: 28px;
        color: #4CAF50;
        text-align: center;
    }

    .thank-you-container p {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
        text-align: center;
        margin-top: 20px;
    }

    .order-summary {
        margin-top: 30px;
    }

    .order-summary h2 {
        font-size: 22px;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
    }

    table th, table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-family: Arial, Helvetica, sans-serif;
    }

    table th {
        background-color: #f4f4f4;
        font-family: Arial, Helvetica, sans-serif;
    }

    .total-price {
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        margin-top: 20px;
    }

    .back-to-home {
        display: block;
        width: 200px;
        margin: 30px auto;
        text-align: center;
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-decoration: none;
    }

    .back-to-home:hover {
        background-color: #45a049;
    }
</style>
<div class="thank-you-container">
    <h1>Thank You for Your Purchase!</h1>
    <p>Your order has been successfully placed. Here is a summary of your order:</p>

    <?php if (!empty($order_items)) : ?>
        <div class="order-summary">
            <h2>Order History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_price = 0;
                    foreach ($order_items as $item) :
                        $item_total = $item['quantity'] * $item['price'];
                        $total_price += $item_total;
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>$<?= number_format($item['price'], 2) ?></td>
                            <td>$<?= number_format($item_total, 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="total-price"><strong>Total Price: $<?= number_format($total_price, 2) ?></strong></p>
        </div>
    <?php else: ?>
        <p>Unfortunately, we couldn't find any order details. Please try again later.</p>
    <?php endif; ?>

    <a href="index.php" class="back-to-home">Back to Home</a>
</div>
