<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include 'router.php';
include 'navbar.php';

// Get the current page from the query string
$page = isset($_GET['page']) ? $_GET['page'] : 'iphone16';

// Only include the carousel if the current page is not login, signup, or profile
if ($page !== 'login' && $page !== 'signup' && $page !== 'profile') {
    include 'carousel.html';
}

route($page);

switch ($page) {
    case 'iphone16':
        include 'contents/pages/iphone16.php';
        break;
    case 'iphone15':
        include 'contents/pages/iphone15.php';
        break;
    case 'iphone14':
        include 'contents/pages/iphone14.php';
        break;
    case 'iphone13':
        include 'contents/pages/iphone13.php';
        break;
    case 'iphone12':
        include 'contents/pages/iphone12.php';
        break;
    case 'iphone11':
        include 'contents/pages/iphone11.php';
        break;
    case 'cart':
        include 'contents/pages/cart.php';
        break;
    case 'login':
        include 'contents/pages/login.php';
        break;
    case 'signup':
        include 'contents/pages/signup.php';
        break;
    case 'profile':
        include 'contents/pages/profile.php';
        break;
    default:
        include 'contents/pages/iphone16.php'; 
}
?>
</body>
</html>
