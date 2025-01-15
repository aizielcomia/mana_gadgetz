<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'iphone16';  // Define current page
?>

<style>
    /* General Styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #111;
        color: #f5f5f5;
    }

    .navbar {
        background-color: #222; /* Dark background */
        padding: 10px 20px;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        color: #f5f5f5;
        text-decoration: none;
    }

    .navbar-brand img {
        width: 40px;
        height: auto;
        margin-right: 10px;
    }

    .navbar-brand span {
        font-size: 1.4rem;
        font-weight: bold;
        color: #f5f5f5;
    }

    /* Navbar Links */
    .navbar-nav {
        list-style-type: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .nav-item {
        display: inline-block;
        margin-left: 20px;
    }

    .nav-link {
        color: #f5f5f5;
        font-size: 1.1rem;
        padding: 8px 12px;
        text-decoration: none;
        transition: color 0.3s ease, background-color 0.3s ease;
    }

    .nav-link:hover,
    .nav-link.active {
        background-color: #6f42c1; /* Purple background on hover and active state */
        color: #fff;
        border-radius: 5px;
    }

    /* Toggler button for mobile */
    .navbar-toggler {
        border: none;
        background-color: transparent;
    }

    .navbar-toggler-icon {
        background-color: #f5f5f5;
    }

    /* Responsive Navbar */
    @media (max-width: 768px) {
        .navbar-nav {
            text-align: center;
            margin-top: 15px;
        }

        .nav-item {
            display: block;
            margin-left: 0;
            margin-bottom: 10px;
        }

        .navbar-toggler-icon {
            font-size: 30px;
        }
    }
</style>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="contents/img/logo.jpg" alt="Logo">
            <span>MANA GADGETZ</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $page === 'iphone16' ? 'active' : '' ?>" href="index.php?page=iphone16">iPhone 16</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page === 'iphone15' ? 'active' : '' ?>" href="index.php?page=iphone15">iPhone 15</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page === 'iphone14' ? 'active' : '' ?>" href="index.php?page=iphone14">iPhone 14</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page === 'iphone13' ? 'active' : '' ?>" href="index.php?page=iphone13">iPhone 13</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page === 'iphone12' ? 'active' : '' ?>" href="index.php?page=iphone12">iPhone 12</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page === 'iphone11' ? 'active' : '' ?>" href="index.php?page=iphone11">iPhone 11</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page === 'cart' ? 'active' : '' ?>" href="index.php?page=cart">CART</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
