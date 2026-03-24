<?php
// homepage.php

$newspapers = [
  [
    "title" => "Mercury, 1844 'Review of Review of Vestiges'",
    "url" => "1844/mercury/"
  ],
  // Add more newspapers here:
  // [
  //     "title" => "Another Newspaper Title",
  //     "url" => "path/to/newspaper/"
  // ],
];
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Old News</title>
  <link rel="stylesheet" type="text/css" href="style/tufte.min.css">
</head>

<body>
  <h1>Old News</h1>
  <nav><a href="about.php">About</a></nav>

  <ul>
    <?php foreach ($newspapers as $paper): ?>
      <li>
        <p><a href="<?php echo htmlspecialchars($paper['url']); ?>"><?php echo htmlspecialchars($paper['title']); ?></a>
        </p>
      </li>
    <?php endforeach; ?>
  </ul>
</body>

</html>