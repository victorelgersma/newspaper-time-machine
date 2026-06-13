<!-- ./html/layout.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?> | <?= htmlspecialchars($pub_name) ?></title>
    <link rel="stylesheet" href="https://oldnews.vjbe.net/style/tufte.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <style>
        body { padding: 2rem; }
        header { margin-bottom: 3rem; }
    </style>
</head>
<body>
    <article>
        <header>
            <h1><a href="/" class="no-tufte-underline"><?= htmlspecialchars($site_name) ?></a></h1>
            <?php include __DIR__ . '/partials/topnav.php'; ?>
            
            <?php if (!isset($is_about_page)): ?>
                <p class="subtitle">
                    <?= htmlspecialchars($pub_name) ?> — <?= $date_str ?>
                </p>
                <nav>
                    <a href="/catalogue">← Back to Catalogue</a> |
                    <a href="<?= $photo_link ?>" target="_blank">View Original</a>
                </nav>
            <?php endif; ?>
        </header>

        <section>
            <?= $content ?>
        </section>

        <?php if (isset($view_count)): ?>
            <footer>
                <hr style="width: 100%; margin-top: 3rem;">
                <p class="sans" style="font-size: 0.85rem; color: #777; text-align: right;">
                    Views: <span class="numeral"><?= number_format($view_count) ?></span>
                </p>
            </footer>
        <?php endif; ?>
    </article>
</body>
</html>