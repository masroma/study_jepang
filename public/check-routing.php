<?php
/**
 * DIRECT PHP TEST - Route testing without Laravel
 * Check if blog route resolves
 */

header('Content-Type: text/plain; charset=utf-8');

echo "=== TESTING BLOG ROUTE RESOLUTION ===\n\n";

// Check if routes/web.php contains blog route
$routesFile = __DIR__ . '/../routes/web.php';
$content = file_get_contents($routesFile);

echo "1. ROUTES FILE CHECK:\n";

if (strpos($content, "Route::get('blog'") !== false) {
    echo "   ✓ Found: Route::get('blog'...\n";
} else {
    echo "   ✗ NOT found: Route::get('blog'\n";
}

// Check Laravel auto-loader
echo "\n2. CHECKING LARAVEL BOOTSTRAP:\n";
if (file_exists(__DIR__ . '/../bootstrap/app.php')) {
    echo "   ✓ bootstrap/app.php exists\n";
} else {
    echo "   ✗ bootstrap/app.php NOT found\n";
}

// Check Blog controller
echo "\n3. BLOG CONTROLLER:\n";
$blogController = __DIR__ . '/../app/Http/Controllers/Blog.php';
if (file_exists($blogController)) {
    echo "   ✓ Blog.php exists\n";
    $ctrl = file_get_contents($blogController);
    if (strpos($ctrl, 'public function index()') !== false) {
        echo "   ✓ index() method exists\n";
    }
} else {
    echo "   ✗ Blog.php NOT found\n";
}

// Check BlogPost model
echo "\n4. BLOGPOST MODEL:\n";
$model = __DIR__ . '/../app/Models/BlogPost.php';
if (file_exists($model)) {
    echo "   ✓ BlogPost.php exists\n";
    $m = file_get_contents($model);
    if (strpos($m, 'class BlogPost') !== false) {
        echo "   ✓ BlogPost class defined\n";
    }
} else {
    echo "   ✗ BlogPost.php NOT found\n";
}

// Check blog view
echo "\n5. BLOG VIEW:\n";
$view = __DIR__ . '/../resources/views/blog.blade.php';
if (file_exists($view)) {
    echo "   ✓ blog.blade.php exists\n";
} else {
    echo "   ✗ blog.blade.php NOT found\n";
}

echo "\n=== IF ALL CHECKS PASS, EVERYTHING IS IN PLACE ===\n";
echo "=== ISSUE MIGHT BE IN EXECUTION/RUNTIME ===\n";
?>
