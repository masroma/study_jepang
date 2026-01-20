<?php
/**
 * ANALYZE /blog RESPONSE
 * Check what's actually being served at /blog
 */

header('Content-Type: text/plain; charset=utf-8');

echo "=== ANALYZING /blog PAGE ===\n\n";

// Check if blog.blade.php contains the data we expect
$viewFile = __DIR__ . '/../resources/views/blog.blade.php';
$content = file_get_contents($viewFile);

echo "1. BLOG VIEW FILE ANALYSIS:\n";
echo "   File size: " . filesize($viewFile) . " bytes\n";
echo "   Contains '@foreach': " . (strpos($content, '@foreach') !== false ? "YES" : "NO") . "\n";
echo "   Contains '\$articles': " . (strpos($content, '$articles') !== false ? "YES" : "NO") . "\n";
echo "   Contains 'BlogPost': " . (strpos($content, 'BlogPost') !== false ? "YES" : "NO") . "\n";

// Check template/blog.html (static template)
$templateFile = __DIR__ . '/../template/blog.html';
if (file_exists($templateFile)) {
    $templateContent = file_get_contents($templateFile);
    echo "\n2. TEMPLATE/BLOG.HTML (static file):\n";
    echo "   ✓ File exists\n";
    echo "   File size: " . filesize($templateFile) . " bytes\n";
    
    // Check if it's being used somewhere
    $routesFile = file_get_contents(__DIR__ . '/../routes/web.php');
    if (strpos($routesFile, 'template/blog.html') !== false) {
        echo "   ⚠ Referenced in routes!\n";
    } else {
        echo "   ✓ Not referenced in routes (good)\n";
    }
    
    // Check for dynamic vs static content
    echo "   Contains '@foreach': " . (strpos($templateContent, '@foreach') !== false ? "YES" : "NO") . "\n";
    echo "   Contains '<article': " . (strpos($templateContent, '<article') !== false ? "YES" : "NO") . "\n";
}

echo "\n3. CONTROLLER ANALYSIS:\n";
$controllerFile = __DIR__ . '/../app/Http/Controllers/Blog.php';
$controllerContent = file_get_contents($controllerFile);
echo "   return view('blog', \$data): " . (strpos($controllerContent, "view('blog'") !== false ? "YES" : "NO") . "\n";
echo "   BlogPost::published(): " . (strpos($controllerContent, 'BlogPost::published()') !== false ? "YES" : "NO") . "\n";
echo "   ->paginate(9): " . (strpos($controllerContent, '->paginate(9)') !== false ? "YES" : "NO") . "\n";

echo "\n4. ROUTES CHECK:\n";
$blogRoute = "Route::get('blog', 'App\\Http\\Controllers\\Blog@index')";
if (strpos($routesFile, 'blog') !== false && strpos($routesFile, 'Blog@index') !== false) {
    echo "   ✓ Blog route exists\n";
} else {
    echo "   ✗ Blog route might not be configured\n";
}

echo "\n5. DATABASE CONNECTIONS:\n";
$pdo = new PDO("mysql:host=127.0.0.1;dbname=jemari_edu", "root", "");
$articles = $pdo->query("SELECT COUNT(*) as count FROM blog_posts WHERE status='publish'")->fetch();
echo "   Published articles in DB: " . $articles['count'] . "\n";

if ($articles['count'] == 0) {
    echo "   ⚠ NO PUBLISHED ARTICLES! This is the problem!\n";
    echo "   Checking all articles:\n";
    $all = $pdo->query("SELECT id_post, judul, status FROM blog_posts LIMIT 5");
    foreach ($all->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo "      - " . $row['judul'] . " (Status: " . $row['status'] . ")\n";
    }
} else {
    echo "   ✓ Articles should display\n";
}

echo "\n=== END ANALYSIS ===\n";
?>
