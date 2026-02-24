<?php
// ==================================================
// CONNECTING TO THE DATABASE
// =================================================
$host = 'db';
$user = 'user';
$password = 'user123';
$database = 'gameshop';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Get data from the stores table
$stores = $conn->query("SELECT * FROM stores ORDER BY id");

// Get data from the toys table with store names
$toys = $conn->query("
    SELECT 
        t.*,
        s1.address as main_store_address,
        s2.address as second_store_address
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
    <title>GameShop - Магазин игрушек</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f0f2f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        h2 {
            color: #444;
            margin: 30px 0 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #667eea;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background: white;
        }
        th {
            background: #667eea;
            color: white;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background: #f5f5f5;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
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
        .stats {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            line-height: 1.6;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎮 GameShop - База данных магазина игрушек</h1>

<!-- =====================================================
STATISTICS
====================================================== -->
        <div class="stats">
            <strong>База данных:</strong> gameshop | 
            <strong>Таблицы:</strong> stores (<?php echo $stores->num_rows; ?>), toys (<?php echo $toys->num_rows; ?>) |
            <strong>Подключение:</strong> <?php echo $conn->host_info; ?>
        </div>

<!-- ====================================================
TABLE 1: SHOPS
==================================================== -->
        <h2>🏪 Таблица 1: Магазины (stores)</h2>
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
                <?php if ($stores->num_rows > 0): ?>
                    <?php while($store = $stores->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $store['id']; ?></td>
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
                    <tr><td colspan="4">Нет данных о магазинах</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

<!-- ====================================================
TABLE 2: TOYS
==================================================== -->
        <h2>🧸 Таблица 2: Игрушки (toys)</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название игрушки</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Основной магазин</th>
                    <th>Доп. магазин</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($toys->num_rows > 0): ?>
                    <?php while($toy = $toys->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $toy['id']; ?></td>
                        <td><strong><?php echo htmlspecialchars($toy['name']); ?></strong></td>
                        <td><?php echo number_format($toy['price'], 2); ?> ₽</td>
                        <td><?php echo $toy['quantity']; ?> шт</td>
                        <td><?php echo htmlspecialchars($toy['main_store_address'] ?? '—'); ?></td>
                        <td><?php echo htmlspecialchars($toy['second_store_address'] ?? '—'); ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">Нет данных об игрушках</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

<!-- ====================================================
DATA INFORMATION
===================================================== -->
        <div class="stats">
            <strong>Всего магазинов:</strong> <?php echo $stores->num_rows; ?><br>
            <strong>Всего игрушек:</strong> <?php echo $toys->num_rows; ?><br>
            <strong>Последнее обновление:</strong> <?php echo date('Y-m-d H:i:s'); ?>
        </div>

        <footer>
            GameShop &copy; 2025 - Один файл, две таблицы
        </footer>
    </div>
</body>
</html>
