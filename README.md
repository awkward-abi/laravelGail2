# Laravel and Vue.js Installation Guide
This guide will help you set up a Laravel project with Vue.js for frontend development.

## Prerequisites
Before you begin, ensure you have the following installed on your machine:

- PHP (recommended version 7.3+)
- Composer
- Node.js (recommended LTS version)
- npm (Node Package Manager)
- Laravel CLI (optional but recommended)

## Installation Steps
Follow these steps to set up your Laravel project with Vue.js:

- Step 1: Clone the Repository

`git clone <repository-url>
cd <project-directory>`

- Step 2: Install Composer Dependencies
`composer install`

- Step 3: Install npm Dependencies
`npm install`

- Step 4: Configure Environment
Rename the .env.example file to .env and configure your environment variables such as database connection details.
`cp .env.example .env `

- Step 5: Generate Application Key
Generate an application key which is used for encryption and other security aspects of your application.
`php artisan key:generate`

- Step 6: Run Migrations (Optional)
If your application requires a database, run migrations to set up the database schema.
`php artisan migrate`

- Step 7: Compile Assets
Compile your assets using npm. This will compile Vue components, JavaScript, and Sass files.
`npm run dev`
If you're working in development mode and want to watch for changes, you can use:
`npm run watch`

- Step 8: Serve the Application
Start the Laravel development server to preview your application:
`php artisan serve`
Your application should now be running locally. Open your web browser and navigate to `http://localhost:8000` to view it.
