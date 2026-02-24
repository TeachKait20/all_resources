-- ===================================================
-- Database: GameShop
-- Version: 1.0
-- Description: A toy shop with two tables
-- ===================================================

-- Creating a database
CREATE DATABASE IF NOT EXISTS gameshop;
USE gameshop;

-- ==================================================
-- Table 1: Stores
-- ==================================================
CREATE TABLE IF NOT EXISTS stores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    address VARCHAR(255) NOT NULL,
    working_hours VARCHAR(100) NOT NULL,
    is_open BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Adding 3 stores
INSERT INTO stores (address, working_hours, is_open) VALUES
    ('ул. Ленина, 15, ТЦ "Гулливер", 2 этаж', '10:00 - 21:00, без выходных', TRUE),
    ('пр. Мира, 42, ТРК "Планета", 1 этаж', '09:00 - 22:00, пн-вс', TRUE),
    ('ул. Пушкина, 8, ТЦ "Детский мир", -1 этаж', '10:00 - 20:00, вт-вс (пн выходной)', FALSE);

-- ==================================================
-- Table 2: Toys
-- ==================================================
CREATE TABLE IF NOT EXISTS toys (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    store_id INT,
    second_store_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (store_id) REFERENCES stores(id) ON DELETE SET NULL,
    FOREIGN KEY (second_store_id) REFERENCES stores(id) ON DELETE SET NULL
);

-- Adding 7 toys
INSERT INTO toys (name, price, quantity, store_id, second_store_id) VALUES
    ('LEGO City Полицейский участок', 4999.99, 15, 1, 2),
    ('Мягкая игрушка "Мишка Тедди" 50см', 1299.50, 8, 2, NULL),
    ('Настольная игра "Монополия"', 2499.00, 12, 3, 1),
    ('Радиоуправляемая машина', 3499.90, 5, 1, NULL),
    ('Кукла "Принцесса" коллекционная', 1899.99, 7, 2, 3),
    ('Детский планшет обучающий', 2999.00, 4, 3, NULL),
    ('Конструктор металлический №3', 899.50, 20, 1, 2);
