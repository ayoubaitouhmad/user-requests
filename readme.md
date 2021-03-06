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
      admin_id = 'admin_'
  ```  
+ open your command prompt inside the project files and run the commands :
+ create pusher account https://pusher.com and copy your api key inside PushNotification class you can found it in app/classes

`npm install`

`copposer  install`

+ open your browser and tap  http://user-requests

## Features

- Light/dark mode toggle




##Screenshots
               
+ index 

![MIT License](./public/img/overview/index.png)
![MIT License](./public/img/overview/index1.png)
+ admin pages
![MIT License](./public/img/overview/admin_signup.png)
![MIT License](./public/img/overview/admin_home.png)
![MIT License](./public/img/overview/users.png)
![MIT License](./public/img/overview/requests.png)
![MIT License](./public/img/overview/settings.png)
![MIT License](./public/img/overview/notifications_admin.png)




## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.


## License
[MIT](https://choosealicense.com/licenses/mit/)
