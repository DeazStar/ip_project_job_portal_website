-- username: admin
-- password: admin

CREATE USER 'admin'@'%' IDENTIFIED WITH mysql_native_password BY '***';GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%' WITH GRANT OPTION;ALTER USER 'admin'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS `admin`;GRANT ALL PRIVILEGES ON `admin`.* TO 'admin'@'%';GRANT ALL PRIVILEGES ON `admin\_%`.* TO 'admin'@'%'; 