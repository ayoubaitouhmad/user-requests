# User Requests



## About

A PHP project based on project structure MVC to handle both user and admin requests

## Installation

+ Install XAMPP or WAMPP.

+ Open XAMPP Control panal and start [apache] and [mysql] .

+ Download or clone project from github(https://github.com/ayoubaitouhmad/user-requests).
+ make shure that the files extracted into in C:\xampp\htdocs.
+ open link localhost/phpmyadmin
+ import database to your mysql you can find it in app/data/shema.sql
+ open hosts file C:\Windows\System32\drivers\etc
+ add the line
    ```
      127.0.0.1       user-requests       
  ```       
+ open vhosts file in C:\xampp\apache\conf\extra
+ add the line
  ```shell
    <VirtualHost *:80>
     ServerName user-requests
     DocumentRoot "C:\xampp\htdocs\urmvc\public"
    </VirtualHost>    
  ```                      
+ we recomended that creating admin account from mysql and set admin id to
   ```shell
      admin_id = 'admin_id'
  ```  
+ open your command prompt inside the project files and run the commands :

`npm install`

`copposer  install`

+ open your browser and tap  http://user-requests

## Features

- Light/dark mode toggle

  

[![MIT License](https://img.shields.io/apm/l/atomic-design-ui.svg?)](https://github.com/tterb/atomic-design-ui/blob/master/LICENSEs)