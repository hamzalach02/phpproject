# Project Setup Guide

This guide will walk you through the process of setting up Apache, MySQL, and PhpMyAdmin on your system.

## Apache Installation

1. Install Apache:
   ```bash
   sudo apt update
   sudo apt install apache2
   ```
2. Virtual Host Configuration
````
sudo mkdir /var/www/hamzalachgar
sudo nano /etc/apache2/sites-available/hamzalachgar.conf
````
````
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

````
````
sudo a2ensite user1.conf
sudo service apache2 restart
````
