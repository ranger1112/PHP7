CREATE DATABASE IF NOT EXISTS php7cookbook DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE USER 'cook'@'%' IDENTIFIED WITH mysql_native_password;
SET PASSWORD FOR 'cook'@'%' = PASSWORD('book');
GRANT ALL PRIVILEGES ON php7cookbook.* to 'cook'@'%';
GRANT ALL PRIVILEGES ON php7cookbook.* to 'cook'@'localhost';
FLUSH PRIVILEGES;

