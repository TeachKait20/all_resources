<?php
require_once 'config.php';
include 'header.php';
?>

<h1>Все модели Aurora Motors</h1>

<div class="car-grid">
<?php
$sql = "SELECT * FROM cars ORDER BY price DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="car-card">';
        echo '<img src="' . $row['image_path'] . '" alt="' . $row['model'] . '">';
        echo '<h3>' . $row['model'] . ' (' . $row['year'] . ')</h3>';
        echo '<p>Цвет: ' . $row['color'] . '</p>';
        echo '<p>Пробег: ' . number_format($row['mileage'], 0, ',', ' ') . ' км</p>';
        echo '<p>Двигатель: ' . $row['engine_type'] . '</p>';
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