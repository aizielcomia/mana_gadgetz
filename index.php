<?php
// finals/index.php
require_once 'route.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Navigation Bar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            display: flex;
            background-color: #333;
            padding: 10px;
        }
        .navbar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }
        .navbar a:hover {
            background-color: #575757;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="?page=iphone11">iPhone 11</a>
        <a href="?page=iphone12">iPhone 12</a>
        <a href="?page=iphone13">iPhone 13</a>
        <a href="?page=iphone14">iPhone 14</a>
        <a href="?page=iphone15">iPhone 15</a>
        <a href="?page=iphone16promax">iPhone 16 Pro Max</a>
    </div>

    <div class="content">
        <?php
        // Load the appropriate page content
        $page = $_GET['page'] ?? 'default';
        echo loadPage($page);
        ?>
    </div>
</body>
</html>
