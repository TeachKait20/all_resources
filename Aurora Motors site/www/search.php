<?php
require_once 'config.php';
include 'header.php';
?>

<h1>Поиск автомобилей Aurora</h1>

<div class="search-container">
    <form method="GET" action="">
        <input type="text" 
               name="q" 
               placeholder="Введите модель (Celestial, Nebula...)" 
               value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>"
               class="search-input">
        <button type="submit" class="search-button">Найти</button>
    </form>
    <p class="search-hint">🔍 Попробуйте: Celestial, Nebula, Comet, Eclipse, Stellar</p>
</div>

<?php
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $search = $_GET['q'];
    
    echo '<div class="debug-info">';
    echo '<h3>🔧 Отладочная информация:</h3>';
    
    $sql = "SELECT * FROM cars WHERE model LIKE '%$search%' OR color LIKE '%$search%' OR engine_type LIKE '%$search%'";
    echo "<p>SQL запрос: <code>" . htmlspecialchars($sql) . "</code></p>";
    echo '</div>';
    
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        echo '<h2>Результаты поиска:</h2>';
        echo '<div class="car-grid">';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="car-card">';
            echo '<img src="' . $row['image_path'] . '" alt="' . $row['model'] . '">';
            echo '<h3>' . $row['model'] . '</h3>';
            echo '<p>' . $row['year'] . ' • ' . $row['color'] . '</p>';
            echo '<p class="price">' . number_format($row['price'], 0, ',', ' ') . ' ₽</p>';
            echo '<a href="car_details.php?id=' . $row['id'] . '">Подробнее</a>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p class="no-results">Ничего не найдено. Попробуйте другое ключевое слово.</p>';
        if ($result && mysqli_error($conn)) {
            echo '<p class="error">Ошибка MySQL: ' . mysqli_error($conn) . '</p>';
        }
    }
}
?>

<?php include 'footer.php'; ?>