<?php
/**
 * DIRECT QUERY TEST - Check exactly what data is being fetched
 */

header('Content-Type: text/plain; charset=utf-8');

$pdo = new PDO("mysql:host=127.0.0.1;dbname=jemari_edu", "root", "");

echo "=== DIRECT DATABASE QUERY TEST ===\n\n";

// Test 1: All articles
echo "1. ALL ARTICLES (no filters):\n";
$all = $pdo->query("SELECT COUNT(*) as total FROM blog_posts")->fetch();
echo "   Total: " . $all['total'] . "\n";

// Test 2: Published only
echo "\n2. PUBLISHED ARTICLES (status = 'publish'):\n";
$published = $pdo->query("SELECT COUNT(*) as total FROM blog_posts WHERE status='publish'")->fetch();
echo "   Total: " . $published['total'] . "\n";

// Test 3: Fetch published with order
echo "\n3. PUBLISHED ARTICLES (ordered by date DESC):\n";
$articles = $pdo->query("
    SELECT id_post, judul, slug, kategori, deskripsi_singkat, tanggal_publish, status, views 
    FROM blog_posts 
    WHERE status='publish' 
    ORDER BY tanggal_publish DESC 
    LIMIT 9
");

$rows = $articles->fetchAll(PDO::FETCH_ASSOC);
echo "   Found: " . count($rows) . " articles\n\n";

if (count($rows) > 0) {
    foreach ($rows as $i => $row) {
        echo "   [" . ($i+1) . "] " . $row['judul'] . "\n";
        echo "       Kategori: " . $row['kategori'] . "\n";
        echo "       Slug: " . $row['slug'] . "\n";
        echo "       Status: " . $row['status'] . "\n";
        echo "       Tanggal: " . $row['tanggal_publish'] . "\n";
        echo "       Views: " . $row['views'] . "\n\n";
    }
}

// Test 4: Check what's in blog_posts raw
echo "4. RAW DATA (All records, first 5):\n";
$raw = $pdo->query("SELECT * FROM blog_posts LIMIT 5");
$rawRows = $raw->fetchAll(PDO::FETCH_ASSOC);

if (count($rawRows) > 0) {
    foreach ($rawRows as $i => $row) {
        echo "   Record " . ($i+1) . ":\n";
        echo "      judul: " . $row['judul'] . "\n";
        echo "      status: " . $row['status'] . "\n";
        echo "      kategori: " . $row['kategori'] . "\n";
    }
} else {
    echo "   ✗ No records found!\n";
}

echo "\n=== END TEST ===\n";
?>
