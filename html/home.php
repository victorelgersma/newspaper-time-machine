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

        <section style="width: 100%; max-width: 1200px;">
            <h2>Archived Journalism Catalog</h2>

            <div class="table-wrapper">
                <table style="width: 100%; border-collapse: collapse; margin-top: 1.5rem; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 2px solid #ccc;">
                            <th style="padding: 0.75rem; font-size: 1.1rem; width: 20%;">Publication / Date</th>
                            <th style="padding: 0.75rem; font-size: 1.1rem; width: 30%;">Article Title</th>
                            <th style="padding: 0.75rem; font-size: 1.1rem; width: 50%;">Summary</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($metadata as $slug => $article):
                            // Cross-reference the data.json 'pub_key' against your $publications map
                            $pub_key = $article['pub_key'] ?? '';
                            $display_pub = $publications[$pub_key] ?? ucwords(str_replace(['_', '-'], ' ', $pub_key));
                            ?>
                            <tr style="border-bottom: 1px solid #eee; vertical-align: top;">
                                <td style="padding: 1rem 0.75rem;">
                                    <span class="pub-tag"><?= htmlspecialchars($display_pub) ?></span><br>
                                    <span class="date-tag"><?= htmlspecialchars($article['date']) ?></span>
                                </td>

                                <td style="padding: 1rem 0.75rem;">
                                    <!-- Changed from $link['uri'] to use the flat array folder key ($slug) -->
                                    <a href="/<?= htmlspecialchars($slug) ?>" style="font-weight: 700;">
                                        <?= htmlspecialchars($article['title']) ?>
                                    </a>
                                </td>

                                <td style="padding: 1rem 0.75rem; font-size: 1.15rem; color: #ddd; line-height: 1.6;">
                                    <?php if (!empty($article['summary'])): ?>
                                        <?= htmlspecialchars($article['summary']) ?>
                                    <?php else: ?>
                                        <span style="color: #999; font-style: italic; font-size: 0.95rem;">
                                            The summary for this article has not been written yet.
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Add Homepage Counter here -->
        <?php if (isset($view_count)): ?>
            <footer>
                <hr style="width: 55%; margin-left: 0; margin-top: 4rem;">
                <p class="sans" style="font-size: 0.85rem; color: #777;">
                    This archive has been explored by <span class="numeral"><?= number_format($view_count) ?></span> unique
                    historical minds.
                </p>
            </footer>
        <?php endif; ?>

    </article>
</body>

</html>