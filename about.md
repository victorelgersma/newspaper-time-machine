<!-- ./about.md -->


<style>


.toc {
    display: inline-block;
    padding: 1rem 1.5rem;
    border-left: 3px solid color-mix(in srgb, currentColor 30%, transparent);
    margin: 1.5rem 0 2.5rem 0;
    font-size: 1.1rem;
}

.toc strong {
    display: block;
    font-variant: small-caps;
    letter-spacing: 0.05em;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
    opacity: 0.6;
}

.toc ol {
    margin: 0;
    padding-left: 1.2rem;
}

.toc li {
    margin: 0.3rem 0;
}
</style>

Old News aims to rectify the absence of high-fidelity, plain text versions of important historical newspaper articles. A lot of important work has been done in scanning old journals, but much remains to be done in converting these articles to *plain text* so that they can be conveniently read, easily searched, and easily linked to and referenced by scholars. 

<nav class="toc">
  <strong>Contents</strong>
  <ol>
    <li><a href="#about">Why Old News?</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#source-verification">Source Verification</a></li>
    <li><a href="#source-websites">Source Websites</a></li>
    <li><a href="#scholarship">Scholarship</a></li>
    <li><a href="#styling">Styling</a></li>
  </ol>
</nav>

<h2 id="contributing">Contributing</h2>

Contributions and text corrections are highly encouraged. You can help by finding [typos](#typos) and by [contributing new articles](#article-contributions). If you spot another kind of mistake feel free to e-mail v.j.b.elgersma@students.uu.nl.

<h3 id="typos">Typos</h3>

If you find a typo in an article, or you find that the text doesn't agree with the original scans, feel free to make a pull request on our article repository [here](https://github.com/victorelgersma/oldnews-article-repo).

<h3 id="article-contributions">Article Contributions</h3>

If you would like to contribute an article yourself, feel free to use [our OCR pipeline](https://github.com/victorelgersma/oldnews-OCR-pipeline) (MacOS + Linux only!), and submit your article as a pull request in [this repo](https://github.com/victorelgersma/oldnews-article-repo). Please e-mail the screenshots used for the OCR to [v.j.b.elgersma@students.uu.nl](mailto:v.j.b.elgersma@students.uu.nl), as well as a link to the original source. 

If you would like to contribute but need a bit of technical on-boarding feel free to e-mail me at the address above and I will try to help out. 


<h2 id="source-verification">Source Verification</h2>

Since we value traceability and want to guard against AI hallucinations, we make sure each newspaper article has a link to an original source, which hosts the original scans. By utilizing the **'View Original'** button on any given entry, you can immediately review original photocopy clippings hosted by our image repository or visit their permanent records. We do not accept articles without a credible source.

<h2 id="source-websites">Source Websites</h2>

We are always adding new sources for our transcriptions. We are currently sourcing articles from the following sources:

- [The British Newspaper Archive](https://www.britishnewspaperarchive.co.uk/)
- [The Spectator Archive](https://archive.spectator.co.uk/)

In addition, we hope to use the following sources soon: 

- [Delpher](delpher.nl)
- [Gallica](https://gallica.bnf.fr/accueil/fr/html/accueil-fr)
- [Gale](https://www.gale.com/end-users)


<h2 id="scholarship">Scholarship</h2>

In addition to bringing the past to life for your amusement, we aim to facilitate original scholarship. If you have written anything interesting based on our articles, we would be delighted if you let us know. 

So far, Victor Elgersma has based his mid-term paper on a few articles reviewer the infamous _Vestiges of the Natural History of Creation_. You can read his essay [here](https://samizdat.vjbe.net/2026-04-13-SciPub%20Research%20Essay%202-4.pdf).

Finally, the source code for this website is [also available](https://github.com/victorelgersma/old-news). Contributions are always welcome.

<h2 id="styling"> Styling </h2>

We use [tufte](https://github.com/edwardtufte/tufte-css) for styling