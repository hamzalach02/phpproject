# Web Development Setup: Apache, MySQL, PHP, and phpMyAdmin

This guide provides step-by-step instructions for setting up a web development environment on Ubuntu, including Apache, MySQL, PHP, and phpMyAdmin.

## Apache Virtual Host Setup for hamzalachgar.com

### Install Apache

```bash
sudo apt install apache2
Virtual Host Configuration
bash
Copy code
# Create directory for website files
sudo mkdir /var/www/hamzalachgar

# Open Virtual Host configuration file
sudo nano /etc/apache2/sites-available/hamzalachgar.conf
apache
Copy code
<VirtualHost *:80>
    ServerAdmin webmaster@hamzalachgar
    DocumentRoot /var/www/hamzalachgar
    ServerName hamzalachgar.com

    <Directory /var/www/hamzalachgar>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
bash
Copy code
# Enable the site
sudo a2ensite hamzalachgar.conf

# Restart Apache
sudo service apache2 restart
MySQL Database Setup for myapp
Install MySQL Server
bash
Copy code
sudo apt update
sudo apt install mysql-server
Secure MySQL Installation
bash
Copy code
sudo mysql_secure_installation
# Follow the prompts to secure your MySQL installation
Create Database and User
bash
Copy code
# Access MySQL
sudo mysql

# Change root user password
> ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'hamza';
> EXIT;

# Access MySQL again with the new password
mysql -u root -p

# Create a new database
> CREATE DATABASE myapp;

# Show the list of databases
> SHOW DATABASES;

# Create a new user
> CREATE USER 'hamzalachgar'@'localhost' IDENTIFIED WITH mysql_native_password BY 'hamza';

# Use the MySQL system database
> USE mysql;

# Show existing users
> SELECT user FROM user;

# Grant privileges to the new user for the 'myapp' database
> GRANT ALL ON myapp.* TO 'hamzalachgar'@'localhost';

# Exit MySQL
> EXIT;

# Import SQL tables using an SQL file
mysql -u root -p myapp < /var/www/hamzalachgar/create.sql
PHP and phpMyAdmin Installation
Install PHP
bash
Copy code
sudo apt install php
Install phpMyAdmin
bash
Copy code
sudo apt install phpmyadmin
