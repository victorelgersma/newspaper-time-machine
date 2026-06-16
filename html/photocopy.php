<?php
// ./html/photocopy.php
require_once('data.php');

$uri = $_GET['uri'] ?? '';
$uri = str_replace(['../', '..\\'], '', $uri); // Sanitize
$folder_name = str_replace('.html', '', $uri);

$meta = $metadata[$uri] ?? [];
$source_url = $meta['source_url'] ?? null;

// Environment check: look for production path, fallback to local directory structure
$local_photo_path = "/var/www/vjbe.net/html/oldnews-photos/" . $folder_name;
if (!is_dir($local_photo_path)) {
    // Local dev fallback folder inside your workspace
    $local_photo_path = __DIR__ . "/oldnews-photos/" . $folder_name;
}

$photos_url_base = "https://oldnews-photos.vjbe.net";

$images = [];
if (is_dir($local_photo_path)) {
    $files = scandir($local_photo_path);

    // Group files by their base name to manage format prioritization
    // e.g., $groups['page_1'] = ['webp' => true, 'png' => true]
    $file_groups = [];

    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..' && preg_match('/^(.*)\.(webp|png|jpg|jpeg)$/i', $file, $matches)) {
            $base_name = $matches[1];
            $extension = strtolower($matches[2]);

            if (!isset($file_groups[$base_name])) {
                $file_groups[$base_name] = [];
            }
            $file_groups[$base_name][$extension] = $file;
        }
    }

    // Resolve which format to show for each unique image base name
    foreach ($file_groups as $base_name => $extensions) {
        if (isset($extensions['webp'])) {
            // WebP available -> Priority 1
            $chosen_file = $extensions['webp'];
        } elseif (isset($extensions['png'])) {
            // PNG available -> Priority 2
            $chosen_file = $extensions['png'];
        } else {
            // Fallback to JPG/JPEG
            $chosen_file = $extensions['jpg'] ?? $extensions['jpeg'];
        }

        $images[] = rtrim($photos_url_base, '/') . '/' . $folder_name . '/' . $chosen_file;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://oldnews-photos.vjbe.net">
    <meta charset="UTF-8">
    <title>Photocopy Viewer | <?= htmlspecialchars($folder_name) ?></title>
    <link rel="stylesheet" href="https://oldnews.vjbe.net/style/tufte.css">
    <style>
        body {
            text-align: center;
        }

        .controls {
            margin-bottom: 2rem;
            text-align: left;
        }

        img {
            display: block;
            margin: 2rem auto;
            width: 100%;
            max-width: 900px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.9);
            border: 1px solid #333;
        }

        a {
            text-decoration: none;
            border-bottom: 1px solid #8cf;
        }

        .error-msg {
            margin-top: 5rem;
        }

        code {
            background: #222;
            padding: 2px 5px;
        }

        body {
            text-align: center;
        }

        .controls {
            margin: 2rem auto;
            max-width: 900px;
            text-align: left;
            font-size: 1.2rem;
            padding: 0 1rem;
        }

        a {
            text-decoration: none;
            color: inherit;
            border-bottom: 1px solid #8cf;
            transition: border-color 0.2s ease;
        }

        a:hover {
            border-bottom-color: transparent;
        }
    </style>
</head>

<body>
    <div class="controls">
        <!-- New Back to Article Link -->
        <a href="/<?= htmlspecialchars($uri) ?>" class="back-link">← Back to Article</a>

        <?php if ($source_url): ?>
            <span style="margin: 0 1rem; opacity: 0.3;">|</span>
            <a href="<?= htmlspecialchars($source_url) ?>" target="_blank" class="source-link">Source ↗</a>
        <?php endif; ?>
    </div>

    <?php if (empty($images)): ?>
        <div class="error-msg">
            <p>No photocopies found.</p>
            <!-- <p style="font-size: 0.8rem;">Checked Disk Path: <code><?= htmlspecialchars($local_photo_path) ?></code></p> -->
        </div>
    <?php else: ?>
        <?php foreach ($images as $index => $img): ?>
            <img src="<?= htmlspecialchars($img) ?>" alt="Original Newspaper Clipping"
                loading="<?= $index < 2 ? 'eager' : 'lazy' ?>" fetchpriority="<?= $index === 0 ? 'high' : 'auto' ?>"
                decoding="async">
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>