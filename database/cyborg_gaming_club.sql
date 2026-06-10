CREATE DATABASE IF NOT EXISTS cyborg_gaming_club;
USE cyborg_gaming_club;

DROP TABLE IF EXISTS contact_messages;
DROP TABLE IF EXISTS fixtures;
DROP TABLE IF EXISTS enrollments;
DROP TABLE IF EXISTS committee;
DROP TABLE IF EXISTS events;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    student_id VARCHAR(50) NOT NULL UNIQUE,
    department VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    favorite_game VARCHAR(100) NOT NULL,
    role ENUM('user','admin') NOT NULL DEFAULT 'user',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(150) NOT NULL,
    game_name VARCHAR(100) NOT NULL,
    event_date DATE NOT NULL,
    event_time TIME NOT NULL,
    venue VARCHAR(150) NOT NULL,
    description TEXT,
    rules TEXT,
    prize VARCHAR(150),
    status ENUM('open','upcoming','finished') NOT NULL DEFAULT 'open',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    game_username VARCHAR(100),
    team_name VARCHAR(100),
    team_members TEXT,
    enrolled_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_user_event (user_id, event_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);

CREATE TABLE fixtures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    round_name VARCHAR(100) NOT NULL,
    team_one VARCHAR(100) NOT NULL,
    team_two VARCHAR(100) NOT NULL,
    match_date DATE NOT NULL,
    match_time TIME NOT NULL,
    status ENUM('upcoming','active','completed') NOT NULL DEFAULT 'upcoming',
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);

CREATE TABLE committee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    section ENUM('executive','secretariat','coordinators','additional') NOT NULL DEFAULT 'additional',
    department VARCHAR(100) NOT NULL,
    favorite_game VARCHAR(100) NOT NULL,
    image VARCHAR(255) NOT NULL DEFAULT 'logo.png'
);

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (id, full_name, student_id, department, email, phone, password, favorite_game, role, created_at) VALUES
(1, 'System Admin', 'ADMIN-001', 'Administration', 'admin@cyborgclub.com', '01700000000', '$2y$10$QZV5UMPMTvmt4FL4NIW1H.9p7.oWDJL3tQOPC1RtkI8nrWLfK8PU.', 'Valorant', 'admin', NOW()),
(2, 'Sajid Hasan', '2026-1-60-001', 'CSE', 'sajid@student.edu', '01712345678', '$2y$10$OSkfEZlHP6PonGaQfDvpsuexC3sTdQDAsfy2VgnNkhXLocY5HhWFS', 'Valorant', 'user', NOW()),
(3, 'Riad Ahmed', '2026-1-60-002', 'EEE', 'riad@student.edu', '01812345678', '$2y$10$OSkfEZlHP6PonGaQfDvpsuexC3sTdQDAsfy2VgnNkhXLocY5HhWFS', 'FIFA', 'user', NOW());

INSERT INTO events (id, event_name, game_name, event_date, event_time, venue, description, rules, prize, status, created_at) VALUES
(1, 'Valorant 5v5 Tournament', 'Valorant', '2026-06-15', '15:00:00', 'Central Computer Lab', 'Official campus tactical shooter tournament.', 'Teams must have 5 members. Student ID required.', '$500 Cash', 'open', NOW()),
(2, 'FIFA Knockout Cup', 'FIFA/eFootball', '2026-06-20', '13:00:00', 'Student Lounge', 'One-on-one console knockout competition.', 'Single elimination. Be present 15 minutes early.', '$200 Cash', 'open', NOW()),
(3, 'PUBG Mobile Squad Battle', 'PUBG Mobile', '2026-07-05', '19:00:00', 'Online Discord Server', 'Squad battle royale event.', 'No emulators. Squads of 4 only.', '$300 Cash', 'upcoming', NOW()),
(4, 'Gaming Night', 'Casual Games', '2026-07-12', '18:00:00', 'Seminar Room 102', 'Casual gaming night with party games.', 'Respect all players and equipment.', 'Mock Medals', 'upcoming', NOW()),
(5, 'Freshers Esports Meetup', 'Orientation', '2026-05-25', '14:00:00', 'Student Lounge', 'Meet the committee and play friendly matches.', 'Open to all new students.', 'N/A', 'finished', NOW());

INSERT INTO enrollments (user_id, event_id, game_username, team_name, team_members, enrolled_at) VALUES
(2, 1, 'SajidVLR', 'Team Alpha', 'Sajid, Riad, Tanvir, Mahi, Fahim', NOW()),
(2, 2, 'SajidFIFA', 'Solo', 'Sajid Hasan', NOW()),
(3, 1, 'RiadAim', 'Team Beta', 'Riad, Niloy, Arif, Shuvo, Imran', NOW());

INSERT INTO fixtures (event_id, round_name, team_one, team_two, match_date, match_time, status) VALUES
(1, 'Quarter Finals', 'Team Alpha', 'Team Beta', '2026-06-16', '16:00:00', 'upcoming'),
(1, 'Semi Finals', 'Winner Match 1', 'Team Gamma', '2026-06-17', '17:00:00', 'upcoming'),
(2, 'Round of 16', 'Sajid', 'Riad', '2026-06-20', '13:30:00', 'upcoming'),
(3, 'Group Stage', 'Squad A', 'Squad B', '2026-07-05', '19:30:00', 'upcoming'),
(4, 'Friendly Round', 'Team Neon', 'Team Pixel', '2026-07-12', '19:00:00', 'upcoming');

INSERT INTO committee (name, position, section, department, favorite_game, image) VALUES
('Ayesha Rahman', 'President', 'executive', 'CSE', 'Valorant', 'logo.png'),
('Nafis Chowdhury', 'Vice President', 'executive', 'EEE', 'CS2', 'logo.png'),
('Maliha Karim', 'General Secretary', 'secretariat', 'BBA', 'PUBG Mobile', 'logo.png'),
('Tanvir Islam', 'Treasurer', 'secretariat', 'CSE', 'FIFA', 'logo.png'),
('Sadia Akter', 'Event Coordinator', 'coordinators', 'English', 'Mobile Legends', 'logo.png'),
('Fahim Hossain', 'Media Lead', 'coordinators', 'BBA', 'Valorant', 'logo.png'),
('Arif Mahmud', 'Technical Lead', 'coordinators', 'CSE', 'CS2', 'logo.png');

INSERT INTO contact_messages (name, email, message, created_at) VALUES
('Demo Visitor', 'visitor@example.com', 'I want to know more about upcoming tournaments.', NOW());
