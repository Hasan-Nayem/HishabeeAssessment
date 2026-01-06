# Laravel Inactive User Reminder System

This Laravel application automatically detects inactive users and sends them reminder emails using a queued job and scheduled command.

---

## Task Overview

- Users who have not logged in for a configurable number of days are considered **inactive**
- A **scheduled command** runs daily
- It finds inactive users
- Dispatches a **queued job** for each user
- The job **sends a reminder email**
- A user is **not processed more than once per day**

---

## Tech Stack

- Laravel
- PostgreSQL
- Laravel Queue (Database Driver)
- Laravel Scheduler (Cron)
- Mailtrap (for email testing)

---

## 📂 Project Setup

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/your-username/inactive-user-reminder.git
cd inactive-user-reminder
```
### 2️⃣ Install Dependencies
```bash
composer install
```
### 3️⃣ Environment Configuration
```bash
cp .env.example .env
Generate application key:
php artisan key:generate
```
### 4️⃣ Database Configuration
```bash
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
Run migration
```bash
php artisan migrate
```

▶️ Running the Scheduler

To simulate the Laravel scheduler locally:

```bash
php artisan schedule:work
```
### In production, this would be handled by a cron job running every minute.

### Running the Queue Worker
This application uses database queue driver.
Create queue tables:
```bash
php artisan queue:table
php artisan migrate
```
Run the queue worker:
```bash
php artisan queue:work
```

### 🧪 Testing the Feature

- Create a test user
- Set last_login_at to a date older than the inactivity period
- Run:
```bash
php artisan schedule:work
php artisan queue:work
```
- Check Mailtrap inbox for reminder email

⚙️ How the System Works
```bash
Scheduler (Daily)
   ↓
Console Command
   ↓
Find Inactive Users
   ↓
Dispatch Queue Job
   ↓
Send Reminder Email
```

### 👤 Author
### MD. Mehedi Hasan Nayem
Laravel / PHP Backend Developer
GitHub: https://github.com/Hasan-Nayem
