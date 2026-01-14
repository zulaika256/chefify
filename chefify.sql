-- Database creation
CREATE DATABASE IF NOT EXISTS chefify;
USE chefify;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(100) NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin') DEFAULT 'customer',
    account_status ENUM('active', 'suspended') DEFAULT 'active',
    avatar VARCHAR(255) DEFAULT 'img/avatar1.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL
);

-- Menu Items Table
CREATE TABLE IF NOT EXISTS menu_items (
    item_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    category ENUM('western', 'local', 'dessert', 'drinks', 'snacks') NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    promo_price DECIMAL(10,2) NULL,
    promo_end_date DATE NULL,
    image_path VARCHAR(255) NOT NULL,
    is_available BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders Table
CREATE TABLE IF NOT EXISTS orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    total_amount DECIMAL(10,2) NOT NULL,
    payment_method ENUM('Cash', 'Card', 'E-Wallet') NOT NULL,
    order_status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
    points_earned INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
);

-- Order Items Table
CREATE TABLE IF NOT EXISTS order_items (
    order_item_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    item_id INT,
    quantity INT NOT NULL,
    price_at_purchase DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES menu_items(item_id) ON DELETE SET NULL
);

-- Reward Points Table
CREATE TABLE IF NOT EXISTS reward_points (
    points_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE NOT NULL,
    points INT DEFAULT 0,
    total_points_earned INT DEFAULT 0,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- User Progress Table
CREATE TABLE IF NOT EXISTS user_progress (
    progress_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE NOT NULL,
    current_level INT DEFAULT 1,
    total_orders INT DEFAULT 0,
    total_spent DECIMAL(10,2) DEFAULT 0,
    badges_earned JSON NULL,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Spin History Table
CREATE TABLE IF NOT EXISTS spin_history (
    spin_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    reward_won VARCHAR(100) NOT NULL,
    points_spent INT DEFAULT 30,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Game History Table
CREATE TABLE IF NOT EXISTS game_history (
    game_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    game_type VARCHAR(50) NOT NULL,
    score INT NOT NULL,
    reward_won VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Badges Table
CREATE TABLE IF NOT EXISTS badges (
    badge_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    icon VARCHAR(10) NOT NULL,
    requirement_type ENUM('points', 'orders', 'level') NOT NULL,
    requirement_value INT NOT NULL
);

-- User Badges Table
CREATE TABLE IF NOT EXISTS user_badges (
    user_badge_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    badge_id INT NOT NULL,
    earned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY (user_id, badge_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (badge_id) REFERENCES badges(badge_id) ON DELETE CASCADE
);

-- Feedback Table
CREATE TABLE IF NOT EXISTS feedback (
    feedback_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT NOT NULL,
    points_awarded INT DEFAULT 5,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
);

-- Leaderboard Table (optional, for performance)
CREATE TABLE IF NOT EXISTS leaderboard (
    cache_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    `rank` INT NOT NULL,
    points INT NOT NULL,
    level VARCHAR(50) NOT NULL,
    badges_count INT NOT NULL,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Insert Default Badges
INSERT INTO badges (name, description, icon, requirement_type, requirement_value) VALUES
('First Order', 'Placed your first order', '🍽️', 'points', 1),
('Food Lover', 'Earned 200 points', '❤️', 'points', 200),
('Chef Explorer', 'Earned 400 points', '👨‍🍳', 'points', 400),
('Master Taster', 'Earned 800 points', '🏆', 'points', 800);

-- Challenges Table (introduced for progress tracker)
CREATE TABLE IF NOT EXISTS challenges (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    target INT NOT NULL DEFAULT 0,
    reward_points INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_challenge_name (name)
);

-- User Challenges mapping table
CREATE TABLE IF NOT EXISTS user_challenges (
    user_id INT NOT NULL,
    challenge_id INT NOT NULL,
    progress INT NOT NULL DEFAULT 0,
    completed_at DATETIME DEFAULT NULL,
    claimed TINYINT(1) NOT NULL DEFAULT 0,
    claimed_at DATETIME DEFAULT NULL,
    PRIMARY KEY (user_id, challenge_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (challenge_id) REFERENCES challenges(id) ON DELETE CASCADE
);

-- Insert default challenges (ignore duplicates by unique name)
INSERT IGNORE INTO challenges (name, description, target, reward_points) VALUES
('Order Master','Complete 5 orders this month',5,100),
('Point Collector','Earn 500 total points',500,50),
('Game Champion','Play 3 mini-games',3,10);

-- Insert Menu Items (Western)
INSERT INTO menu_items (name, category, price, description, image_path) VALUES
('Grilled Chicken Chop', 'western', 18.90, 'Juicy grilled chicken thigh with black pepper sauce and fries.', 'img/grilledchicken.jpg'),
('Fish & Chips', 'western', 21.00, 'Crispy battered dory fillet served with tartar sauce.', 'img/fishandchips.jpg'),
('Spaghetti Carbonara', 'western', 19.50, 'Creamy carbonara with beef bacon and parmesan cheese.', 'img/pasta.jpg'),
('Spaghetti Bolognese', 'western', 18.50, 'Slow-cooked beef sauce with herbs and tomato.', 'img/bolognese.jpg'),
('Seafood Aglio Olio', 'western', 24.00, 'Spaghetti tossed with shrimp, mussels and garlic oil.', 'img/seafood.jpg'),
('Chicken Lasagna', 'western', 20.00, 'Layered pasta with creamy cheese and minced chicken.', 'img/lasagna.jpg'),
('Beef Burger', 'western', 22.50, 'Juicy beef patty with cheese, caramelised onions and brioche bun.', 'img/beefburger.jpg'),
('Avocado Toast', 'western', 19.50, 'Sourdough bread with smashed avocado and poached egg.', 'img/avocadotoast.jpg');

-- Insert Menu Items (Local)
INSERT INTO menu_items (name, category, price, description, image_path) VALUES
('Nasi Lemak Ayam Crispy', 'local', 15.90, 'Fragrant coconut rice with crispy chicken, sambal and egg.', 'img/nasilemak.jpg'),
('Nasi Goreng Kampung', 'local', 13.90, 'Traditional fried rice with anchovies and vegetables.', 'img/nasigoreng.jpg'),
('Mee Goreng Mamak', 'local', 13.50, 'Spicy stir-fried noodles with egg and tofu.', 'img/meegoreng.jpg'),
('Chicken Rendang Rice', 'local', 17.90, 'Slow-cooked chicken in rich coconut gravy.', 'img/rendang.jpg'),
('Laksa Lemak', 'local', 16.50, 'Creamy coconut noodle soup with fish cake.', 'img/laksa.jpg');

-- Insert Menu Items (Desserts)
INSERT INTO menu_items (name, category, price, description, image_path) VALUES
('Chocolate Lava Cake', 'dessert', 12.50, 'Warm chocolate cake with molten centre.', 'img/lava.jpg'),
('Classic Cheesecake', 'dessert', 13.50, 'Creamy baked cheesecake with biscuit base.', 'img/classiccheesecake.jpg'),
('Classic Tiramisu', 'dessert', 14.00, 'Coffee-soaked ladyfingers with mascarpone cream.', 'img/tiramisu.jpg'),
('Matcha Tiramisu', 'dessert', 14.50, 'Japanese matcha twist on classic tiramisu.', 'img/matchatiramisu.jpg'),
('Brownies with Ice Cream', 'dessert', 11.90, 'Rich chocolate brownies served warm.', 'img/browniesice.jpg'),
('Red Velvet Cake', 'dessert', 11.00, 'Soft red velvet sponge with cream cheese frosting.', 'img/redvelvet.jpg'),
('Crème Brûlée', 'dessert', 13.00, 'Vanilla custard with caramelised sugar top.', 'img/cremebrulee.jpg');

-- Insert Menu Items (Drinks)
INSERT INTO menu_items (name, category, price, description, image_path) VALUES
('Hot Latte', 'drinks', 8.00, 'Smooth espresso with steamed milk.', 'img/latte.jpg'),
('Cappuccino', 'drinks', 8.50, 'Espresso with milk foam.', 'img/cappuccino.jpg'),
('Iced Latte', 'drinks', 9.00, 'Chilled espresso with fresh milk.', 'img/icedlatte.jpg'),
('Matcha Latte', 'drinks', 9.00, 'Earthy matcha blended with creamy milk.', 'img/matcha.jpg'),
('Iced Mocha', 'drinks', 9.50, 'Chocolate espresso drink served cold.', 'img/mocha.jpg'),
('Lemon Iced Tea', 'drinks', 6.50, 'Refreshing lemon tea with mint.', 'img/lemon.jpg'),
('Peach Tea', 'drinks', 7.00, 'Sweet peach-infused iced tea.', 'img/peachtea.jpg'),
('Strawberry Frappe', 'drinks', 8.50, 'Blended strawberry drink with ice.', 'img/strawberryfrappe.jpg');

-- Insert Menu Items (Snacks)
INSERT INTO menu_items (name, category, price, description, image_path) VALUES
('French Fries', 'snacks', 6.90, 'Golden crispy fries.', 'img/frenchfries.jpg'),
('Cheesy Fries', 'snacks', 8.50, 'Fries topped with melted cheese sauce.', 'img/cheesyfries.jpg'),
('Chicken Nuggets', 'snacks', 8.50, 'Crunchy bite-sized chicken nuggets.', 'img/nuggets.jpg'),
('Onion Rings', 'snacks', 7.50, 'Crispy battered onion rings.', 'img/onionrings.jpg'),
('Nachos with Cheese', 'snacks', 9.90, 'Corn chips served with cheese and salsa.', 'img/nachos.jpg');

-- Insert Initial Admin User (Password: admin123)
-- Hash generated using password_hash('admin123', PASSWORD_DEFAULT)
INSERT IGNORE INTO users (fullname, username, email, phone, password, role, account_status)
VALUES ('System Admin', 'admin', 'admin@chefify.com', '0123456789', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'active');

-- Cart Table
CREATE TABLE IF NOT EXISTS cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    menu_id INT NOT NULL,
    quantity INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (menu_id) REFERENCES menu_items(item_id) ON DELETE CASCADE
);

-- User Coupons/Vouchers Table
CREATE TABLE IF NOT EXISTS user_vouchers (
    voucher_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    code VARCHAR(50) NOT NULL,
    discount_type ENUM('percentage', 'fixed') DEFAULT 'percentage',
    discount_value DECIMAL(10,2) NOT NULL,
    status ENUM('active', 'used', 'expired') DEFAULT 'active',
    expiry_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- User Avatars Table
CREATE TABLE IF NOT EXISTS user_avatars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    avatar_path VARCHAR(255) NOT NULL,
    unlocked TINYINT DEFAULT 1,
    selected TINYINT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);
