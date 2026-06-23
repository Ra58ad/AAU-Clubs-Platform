# Config

Use the sample [config file](sample-config.php) as a guideline.

# Database

Run this query to get your database up and running.

```sql
    CREATE DATABASE IF NOT EXISTS aau_clubs_db;
    USE aau_clubs_db;

    CREATE TABLE clubs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        slug VARCHAR(50) UNIQUE NOT NULL, 
        description TEXT,
        about_us TEXT,
        contact_email VARCHAR(100),
        phone VARCHAR(20),
        hero_image VARCHAR(255) DEFAULT 'images/AAULogo.png',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        club_id INT,
        full_name VARCHAR(100) NOT NULL,
        username VARCHAR(255) NOT NULL,
        student_id VARCHAR(50),
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL, 
        role VARCHAR(20) DEFAULT 'member', 
        club VARCHAR(100), 
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (club_id) REFERENCES clubs(id) ON DELETE SET NULL
    );

    CREATE TABLE events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        club_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        event_date DATETIME NOT NULL,
        media_url VARCHAR(255), 
        media_type ENUM('image', 'video'), 
        type ENUM('event', 'deadline', 'meeting') DEFAULT 'event',
        is_highlight BOOLEAN DEFAULT 0, -- 1 = Show in gallery, 0 = Show in key-dates
        FOREIGN KEY (club_id) REFERENCES clubs(id) ON DELETE CASCADE
    );

    INSERT INTO clubs (name, slug, description, about_us, hero_image) VALUES 
    ('Art & Culture Club', 'art', 'Celebrating creativity.', 'A community for painters and performers.', 'images/art2.jpg'),
    ('Hackathon Club', 'hackathon', 'Innovation through engineering.', 'Building software and hardware solutions.', 'images/hack4.jpg'),
    ('Sports Club', 'sports', 'Compete and train.', 'Promoting fitness and school spirit.', 'images/sport.jpg');

    INSERT INTO events (club_id, title, event_date, media_url, media_type, is_highlight, type) VALUES 
    (1, 'Cultural Dance Night', '2024-05-15', 'images/highlight_video2.mp4', 'video', 1, 'event'),
    (2, 'Summer Bootcamp Registration', '2024-06-10', NULL, NULL, 0, 'deadline'),
    (1, 'Gallery Opening', '2024-06-20', 'images/art1.jpg', 'image', 1, 'event');

```
