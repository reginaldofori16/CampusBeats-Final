-- Schools table
CREATE TABLE schools (
    school_id INT PRIMARY KEY AUTO_INCREMENT,
    school_name VARCHAR(255) NOT NULL,
    logo_url VARCHAR(255),
    location VARCHAR(255)
);

-- Users table (base table for all user types)
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20),
    user_type ENUM('superadmin', 'artist', 'listener', 'recordlabel') NOT NULL,
    profile_picture VARCHAR(255),
    school_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP,
    FOREIGN KEY (school_id) REFERENCES schools(school_id)
);

-- Artists table
CREATE TABLE artists (
    artist_id INT PRIMARY KEY,
    stage_name VARCHAR(255),
    bio TEXT,
    school_id INT,
    FOREIGN KEY (artist_id) REFERENCES users(user_id),
    FOREIGN KEY (school_id) REFERENCES schools(school_id)
);

-- Record Labels table
CREATE TABLE record_labels (
    label_id INT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    description TEXT,
    website VARCHAR(255),
    address TEXT,
    FOREIGN KEY (label_id) REFERENCES users(user_id)
);

-- Listeners table
CREATE TABLE listeners (
    listener_id INT PRIMARY KEY,
    school_id INT,
    bio TEXT,
    FOREIGN KEY (listener_id) REFERENCES users(user_id),
    FOREIGN KEY (school_id) REFERENCES schools(school_id)
);

-- First create the genres table
CREATE TABLE genres (
    genre_id INT PRIMARY KEY AUTO_INCREMENT,
    genre_name VARCHAR(100) UNIQUE NOT NULL
);

-- Then create the tracks table (moved up, before its ALTER statement)
CREATE TABLE tracks (
    track_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    artist_id INT,
    label_id INT,
    file_url VARCHAR(255) NOT NULL,
    cover_art_url VARCHAR(255),
    release_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    duration INT,
    plays INT DEFAULT 0,
    genre_id INT,
    FOREIGN KEY (artist_id) REFERENCES artists(artist_id),
    FOREIGN KEY (label_id) REFERENCES record_labels(label_id),
    FOREIGN KEY (genre_id) REFERENCES genres(genre_id)
);

-- Playlists table
CREATE TABLE playlists (
    playlist_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_public BOOLEAN DEFAULT true,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- Playlist_Tracks table
CREATE TABLE playlist_tracks (
    playlist_id INT,
    track_id INT,
    position INT,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (playlist_id, track_id),
    FOREIGN KEY (playlist_id) REFERENCES playlists(playlist_id),
    FOREIGN KEY (track_id) REFERENCES tracks(track_id)
);

-- Artist_Genres table
CREATE TABLE artist_genres (
    artist_id INT,
    genre_id INT,
    PRIMARY KEY (artist_id, genre_id),
    FOREIGN KEY (artist_id) REFERENCES artists(artist_id),
    FOREIGN KEY (genre_id) REFERENCES genres(genre_id)
);

-- Messages table
CREATE TABLE messages (
    message_id INT PRIMARY KEY AUTO_INCREMENT,
    sender_id INT,
    receiver_id INT,
    message_text TEXT,
    sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    read_at TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(user_id),
    FOREIGN KEY (receiver_id) REFERENCES users(user_id)
);

-- Favorites table
CREATE TABLE favorites (
    user_id INT,
    track_id INT,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, track_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (track_id) REFERENCES tracks(track_id)
);

-- Create a separate table for relationship statuses
CREATE TABLE relationship_statuses (
    status_id INT PRIMARY KEY AUTO_INCREMENT,
    status_name VARCHAR(50) UNIQUE NOT NULL
);

-- Artist_Label_Relationships table
CREATE TABLE artist_label_relationships (
    artist_id INT,
    label_id INT,
    status_id INT,
    start_date TIMESTAMP,
    end_date TIMESTAMP,
    PRIMARY KEY (artist_id, label_id),
    FOREIGN KEY (artist_id) REFERENCES artists(artist_id),
    FOREIGN KEY (label_id) REFERENCES record_labels(label_id),
    FOREIGN KEY (status_id) REFERENCES relationship_statuses(status_id)
);
