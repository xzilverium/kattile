# Kattile

A Laravel-based application framework powered by the Kvendor engine.

Current Version: 26.6.1 (Development Preview)
Target First Stable Release: 26.6.2

---

## Overview

Kattile is an application framework built on top of Laravel.

It provides:

* Structured project architecture
* Kvendor engine
* Air command-line tools
* Project branding system
* Template management
* Silver Ambient 1010 styling system
* Laravel ecosystem compatibility

Kattile extends Laravel while remaining familiar to Laravel developers.

---

## Components

### Kattile

The application framework.

### Kvendor

The internal engine powering Kattile.

Kvendor contains:

* Air commands
* Templates
* Framework manifests
* Internal utilities
* Future framework services

### Air

The Kattile command-line interface.

Examples:

```bash
php air --version
php air pull
php air pull config/brand.php
php air pull public/css
php air rebrand
```

---

## Requirements

### Required

* PHP 8.3 or later
* Composer

### Database

Any Laravel-supported database:

* SQLite
* MySQL
* MariaDB
* PostgreSQL

### Browser Support

Modern web browser with support for:

* HTML5
* CSS3
* JavaScript (ES6+)

Examples:

* Chrome
* Edge
* Firefox
* Safari

### Optional Tools

* Node.js
* npm
* Git

Node.js and npm are only required when compiling frontend assets or using frontend build workflows.

---

## Installation

### Recommended

Create a new Kattile project using Composer:

```bash
composer create-project xzilverium/kattile myapp
```

Enter the project:

```bash
cd myapp
```

Generate the application key:

```bash
php artisan key:generate
```

Run database migrations:

```bash
php artisan migrate
```

Start the development server:

```bash
php artisan serve
```

---

## Development Server

Kattile includes Laravel's built-in development server.

```bash
php artisan serve
```

No external web server is required for local development.

---

## Air Commands

### Show Framework Information

```bash
php air --version
```

### List Available Templates

```bash
php air pull
```

### Pull Template File

```bash
php air pull config/brand.php
```

### Pull Template Folder

```bash
php air pull public/css
```

### Rebrand Project

```bash
php air rebrand
```

---

## Template System

Templates are stored within:

```text
kvendor/templates/
```

Example:

```text
kvendor/templates/config/brand.php
kvendor/templates/public/css/
```

Templates may contain metadata:

```php
/**
 * @target config/brand.php
 */
```

or

```text
@target-root public/css
```

which allows Air to determine installation locations automatically.

---

## Backup System

When Air overwrites files, backups are created automatically.

Single-file example:

```text
backups/config-brand.php.10-45-30.09-06-26.backup
```

Folder example:

```text
backups/public-css.10-45-30.09-06-26/
```

---

## Branding

Project branding is configured in:

```text
config/brand.php
```

Example:

```php
return [
    'name' => env('BRAND_NAME', 'Kattile'),
    'version' => env('BRAND_VERSION', '26.6.1'),
    'description' => env('BRAND_DESCRIPTION', 'The skeleton for Kattile Apps.'),
    'manufacturer' => env('BRAND_MANUFACTURER', 'Xzilverium Realms'),

    'icon' => env('BRAND_ICON', 'icon.svg'),
];
```

---

## Versioning

Kattile uses a calendar-inspired versioning format.

Example:

```text
26.6.1
```

General guideline:

* Patch releases fix bugs
* Minor releases introduce features
* Major releases may contain architectural changes

---

## License

Kattile source code is licensed under the MIT License.

See:

```text
LICENSE
```

---

## Trademarks and Branding

Project branding and identity are governed by the Xzilverium Trademark License (XZTML).

See:

```text
TRADEMARKS.md
```

The source code remains fully open source under the MIT License.

---

## Contributing

Contributions, bug reports, documentation improvements, and feature suggestions are welcome.

Please use the project's GitHub repository for issues and pull requests.

---

## Credits

Created and maintained by Xzilverium Realms.

Built upon Laravel and the PHP open-source ecosystem.
