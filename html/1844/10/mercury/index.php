<?php
$title = "Third Supplement to the Liverpool Mercury";
$price = "6 pence";
$date = "Friday 17 October 1845";
$links = [
    "Home" => "/",
    "Link to original" => "https://britishnewspaperarchive.co.uk/viewer/bl/0000081/18451017/005/0001",
    "View photos" => "./photos"
];
$headerPartial = __DIR__ . '/../../../partials/newspaper-header.php';
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="/style/tufte.min.css">
  <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body>
  <article>
    <?php require $headerPartial; ?>

    <section>
      <?php require __DIR__ . '/../../../partials/articles/mercury.html'; ?>
    </section>
  </article>
</body>
</html>