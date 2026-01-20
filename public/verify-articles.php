<?php
/**
 * SIMPLE ELOQUENT TEST - Without full bootstrap
 * Just test model directly
 */

header('Content-Type: text/plain; charset=utf-8');

// Get to project root and autoload
require_once __DIR__ . '/../vendor/autoload.php';

// Create a simple PDO connection to verify data exists first
$pdo = new PDO("mysql:host=127.0.0.1;dbname=jemari_edu", "root", "");

echo "=== BASIC DATA VERIFICATION ===\n\n";

// Direct SQL query
$result = $pdo->query("SELECT * FROM blog_posts WHERE status='publish' ORDER BY tanggal_publish DESC LIMIT 9");
$articles = $result->fetchAll(PDO::FETCH_ASSOC);

echo "Query Result:\n";
echo "SELECT * FROM blog_posts WHERE status='publish' ORDER BY tanggal_publish DESC LIMIT 9\n\n";

if (count($articles) > 0) {
    echo "✓ SUCCESS! Found " . count($articles) . " published articles:\n\n";
    
    foreach ($articles as $i => $article) {
        echo "[" . ($i+1) . "] " . $article['judul'] . "\n";
        echo "    Slug: " . $article['slug'] . "\n";
        echo "    Kategori: " . $article['kategori'] . "\n";
        echo "    Status: " . $article['status'] . "\n";
        echo "    Gambar: " . substr($article['gambar'], 0, 60) . "...\n";
        echo "    Deskripsi: " . substr($article['deskripsi_singkat'], 0, 50) . "...\n\n";
    }
} else {
    echo "✗ NO ARTICLES FOUND!\n\n";
    
    // Debug: check all records
    echo "Checking ALL records (no filter):\n";
    $all = $pdo->query("SELECT id_post, judul, status, kategori FROM blog_posts");
    $allRecords = $all->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($allRecords as $record) {
        echo "  - " . $record['judul'] . " (Status: " . $record['status'] . ")\n";
    }
}

echo "\n=== END VERIFICATION ===\n";
?>
