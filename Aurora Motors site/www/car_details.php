<?php
require_once 'config.php';
include 'header.php';

$id = $_GET['id'] ?? 1;

$sql = "SELECT * FROM cars WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $car = mysqli_fetch_assoc($result);
?>
    <div class="car-details">
        <div class="car-image">
            <img src="<?php echo $car['image_path']; ?>" alt="<?php echo $car['model']; ?>">
        </div>
        <div class="car-info">
            <h1><?php echo $car['model']; ?></h1>
            <p class="price-big"><?php echo number_format($car['price'], 0, ',', ' '); ?> ₽</p>
            <table>
                <tr>
                    <th>Год выпуска:</th>
                    <td><?php echo $car['year']; ?></td>
                </tr>
                <tr>
                    <th>Цвет:</th>
                    <td><?php echo $car['color']; ?></td>
                </tr>
                <tr>
                    <th>Пробег:</th>
                    <td><?php echo number_format($car['mileage'], 0, ',', ' '); ?> км</td>
                </tr>
                <tr>
                    <th>Двигатель:</th>
                    <td><?php echo $car['engine_type']; ?></td>
                </tr>
            </table>
            <a href="cars.php" class="button">← К всем моделям</a>
        </div>
    </div>

    <div class="debug-info">
        <h3>🔧 Отладочная информация (для обучения):</h3>
        <p>Выполнен SQL запрос: <code><?php echo htmlspecialchars($sql); ?></code></p>
    </div>
<?php
} else {
    echo "<h1>Автомобиль не найден</h1>";
    echo "<p>Запрос: " . htmlspecialchars($sql) . "</p>";
    echo "<p>Ошибка: " . mysqli_error($conn) . "</p>";
}

include 'footer.php';
?>