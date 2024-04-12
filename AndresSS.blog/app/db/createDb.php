<?php
//Db connection
require 'connDb.php';

//Create users table 

$pdo -> exec("CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username VARCHAR(255) NOT NULL,
    password CHAR (255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    ft_image VARCHAR(255) NOT NULL,
    content text NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    role ENUM('Auteur','Admin','Suscriber') NULL DEFAULT 'Suscriber',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

echo 'users,';

//Create posts table 

$pdo -> exec("CREATE TABLE posts(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_id INT DEFAULT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    ft_image VARCHAR(255) NOT NULL,
    content text NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    published TINYINT NOT NULL,
    foreign key (user_id) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

echo 'posts,';

//Create comments table 

$pdo -> exec("CREATE TABLE comments(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    pseudo VARCHAR (255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    content text NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    published TINYINT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

echo 'comments, ';

//Create categories table 

$pdo -> exec("CREATE TABLE categories(
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    ft_image VARCHAR(255) NOT NULL,
    content text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

echo 'categories, ';


// Create post_comments tables

$pdo -> exec("CREATE TABLE posts_comments(
    post_id INT UNSIGNED NOT NULL,
    comment_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(post_id,comment_id),
    CONSTRAINT fk_post 
            FOREIGN KEY (post_id) REFERENCES posts(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_comment       
            FOREIGN KEY (comment_id) REFERENCES comments(id) ON UPDATE CASCADE ON DELETE RESTRICT

    )DEFAULT CHARSET=utf8mb4");

    echo 'POSTS_COMMENTS,';

    // Create users_posts tables
$pdo->exec("CREATE TABLE  users_posts(
    user_id INT UNSIGNED NOT NULL,
    post_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(user_id,post_id),
    CONSTRAINT fk_user 
            FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_post        
            FOREIGN KEY (post_id) REFERENCES posts(id) ON UPDATE CASCADE ON DELETE RESTRICT

    ) DEFAULT CHARSET=utf8mb4");

    echo 'USERS_POSTS,';

      // Create posts_CATEGORIES tables
$pdo->exec("CREATE TABLE  posts_categories(
    category_id INT UNSIGNED NOT NULL,
    post_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(category_id,post_id),
    CONSTRAINT fk_category 
            FOREIGN KEY (category_id) REFERENCES categories(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_post        
            FOREIGN KEY (post_id) REFERENCES posts(id) ON UPDATE CASCADE ON DELETE RESTRICT

    ) DEFAULT CHARSET=utf8mb4");

    echo 'posts_categories were created successfully!,';
?>