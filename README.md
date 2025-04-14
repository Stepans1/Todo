## Installation Instructions

Follow these steps to set up and run the project:

1. **Clone the repository**

   ```bash
   git clone [repository-url]
   cd todoTask
   ```

2. **Copy the environment file**

   ```bash
   cp .env.example .env
   ```

3. **Install PHP dependencies**

   ```bash
   composer install
   ```

4. **Generate application key**

   ```bash
   php artisan key:generate
   ```

5. **Configure the database**

   Edit the `.env` file and update the database configuration:

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=todo_app
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

   Make sure to create a database named `todo_app` in MySQL.

6. **Install JavaScript dependencies**

   ```bash
   npm install
   ```

7. **Run database migrations**

   ```bash
   php artisan migrate
   ```

8. **Start FE**

   ```bash
   npm run dev
   ```

9. **Start BE**

   ```bash
   php artisan serve
   ```

   The application will be available at http://127.0.0.1:8000