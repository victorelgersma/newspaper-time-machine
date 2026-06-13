<?php
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$current =
    $path === '' ? 'home' :
    ($path === 'about' ? 'about' :
        ($path === 'catalogue' ? 'catalogue' : ''));
?>

<nav style="margin-bottom: 2rem;">
    <a href="/" class="<?= $current === 'home' ? 'tufte-underline' : 'hover-tufte-underline no-tufte-underline' ?>">
        Home
    </a> |
    <a href="/catalogue"
        class="<?= $current === 'catalogue' ? 'tufte-underline' : 'hover-tufte-underline no-tufte-underline' ?>">
        Catalogue
    </a> |
    <a href="/about"
        class="<?= $current === 'about' ? 'tufte-underline' : 'hover-tufte-underline no-tufte-underline' ?>">
        About
    </a>


</nav>