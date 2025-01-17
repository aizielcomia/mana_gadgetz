<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page = isset($_GET['page']) ? $_GET['page'] : 'iphone16';
?>
<style>
    .navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 30px;
        background: linear-gradient(90deg, #6f42c1, #543d8a);
        color: white;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Brand Section */
    .navbar-brand {
        display: flex;
        align-items: center;
        font-size: 1.5rem;
        font-weight: bold;
        color: white;
    }

    .navbar-brand img {
        width: 50px;
        margin-right: 10px;
    }

    /* Navbar Links */
    .navbar-nav {
        display: flex;
        list-style: none;
        gap: 20px;
    }

    .nav-item .nav-link {
        text-decoration: none;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .nav-item .nav-link:hover,
    .nav-item .nav-link.active {
        background-color: #ffd700;
        color: #6f42c1;
    }

    /* Responsive Styles */
    .navbar-toggler {
        display: none;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: white;
        cursor: pointer;
    }

    .navbar-collapse {
        display: flex;
        align-items: center;
    }

    @media (max-width: 768px) {
        .navbar-collapse {
            display: none;
            flex-direction: column;
            gap: 10px;
            background: linear-gradient(90deg, #6f42c1, #543d8a);
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            padding: 10px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-collapse.show {
            display: flex;
            animation: slideDown 0.3s ease-in-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar-toggler {
            display: block;
        }
    }
</style>

<nav class="navbar" aria-label="Main Navigation">
    <div class="navbar-brand">
        <img src="contents/img/logo.jpg" alt="Logo">
        MANA GADGETZ
    </div>
    <button class="navbar-toggler" aria-expanded="false" aria-controls="navbarNav" onclick="toggleNavbar()">
        ☰
    </button>
    <div class="navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
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
                <a class="nav-link <?= $page === 'cart' ? 'active' : '' ?>" href="index.php?page=cart">Cart</a>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=profile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=signup">Signup</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<script>
    function toggleNavbar() {
        const navbar = document.getElementById('navbarNav');
        const toggler = document.querySelector('.navbar-toggler');
        const isExpanded = toggler.getAttribute('aria-expanded') === 'true';

        toggler.setAttribute('aria-expanded', !isExpanded);
        navbar.classList.toggle('show');
    }
</script>
