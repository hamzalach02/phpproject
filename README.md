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
#this directory is for our web application
sudo mkdir /var/www/user
sudo nano /etc/apache2/sites-available/user.conf
````
````
<VirtualHost *:80>
    ServerAdmin webmaster@user
    DocumentRoot /var/www/user
    ServerName user.com

    <Directory /var/www/user>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    
</VirtualHost>

````
````
sudo a2ensite user.conf
sudo service apache2 restart
````
3.setup mysql-server
installation
````
sudo apt install mysql-server
````
manipulate sql
````
sudo mysql
````

#add password for the root 
````
>alter user 'root'@'localhost' identified with mysql_native_password by 'yourpassword';
>exit
````
mysql secure installation for securityand to disable Remote Root Login 
````
mysql_secure_installation
````
try now to log : 
````
sudo mysql
````
you'll see that the access is  denied so now if you want to login you have to type this command
````
mysql -u root -p
````
you'll see password field type the password of the root to connect

creation of a new db 
after login let's create a new db for our project 
````
>create database myapp;
````
let's show the list of all the databases that we have
````
>show schemas;
````
we will create new user bc using root is not the best practice 
````
>create user 'user'@'localhost' identified with mysql_native_password by 'userpassword';
````
let's see the lists of the users that we have : 
````
>use mysql;
>select user from user;

````
now let's add privilleges on the new user for our database
````
>grant all on myapp.* to 'user'@'localhost';
>exit
````
create the sql tables using an sql file : 
you can create it using root or the user created : 
````
mysql -u root -p myapp < var/www/user/create.sql
````
move on phpmyadmin installation :
````
sudo apt install php
sudo apt install phpmyadmin
````
