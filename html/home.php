<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($site_name) ?></title>
    <link rel="stylesheet" href="https://oldnews.vjbe.net/style/tufte.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            padding: 2rem;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 1.5rem;
        }

        .pub-tag {
            font-variant: small-caps;
            color: #666;
            font-size: 0.9rem;
        }

        .date-tag {
            color: #888;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    <article>
        <header>
            <h1><?= htmlspecialchars($site_name) ?></h1>
            <nav>
                <a href="/about">About</a>
            </nav>
        </header>

        <section>
            <h2>Available Articles</h2>
            <ul>
                <?php foreach ($links as $link): ?>
                    <li>
                        <span class="pub-tag"><?= htmlspecialchars($link['pub']) ?></span><br>
                        <a href="/<?= htmlspecialchars($link['uri']) ?>">
                            <strong><?= htmlspecialchars($link['title']) ?></strong>
                        </a>
                        <span class="date-tag">— <?= $link['date'] ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>

        <!-- Add Homepage Counter here -->
        <?php if (isset($view_count)): ?>
            <footer>
                <hr style="width: 55%; margin-left: 0; margin-top: 4rem;">
                <p class="sans" style="font-size: 0.85rem; color: #777;">
                    This archive has been explored by <span class="numeral"><?= number_format($view_count) ?></span> unique historical minds.
                </p>
            </footer>
        <?php endif; ?>

    </article>
</body>

</html>