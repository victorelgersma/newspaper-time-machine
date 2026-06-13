<!-- ./html/catalogue.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Archive Catalogue | <?= htmlspecialchars($site_name) ?></title>
    <link rel="stylesheet" href="https://oldnews.vjbe.net/style/tufte.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            padding: 2rem;
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
            <h1>Old News</h1>
            <?php include __DIR__ . '/partials/topnav.php'; ?>
        </header>

        <section style="width: 100%; max-width: 1200px;">
            <div class="table-wrapper">
                <table style="width: 100%; border-collapse: collapse; margin-top: 1.5rem; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 2px solid #ccc;">
                            <th style="padding: 0.75rem; font-size: 1.1rem; width: 25%;">Publication / Date</th>
                            <th style="padding: 0.75rem; font-size: 1.1rem; width: 30%;">Article Title</th>
                            <th style="padding: 0.75rem; font-size: 1.1rem; width: 45%;">Summary Output</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($links as $article): ?>
                            <tr style="border-bottom: 1px solid #eee; vertical-align: top;">
                                <td style="padding: 1rem 0.75rem;">
                                    <span class="pub-tag"><?= htmlspecialchars($article['pub']) ?></span><br>
                                    <span class="date-tag"><?= htmlspecialchars($article['date']) ?></span>
                                </td>
                                <td style="padding: 1rem 0.75rem;">
                                    <a href="/<?= htmlspecialchars($article['uri']) ?>" style="font-weight: 700;">
                                        <?= htmlspecialchars($article['title']) ?>
                                    </a>
                                </td>
                                <td style="padding: 1rem 0.75rem; font-size: 1.15rem; color: #ddd; line-height: 1.6;">
                                    <?= !empty($article['summary']) ? htmlspecialchars($article['summary']) : '<span style="color: #999; font-style: italic; font-size: 0.95rem;">Pending transcription tracking details.</span>' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <?php if (isset($view_count)): ?>
            <footer>
                <hr style="width: 100%; margin-top: 4rem;">
                <p class="sans" style="font-size: 0.85rem; color: #777;">
                    Catalogue Index Explorations: <span class="numeral"><?= number_format($view_count) ?></span>
                </p>
            </footer>
        <?php endif; ?>
    </article>
</body>

</html>