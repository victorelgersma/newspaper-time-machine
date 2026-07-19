<!-- ./html/partials/article_header.php -->

<style>
    /* Newspaper styling */
    article p {
        text-indent: 1.5em;
    }

    .centered {
        text-align: center;
    }

    /* Make headings live in the same column as text */
    section>h1,
    section>h2,
    section>h3 {
        max-width: 500px;
        width: 100%;
        text-align: center;
        font-style: normal;
    }

    h1 {

        font-size: 2rem;
    }

    h2 {

        font-size: 1.8rem;
    }

    h3 {

        font-size: 1.6rem;
    }


    @media (max-width: 760px) {

        section>h1,
        section>h2,
        section>h3 {
            width: 100%;
            max-width: 100%;
            text-align: center;
        }
    }



    p {
        max-width: 500px;
        width: 100%;
        text-align: justify;
        font-kerning: none;
        letter-spacing: -0.01em;
        line-height: 1.2;
    }

    section>p {
        width: 100%;
    }

    .summary {
        background: #f0f0f0;
        padding: 0em 1em 1em 1em;
    }
</style>
<section>



    <p class="summary" style="text-align: left;">
        <br>
        <?php if (!empty($summary)): ?>
            Summary: <br>
            <em> <?= htmlspecialchars($summary) ?> </em>
        <?php endif; ?>
        <br>
    </p>
    <ul>
        <li>
            <a href="<?= htmlspecialchars($photo_link) ?>" target="_blank">
                View Original Scans
            </a>
        </li>
        <li>
            <a href="<?= htmlspecialchars($plaintext_url) ?>" target="_blank">
                View Plain Text
            </a>
        </li>
        <li>
            <?php if ($source_url): ?>

                <a href="<?= htmlspecialchars($source_url) ?>" target="_blank">
                    Go To Source
                </a>
            <?php endif; ?>
        </li>
    </ul>



    <!-- How can these be centered on mobile but left aligned on desktop -->
    <div class="article-meta">
        <p class="pub-name"><?= htmlspecialchars($pub_name) ?></p>
        <p class="pub-date"><?= htmlspecialchars($date_str) ?></p>
    </div>
</section>
<style>
    /* Mobile styling: Center the metadata text */
    .article-meta {
        width: 100%;
        max-width: 500px;
        text-align: center;
    }

    /* Remove paragraph indentations specifically for these header lines */
    .article-meta p {
        text-indent: 0;
        margin: 0.2em 0;
    }

    /* Desktop overrides: Left-align the text when screen is wide */
    @media (min-width: 761px) {
        .article-meta {
            text-align: left;
        }
    }
</style>