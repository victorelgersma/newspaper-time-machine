<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Archive Catalogue | <?= htmlspecialchars($site_name) ?></title>
    <link rel="stylesheet" href="https://oldnews.vjbe.net/style/tufte.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .pub-tag {
            font-variant: small-caps;
            font-size: 0.9rem;
        }

        .date-tag {
            font-size: 0.8rem;
        }

        /* Force the table to respect exact column widths */
        .fixed-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
            text-align: left;
            table-layout: fixed; 
        }
        

        /* Truncation wrapper for the summary text */
        .summary-truncate {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3; /* Change this number to control how many lines display before the "..." */
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 4.5em; /* Fallback for older browsers (line-height * lines) */
            line-height: 1.5;
        }

        /* Clean up the link styles for the summary */
        .summary-link {
            color: inherit;
            text-decoration: none;
            display: block;
        }
        .summary-link:hover .summary-truncate {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <?php include __DIR__ . '/partials/topnav.php'; ?>
    </header>
    <article>

        <section>
            <p class="sans" style="font-size: 1.1rem; margin-bottom: 1.5rem;">
                Archive contains
                <strong><?= number_format(count($links)) ?></strong>
                digitized articles.
            </p>
            <div class="table-wrapper">
                <table class="fixed-table">
                    <thead>
                        <tr style="border-bottom: 2px solid #ccc;">
                            <th style="padding: 0.75rem; font-size: 1.1rem; width: 25%;"></th>
                            <th style="padding: 0.75rem; font-size: 1.1rem; width: 30%;">Title</th>
                            <th style="padding: 0.75rem; font-size: 1.1rem; width: 45%;">Summary</th>
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
                                <td style="padding: 1rem 0.75rem; font-size: 1.15rem;">
                                    <?php if (!empty($article['summary'])): ?>
                                        <a href="/<?= htmlspecialchars($article['uri']) ?>" class="summary-link" title="Click to read full article">
                                            <div class="summary-truncate">
                                                <?= htmlspecialchars($article['summary']) ?>
                                            </div>
                                        </a>
                                    <?php else: ?>
                                        <span style="font-style: italic; font-size: 0.95rem;">Pending transcription tracking details.</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <?php if (isset($view_count)): ?>
            <footer>
                <p class="sans" style="font-size: 0.85rem;">
                    Catalogue Index Explorations: <span class="numeral"><?= number_format($view_count) ?></span>
                </p>
            </footer>
        <?php endif; ?>
    </article>
</body>

</html>