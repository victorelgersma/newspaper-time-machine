<?php
// ./html/counter.php

function get_and_increment_page_views($page_uri) {
    // Sanitize the input to make sure it's safe for filenames
    $safe_name = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $page_uri);
    if (empty($safe_name)) {
        $safe_name = 'home';
    }

    // FORCE pathing relative strictly to this exact file's location
    $stats_dir = dirname(__FILE__) . '/stats';
    
    // Attempt to make the directory if it doesn't exist
    if (!is_dir($stats_dir)) {
        @mkdir($stats_dir, 0777, true);
    }

    $stat_file = $stats_dir . '/' . $safe_name . '.txt';

    // Read current count safely
    $current_count = 0;
    if (file_exists($stat_file)) {
        $current_count = (int)@file_get_contents($stat_file);
    }

    // Start a PHP session to determine unique visitor status
    if (session_status() === PHP_SESSION_NONE) {
        @session_start();
    }

    if (!isset($_SESSION['visited_pages'])) {
        $_SESSION['visited_pages'] = [];
    }

    // If they haven't seen this page during this session, increment the count
    if (!isset($_SESSION['visited_pages'][$safe_name])) {
        $_SESSION['visited_pages'][$safe_name] = true;
        $current_count++;
        
        // Attempt to save. If it fails, fallback gracefully to returning the number 1 
        // instead of dropping to 0
        if (@file_put_contents($stat_file, $current_count, LOCK_EX) === false) {
            // If it returns false, it means permission error!
            return $current_count; 
        }
    }

    return $current_count;
}