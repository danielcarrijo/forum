This is a simple forum created using Laravel and JQUERY AJAX. Click here if you want to see a [demo](http://serene-scrubland-60573.herokuapp.com/) (If css is not working, try to refresh the page. Database is also on web, so maybe it might be kinf of slow). But if you prefer to run it local, follow the steps presented at <a href="#getting-started">Getting Started </a>

## Features available so far
<ul>
    <li>Create a thread</li>
    <li>Create a user</li>
    <li>Comment threads</li>
    <li>Like both threads and comments</li>
    <li>Check profile page (Page done, but not all the functions yet)</li>
</ul>

## Getting Started
Clone the project repository by running the command below if you use SSH

```bash
git clone git@github.com:danielcarrijo/forum.git
```

If you use https, use this instead

```bash
git clone https://github.com/danielcarrijo/forum.git
```

After cloning, run:

```bash
composer install
```

Duplicate `.env.example` and rename it `.env`

Generate a new application jey

```bash
php artisan key:generate
```

=
### Prerequisites

Be sure to fill in your database details in your `.env` file before running the migrations:

```bash
php artisan migrate
```

And finally, start the application:

```bash
php artisan serve
```

and visit [http://localhost:8000](http://localhost:8000) to see the application in action.

## Built With

* [Laravel](https://laravel.com) - The PHP Framework For Web Artisans
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
