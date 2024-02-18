> [!CAUTION]
>
> this project is still under development



## Features

This is a simple chat application created with laraevl 10, beyond websockets and pusher. In this app users can:

- send chat request to another user



## How to install

Clone or download the zip of this repository. Now open the terminal in this folder and run the following commands

```
composer install
```

```
cp .env-example .env
```

Now in your .env file search for **PUSHER_APP_ID** **PUSHER_APP_KEY** & **PUSHER_APP_SECRET** and put there any random number or character as value and replace **BROADCAST_DRIVER = log**  with **BROADCAST_DRIVER = pusher**

Now again run the following commands

```
php artisan key:generate
```

```
composer require beyondcode/laravel-websockets
```

```
npm install
```

```
php artisan migrate
```



Now open the browser hit http://localhost:8000 navigate to registration page then register a new user and start chatting. 
