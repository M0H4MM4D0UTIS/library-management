# Library Management In Persian
 A Library Management System with PHP/Laravel 
 
 سیستم مدیریت کتابخانه فیزیکی توسط زبان برنامه نویسی php و فریم ورک لاراول به زبان فارسی


# How To Install
https://devmarketer.io/learn/setup-laravel-project-cloned-github-com/

OR Run Command:

    composer install
    npm install
    cp .env.example .env 
    php artisan key:generate
    php artisan migrate  
    php artisan db:seed // if you have seed  
    php artisan passport:install // if you have passport  


# Insert First User:
run this sql query:

    INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `status`, `last_login_at`, `last_login_ip`) VALUES (1, 'example', 'info@example.com', NULL, '$2y$10$IrGmnFyptoY1s6UuNNy/s.j0x5qQX2ZU/SSor35KtzeOKafwqc7TW', NULL, '2021-11-24 11:25:29', '2021-11-24 11:25:29', 1, NULL, NULL);

# Default Admin Email/Password
Email: info@example.com

Password: example

