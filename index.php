<?php
include 'router.php'; 

include 'navbar.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'iphone16';
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
    default:
        include 'contents/pages/iphone16.php'; 
}
?>
