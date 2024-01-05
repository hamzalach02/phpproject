# Project Setup Guide

This guide will walk you through the process of setting up Apache, MySQL, and PhpMyAdmin on your system.

## Apache Installation

1. Install Apache:
   ```bash
   sudo apt update
   sudo apt install apache2
   ```
2. Virtual Host Configuration
```bash
#this directory is for our web application
sudo mkdir /var/www/user
sudo nano /etc/apache2/sites-available/user.conf
```
```bash
<VirtualHost *:80>
    ServerAdmin webmaster@user
    DocumentRoot /var/www/user
    ServerName user.com
</VirtualHost>

```
```bash
sudo a2ensite user.conf
sudo service apache2 restart

```
3.setup mysql-server
installation
```bash
sudo apt install mysql-server
sudo apt-get install php-mysql

```
manipulate sql
```bash
sudo mysql
```

#add password for the root 
```bash
>alter user 'root'@'localhost' identified with mysql_native_password by 'yourpassword';
>exit
```
mysql secure installation for securityand to disable Remote Root Login 
```bash
mysql_secure_installation
```
try now to log : 
```bash
sudo mysql
```
you'll see that the access is  denied so now if you want to login you have to type this command
```bash
mysql -u root -p
```
you'll see password field type the password of the root to connect

creation of a new db 
after login let's create a new db for our project 
```bash
>create database myapp;
```
let's show the list of all the databases that we have
```bash
>show schemas;
```
we will create new user bc using root is not the best practice 
```bash
>create user 'user'@'localhost' identified with mysql_native_password by 'userpassword';
```
let's see the lists of the users that we have : 
```bash
>use mysql;
>select user from user;

```
now let's add privilleges on the new user for our database
```bash
>grant all on myapp.* to 'user'@'localhost';
>exit
```
create the sql tables using an sql file : 
you can create it using root or the user created : 
```bash
mysql -u root -p myapp < var/www/user/create.sql
```
4.move on phpmyadmin installation :
```bash
sudo apt install php
sudo apt install phpmyadmin

```
5.now you add the ip adresse of the server machine to go just by the domaine name :
go to this file and modify it as admin
```bash
C:\Windows\System32\drivers\etc\hosts
```
and add this to it 
```bash
ubuntu_server_ip user.com

```
