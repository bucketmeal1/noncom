# Laravel with Filament 3 Installation Guide
## 1. Requirements
Live IP
Domain
SSL
Server Specification:
CPU: 4 Cores (e.g., 2.5 GHz+)
RAM: 8 GB (Allows for proper caching, multiple concurrent users, and smoother operations)

Make sure you have these installed:

* **PHP:** 8.3
* **Composer:** Latest stable version
* **Node.js & npm:** Node.js 22.14.0 
* **Database:** MySQL 8.0.41 
* **Git** (Recommended)

## 2. Installation Steps

Follow these steps in your terminal:

### Step 1: Install Dependencies

If you don't have them, install **Composer**, **Node.js/npm**, and **PHP (8.3)**.

* **Composer:** `php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php --install-dir=/usr/local/bin --filename=composer && php -r "unlink('composer-setup.php');"`
* **Node.js/npm:** Download from [nodejs.org](https://nodejs.org/en/download/) or use `nvm`.
* **PHP:** Use your system's package manager (e.g., `brew install php@8.2` on macOS, `sudo apt install php8.2` on Ubuntu).

Step 2: Configure Database
Copy .env.example to .env: cp .env.example .env (or manually copy on Windows)
Edit .env and set your database credentials:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=my_filament_app_db # Create this database
DB_USERNAME=root
DB_PASSWORD=
Step 3: Database Migration
php artisan migrate

NOTE::
APP_URL=http://127.0.0.1:8000 -> URL
FILAMENT_PATH=noncomis/public/client URL path
FILAMENT_VENDOR=noncomis/vendor 




