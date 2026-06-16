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
    section > p {
        width: 100%;
    }
</style>
<section>
    <p style="text-indent:0em; text-align: center">

        <?= htmlspecialchars($pub_name) ?> — <?= htmlspecialchars($date_str) ?> <br>
        <a href="<?= htmlspecialchars($photo_link) ?>" target="_blank">
            View Original
        </a>
    </p>
    <p>
        <br>
        <?php if (!empty($summary)): ?>
            <em> <?= htmlspecialchars($summary) ?> </em>
        <?php endif; ?>
        <br>
    </p>
</section>