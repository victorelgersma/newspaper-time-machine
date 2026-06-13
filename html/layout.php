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
        body {
            padding: 2rem;
        }

        header {
            margin-bottom: 3rem;
        }
    </style>
</head>

<body>
    <header>

        <?php include __DIR__ . '/partials/topnav.php'; ?>

        <?php
        if (isset($article_header_partial)) {
            include $article_header_partial;
        }
        ?>
    </header>
    <article>

        <section>
            <?= $content ?>
        </section>

        <?php if (isset($view_count)): ?>
            <footer>
                <p class="sans" style="font-size: 0.85rem; text-align: right;">
                    Views: <span class="numeral"><?= number_format($view_count) ?></span>
                </p>
            </footer>
        <?php endif; ?>
    </article>
    <script>
        (function () {
            const root = document.body;
            const key = "oldnews-theme";

            function applyTheme(theme) {
                if (theme === "dark") {
                    root.classList.add("theme-dark");
                    root.classList.remove("theme-light");
                } else {
                    root.classList.add("theme-light");
                    root.classList.remove("theme-dark");
                }
            }

            // Load saved theme
            const saved = localStorage.getItem(key);
            applyTheme(saved || "light");

            // Toggle button
            const btn = document.getElementById("themeToggle");
            if (btn) {
                btn.addEventListener("click", function () {
                    const isDark = root.classList.contains("theme-dark");
                    const next = isDark ? "light" : "dark";

                    localStorage.setItem(key, next);
                    applyTheme(next);
                });
            }
        })();
    </script>
</body>

</html>