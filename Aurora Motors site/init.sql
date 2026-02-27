-- Создание базы данных
CREATE DATABASE IF NOT EXISTS autoelite_db;
USE autoelite_db;

-- 1. Таблица автомобилей
CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    model VARCHAR(100) NOT NULL,
    year INT,
    price DECIMAL(10, 2),
    color VARCHAR(50),
    mileage INT,
    engine_type VARCHAR(50),
    image_path VARCHAR(255) DEFAULT 'imgs/cars/default.jpg',
    is_featured BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Таблица сотрудников
CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    position VARCHAR(100),
    department VARCHAR(100),
    phone VARCHAR(20),
    email VARCHAR(100),
    photo_path VARCHAR(255) DEFAULT 'imgs/staff/default.jpg',
    hire_date DATE
);

-- 3. Таблица магазинов
CREATE TABLE IF NOT EXISTS stores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city VARCHAR(100) NOT NULL,
    address TEXT,
    phone VARCHAR(20),
    manager_name VARCHAR(100),
    opening_hours VARCHAR(255),
    map_coordinates VARCHAR(100)
);

-- 4. Таблица контента
CREATE TABLE IF NOT EXISTS page_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_name VARCHAR(50) UNIQUE,
    content TEXT,
    is_hidden BOOLEAN DEFAULT FALSE
);

-- 5. Таблица администраторов
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password_hash VARCHAR(255),
    role VARCHAR(50)
);

-- Наполнение данными (ВЫМЫШЛЕННЫЕ АВТОМОБИЛИ)
INSERT INTO cars (model, year, price, color, mileage, engine_type, image_path, is_featured) VALUES
('Aurora Celestial GT', 2024, 8900000.00, 'Северное сияние (градиент)', 50, 'Электро (два мотора, 600 л.с.)', 'imgs/cars/aurora_celestial.jpg', TRUE),
('Aurora Nebula S', 2023, 12500000.00, 'Космический синий металлик', 1200, 'Электро (три мотора, 850 л.с.)', 'imgs/cars/aurora_nebula.jpg', TRUE),
('Aurora Comet Cross', 2024, 6700000.00, 'Лунный серебристый', 100, 'Гибрид (турбо + электромотор)', 'imgs/cars/aurora_comet.jpg', FALSE),
('Aurora Eclipse Coupe', 2023, 15300000.00, 'Черная дыра (матовая)', 500, 'Электро (спортивный, 1000 л.с.)', 'imgs/cars/aurora_eclipse.jpg', TRUE),
('Aurora Stellar Van', 2024, 5200000.00, 'Облачно-белый', 10, 'Электро (грузовой фургон)', 'imgs/cars/aurora_stellar.jpg', FALSE);

-- ВЫМЫШЛЕННЫЕ СОТРУДНИКИ
INSERT INTO employees (full_name, position, department, phone, email, photo_path, hire_date) VALUES
('Артем Северцев', 'Ведущий дизайнер', 'Отдел дизайна', '+7 (495) 123-45-71', 'a.severtsev@aurora.ru', 'imgs/staff/severtsev.jpg', '2022-02-10'),
('Елена Радуга', 'Менеджер по продажам', 'Отдел продаж', '+7 (495) 123-45-72', 'e.raduga@aurora.ru', 'imgs/staff/raduga.jpg', '2023-05-15'),
('Дмитрий Звездный', 'Инженер-робототехник', 'Технический отдел', '+7 (495) 123-45-73', 'd.zvezdny@aurora.ru', 'imgs/staff/zvezdny.jpg', '2021-11-20'),
('София Лунная', 'PR-директор', 'Маркетинг', '+7 (495) 123-45-74', 's.lunnaya@aurora.ru', 'imgs/staff/lunnaya.jpg', '2023-01-10');

-- Магазины
INSERT INTO stores (city, address, phone, manager_name, opening_hours) VALUES
('Москва', 'ул. Звездная, д. 42 (Технопарк Сколково)', '+7 (495) 777-88-99', 'Артем Северцев (и.о.)', 'Пн-Вс: 10:00 - 22:00'),
('Санкт-Петербург', 'пр. Космонавтов, д. 15, лит. А', '+7 (812) 555-66-77', 'Елена Радуга', 'Пн-Вс: 11:00 - 21:00'),
('Казань', 'ул. Иннополис, д. 1', '+7 (843) 444-55-66', 'Дмитрий Звездный', 'Пн-Сб: 09:00 - 20:00'),
('Сочи', 'ул. Лунная, д. 20/1', '+7 (862) 333-44-55', 'София Лунная', 'Ежедневно: 09:00 - 23:00');

-- Скрытый контент
INSERT INTO page_content (page_name, content, is_hidden) VALUES
('about', '<h2>О компании Aurora Motors</h2><p>Мы создаем автомобили будущего с 2022 года. Наша миссия - сделать электромобили доступными и желанными.</p>', FALSE),
('privacy_policy', 'Политика конфиденциальности...', FALSE),
('secret_flag', 'Поздравляю! Вы нашли секретную страницу. Флаг: AURORA_SQL_2024', TRUE);

-- Администраторы (пароли: adminpass и managerpass)
INSERT INTO admin_users (username, password_hash, role) VALUES
('admin', MD5('adminpass'), 'superadmin'),
('artem.design', MD5('design2024'), 'editor');