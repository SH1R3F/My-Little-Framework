# My Little Framework
In this project I tried my best to recreate a framework very similar to laravel to understand its internals and getting more deep in php.

---

# # Installation
Download the repository or clone it by using this command:
` git clone https://github.com/SniffAByte/My-Little-Framework.git`

##### # Install dependencies
Install the project dependencies via composer:
` composer install`

##### # Modify your environment variables:
Rename `.env.example` file to `.env` and update it with your data.


##### # Running it on local server
`cd` into the project directory and run this command:
`php -S localhost:8080 -t public/ public/index.php`

----

# # Usage
#### # Routing basics
[`thephpleague/route/`](https://github.com/thephpleague/route/) is the responsible for routing system. You can check their documentation through [this page](https://route.thephpleague.com/3.x/).
##### # Redirecting
`redirect($path)` is a helper function receives a path or a url to redirect the user to.

#### # Middlewares
Already registered middlewares are `Authenticated`, `Guest`, and other middlewares you can find or create your own middlewares inside `App/middleware` folder and register them by adding to `config/app.php` middlewares array.

#### # Models
Eloquent is used for Database connection so that any information you need will be found in [Eloquent documentation](https://github.com/illuminate/database).
You can switch to Doctrine or whatever you want for ORM by modifying the Database Service Provider `App\Providers\DatabaseServiceProvider` and updating depenting functions inside Auth (`App\Auth\Auth`) class with the syntax of the new package

#### # Views
Twig template engine is used in this project. You can add your views files inside `views` directory and all twig syntax will be find through [twig documentation](https://twig.symfony.com/).

#### # Validation
[`vlucas/valitron`](https://github.com/vlucas/valitron) package is used for validation and the validate functionality is written inside the Abstract Controllers inside `App/Controllers` directory. You can check rules through (their docs)[https://github.com/vlucas/valitron]. And you can create your own rules and register them inside `App\Providers\ValidationRuleServiceProvider`.

