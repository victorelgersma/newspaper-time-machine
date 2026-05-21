<?php
// index.php
require_once('data.php');

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Strip leading slash
$clean_uri = ltrim($request_uri, '/');

// Basic normalization / safety
$clean_uri = preg_replace('/\.\.+/', '', $clean_uri);

// 1. Home Route
if ($clean_uri === "" || $clean_uri === "index.php") {
    render_home();
    exit;
}

// 2b. About Page Route
// 2b. About Page Route
if ($clean_uri === "about") {
    $title = "About | " . $site_name;
    $pub_name = $site_name;
    $day_name = "";
    $day_num = "";
    $date_str = "";
    $photo_link = "/"; 
    $is_about_page = true; // Add this conditional variable

    // Capture the template output or include directly
    ob_start();
    include('about.php');
    $content = ob_get_clean();

    include('layout.php');
    exit;
}

// 2. Photocopy Viewer Route

if (strpos($clean_uri, 'photocopy/') === 0) {
    $uri = str_replace('photocopy/', '', $clean_uri);
    $uri = ltrim($uri, '/');
    $uri = preg_replace('/\.\.+/', '', $uri);

    // Optional strict validation (recommended)
    if (!isset($metadata[$uri])) {
        http_response_code(404);
        render_404();
        exit;
    }

    $_GET['uri'] = $uri;
    include('photocopy.php');
    exit;
}

// 3. Article Route
$target_file = $articles_base . '/' . $clean_uri;

// Check if we have metadata for this URI
if (isset($metadata[$clean_uri])) {
    if (file_exists($target_file) && is_file($target_file)) {
        // Normal Case: Transcription exists
        render_article($clean_uri, $target_file);
    } else {
        // Case: Metadata exists, but no transcription file yet
        render_pending_transcription($clean_uri);
    }
    exit;
}

// Fallback: If no metadata exists at all, it's a real 404
http_response_code(404);
render_404();


// ------------------------

function render_article($uri, $full_path)
{
    global $metadata, $publications;

    $meta = $metadata[$uri] ?? ['title' => basename($uri, '.html')];
    $parts = explode('/', $uri);

    // Variables for layout.php
    $title = $meta['title'] ?? basename($uri, '.html');

    $pub_key = $parts[0];
    $pub_name = $publications[$pub_key] ?? ucfirst(str_replace('_', ' ', $pub_key));
    $day_name = $meta['day_name'] ?? '';
    $day_num = $meta['day_num'] ?? '';
    $date_str = ($parts[2] ?? '') . '/' . ($parts[1] ?? '');
    $source_url = $meta['source_url'] ?? null;

    // Photocopy link
    $photo_link = "/photocopy/" . $uri;

    $content = file_get_contents($full_path);
    include('layout.php');
}

function render_home()
{
    global $site_name, $metadata, $publications;

    $links = [];
    foreach ($metadata as $uri => $meta) {
        $parts = explode('/', $uri);
        $pub_key = $parts[0];

        $links[] = [
            'uri' => $uri,
            'title' => $meta['title'],
            'pub' => $publications[$pub_key] ?? $pub_key,
            'date' => ($parts[2] ?? '') . '/' . ($parts[1] ?? '')
        ];
    }

    // Sort newest-ish first (by URI descending)
    // Sort articles chronologically (oldest first)
    // Extract date (year, month, day) from the URI for sorting
// Sort articles chronologically (oldest first)
// Extract date (year, month, day) from the URI for sorting
    usort($links, function ($a, $b) {
        // Extract date parts from URI (e.g., liverpool_mercury/1845/10/17/some-article.html)
        preg_match('/(\d{4})\/(\d{2})\/(\d{2})/', $a['uri'], $date_a);
        preg_match('/(\d{4})\/(\d{2})\/(\d{2})/', $b['uri'], $date_b);

        // If a date is missing day/month, set them to the first of the month/year.
        if (empty($date_a)) {
            preg_match('/(\d{4})\/(\d{2})/', $a['uri'], $date_a);
            $date_a[3] = '01'; // Default to 1st day of the month
        }
        if (empty($date_b)) {
            preg_match('/(\d{4})\/(\d{2})/', $b['uri'], $date_b);
            $date_b[3] = '01'; // Default to 1st day of the month
        }

        // Format the extracted date as "YYYY-MM-DD" to make string comparison correct
        $date_a = "{$date_a[1]}-{$date_a[2]}-{$date_a[3]}"; // Format: YYYY-MM-DD
        $date_b = "{$date_b[1]}-{$date_b[2]}-{$date_b[3]}"; // Format: YYYY-MM-DD

        // Compare the dates in ascending order (oldest first)
        return strcmp($date_a, $date_b);
    });
    include('home.php');
}

// Update this function at the bottom of index.php
function render_404()
{
    global $site_name, $publications; // Bring in globals for layout.php

    // Set variables that layout.php expects
    $title = "404 Not Found";
    $pub_name = $site_name;
    $day_name = "";
    $day_num = "";
    $date_str = "";
    $photo_link = "/"; // Link back home

    // The actual error message
    $content = "
        <p>We are sorry, but the article or page you are looking for doesn't exist in the archive.</p>
        <p>It may have been moved, or our digital humanities pipeline hasn't processed it yet.</p>
    ";

    include('layout.php');
}

function render_pending_transcription($uri)
{
    global $metadata, $publications;

    $meta = $metadata[$uri] ?? ['title' => 'Pending Article'];
    $parts = explode('/', $uri);

    $title = $meta['title'];
    $pub_key = $parts[0];
    $pub_name = $publications[$pub_key] ?? ucfirst(str_replace('_', ' ', $pub_key));
    $day_name = $meta['day_name'] ?? '';
    $day_num = $meta['day_num'] ?? '';
    $date_str = ($parts[2] ?? '') . '/' . ($parts[1] ?? '');

    // Photocopy link remains the same
    $photo_link = "/photocopy/" . $uri;

    $content = "
        <div style='background: #fff4e6; border: 1px solid #ffd8a8; padding: 1.5rem; border-radius: 4px; color: #d9480f;'>
            <h3 style='margin-top:0;'>Transcription Pending</h3>
            <p>The text for this article hasn't been performed yet as part of our digital humanities pipeline.</p>
            <p>However, you can view the original newspaper clipping by clicking <strong>'View Source'</strong> above.</p>
        </div>
    ";

    include('layout.php');
}
