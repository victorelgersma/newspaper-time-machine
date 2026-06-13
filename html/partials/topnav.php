<?php
$current = $current_page ?? '';
?>

<nav style="margin-bottom: 2rem;">
    <a href="/"
       <?= $current === 'home' ? 'style="font-weight:bold;"' : '' ?>>
        Home
    </a> |

    <a href="/about"
       <?= $current === 'about' ? 'style="font-weight:bold;"' : '' ?>>
        About
    </a> |

    <a href="/catalogue"
       <?= $current === 'catalogue' ? 'style="font-weight:bold;"' : '' ?>>
        Catalogue
    </a>
</nav>