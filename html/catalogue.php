<?php
$sort = $_GET['sort'] ?? 'newest';

usort($links, function ($a, $b) use ($sort) {
    // 'd/m/Y' explicitly tells PHP: Day first, then Month, then 4-digit Year
    $format = 'd/m/Y'; 
    
    $dateA = DateTime::createFromFormat($format, trim($a['date']));
    $dateB = DateTime::createFromFormat($format, trim($b['date']));
    
    // Convert to Unix timestamps, handling any missing/malformed data gracefully
    $timeA = $dateA ? $dateA->getTimestamp() : 0;
    $timeB = $dateB ? $dateB->getTimestamp() : 0;
    
    return $sort === 'oldest' ? $timeA <=> $timeB : $timeB <=> $timeA;
});
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Archive Catalogue | <?= htmlspecialchars($site_name) ?></title>
    <link rel="stylesheet" href="https://oldnews.vjbe.net/style/tufte.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .archive-list {
            margin-top: 1.5rem;
            padding: 0;
            list-style: none;
        }

        .archive-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .meta-group {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            color: #666;
        }

        .pub-tag {
            font-variant: small-caps;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .date-tag {
            font-size: 0.85rem;
        }

        .article-title {
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            color: #111;
        }

        .article-title:hover {
            text-decoration: underline;
        }

        .sort-controls {
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            color: #666;
        }

        .sort-link {
            text-decoration: none;
            color: #0066cc;
        }

        .sort-link.active {
            color: #111;
            font-weight: bold;
            pointer-events: none;
        }

        @media (min-width: 600px) {
            .archive-item {
                flex-direction: row;
                align-items: baseline;
                gap: 2rem;
            }
            .meta-group {
                flex-shrink: 0;
                width: 150px;
                flex-direction: column;
                align-items: flex-start;
                gap: 0;
            }
        }
    </style>
</head>

<body>
    <header>
        <?php include __DIR__ . '/partials/topnav.php'; ?>
    </header>
    <article>
        <section>
            <!-- <p class="sans" style="font-size: 1.1rem; margin-bottom: 0.5rem;">
                <strong><?= number_format(count($links)) ?></strong>
                articles.
            </p> -->

            <div class="sans sort-controls">
                Sort by: 
                <a href="?sort=newest" class="sort-link <?= $sort === 'newest' ? 'active' : '' ?>">Newest</a> | 
                <a href="?sort=oldest" class="sort-link <?= $sort === 'oldest' ? 'active' : '' ?>">Oldest</a>
            </div>

            <ul class="archive-list">
                <?php foreach ($links as $article): ?>
                    <li class="archive-item">
                        <div class="meta-group">
                            <span class="pub-tag"><?= htmlspecialchars($article['pub']) ?></span>
                            <span class="date-tag"><?= htmlspecialchars($article['date']) ?></span>
                        </div>
                        
                        <a class="article-title" href="/<?= htmlspecialchars($article['uri']) ?>">
                            <?= htmlspecialchars($article['title']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </article>
</body>

</html>