<?php
/**
 * LARAVEL FRAMEWORK TEST
 * Test using Laravel to see if controller works
 */

// Bootstrap Laravel
require_once __DIR__ . '/../bootstrap/app.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::create('/blog');
$response = $kernel->handle($request);

header('Content-Type: text/plain; charset=utf-8');

echo "=== LARAVEL BLOG CONTROLLER TEST ===\n\n";

// Instead, let's manually test the controller logic
echo "Testing controller logic directly:\n\n";

// Load necessary classes
use Illuminate\Support\Facades\DB;
use App\Models\BlogPost;

echo "1. CHECKING BLOGPOST MODEL:\n";
try {
    $count = BlogPost::count();
    echo "   ✓ BlogPost model works\n";
    echo "   ✓ Total records in blog_posts: " . $count . "\n";
} catch (Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

echo "\n2. CHECKING PUBLISHED SCOPE:\n";
try {
    $published = BlogPost::published()->count();
    echo "   ✓ Published articles: " . $published . "\n";
    
    $articles = BlogPost::published()->latest()->get();
    if ($articles->count() > 0) {
        echo "   ✓ Sample articles:\n";
        foreach ($articles->take(3) as $article) {
            echo "      - " . $article->judul . "\n";
        }
    }
} catch (Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

echo "\n3. CHECKING PAGINATION:\n";
try {
    $paginated = BlogPost::published()->latest()->paginate(9);
    echo "   ✓ Pagination works\n";
    echo "   ✓ Per page: 9\n";
    echo "   ✓ Total items: " . $paginated->total() . "\n";
    echo "   ✓ Items on this page: " . $paginated->count() . "\n";
} catch (Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

echo "\n=== END TEST ===\n";

$kernel->terminate($request, $response);
?>
