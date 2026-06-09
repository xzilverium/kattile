# Kattile Development Guide

Kattile is a Laravel-based application starter/framework by **Xzilverium**.

It is built on top of Laravel, but adds Xzilverium structure, Silver Ambient styling, branding support, Air CLI commands, and ready-made templates.

---

## 1. Official Learning Resources

### Laravel

* Laravel Official Website: https://laravel.com
* Laravel Documentation: https://laravel.com/docs
* Laravel Installation Guide: https://laravel.com/docs/installation
* Laravel Configuration: https://laravel.com/docs/configuration
* Laravel Routing: https://laravel.com/docs/routing
* Laravel Controllers: https://laravel.com/docs/controllers
* Laravel Blade Templates: https://laravel.com/docs/blade
* Laravel Migrations: https://laravel.com/docs/migrations
* Laravel Eloquent ORM: https://laravel.com/docs/eloquent
* Laravel Artisan Console: https://laravel.com/docs/artisan
* Laravel Packages: https://laravel.com/docs/packages

### Laravel Video Learning

* Laracasts: https://laracasts.com
* Laravel Bootcamp: https://bootcamp.laravel.com

### Composer and Packagist

* Composer: https://getcomposer.org
* Packagist: https://packagist.org

### GitHub

* GitHub Docs: https://docs.github.com

---

## 2. Local Development Setup

Clone the repository:

```bash
git clone https://github.com/xzilverium/kattile.git
cd kattile
```

Install PHP dependencies:

```bash
composer install
```

Create environment file:

```bash
copy .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Run migrations:

```bash
php artisan migrate
```

Install frontend dependencies:

```bash
npm install
```

Run frontend development server:

```bash
npm run dev
```

Run Laravel development server:

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

---

## 3. Testing Fresh Installation

Use this to test whether Kattile installs correctly like a real public package.

```bash
cd C:\
composer create-project xzilverium/kattile testingworld
cd testingworld
php artisan key:generate
php artisan migrate
php artisan serve
```

If this works, the Composer package is healthy.

---

## 4. Development Workflow

Normal development flow:

1. Edit files locally.
2. Test using `php artisan serve`.
3. Run migrations if database changes are added.
4. Update README.md if the change affects users.
5. Update DEV.md if the change affects developers.
6. Commit changes.
7. Push to GitHub.
8. Create version tag when stable.
9. Test fresh installation again.

---

## 5. Git Commands

Check current changes:

```bash
git status
```

Add files:

```bash
git add .
```

Commit changes:

```bash
git commit -m "Describe the change"
```

Push to GitHub:

```bash
git push origin main
```

---

## 6. Version Tagging

Kattile uses version tags for stable Composer installation.

Example:

```bash
git tag v26.6.2
git push origin v26.6.2
```

After pushing the tag, update Packagist if automatic sync is delayed.

Package name:

```text
xzilverium/kattile
```

---

## 7. Kattile Core Areas

### Branding System

Branding is configured in:

```text
config/brand.php
```

Use branding values like this:

```php
config('brand.name')
config('brand.version')
config('brand.logo')
config('brand.company')
```

Avoid hard-coding project names in Blade files.

Good:

```php
{{ config('brand.name') }}
```

Avoid:

```php
Kattile
```

---

### Silver Ambient 1010

Silver Ambient 1010 is the official Kattile styling system.

Suggested structure:

```text
resources/css/silver-ambient/
├── tokens.css
├── base.css
├── layout.css
├── sidebar.css
├── buttons.css
├── cards.css
├── forms.css
├── tables.css
├── utilities.css
```

Main entry file:

```text
resources/css/app.css
```

The `app.css` file should import Silver Ambient files cleanly.

Avoid messy inline CSS inside Blade files.

---

### Air CLI

Air is the planned Kattile command system.

Planned commands:

```bash
php air info
php air setup
php air version
php air template:list
php air template:install
php air backup
php air restore
```

Air should help developers quickly manage Kattile projects.

---

### Template System

Templates should be stored in:

```text
templates/
```

Possible templates:

```text
blank
crm
school
clinic
inventory
billing
admin-panel
```

Example future command:

```bash
php air template:install crm
```

Templates should be reusable, clean, and easy to copy into a new Kattile project.

---

## 8. Recommended Project Structure

Important Kattile areas:

```text
app/
bootstrap/
config/
database/
public/
resources/
routes/
templates/
tests/
```

Kattile-specific areas:

```text
config/brand.php
resources/css/silver-ambient/
templates/
air
DEV.md
README.md
TRADEMARKS.md
```

---

## 9. Coding Standards

Follow these rules while developing Kattile:

* Stay close to Laravel standards.
* Keep the framework clean and understandable.
* Do not hard-code branding text.
* Use `config('brand...')` for brand values.
* Keep reusable UI inside Blade components or partials.
* Keep Silver Ambient CSS modular.
* Avoid unnecessary inline CSS.
* Use migrations for database structure changes.
* Use seeders for sample/default data.
* Use clear controller names.
* Use meaningful route names.
* Keep README.md user-focused.
* Keep DEV.md developer-focused.
* Keep comments useful, not noisy.

---

## 10. Blade Guidelines

Use layouts:

```text
resources/views/layouts/
```

Use partials:

```text
resources/views/partials/
```

Use components where useful:

```text
resources/views/components/
```

Recommended layout files:

```text
layouts/app.blade.php
partials/sidebar.blade.php
partials/header.blade.php
partials/footer.blade.php
```

Blade files should be clean and readable.

---

## 11. Database Guidelines

Use migrations for all database changes.

Create migration:

```bash
php artisan make:migration create_example_table
```

Run migrations:

```bash
php artisan migrate
```

Fresh migration for testing:

```bash
php artisan migrate:fresh
```

Fresh migration with seeders:

```bash
php artisan migrate:fresh --seed
```

---

## 12. Frontend Build

For development:

```bash
npm run dev
```

For production build:

```bash
npm run build
```

Before release, always run:

```bash
npm run build
```

---

## 13. Release Checklist

Before creating a release tag:

```bash
composer install
npm install
npm run build
php artisan test
php artisan migrate:fresh
```

Then commit:

```bash
git status
git add .
git commit -m "Release Kattile 26.6.x"
git push origin main
```

Create version tag:

```bash
git tag v26.6.x
git push origin v26.6.x
```

Test fresh installation:

```bash
cd C:\
composer create-project xzilverium/kattile test-release
cd test-release
php artisan key:generate
php artisan migrate
php artisan serve
```

---

## 14. README vs DEV.md

### README.md

For users and installers.

It should explain:

* What Kattile is
* How to install it
* Basic usage
* Features
* License
* Package information

### DEV.md

For developers.

It should explain:

* How to develop Kattile
* How to test it
* How to release it
* Coding rules
* Internal structure
* Development workflow

---

## 15. Kattile Development Principle

Kattile should feel familiar to Laravel developers.

But it should also provide:

* Better default structure
* Central branding
* Silver Ambient design system
* Air CLI commands
* Ready-made templates
* Developer-friendly workflow
* Clean starting point for real business applications

Kattile is not meant to fight Laravel.

Kattile is meant to stand on Laravel and make application development faster, cleaner, and more branded.

---

## 16. Current Package

Composer package:

```text
xzilverium/kattile
```

Install command:

```bash
composer create-project xzilverium/kattile project-name
```

Development branch install:

```bash
composer create-project xzilverium/kattile project-name dev-main
```

Stable version install:

```bash
composer create-project xzilverium/kattile project-name
```

---

## 17. Final Note

Every feature added to Kattile should answer one question:

```text
Does this make Laravel development faster, cleaner, or more professional?
```

If yes, it belongs in Kattile.
