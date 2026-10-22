<p align="center"><a href="./Z.svg" target="_blank"><img src="./Z.svg" width="100" alt="Monthly Calculator Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Monthly Calculator

`monthly-calculator` is a simple Laravel web application for tracking monthly spending by category. Authenticated users can create categories, log purchases, and review expense totals by month and year.

### How it works

- Users register or sign in to access their personal monthly budget dashboard.
- Categories are defined once and used to group purchases.
- Purchases capture amount, date, category, and optional description.
- The app summarizes spending by month and provides a category breakdown for each reporting period.
- Data is persisted in a MySQL database via Laravel migrations and Eloquent models.

### Requirements

- PHP 8.3 or newer, with Laravel's required extensions and PDO MySQL.
- Composer 2.
- Node.js 22.12+ (22.x) or 24+, and npm.
- MySQL 8+ for application data; automated tests use an isolated SQLite database.
- A modern browser supported by Tailwind 4 (Safari 16.4+, Chrome 111+, Firefox 128+).

### Local setup

```bash
cp .env.example .env
composer install
php artisan key:generate
npm ci
npm run build
```

Set the database connection and mail settings in `.env`, then run:

```bash
php artisan migrate
php artisan serve
```

Open http://127.0.0.1:8000. For frontend development, run `npm run dev` in a separate terminal.

### Verification and maintenance

```bash
composer validate --strict
composer audit
npm audit
npm run build
php artisan test
```

Tests force an in-memory SQLite connection and do not use your application database.
GitHub Actions runs these checks on PHP 8.3, 8.4, and 8.5. Dependabot checks Composer,
npm, and GitHub Actions dependencies weekly. Laravel is on version 13; Tailwind is
on version 4. Composer resolves dependencies for PHP 8.3 to retain compatibility
with the minimum supported version.

### Deployment

GitHub stores the source and runs CI. A running Laravel application requires a PHP
hosting service and a database; GitHub Pages cannot execute Laravel.

On the application server, use PHP 8.3+ and set the web root to `public/`. Keep
`.env` out of Git, set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL` to the
HTTPS URL, and configure the database and mail service. Preserve the existing
`APP_KEY` when updating an existing installation. Back up the database before
running migrations.

Build assets using `npm ci && npm run build` and deploy `public/build/` with the
application. Install PHP dependencies using
`composer install --no-dev --optimize-autoloader`, then run
`php artisan migrate --force` and `php artisan optimize`. Make `storage/` and
`bootstrap/cache/` writable by the web server. Restart queue workers if used.

### Usage

- Register a new account or login with an existing user.
- Create categories such as `Rent`, `Groceries`, or `Utilities`.
- Add purchases with an amount, date, and selected category.
- Review monthly totals and category summaries from the dashboard.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
