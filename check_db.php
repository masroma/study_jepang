<?php
// Direct database check
$host = '127.0.0.1';
$db = 'jemari_edu';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if blog_posts table exists
    $result = $pdo->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db' AND TABLE_NAME = 'blog_posts'");
    $tableExists = $result->fetch();
    
    if ($tableExists) {
        echo "✓ Tabel blog_posts DITEMUKAN\n";
        
        // Count articles
        $count = $pdo->query("SELECT COUNT(*) as total FROM blog_posts")->fetch();
        echo "✓ Total artikel: " . $count['total'] . "\n\n";
        
        if ($count['total'] > 0) {
            echo "Data artikel:\n";
            $articles = $pdo->query("SELECT id_post, judul, kategori, status, tanggal_publish FROM blog_posts LIMIT 5");
            foreach ($articles->fetchAll(PDO::FETCH_ASSOC) as $article) {
                echo "  - [{$article['id_post']}] {$article['judul']} ({$article['kategori']}, {$article['status']})\n";
            }
        } else {
            echo "⚠ Tabel kosong, tidak ada artikel\n";
        }
    } else {
        echo "✗ Tabel blog_posts TIDAK DITEMUKAN\n";
        
        // List all tables
        echo "\nTabel yang ada di database:\n";
        $tables = $pdo->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db'");
        foreach ($tables->fetchAll(PDO::FETCH_COLUMN) as $table) {
            echo "  - $table\n";
        }
    }
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
?>
