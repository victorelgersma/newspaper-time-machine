<!-- ./html/home.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($site_name) ?> | Preservation Archive</title>
    <link rel="stylesheet" href="https://oldnews.vjbe.net/style/tufte.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .featured-entry {
            border-left: 3px solid currentColor;
            padding-left: 1.5rem;
            margin: 3rem 0;
            max-width: 38rem;
        }

        .featured-label {
            display: block;
            margin-bottom: 0.75rem;

            font-size: 0.9rem;
            font-variant: small-caps;
            letter-spacing: 0.08em;

            opacity: 0.65;
        }

        .featured-entry h2 {
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        .featured-meta {
            margin-top: 0;
            margin-bottom: 1rem;

            font-size: 1rem;
            font-style: italic;
            opacity: 0.8;
        }

        .featured-entry p {
            width: 100%;
            width: 100%;
            text-align: justify;
            font-kerning: none;
            letter-spacing: -0.01em;
            line-height: 1.2;
        }
    </style>
</head>

<body>
    <header>
        <?php include __DIR__ . '/partials/topnav.php'; ?>
    </header>
    <article>
            <?php if ($featured_article): ?>
                <section class="featured-entry">
                    <span class="featured-label">Featured Article</span>
                    <h2>
                        <a href="/<?= htmlspecialchars($featured_article['uri']) ?>">
                            <?= htmlspecialchars($featured_article['title']) ?>
                        </a>
                    </h2>

                    <p class="featured-meta">
                        <?= htmlspecialchars($featured_article['pub']) ?>
                        —
                        <?= htmlspecialchars($featured_article['date']) ?>
                    </p>

                    <p>
                        <?= htmlspecialchars($featured_article['summary']) ?>
                    </p>

                    <p>
                        <a href="/<?= htmlspecialchars($featured_article['uri']) ?>">
                            Read article →
                        </a>
                    </p>
                </section>
            <?php endif; ?>
    </article>
</body>

</html>