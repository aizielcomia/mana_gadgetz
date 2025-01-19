<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MANA GADGETZ</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap');

    /* Apply imported font */
    body {
        font-family: 'Permanent Marker', sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        background: linear-gradient(90deg, #f8f0f8, #d3c0f4);
    }

    .route-container {
        flex: 1; /* Ensures this section takes up remaining space between header and footer */
        padding: 20px;
    }

    footer {
        background: #24243e;
        color: #fff;
        text-align: center;
        padding: 15px 0;
        border-top: 2px solid #444;
        font-size: 1rem;
    }
</style>
</head>
<body>
<?php
include 'router.php';
include 'nav.php';

if ($page !== 'login' && $page !== 'signup' && $page !== 'profile' && $page !== 'cart' && $page !== 'thanks') {
    include 'carousel.html';
}

$page = isset($_GET['page']) ? $_GET['page'] : 'iphone16';

echo '<div class="route-container">';
    route($page); 
echo '</div>';

include 'footer.html';
?>
</body>
</html>
