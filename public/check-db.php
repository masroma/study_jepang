<?php
// Database status check - accessible via HTTP
// Put in public folder

$host = '127.0.0.1';
$db = 'jemari_edu';
$user = 'root';
$pass = '';

header('Content-Type: text/plain; charset=utf-8');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if blog_posts table exists
    $result = $pdo->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'jemari_edu' AND TABLE_NAME = 'blog_posts'");
    $tableExists = $result->fetch();
    
    if ($tableExists) {
        echo "✓ Table blog_posts FOUND\n";
        
        // Count articles
        $count = $pdo->query("SELECT COUNT(*) as total FROM blog_posts")->fetch();
        echo "✓ Total articles: " . $count['total'] . "\n\n";
        
        if ($count['total'] > 0) {
            echo "Sample articles:\n";
            $articles = $pdo->query("SELECT id_post, judul, kategori, status FROM blog_posts LIMIT 5");
            foreach ($articles->fetchAll(PDO::FETCH_ASSOC) as $i => $article) {
                echo "  [" . ($i+1) . "] " . $article['judul'] . " (Kategori: " . $article['kategori'] . ", Status: " . $article['status'] . ")\n";
            }
        } else {
            echo "✗ Table is EMPTY - no articles\n";
        }
    } else {
        echo "✗ Table blog_posts NOT FOUND\n";
        
        // List all tables
        echo "\nAvailable tables in database:\n";
        $tables = $pdo->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'jemari_edu' ORDER BY TABLE_NAME");
        foreach ($tables->fetchAll(PDO::FETCH_COLUMN) as $table) {
            echo "  - $table\n";
        }
    }
} catch (Exception $e) {
    echo "✗ Database Error: " . $e->getMessage() . "\n";
}
?>
