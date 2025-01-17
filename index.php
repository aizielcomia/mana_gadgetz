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

// // Only include the carousel if the current page is not login, signup, or profile
// if ($page !== 'login' && $page !== 'signup' && $page !== 'profile') {
//     include 'carousel.html';
// }

route($page);

?>
</body>
</html>
