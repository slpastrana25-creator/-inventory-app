-- Import this in phpMyAdmin (select your database first; InfinityFree doesn't allow CREATE DATABASE)
CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  category VARCHAR(50) NOT NULL,
  quantity INT NOT NULL DEFAULT 0,
  price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO products (name, category, quantity, price) VALUES
('Ballpoint Pen (Blue)', 'Office Supplies', 120, 8.50),
('A4 Bond Paper (Ream)', 'Office Supplies', 40, 260.00),
('USB Flash Drive 32GB', 'Electronics', 15, 350.00);
