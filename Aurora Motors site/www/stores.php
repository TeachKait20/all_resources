<?php
require_once 'config.php';
include 'header.php';
?>

<h1>Шоурумы Aurora Motors</h1>
<p class="section-description">Посетите наши магазины в крупнейших городах</p>

<div class="stores-grid">
<?php
$sql = "SELECT * FROM stores ORDER BY city";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="store-card">';
        echo '<h3>🌍 ' . $row['city'] . '</h3>';
        echo '<p class="address">📍 ' . $row['address'] . '</p>';
        echo '<p class="phone">📞 ' . $row['phone'] . '</p>';
        echo '<p class="manager">👤 Управляющий: ' . $row['manager_name'] . '</p>';
        echo '<p class="hours">🕒 ' . $row['opening_hours'] . '</p>';
        echo '</div>';
    }
} else {
    echo "<p>Нет данных о магазинах</p>";
}
?>
</div>

<?php include 'footer.php'; ?>