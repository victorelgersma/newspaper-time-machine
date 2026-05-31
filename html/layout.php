<!-- ./html/layout.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?> | <?= htmlspecialchars($pub_name) ?></title>
    <link rel="stylesheet" href="https://oldnews.vjbe.net/style/tufte.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Add MathJax to support LaTeX in OCR fragments -->
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <style>
        body {
            padding: 2rem;
        }

        header {
            margin-bottom: 3rem;
        }

        .source-link {
            font-style: italic;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <article>
        <header>
            <?php if (isset($is_about_page) && $is_about_page === true): ?>
                <h1>About Old News</h1>
                <nav>
                    <a href="/">← Back to Archive</a>
                </nav>
            <?php else: ?>
                <p class="subtitle">
                    <?= htmlspecialchars($pub_name) ?> —
                    <?= $date_str ?>
                </p>
                <nav>
                    <a href="/">← Back to Archive</a> |
                    <a href="<?= $photo_link ?>" target="_blank">View Source</a>
                </nav>
            <?php endif; ?>
        </header>

        <section>
            <?= $content ?>
        </section>


        <!-- Add Counter Badge here -->
        <?php if (isset($view_count)): ?>
            <footer>
                <hr style="width: 100%; margin-top: 3rem;">
                <p class="sans" style="font-size: 0.85rem; color: #777; text-align: right;">
                    Unique Visitors: <span class="numeral"><?= number_format($view_count) ?></span>
                </p>
            </footer>
        <?php endif; ?>
        
    </article>
</body>

</html>