# TaskList App

A simple and intuitive TaskList application built with PHP and Laravel framework. Manage your daily tasks efficiently with CRUD operations, user authentication, and a clean responsive interface.

## Features

- User registration and login
- Create, read, update, and delete tasks
- Mark tasks as completed or pending
- Responsive and user-friendly UI
- Built with Laravel MVC architecture

## Requirements

- PHP >= 7.4
- Composer
- MySQL or any supported database
- Laravel 8 or higher
- Node.js and npm (for frontend assets)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/tasklist-app.git
   cd tasklist-app
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Copy `.env.example` to `.env` and configure your database settings:
   ```bash
   cp .env.example .env
   # update .env with your database credentials
   ```

4. Generate application key:
   ```bash
   php artisan key:generate
   ```

5. Run database migrations:
   ```bash
   php artisan migrate
   ```

6. Install frontend dependencies and compile assets (optional):
   ```bash
   npm install
   npm run dev
   ```

7. Serve the application:
   ```bash
   php artisan serve
   ```

Open your browser and go to `http://localhost:8000` to access the app.

## Usage

- Register a new account or login if you already have one.
- Add new tasks by entering the task description.
- Edit or delete existing tasks by clicking the action buttons.
- Mark tasks as complete by toggling the status checkbox.

## Contributing

Contributions are welcome! Feel free to fork the repository and submit pull requests.

## License

This project is open source and available under the [MIT License](LICENSE).

```
