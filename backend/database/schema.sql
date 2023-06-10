DROP TABLE IF EXISTS dbo.users;
DROP TABLE IF EXISTS dbo.links;

CREATE TABLE IF NOT EXISTS users(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_avatar VARCHAR(255) NOT NULL,
    user_name VARCHAR(255) NOT NULL,
    user_login VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    user_pass VARCHAR(255) NOT NULL,
    user_confirm_pass VARCHAR(255) NOT NULL,
    user_registerd datetime NOT NULL DEFAULT CURRENT_TIMESTAMP()
);

CREATE TABLE IF NOT EXISTS links(
    link_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    link_title VARCHAR(255) NOT NULL,
    link_content VARCHAR(255) NOT NULL,
    link_post_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS user_roles(
    role_id int PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    user_role VARCHAR(25) DEFAULT 'user',
    FOREIGN KEY (role_id) REFERENCES users(role_id)
);

