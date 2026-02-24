<?php
// ==============================================
// GameShopSite.php
// Единый файл: подключение к БД + две таблицы
// ==============================================

// Параметры подключения к MySQL
$host = 'db';
$user = 'user';
$password = 'user123';
$database = 'gameshop';

// Подключение к базе данных
$conn = new mysqli($host, $user, $password, $database);

// Проверка подключения
if ($conn->connect_error) {
    die("<div style='color: red; padding: 20px; background: #ffeeee; border: 2px solid red; margin: 20px;'>
            ❌ Ошибка подключения к БД: " . $conn->connect_error . "
         </div>");
}

// ========== ЭТА СТРОКА РЕШАЕТ ПРОБЛЕМУ ==========
$conn->set_charset("utf8mb4");
// =================================================

// Получаем данные из таблицы магазинов
$stores = $conn->query("SELECT * FROM stores ORDER BY id");

// Получаем данные из таблицы игрушек с информацией о магазинах
$toys = $conn->query("
    SELECT 
        t.*,
        s1.address as main_store_address,
        s1.is_open as main_store_open,
        s2.address as second_store_address,
        s2.is_open as second_store_open
    FROM toys t
    LEFT JOIN stores s1 ON t.store_id = s1.id
    LEFT JOIN stores s2 ON t.second_store_id = s2.id
    ORDER BY t.id
");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameShopSite - Магазин игрушек</title>
    <style>
        /* ========== МИНИМАЛЬНЫЕ СТИЛИ ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid #3498db;
        }
        h2 {
            color: #34495e;
            margin: 30px 0 20px;
            padding-left: 10px;
            border-left: 5px solid #3498db;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background: white;
            border: 1px solid #ddd;
        }
        th {
            background: #3498db;
            color: white;
            padding: 12px;
            text-align: left;
        }
        td {
            padding: 10px 12px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background: #f8f9fa;
        }
        tr:hover {
            background: #e8f4f8;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge.open {
            background: #d4edda;
            color: #155724;
        }
        .badge.closed {
            background: #f8d7da;
            color: #721c24;
        }
        .info-box {
            background: #e8f4f8;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 5px solid #3498db;
        }
        .stats {
            display: flex;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        .stat-item {
            background: #3498db;
            color: white;
            padding: 15px 25px;
            border-radius: 5px;
            font-size: 1.1em;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #ddd;
            color: #7f8c8d;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎮 GameShopSite - Магазин игрушек</h1>

        <!-- Информация о подключении -->
        <div class="success">
            ✅ Подключено к базе данных 'gameshop' | 
            Сервер: <?php echo $conn->server_info; ?> | 
            Время: <?php echo date('d.m.Y H:i:s'); ?>
        </div>

        <!-- ========== ТАБЛИЦА 1: МАГАЗИНЫ ========== -->
        <h2>🏪 Таблица 1: Магазины (stores) - <?php echo $stores->num_rows; ?> записей</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Адрес магазина</th>
                    <th>Часы работы</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($stores && $stores->num_rows > 0): ?>
                    <?php while($store = $stores->fetch_assoc()): ?>
                    <tr>
                        <td>#<?php echo $store['id']; ?></td>
                        <td><?php echo htmlspecialchars($store['address']); ?></td>
                        <td><?php echo htmlspecialchars($store['working_hours']); ?></td>
                        <td>
                            <?php if($store['is_open']): ?>
                                <span class="badge open">🟢 Открыт</span>
                            <?php else: ?>
                                <span class="badge closed">🔴 Закрыт</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4" style="text-align:center;">Нет данных о магазинах</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- ========== ТАБЛИЦА 2: ИГРУШКИ ========== -->
        <h2>🧸 Таблица 2: Игрушки (toys) - <?php echo $toys->num_rows; ?> записей</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название игрушки</th>
                    <th>Цена</th>
                    <th>Кол-во</th>
                    <th>Основной магазин</th>
                    <th>Доп. магазин</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($toys && $toys->num_rows > 0): ?>
                    <?php while($toy = $toys->fetch_assoc()): ?>
                    <tr>
                        <td>#<?php echo $toy['id']; ?></td>
                        <td><strong><?php echo htmlspecialchars($toy['name']); ?></strong></td>
                        <td><?php echo number_format($toy['price'], 2, '.', ' '); ?> ₽</td>
                        <td><?php echo $toy['quantity']; ?> шт</td>
                        <td>
                            <?php echo htmlspecialchars($toy['main_store_address'] ?? '—'); ?>
                            <?php if(isset($toy['main_store_open']) && $toy['main_store_address']): ?>
                                <?php echo $toy['main_store_open'] ? ' 🟢' : ' 🔴'; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($toy['second_store_address'] ?? '—'); ?>
                            <?php if(isset($toy['second_store_open']) && $toy['second_store_address']): ?>
                                <?php echo $toy['second_store_open'] ? ' 🟢' : ' 🔴'; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6" style="text-align:center;">Нет данных об игрушках</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- ========== СТАТИСТИКА ========== -->
        <div class="stats">
            <div class="stat-item">🏪 Магазинов: <?php echo $stores->num_rows; ?></div>
            <div class="stat-item">🧸 Игрушек: <?php echo $toys->num_rows; ?></div>
            <?php 
            $total = $conn->query("SELECT SUM(quantity) as total FROM toys")->fetch_assoc()['total'];
            ?>
            <div class="stat-item">📦 Всего единиц: <?php echo $total ?? 0; ?> шт</div>
        </div>

        <!-- Информация -->
        <div class="info-box">
            <strong>📋 Описание базы данных:</strong><br>
            • Таблица <b>stores</b> - магазины (id, адрес, часы работы, статус)<br>
            • Таблица <b>toys</b> - игрушки (id, название, цена, количество, store_id, second_store_id)<br>
            • 🟢 - магазин открыт, 🔴 - магазин закрыт<br>
            • Если second_store_id = NULL - игрушка только в одном магазине
        </div>

        <footer>
            GameShopSite v1.0 | <?php echo date('Y'); ?> | Данные из MySQL
        </footer>
    </div>
</body>
</html>
