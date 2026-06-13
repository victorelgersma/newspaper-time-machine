<!-- ./html/home.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($site_name) ?> | Preservation Archive</title>
    <link rel="stylesheet" href="https://oldnews.vjbe.net/style/tufte.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { padding: 2rem; }
        .featured-card {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 1.5rem;
        }
    </style>
</head>
<body>
    <header>
        <?php include __DIR__ . '/partials/topnav.php'; ?>
    </header>
    <article>
        <section>
            <p style="font-size: 1.2rem; line-height: 1.7; margin-bottom: 2.5rem;">
                Old News is a digital humanities project that aims to digitize and re-publish old newspaper
                articles for your enlightenment and amusement.
            </p>
            <h2 style="margin-top: 0;">Featured Article</h2>
            <?php if ($featured_article): ?>
                <div class="featured-card">
                    <p class="subtitle"><?= htmlspecialchars($featured_article['pub']) ?> — <?= htmlspecialchars($featured_article['date']) ?></p>
                    <h3 style="margin-top: 0;"><a href="/<?= htmlspecialchars($featured_article['uri']) ?>"><?= htmlspecialchars($featured_article['title']) ?></a></h3>
                    <p><?= htmlspecialchars($featured_article['summary']) ?></p>
                </div>
            <?php endif; ?>
        </section>
    </article>
</body>
</html>