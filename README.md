<p align="center">
<img align="center" src="https://miro.medium.com/v2/resize:fit:700/0*myazq11Ldd1mPuJM.png" alt="TUBE" width="300" height="300">
</p>

<div align="center">
    <h1 align="center">
       Custom Role Permissions 
    </h1>
</div>

### REQUIREMENTS : 

* PHP >= 8.0
* LARAVEL FRAMEWORK : 8.75

***

### LICENSE :

* All Rights Reserved to the authors and contributors
* Released under the MIT License

***

# Custom Role Permissions

A simple, lightweight role-based permissions system built without using any external packages. This system allows you to easily define and manage user roles and permissions, ensuring that users can only access or perform actions that are authorized based on their role.

## Features

- **No external dependencies**: Built from scratch, no need for third-party packages.
- **Role management**: Create custom roles and assign them to users.
- **Permissions system**: Enforce permissions based on roles (e.g., read, write, delete).
- **Flexible and Extendable**: Easily adaptable to meet the needs of any application.

***
### INSALLATION :

After cloning the application repository
```
composer install
```
Paste .env file
```
cp .env.example .env
```
Migrations & Seeds
```
php artisan migrate:fresh --seed
```
Final
```
php artisan serve
```
***
