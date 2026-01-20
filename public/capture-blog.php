<?php
/**
 * CAPTURE /blog PAGE OUTPUT
 */

header('Content-Type: text/html; charset=utf-8');

$url = 'http://localhost:8000/blog';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Blog Page Source Capture</title>
    <style>
        body { font-family: monospace; margin: 20px; background: #f5f5f5; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .url { color: #0066cc; margin: 10px 0; }
        .source { white-space: pre-wrap; word-wrap: break-word; background: #fffacd; padding: 15px; border-left: 3px solid #ff9900; margin: 15px 0; max-height: 500px; overflow-y: auto; }
        .debug { color: #666; font-size: 0.9em; }
        h1 { color: #333; }
        .article-count { background: #e8f5e9; padding: 10px; border-radius: 4px; margin: 10px 0; }
    </style>
</head>
<body>
    <div class=\"container\">
        <h1>Blog Page Source Analysis</h1>
        <p class=\"debug\">Capturing content from: <span class=\"url\">$url</span></p>
        <hr>";

// Use fopen to get the page content
$context = stream_context_create([
    'http' => [
        'timeout' => 10
    ]
]);

$content = @file_get_contents($url, false, $context);

if ($content === false) {
    echo "<p style='color: red;'>✗ Failed to fetch page</p>";
} else {
    echo "<p>✓ Page fetched successfully (" . strlen($content) . " bytes)</p>";
    
    // Look for article markers
    $articleCount = substr_count($content, '<article');
    echo "<div class='article-count'>Found <strong>$articleCount</strong> &lt;article&gt; tags</div>";
    
    // Look for debug comment
    if (strpos($content, 'DEBUG: Articles count')) {
        preg_match('/DEBUG: Articles count = (\d+)/', $content, $matches);
        if (isset($matches[1])) {
            echo "<div class='article-count'>Debug info shows: <strong>" . $matches[1] . " articles</strong></div>";
        }
    }
    
    // Show first 2000 chars of page source
    echo "<h2>First 2000 characters of page source:</h2>";
    echo "<div class='source'>" . htmlspecialchars(substr($content, 0, 2000)) . "...</div>";
    
    // Look for specific keywords
    echo "<h2>Content Analysis:</h2>";
    echo "<ul>";
    echo "<li>Contains '@foreach': " . (strpos($content, '@foreach') !== false ? "YES" : "NO") . "</li>";
    echo "<li>Contains '@if': " . (strpos($content, '@if') !== false ? "YES" : "NO") . "</li>";
    echo "<li>Contains 'Artikel tidak ditemukan': " . (strpos($content, 'Artikel tidak ditemukan') !== false ? "YES (Empty State)" : "NO") . "</li>";
    echo "<li>Contains template/img': " . (strpos($content, \"template/img'\") !== false ? "YES" : "NO") . "</li>";
    echo "<li>Contains 'Metode Efektif': " . (strpos($content, 'Metode Efektif') !== false ? "YES (First Article Title)" : "NO") . "</li>";
    echo "</ul>";
}

echo "    </div>
</body>
</html>";
?>
