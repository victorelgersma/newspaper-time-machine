<?php
$photo_dir = '/var/www/vjbe.net/html/oldnews-photos/1844/10/liverpool_mercury';
$photo_url_base = 'https://vjbe.net/oldnews-photos/1844/10/liverpool_mercury';

$images = glob($photo_dir . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mercury Photos</title>
    <style>
        body {
            text-align: center;
            font-family: sans-serif;
        }
    </style>
</head>
<body>

<?php include __DIR__ . '/../../../../partials/gallery.php'; ?>

</body>
</html>