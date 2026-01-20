<?php
/**
 * DIRECT ELOQUENT MODEL TEST
 */

header('Content-Type: text/plain; charset=utf-8');

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

use Illuminate\Support\Facades\DB;
use App\Models\BlogPost;

echo "=== ELOQUENT MODEL DIRECT TEST ===\n\n";

// Test 1: Model connectivity
echo "1. MODEL CONNECTION TEST:\n";
try {
    $total = BlogPost::count();
    echo "   ✓ BlogPost model works\n";
    echo "   ✓ Total records: " . $total . "\n";
} catch (\Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
    exit;
}

// Test 2: Published scope
echo "\n2. PUBLISHED SCOPE TEST:\n";
try {
    $published = BlogPost::published()->count();
    echo "   ✓ Published scope works\n";
    echo "   ✓ Published count: " . $published . "\n";
} catch (\Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

// Test 3: Latest scope
echo "\n3. LATEST SCOPE TEST:\n";
try {
    $articles = BlogPost::published()->latest()->get();
    echo "   ✓ Latest scope works\n";
    echo "   ✓ Total: " . $articles->count() . "\n";
    if ($articles->count() > 0) {
        echo "   ✓ First article: " . $articles[0]->judul . "\n";
    }
} catch (\Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

// Test 4: Pagination
echo "\n4. PAGINATION TEST:\n";
try {
    $paginated = BlogPost::published()->latest()->paginate(9);
    echo "   ✓ Pagination works\n";
    echo "   ✓ Total items: " . $paginated->total() . "\n";
    echo "   ✓ Items on page 1: " . $paginated->count() . "\n";
    echo "   ✓ Per page: " . $paginated->perPage() . "\n";
} catch (\Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

// Test 5: Category count
echo "\n5. CATEGORY COUNT TEST:\n";
try {
    $categories = [
        'Pendidikan' => BlogPost::published()->byCategory('Pendidikan')->count(),
        'Panduan' => BlogPost::published()->byCategory('Panduan')->count(),
        'Karier' => BlogPost::published()->byCategory('Karier')->count(),
        'Budaya' => BlogPost::published()->byCategory('Budaya')->count(),
        'Tips & Trik' => BlogPost::published()->byCategory('Tips & Trik')->count(),
        'Lifestyle' => BlogPost::published()->byCategory('Lifestyle')->count(),
    ];
    echo "   ✓ Categories:\n";
    foreach ($categories as $cat => $count) {
        echo "      - $cat: $count articles\n";
    }
} catch (\Exception $e) {
    echo "   ✗ Error: " . $e->getMessage() . "\n";
}

echo "\n=== IF ALL TESTS PASS, ELOQUENT IS WORKING ===\n";
echo "=== IF NOT, THERE'S AN ISSUE WITH MODELS/DATABASE ===\n";

$app->terminate(app(\Illuminate\Http\Request::class), new \Illuminate\Http\Response());
?>
