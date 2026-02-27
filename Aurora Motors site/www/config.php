<?php
// config.php - УЯЗВИМАЯ КОНФИГУРАЦИЯ (без параметризации)
$db_host = getenv('MYSQL_HOST') ?: 'db';
$db_user = getenv('MYSQL_USER') ?: 'autoelite_user';
$db_pass = getenv('MYSQL_PASSWORD') ?: 'autoelite_pass';
$db_name = getenv('MYSQL_DATABASE') ?: 'autoelite_db';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

// Для отладки (включи только для обучения!)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>