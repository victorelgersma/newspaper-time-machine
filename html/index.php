<?php
// ./html/index.php
require_once('data.php');
require_once('counter.php');

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
    include(__DIR__ . '/about.php');
    $content = ob_get_clean();

    include(__DIR__ . '/layout.php');
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
    include(__DIR__ . '/photocopy.php');
    exit;
}

// 4. Flat Article Route
if (array_key_exists($clean_uri, $metadata)) {
    $target_file = $articles_base . '/' . $clean_uri;

    // Dynamically look for any compilation html file inside your custom folder name
    $html_files = glob($target_file . '/*.html');
    $real_target = !empty($html_files) ? realpath($html_files[0]) : false;
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

function render_article($uri, $full_path)
{
    global $metadata, $publications;

    $view_count = get_and_increment_page_views($uri);
    $meta = $metadata[$uri];

    $title = $meta['title'];
    $pub_key = $meta['pub_key'];
    $pub_name = $publications[$pub_key] ?? (!empty($pub_key) ? ucfirst(str_replace('_', ' ', $pub_key)) : 'Archive Entry');

    // Explicit clean fallback for the layout subtitle
    $date_str = (!empty($meta['date']) && $meta['date'] !== '//') ? $meta['date'] : 'Undated';
    $photo_link = "/photocopy/" . $uri;

    $content = file_get_contents($full_path);
    include(__DIR__ . '/layout.php');
}

function render_home()
{
    global $site_name, $metadata, $publications, $articles_base, $links;

    $view_count = get_and_increment_page_views('home');
    $links = []; 

    foreach ($metadata as $uri => $meta) {
        $pub_key = $meta['pub_key'] ?? 'NOT SET';

        // Grab summary out of directory json if it exists
        $summary = null;
        $data_json_path = $articles_base . '/' . $uri . '/data.json';
        $json_file_status = file_exists($data_json_path) ? "FOUND" : "NOT FOUND";
        
        $json_decode_status = "N/A";
        if (file_exists($data_json_path)) {
            $raw_body = file_get_contents($data_json_path);
            $json = json_decode($raw_body, true);
            if ($json === null) {
                $json_decode_status = "FAILED (Syntax Error in JSON)";
            } else {
                $json_decode_status = "SUCCESS";
                $summary = $json['summary'] ?? null;
            }
        }

        // Clean date assignment matching data.php parsing
        $display_date = (!empty($meta['date']) && $meta['date'] !== '//') ? $meta['date'] : 'Undated';
        
        $resolved_pub = $publications[$pub_key] ?? (!empty($pub_key) ? ucfirst(str_replace('_', ' ', $pub_key)) : 'Archive Entry');
        $sort_date = $meta['sort_date'] ?? '0000-00-00';

        $links[] = [
            'uri' => $uri,
            'title' => $meta['title'] ?? 'Untitled Article',
            'pub' => $resolved_pub,
            'date' => $display_date,
            'summary' => $summary,
            'sort_date' => $sort_date
        ];
    }

    // Clean stable chronological sorting
    usort($links, function ($a, $b) {
        return strcmp($a['sort_date'], $b['sort_date']);
    });


    include(__DIR__ . '/home.php');
}

function render_404()
{
    global $site_name;
    $title = "404 Not Found";
    $pub_name = $site_name;
    $day_name = $day_num = $date_str = "";
    $photo_link = "/";
    $content = "<p>We are sorry, but that piece doesn't exist in the archive yet.</p>";
    include(__DIR__ . '/layout.php');
}

function render_pending_transcription($uri)
{
    global $metadata, $publications;

    $meta = $metadata[$uri];
    $title = $meta['title'];
    $pub_key = $meta['pub_key'];
    $pub_name = $publications[$pub_key] ?? (!empty($pub_key) ? ucfirst(str_replace('_', ' ', $pub_key)) : 'Archive Entry');
    $date_str = (!empty($meta['date']) && $meta['date'] !== '//') ? $meta['date'] : 'Undated';
    $photo_link = "/photocopy/" . $uri;

    $content = "
        <div style='background: #fff4e6; border: 1px solid #ffd8a8; padding: 1.5rem; border-radius: 4px; color: #d9480f;'>
            <h3>Transcription Pending</h3>
            <p>The text for this article is still processing in our digital humanities pipeline.</p>
            <p>Click <strong>'View Source'</strong> above to look at the original print clippings.</p>
        </div>";

    include(__DIR__ . '/layout.php');
}