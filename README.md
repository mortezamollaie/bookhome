# 📚 BookHome - Book Management API

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-12.x-red?style=for-the-badge&logo=laravel" alt="Laravel Version">
    <img src="https://img.shields.io/badge/PHP-8.2+-blue?style=for-the-badge&logo=php" alt="PHP Version">
    <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

## 🎯 About BookHome

BookHome is a modern and robust **Book Management API** built with Laravel. This RESTful API provides comprehensive functionality for managing books, authors, and user authentication with a clean and intuitive interface.

### ✨ Key Features

- 📖 **Book Management**: Create, read, update, and delete books
- 👨‍💼 **Author Management**: Manage author information with first/last name
- 🔐 **Authentication**: Secure user authentication using Laravel Sanctum
- 🔍 **Advanced Search**: Find authors by name with exact or partial matching
- 📄 **Pagination**: Efficient data pagination for large datasets
- 🛡️ **Validation**: Comprehensive request validation and error handling
- 📊 **Resource Transformation**: Clean JSON responses using Laravel Resources
- 🗄️ **SQLite Database**: Lightweight database for development

## 🚀 Quick Start

### Prerequisites

Make sure you have the following installed:
- 🐘 **PHP 8.2+**
- 🎼 **Composer**
- 🗄️ **SQLite** (or your preferred database)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/bookhome.git
   cd bookhome
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate --seed
   ```

5. **Start the development server**
   ```bash
   php artisan serve
   ```

Your API will be available at `http://localhost:8000` 🌐

## 📋 API Documentation

### 🔐 Authentication Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| `POST` | `/api/signup` | Register a new user |
| `POST` | `/api/login` | User login |

### 📚 Book Endpoints

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| `GET` | `/api/books` | Get all books (paginated) | ✅ |
| `POST` | `/api/books` | Create a new book | ✅ |
| `GET` | `/api/books/{id}` | Get specific book | ✅ |
| `PUT` | `/api/books/{id}` | Update a book | ✅ |
| `DELETE` | `/api/books/{id}` | Delete a book | ✅ |

### 👨‍💼 Author Endpoints

| Method | Endpoint | Description | Auth Required |
|--------|----------|-------------|---------------|
| `GET` | `/api/authors` | Get all authors (paginated) | ✅ |
| `POST` | `/api/authors` | Create a new author | ✅ |
| `GET` | `/api/authors/{id}` | Get specific author | ✅ |
| `PUT` | `/api/authors/{id}` | Update an author | ✅ |
| `DELETE` | `/api/authors/{id}` | Delete an author | ✅ |
| `GET` | `/api/authors/find-by-name` | Find author by exact name | ✅ |
| `GET` | `/api/authors/search-by-name` | Search authors by partial name | ✅ |


## 🏗️ Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php      # 🔐 Authentication logic
│   │   ├── BookController.php      # 📚 Book management
│   │   └── AuthorController.php    # 👨‍💼 Author management
│   ├── Requests/                   # ✅ Form validations
│   ├── Resources/                  # 📊 API response formatting
│   └── Responses/                  # 📤 Custom response classes
└── Models/
    ├── User.php                    # 👤 User model
    ├── Book.php                    # 📖 Book model
    └── Author.php                  # ✍️ Author model
```

## 🛠️ Development

### Running Tests

```bash
php artisan test
```

### Code Formatting

```bash
./vendor/bin/pint
```

### Database Operations

```bash
# Fresh migration with seeding
php artisan migrate:fresh --seed

# Create new migration
php artisan make:migration create_table_name

# Create new seeder
php artisan make:seeder TableSeeder
```

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. 🍴 Fork the repository
2. 🌿 Create a feature branch (`git checkout -b feature/amazing-feature`)
3. 💾 Commit your changes (`git commit -m 'Add amazing feature'`)
4. 📤 Push to the branch (`git push origin feature/amazing-feature`)
5. 🔄 Open a Pull Request

## 📝 License

This project is licensed under the [MIT License](LICENSE) - see the LICENSE file for details.

## 🙏 Acknowledgments

- 🔥 **Laravel Framework** - The elegant PHP framework
- 🛡️ **Laravel Sanctum** - API authentication
- 🧪 **Pest PHP** - Testing framework
- 📦 **Composer** - Dependency management

## 📧 Contact

For questions or support, please contact:
- 📧 Email: your-email@example.com
- 🐱 GitHub: [@mortezamollaie](https://github.com/mortezamollaie)

---

<p align="center">
    Made with ❤️ using Laravel
</p>
