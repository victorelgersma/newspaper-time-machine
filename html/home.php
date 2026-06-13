<!-- ./html/home.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($site_name) ?> | Preservation Archive</title>
    <link rel="stylesheet" href="https://oldnews.vjbe.net/style/tufte.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            padding: 2rem;
        }

        .featured-card {
            background: #1a1a1a;
            border: 1px solid #333;
            padding: 2rem;
            border-radius: 6px;
            margin-top: 2rem;
        }

        @media (prefers-color-scheme: light) {
            .featured-card {
                background: #fcfcfc;
                border: 1px solid #e0e0e0;
            }
        }

        .featured-flex {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-top: 1.5rem;
        }

        .featured-image-pane {
            flex: 1;
            min-width: 280px;
            max-width: 400px;
        }

        .featured-image-pane img {
            width: 100%;
            border-radius: 4px;
            border: 1px solid #444;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .featured-text-pane {
            flex: 2;
            min-width: 300px;
        }

        .tag-row {
            font-variant: small-caps;
            color: #888;
            letter-spacing: 0.05em;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <article>
        <header>
            <h1><?= htmlspecialchars($site_name) ?></h1>
            <?php include __DIR__ . '/partials/topnav.php'; ?>
        </header>

        <section style="max-width: 1200px; width:100%;">
            <h2>From Today's Archive Selection</h2>

            <?php if ($featured_article): ?>
                <div class="featured-card">
                    <div class="tag-row">
                        Featured Entry • <strong><?= htmlspecialchars($featured_article['pub']) ?></strong> —
                        <?= htmlspecialchars($featured_article['date']) ?>
                    </div>

                    <div class="featured-flex">
                        <?php if (!empty($featured_article['image'])): ?>
                            <div class="featured-image-pane">
                                <a href="/<?= htmlspecialchars($featured_article['uri']) ?>">
                                    <img src="<?= htmlspecialchars($featured_article['image']) ?>"
                                        alt="Clipping preview snippet">
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="featured-text-pane">
                            <h3 style="margin-top:0;"><a
                                    href="/<?= htmlspecialchars($featured_article['uri']) ?>"><?= htmlspecialchars($featured_article['title']) ?></a>
                            </h3>
                            <p style="font-size: 1.2rem; line-height: 1.6;">
                                <?= !empty($featured_article['summary']) ? htmlspecialchars($featured_article['summary']) : "No transcription breakdown available yet for this historic item." ?>
                            </p>
                            <p><a href="/<?= htmlspecialchars($featured_article['uri']) ?>" style="font-weight:bold;">Read →</a></p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p>No documents currently discovered inside the local data repository pipeline blocks.</p>
            <?php endif; ?>
        </section>

        <?php if (isset($view_count)): ?>
            <footer>
                <hr style="width: 55%; margin-left: 0; margin-top: 6rem;">
                <p class="sans" style="font-size: 0.85rem; color: #777;">
                    Unique Visitors: <span class="numeral"><?= number_format($view_count) ?></span>
                </p>
            </footer>
        <?php endif; ?>
    </article>
</body>

</html>