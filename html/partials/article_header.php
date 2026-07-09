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
    <p style="text-indent:0em; text-align: center">


        <?= htmlspecialchars($pub_name) ?> — <?= htmlspecialchars($date_str) ?><br>

        <a href="<?= htmlspecialchars($photo_link) ?>" target="_blank">
            View Original
        </a>

        <span style="margin: 0 1rem; opacity: 0.3;">|</span>

        <a href="<?= htmlspecialchars($plaintext_url) ?>" target="_blank">
            View Plain Text
        </a>

        <?php if ($source_url): ?>
            <span style="margin: 0 1rem; opacity: 0.3;">|</span>

            <a href="<?= htmlspecialchars($source_url) ?>" target="_blank">
                Source ↗
            </a>
        <?php endif; ?>

    <p class="summary" style="text-align: left;">
        <br>
        <?php if (!empty($summary)): ?>
            <em> <?= htmlspecialchars($summary) ?> </em>
        <?php endif; ?>
        <br>
    </p>
    </p>
</section>