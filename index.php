<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MANA GADGETZ</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap');

    body {
        font-family: 'Permanent Marker', sans-serif; /* Use the imported font */
        background-color: linear-gradient(90deg, #f8f0f8, #d3c0f4);
        margin: 0;
        padding: 0;
    }

    .route-container {
        height: 830px;
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
