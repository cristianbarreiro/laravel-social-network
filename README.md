# Laravel Social Network

A social network application built with Laravel and Blade, featuring a modular and scalable folder structure for views.

## Features

- **User Authentication**: Register, login, and logout functionality.
- **Posts**: Create, view, edit, and delete posts with optional image uploads.
- **Comments**: Add and delete comments on posts.
- **User Profiles**: View and edit user profiles, including bio and profile photo.
- **Feed**: A feed of user posts with pagination.
- **Responsive Design**: Built with Tailwind CSS for a modern and responsive UI.

## Setup

1. **Clone the repository**:
   ```bash
   git clone <repository-url>
   cd laravel-social-network
   ```

2. **Install dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Set up environment variables**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure your database** in the `.env` file.

5. **Run migrations**:
   ```bash
   php artisan migrate
   ```

6. **Start the development server**:
   ```bash
   php artisan serve
   ```

7. **Build assets**:
   ```bash
   npm run dev
   ```

## Usage

- **Register** a new account or **login** with existing credentials.
- **Create posts** with text and optional images.
- **Comment** on posts and **interact** with other users.
- **Edit your profile** and **view other user profiles**.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
