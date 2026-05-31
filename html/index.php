<?php
// ./html/index.php
require_once('data.php');
require_once('counter.php'); // <-- Add this here

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$clean_uri = ltrim($request_uri, '/');

// Strict path sanitization to prevent directory traversal
$clean_uri = str_replace(['../', '..\\'], '', $clean_uri);

// 1. Home Route
if ($clean_uri === "" || $clean_uri === "index.php") {
    render_home();
    exit;
}

// 2. About Page Route
if ($clean_uri === "about") {
    $title = "About | " . $site_name;
    $pub_name = $site_name;
    $day_name = "";
    $day_num = "";
    $date_str = "";
    $photo_link = "/"; 
    $is_about_page = true;

    ob_start();
    include('about.php');
    $content = ob_get_clean();

    include('layout.php');
    exit;
}

// 3. Photocopy Viewer Route
if (strpos($clean_uri, 'photocopy/') === 0) {
    $uri = str_replace('photocopy/', '', $clean_uri);
    $uri = ltrim($uri, '/');
    $uri = str_replace(['../', '..\\'], '', $uri);

    if (!isset($metadata[$uri])) {
        http_response_code(404);
        render_404();
        exit;
    }

    $_GET['uri'] = $uri;
    include('photocopy.php');
    exit;
}

// 4. Article Route
// Switch section #4 in index.php to a strict whitelist check
if (array_key_exists($clean_uri, $metadata)) {
    $target_file = $articles_base . '/' . $clean_uri;
    $real_target = realpath($target_file);
    $real_base = realpath($articles_base);

    if ($real_target !== false && strpos($real_target, $real_base) === 0 && is_file($real_target)) {
        render_article($clean_uri, $real_target);
    } else {
        render_pending_transcription($clean_uri);
    }
    exit;
}

// Fallback 404
http_response_code(404);
render_404();

// ---- Render Functions ----

function render_article($uri, $full_path) {
    global $metadata, $publications;

    $view_count = get_and_increment_page_views($uri);

    $meta = $metadata[$uri] ?? ['title' => basename($uri, '.html')];
    $parts = explode('/', $uri);

    $title = $meta['title'] ?? basename($uri, '.html');
    $pub_key = $parts[0] ?? '';
    $pub_name = $publications[$pub_key] ?? ucfirst(str_replace('_', ' ', $pub_key));
    $day_name = $meta['day_name'] ?? '';
    $day_num = $meta['day_num'] ?? '';
    $date_str = ($meta['day_num'] ?? '') . '/' . ($parts[2] ?? '') . '/' . ($parts[1] ?? '');
    $source_url = $meta['source_url'] ?? null;
    $photo_link = "/photocopy/" . $uri;

    $content = file_get_contents($full_path);
    include('layout.php');
}

function render_home() {
    global $site_name, $metadata, $publications;

    $links = [];
    foreach ($metadata as $uri => $meta) {
        $parts = explode('/', $uri);
        $pub_key = $parts[0] ?? '';

        // Replace the date key loader loop in render_home() with this:
        $month_num = intval($parts[2] ?? 0);
        $year_val = htmlspecialchars($parts[1] ?? '');
        $month_name = $month_num ? date("F", mktime(0, 0, 0, $month_num, 10)) : '';

        $links[] = [
            'uri' => $uri,
            'title' => $meta['title'],
            'pub' => $publications[$pub_key] ?? ucfirst(str_replace('_', ' ', $pub_key)),
            'date' => trim("$month_name $year_val")
        ];
    }

    // Stable Chronological Sorting (Oldest First)
    usort($links, function ($a, $b) {
        $get_date = function($uri) {
            if (preg_match('/\/(\d{4})\/(\d{2})\/(\d{2})\//', $uri, $m)) {
                return "{$m[1]}-{$m[2]}-{$m[3]}";
            }
            if (preg_match('/\/(\d{4})\/(\d{2})\//', $uri, $m)) {
                return "{$m[1]}-{$m[2]}-01";
            }
            if (preg_match('/\/(\d{4})\//', $uri, $m)) {
                return "{$m[1]}-01-01";
            }
            return "0000-00-00"; 
        };

        return strcmp($get_date($a['uri']), $get_date($b['uri']));
    });

    include('home.php');
}

function render_404() {
    global $site_name;
    $title = "404 Not Found";
    $pub_name = $site_name;
    $day_name = $day_num = $date_str = "";
    $photo_link = "/";
    $content = "<p>We are sorry, but that piece doesn't exist in the archive yet.</p>";
    include('layout.php');
}

function render_pending_transcription($uri) {
    global $metadata, $publications;

    $meta = $metadata[$uri] ?? ['title' => 'Pending Article'];
    $parts = explode('/', $uri);

    $title = $meta['title'];
    $pub_key = $parts[0] ?? '';
    $pub_name = $publications[$pub_key] ?? ucfirst(str_replace('_', ' ', $pub_key));
    $day_name = $meta['day_name'] ?? '';
    $day_num = $meta['day_num'] ?? '';
    $date_str = ($meta['day_num'] ?? '') . '/' . ($parts[2] ?? '') . '/' . ($parts[1] ?? '');
// Outputs: 22/07/1837
    $photo_link = "/photocopy/" . $uri;

    $content = "
        <div style='background: #fff4e6; border: 1px solid #ffd8a8; padding: 1.5rem; border-radius: 4px; color: #d9480f;'>
            <h3 style='margin-top:0;'>Transcription Pending</h3>
            <p>The text for this article is still processing in our digital humanities pipeline.</p>
            <p>Click <strong>'View Source'</strong> above to look at the original print clippings.</p>
        </div>";

    include('layout.php');
}