-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Nov 30, 2021 at 02:48 PM
-- Server version: 10.6.4-MariaDB-1:10.6.4+maria~focal
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for all tables
--

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_id INT DEFAULT 1,
    joined_at DATETIME NOT NULL DEFAULT CURRENT_DATE,
    FOREIGN KEY (role_id) REFERENCES user_roles(role_id)
);

CREATE TABLE boards (
    board_id INT AUTO_INCREMENT PRIMARY KEY,
    board_name VARCHAR(255) NOT NULL,
    total_messages INT DEFAULT 0
);
CREATE TABLE threads (
    thread_id INT AUTO_INCREMENT PRIMARY KEY,
    board_id INT,
    title VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_DATE,
    FOREIGN KEY (board_id) REFERENCES boards(board_id)
);

CREATE TABLE posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    thread_id INT,
    user_id INT,
    message TEXT,
    posted_at DATETIME NOT NULL DEFAULT CURRENT_DATE,
    FOREIGN KEY (thread_id) REFERENCES threads(thread_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) 
);

CREATE TABLE tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    tag_name VARCHAR(50) NOT NULL
);

CREATE TABLE thread_tags (
    thread_id INT,
    tag_id INT,
    FOREIGN KEY (thread_id) REFERENCES threads(thread_id),
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id),
    PRIMARY KEY (thread_id, tag_id)
);
CREATE TABLE user_roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL
);

INSERT INTO user_roles (role_name) VALUES ('Member');
INSERT INTO user_roles (role_name) VALUES ('Moderator');
INSERT INTO user_roles (role_name) VALUES ('Administrator');

ALTER TABLE users
ADD COLUMN role_id INT DEFAULT 1,
ADD FOREIGN KEY (role_id) REFERENCES user_roles(role_id);


--
-- Dumping data for table tags
--

INSERT INTO tags (`title`, `content`, `author`, `posted_at`) VALUES
(1, 'test title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris porta mauris nisl, vel iaculis quam venenatis quis. Quisque id efficitur dui, eget tempor erat. Fusce hendrerit, sem non porttitor semper, nunc metus pharetra sem, a ultrices lorem leo nec arcu. Vestibulum at interdum velit. Suspendisse vulputate rutrum libero, id placerat ipsum lacinia eu. Fusce vel orci eget augue maximus rhoncus eu non nisl. Cras id sodales risus. Mauris sed ullamcorper lacus, a tempus orci. Donec dignissim ipsum at varius commodo. Nulla a sapien aliquam, maximus neque non, vehicula libero. Nulla a varius purus, at tincidunt diam. Morbi sed urna a diam pretium tincidunt nec at neque. Aliquam consectetur at turpis at consequat. Sed dapibus, quam vel faucibus malesuada, dui lectus lacinia felis, porta posuere dui odio id enim. Vivamus molestie pharetra leo, vitae mattis sapien congue non. Etiam dapibus, diam at interdum tempus, ligula augue commodo nulla, vel fermentum elit est vel justo.', 'test author', '2021-11-30 13:09:55');

INSERT INTO `article` (`id`, `title`, `content`, `author`, `posted_at`) VALUES
(2, 'test title', 'Donec fermentum porttitor metus, quis pulvinar elit ornare congue. Donec dapibus est ut metus fermentum ultricies. Ut eu turpis facilisis, dignissim sem porttitor, congue libero. Fusce volutpat facilisis interdum. Mauris vulputate ultricies mauris a facilisis. Maecenas tincidunt efficitur tincidunt. Etiam tempor maximus tincidunt.', 'test author', '2021-11-30 13:09:55');

INSERT INTO `article` (`id`, `title`, `content`, `author`, `posted_at`) VALUES
(3, 'test title', 'Mauris id feugiat lectus, ut efficitur tellus. Phasellus a arcu vel urna venenatis laoreet. Nullam congue sem ac erat aliquet, ac pulvinar felis fermentum. Sed rutrum nulla sit amet porta suscipit. Etiam consectetur mauris ac arcu scelerisque, ut blandit lectus porta. Pellentesque at ligula a lacus mattis laoreet. Nulla finibus volutpat velit a finibus. In nec condimentum erat. Aliquam erat volutpat. Vestibulum molestie finibus lorem quis egestas. Fusce id mi ac nisl vehicula laoreet. Cras molestie dolor eget nunc laoreet, et sodales velit mollis. Aliquam dignissim leo quis dolor varius, at molestie est hendrerit. Sed lorem tellus, rhoncus at dignissim ac, euismod id sem. Quisque facilisis felis eget ex mattis, sed pretium magna pulvinar. Etiam tincidunt sodales ultrices.', 'test author', '2021-11-30 13:09:55');

INSERT INTO `article` (`id`, `title`, `content`, `author`, `posted_at`) VALUES
(4, 'test title', 'Curabitur ultricies est malesuada ante laoreet condimentum. Nam ullamcorper, mi at dignissim dignissim, turpis tortor tristique ligula, sed rhoncus ipsum sapien sit amet lacus. Curabitur ligula risus, vulputate vel urna ac, gravida maximus erat. Nunc odio urna, sagittis non mi eu, semper tristique magna. Cras vitae mi nec ex sollicitudin hendrerit et vitae urna. Praesent posuere sem in lectus dignissim viverra. Vivamus neque metus, rhoncus ac arcu vel, eleifend molestie neque. Fusce eget varius massa. Praesent eleifend nunc leo, et pretium sapien volutpat a. Nulla consectetur facilisis sapien, at rhoncus nibh cursus maximus. Donec at eleifend lacus, quis mollis eros. Fusce dui augue, rutrum sit amet ipsum porttitor, convallis congue sapien.', 'test author', '2021-11-30 13:09:55');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
