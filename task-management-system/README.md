# Task Management System

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

A complete task management solution with user roles, email notifications, queue processing, and a beautiful Tailwind UI.

## ✨ Features

- 👤 Admin and User roles  
- ✅ Task assignment with email notifications  
- 🗓️ Deadline tracking  
- 📊 Status updates (Pending / In Progress / Completed)  
- 📧 Email via Mailtrap or Gmail SMTP  
- 🚀 Queue worker integration  
- 🎨 Responsive Tailwind CSS interface  

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Cramelsim/task-management-system.git
   cd task-management-system
   ```

2. **Install backend & frontend dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Set up your environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure the database**
   ```bash
   touch database/database.sqlite
   php artisan migrate --seed
   ```

5. **Configure email settings** in `.env`:
   ```env
   MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=simwa.melody@student.moringaschool.com
MAIL_PASSWORD=vxionnyzwqftivqr
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=simwa.melody@student.moringaschool.com

   ```

6. **Build frontend assets**
   ```bash
   npm run build
   ```

## ▶️ Running the Application

Start the development server:
```bash
php artisan serve
```

Start the queue worker in a new terminal:
```bash
php artisan queue:work
```

## 👤 Default Credentials

### Admin:
- Email: `admin@example.com`  
- Password: `password`

### Regular User:
- Email: `simwamelody@gmail.com`  
- Password: `simwamelody`

## 📧 Gmail Email Setup

To use Gmail SMTP:
1. Enable 2-Step Verification in your Google Account.
2. Generate an [App Password](https://myaccount.google.com/apppasswords).
3. Use the 16-digit app password in your `.env`.

## 🚀 Deployment Tips

For production:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Set up **Supervisor** for queue workers:
```ini
[program:laravel-worker]
command=php /path/to/your/project/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=melody
numprocs=1
redirect_stderr=true
stdout_logfile=/path/to/your/project/storage/logs/worker.log
```

## 🛠️ Troubleshooting

**Emails not arriving?**
- Make sure `php artisan queue:work` is running.
- Check logs:
  ```bash
  tail -f storage/logs/laravel.log
  ```

**Database issues?**
```bash
php artisan migrate:fresh --seed
```

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).
