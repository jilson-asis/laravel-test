<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



## Laravel Test

A web application that allows the admin to manage users and create products that the users can buy.

### Stripe Integration

- Integrated stripe using default Laravel Cashier. 
- Followed Laravel Cashier documentation in step by step but added other features that are in the requirements of the test.
- Reason: I used Laravel Cashier because I expect it to be more readable by other developers. The documentation is readily available and there are a lot of resources to work on. Basically, I choose this kind of integration mostly because of collaboration.

### User Roles and Access

- Used the recommended package Laravel Permissions by Spatie
- The package is easy to use and very straightforward.
- The middlewares that are readily available are very helpful in creating Users with differen roles and access.

### Installation

- Use PHP >8.1
- Run `composer install`
- Run `php artisan migrate`
- Run `php artisan db:seed`
- Run `npm install`
- Run `npm run build`
- Run `php artisan serve`

