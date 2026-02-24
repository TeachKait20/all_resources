-- Creating a table
CREATE TABLE employees (
    id SERIAL PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    work_email VARCHAR(100) UNIQUE NOT NULL,
    department VARCHAR(50) NOT NULL,
    hire_date DATE NOT NULL
);

-- Adding 10 employees
INSERT INTO employees (full_name, work_email, department, hire_date) VALUES
    ('Иванов Петр Сергеевич', 'p.ivanov@company.ru', 'ИТ-отдел', '2023-02-15'),
    ('Петрова Анна Владимировна', 'a.petrova@company.ru', 'Бухгалтерия', '2022-11-01'),
    ('Сидоров Алексей Игоревич', 'a.sidorov@company.ru', 'Отдел продаж', '2024-01-20'),
    ('Козлова Елена Дмитриевна', 'e.kozlova@company.ru', 'HR-отдел', '2023-08-10'),
    ('Морозов Денис Александрович', 'd.morozov@company.ru', 'ИТ-отдел', '2023-05-22'),
    ('Волкова Татьяна Сергеевна', 't.volkova@company.ru', 'Маркетинг', '2022-09-05'),
    ('Соколов Андрей Павлович', 'a.sokolov@company.ru', 'Отдел продаж', '2024-02-01'),
    ('Новикова Ольга Игоревна', 'o.novikova@company.ru', 'Бухгалтерия', '2023-03-12'),
    ('Кузнецов Михаил Викторович', 'm.kuznetsov@company.ru', 'ИТ-отдел', '2023-10-18'),
    ('Смирнова Наталья Алексеевна', 'n.smirnova@company.ru', 'HR-отдел', '2024-01-10');
