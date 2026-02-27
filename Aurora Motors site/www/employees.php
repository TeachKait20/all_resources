<?php
require_once 'config.php';
include 'header.php';
?>

<h1>Команда Aurora Motors</h1>
<p class="section-description">Талантливые специалисты, создающие будущее</p>

<div class="employees-grid">
<?php
$sql = "SELECT * FROM employees ORDER BY hire_date";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="employee-card">';
        echo '<img src="' . $row['photo_path'] . '" alt="' . $row['full_name'] . '">';
        echo '<h3>' . $row['full_name'] . '</h3>';
        echo '<p class="position">' . $row['position'] . '</p>';
        echo '<p class="department">' . $row['department'] . '</p>';
        echo '<p class="phone">📞 ' . $row['phone'] . '</p>';
        echo '<p class="email">✉️ ' . $row['email'] . '</p>';
        echo '<p class="hire-date">В команде с ' . date('d.m.Y', strtotime($row['hire_date'])) . '</p>';
        echo '</div>';
    }
} else {
    echo "<p>Нет данных о сотрудниках</p>";
}
?>
</div>

<?php include 'footer.php'; ?>