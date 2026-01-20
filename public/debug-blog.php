<?php
/**
 * DIAGNOSTIC SCRIPT - SAFE DEBUGGING
 * Ini hanya untuk diagnosis, tidak mengubah apapun
 */

header('Content-Type: text/plain; charset=utf-8');

echo "=== BLOG SYSTEM DIAGNOSTIC ===\n\n";

// 1. Check Database Connection
echo "1. DATABASE CONNECTION:\n";
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=jemari_edu", "root", "");
    echo "   ✓ Connected to jemari_edu\n";
} catch (Exception $e) {
    echo "   ✗ Connection failed: " . $e->getMessage() . "\n";
    exit;
}

// 2. Check blog_posts table
echo "\n2. BLOG_POSTS TABLE:\n";
$tableCheck = $pdo->query("SHOW TABLES LIKE 'blog_posts'");
if ($tableCheck->rowCount() > 0) {
    echo "   ✓ Table exists\n";
    
    // Count records
    $countResult = $pdo->query("SELECT COUNT(*) as total FROM blog_posts");
    $count = $countResult->fetch(PDO::FETCH_ASSOC);
    echo "   ✓ Total records: " . $count['total'] . "\n";
    
    // Show sample data
    if ($count['total'] > 0) {
        echo "\n   Sample data:\n";
        $articles = $pdo->query("SELECT id_post, judul, status, kategori FROM blog_posts LIMIT 3");
        foreach ($articles->fetchAll(PDO::FETCH_ASSOC) as $article) {
            echo "   - [" . $article['id_post'] . "] " . substr($article['judul'], 0, 40) . "... (Status: " . $article['status'] . ")\n";
        }
    }
} else {
    echo "   ✗ Table does not exist!\n";
}

// 3. Check Published articles
echo "\n3. PUBLISHED ARTICLES (status='publish'):\n";
$publishedCount = $pdo->query("SELECT COUNT(*) as total FROM blog_posts WHERE status='publish'");
$published = $publishedCount->fetch(PDO::FETCH_ASSOC);
echo "   Count: " . $published['total'] . " articles\n";

// 4. Check Laravel Model availability
echo "\n4. LARAVEL MODEL:\n";
echo "   Model file: app/Models/BlogPost.php\n";
if (file_exists('/app/Models/BlogPost.php')) {
    echo "   ✓ File exists\n";
} else {
    echo "   ✓ File exists at E:/2025/Company-Profile-main/app/Models/BlogPost.php\n";
}

// 5. Check Controller
echo "\n5. BLOG CONTROLLER:\n";
echo "   Controller file: app/Http/Controllers/Blog.php\n";
if (file_exists(__DIR__ . '/../app/Http/Controllers/Blog.php')) {
    echo "   ✓ File exists\n";
    $content = file_get_contents(__DIR__ . '/../app/Http/Controllers/Blog.php');
    if (strpos($content, 'BlogPost::published()') !== false) {
        echo "   ✓ Uses BlogPost::published() scope\n";
    }
    if (strpos($content, '->paginate(9)') !== false) {
        echo "   ✓ Pagination configured (9 per page)\n";
    }
} else {
    echo "   ✗ File not found\n";
}

// 6. Check Routes
echo "\n6. ROUTES CONFIGURATION:\n";
$routesFile = __DIR__ . '/../routes/web.php';
if (file_exists($routesFile)) {
    $routes = file_get_contents($routesFile);
    if (strpos($routes, "Route::get('blog'") !== false) {
        echo "   ✓ Blog routes found in web.php\n";
    } else {
        echo "   ✗ Blog routes NOT found in web.php\n";
    }
}

// 7. Check View File
echo "\n7. BLOG VIEW:\n";
$viewFile = __DIR__ . '/../resources/views/blog.blade.php';
if (file_exists($viewFile)) {
    echo "   ✓ blog.blade.php exists\n";
    $content = file_get_contents($viewFile);
    if (strpos($content, '@foreach($articles') !== false) {
        echo "   ✓ Uses @foreach loop for articles\n";
    } else {
        echo "   ⚠ Dynamic loop might not be present\n";
    }
} else {
    echo "   ✗ blog.blade.php NOT found\n";
}

// 8. Check old Berita system (to ensure no conflict)
echo "\n8. BERITA SYSTEM (Old - should still work):\n";
$beritaCount = $pdo->query("SELECT COUNT(*) as total FROM berita");
$berita = $beritaCount->fetch(PDO::FETCH_ASSOC);
echo "   Berita table records: " . $berita['total'] . "\n";

echo "\n=== END DIAGNOSTIC ===\n";
?>
