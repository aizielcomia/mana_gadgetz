<?php
function route($page) {
    $pages = [
        'iphone16' => 'contents/pages/iphone16.php',
        'iphone15' => 'contents/pages/iphone15.php',
        'iphone14' => 'contents/pages/iphone14.php',
        'iphone13' => 'contents/pages/iphone13.php',
        'iphone12' => 'contents/pages/iphone12.php',
        'iphone11' => 'contents/pages/iphone11.php',
    ];

    if (array_key_exists($page, $pages)) {
        include $pages[$page];
    } else {
        include 'contents/pages/iphone16.php'; // Default to iphone16 if not found
    }
}
?>
