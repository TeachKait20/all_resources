<?php
require_once 'config.php';
include 'header.php';
?>

<div class="hero" style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://via.placeholder.com/1200x400/1a1a2e/ffffff?text=Aurora+Motors');">
    <h1>Добро пожаловать в будущее</h1>
    <p>Инновационные электромобили премиум-класса</p>
</div>

<h2>Флагманские модели</h2>

<div class="car-grid">
<?php
$sql = "SELECT * FROM cars WHERE is_featured = TRUE";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="car-card">';
        echo '<img src="' . $row['image_path'] . '" alt="' . $row['model'] . '">';
        echo '<h3>' . $row['model'] . '</h3>';
        echo '<p>' . $row['year'] . ' • ' . $row['engine_type'] . '</p>';
        echo '<p class="price">' . number_format($row['price'], 0, ',', ' ') . ' ₽</p>';
        echo '<a href="car_details.php?id=' . $row['id'] . '">Подробнее</a>';
        echo '</div>';
    }
} else {
    echo "<p>Нет автомобилей в наличии</p>";
}
?>
</div>

<?php include 'footer.php'; ?>