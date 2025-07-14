# Task Management System

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

A full-featured task management application built with Laravel that allows users to create, assign, and track tasks with email notifications.

## Features

- ✅ User authentication (Admin/Regular users)
- 📝 Create and assign tasks with deadlines
- 📊 Track task status (Pending/In Progress/Completed)
- 🔔 Email notifications for assigned tasks
- 🎨 Responsive UI with Tailwind CSS
- 📱 Mobile-friendly interface
- 📅 Deadline reminders

## Prerequisites

- PHP 8.1+
- Composer 2.0+
- Node.js 16+
- SQLite (or MySQL/PostgreSQL)
- SMTP credentials (Mailtrap/Gmail)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/task-management-system.git
   cd task-management-system
Install dependencies:

bash
composer install
npm install
Configure environment:

bash
cp .env.example .env
php artisan key:generate
Set up database:

bash
touch database/database.sqlite
php artisan migrate --seed
Configure email (in .env):

env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io  # or smtp.gmail.com
MAIL_PORT=2525              # or 587 for Gmail
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
Build assets:

bash
npm run build
Start development server:

bash
php artisan serve
Usage
Admin Account
Email: admin@example.com

Password: password

Regular User
Email: user@example.com

Password: password

Screenshots
https://screenshots/dashboard.png
https://screenshots/tasks.png
https://screenshots/create-task.png

Email Setup
For Gmail SMTP:

Enable 2-Step Verification in your Google Account

Generate an App Password (select "Mail" + "Other")

Use the 16-digit password in .env

Deployment
For production deployment:

bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
Contributing
Pull requests are welcome. For major changes, please open an issue first.

License
MIT

text

### Key Sections Included:
1. **Badges** - Shows tech stack at a glance
2. **Features** - Highlights core functionality
3. **Installation** - Step-by-step setup guide
4. **Default Credentials** - For quick testing
5. **Email Configuration** - Special instructions for Gmail
6. **Deployment Notes** - Production optimization

### Recommended Additions:
- Add actual screenshots in a `/screenshots` folder
- Include environment-specific notes if needed
- Add API documentation if your system has endpoints
