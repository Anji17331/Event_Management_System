
-- Create database
CREATE DATABASE IF NOT EXISTS chronosrevel;
USE chronosrevel;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Events Table
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(255) NOT NULL,
    category VARCHAR(100),
    event_date DATE NOT NULL,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Wishlist Table
CREATE TABLE wishlists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);

-- Cart Table
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    quantity INT DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);

-- Sample Admin and Users
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@example.com', SHA2('admin123', 256), 'admin'),
('john_doe', 'john@example.com', SHA2('password123', 256), 'user'),
('jane_smith', 'jane@example.com', SHA2('mypassword', 256), 'user');

-- Sample Events
INSERT INTO events (title, description, location, category, event_date, image_path) VALUES
('Tech Conference 2025', 'An event for developers and tech enthusiasts.', 'London, UK', 'Technology', '2025-06-15', 'images/tech_conference.jpg'),
('Art & Culture Fest', 'Experience vibrant cultures through art and music.', 'Manchester, UK', 'Culture', '2025-07-20', 'images/art_fest.jpg'),
('Startup Meetup', 'Network with founders and investors.', 'Birmingham, UK', 'Business', '2025-05-30', 'images/startup_meetup.jpg'),
('Food Carnival', 'A day full of cuisines from around the world.', 'Liverpool, UK', 'Food', '2025-08-05', 'images/food_carnival.jpg');

-- Sample Wishlist
INSERT INTO wishlists (user_id, event_id) VALUES
(2, 1),
(3, 2);

-- Sample Cart
INSERT INTO cart (user_id, event_id, quantity) VALUES
(2, 3, 1),
(3, 4, 2);
