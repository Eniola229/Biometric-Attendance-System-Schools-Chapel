# Biometric Attendance System for Schools & Chapels

A comprehensive biometric attendance management system built with Laravel for tracking student and member attendance in educational institutions and religious organizations using fingerprint authentication.

## Features

- **Biometric Authentication**: Fingerprint-based attendance marking
- **Multi-User Roles**: Support for administrators, teachers, and students
- **Real-time Attendance Tracking**: Instant attendance recording and monitoring
- **Report Generation**: Comprehensive attendance reports and analytics
- **Dashboard**: Intuitive admin and user dashboards
- **Responsive Design**: Mobile-friendly interface using Tailwind CSS
- **Student/Member Management**: Complete profile and record management
- **Class/Group Management**: Organize students into classes or groups

## Technology Stack

- **Backend**: Laravel 10.x (PHP 8.1+)
- **Frontend**: Blade Templates, Tailwind CSS, JavaScript
- **Database**: MySQL
- **Hardware Integration**: Python scripts for fingerprint scanner communication
- **CSS Framework**: Tailwind CSS, SCSS
- **Build Tool**: Vite

## Prerequisites

Before setting up the project, ensure you have the following installed:

- **PHP** >= 8.1
- **Composer** (latest version)
- **Node.js** >= 16.x and npm
- **MySQL** >= 5.7 or **MariaDB** >= 10.3
- **Python** >= 3.7 (for fingerprint scanner integration)
- **Git**
- **Fingerprint Scanner** (compatible with the system)

## Local Setup Instructions

### Step 1: Clone the Repository

```bash
git clone https://github.com/Eniola229/Biometric-Attendance-System-Schools-Chapel.git
cd Biometric-Attendance-System-Schools-Chapel
```

### Step 2: Install PHP Dependencies

```bash
composer install
```

### Step 3: Install Node.js Dependencies

```bash
npm install
```

### Step 4: Environment Configuration

1. Copy the example environment file:
```bash
cp .env.example .env
```

2. Generate application key:
```bash
php artisan key:generate
```

3. Configure your database in the `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biometric_attendance
DB_USERNAME=root
DB_PASSWORD=your_password
```

4. Configure other necessary settings in `.env`:
```env
APP_NAME="Biometric Attendance System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
```

### Step 5: Create Database

Create a new MySQL database:

```sql
CREATE DATABASE biometric_attendance CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 6: Run Database Migrations

```bash
php artisan migrate
```

If you want to seed the database with sample data:
```bash
php artisan db:seed
```

### Step 7: Create Storage Link

```bash
php artisan storage:link
```

### Step 8: Set Permissions

Set proper permissions for storage and cache directories:

**On Linux/Mac:**
```bash
chmod -R 775 storage bootstrap/cache
chown -R $USER:www-data storage bootstrap/cache
```

**On Windows (Run as Administrator):**
```bash
icacls storage /grant Users:F /T
icacls bootstrap/cache /grant Users:F /T
```

### Step 9: Build Frontend Assets

Development mode:
```bash
npm run dev
```

Production build:
```bash
npm run build
```

### Step 10: Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

### Step 11: Set Up Fingerprint Scanner (Optional)

1. Navigate to the fingerprint directory:
```bash
cd fingerprint
```

2. Install Python dependencies:
```bash
pip install -r requirements.txt
```

3. Configure your fingerprint scanner settings in the Python scripts

4. Run the fingerprint service:
```bash
python fingerprint_service.py
```

## Default Login Credentials

After running the seeders, you can use these default credentials:

- **Admin**:
  - Email: admin@example.com
  - Password: password

- **Teacher**:
  - Email: teacher@example.com
  - Password: password

- **Student**:
  - Email: student@example.com
  - Password: password

**Important**: Change these credentials immediately in production!

## Project Structure

```
.
├── app/                    # Application core files
│   ├── Http/              # Controllers, Middleware, Requests
│   ├── Models/            # Eloquent models
│   └── Services/          # Business logic services
├── bootstrap/             # Framework bootstrap files
├── config/                # Configuration files
├── database/              # Migrations, seeders, factories
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders
├── fingerprint/           # Python scripts for fingerprint integration
├── public/                # Public assets (CSS, JS, images)
├── resources/             # Views, raw assets
│   ├── css/              # SCSS files
│   ├── js/               # JavaScript files
│   └── views/            # Blade templates
├── routes/                # Route definitions
│   ├── web.php           # Web routes
│   └── api.php           # API routes
├── storage/               # Logs, uploads, cache
└── tests/                 # Unit and feature tests
```

## Common Issues and Solutions

### Issue 1: `composer install` fails
**Solution**: Ensure you have PHP 8.1 or higher installed:
```bash
php -v
```

### Issue 2: Database connection error
**Solution**: 
- Verify MySQL is running
- Check database credentials in `.env`
- Ensure the database exists

### Issue 3: Permission denied errors
**Solution**: Set proper permissions (see Step 8)

### Issue 4: `npm install` fails
**Solution**: Update Node.js to version 16 or higher

### Issue 5: Assets not loading
**Solution**: 
```bash
npm run build
php artisan config:clear
php artisan cache:clear
```

### Issue 6: Fingerprint scanner not detected
**Solution**:
- Check USB connection
- Install proper drivers for your scanner
- Verify scanner compatibility
- Check Python dependencies

## Running Tests

Run the test suite:
```bash
php artisan test
```

Or using PHPUnit directly:
```bash
vendor/bin/phpunit
```

## Development Workflow

1. **For backend changes**:
   - Modify PHP files in `app/` directory
   - Clear cache: `php artisan cache:clear`

2. **For frontend changes**:
   - Edit Blade files in `resources/views/`
   - Modify CSS in `resources/css/`
   - Modify JS in `resources/js/`
   - Run: `npm run dev` for hot-reload

3. **For database changes**:
   - Create migration: `php artisan make:migration migration_name`
   - Run migration: `php artisan migrate`

## Deployment

For production deployment:

1. Set environment to production in `.env`:
```env
APP_ENV=production
APP_DEBUG=false
```

2. Build assets:
```bash
npm run build
```

3. Optimize Laravel:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

4. Set proper file permissions

5. Configure web server (Apache/Nginx) to point to `public/` directory

## Security Considerations

- Change all default passwords
- Keep `.env` file secure and never commit it
- Use HTTPS in production
- Regularly update dependencies
- Enable CSRF protection (enabled by default)
- Implement rate limiting for API endpoints
- Sanitize all user inputs

## Hardware Requirements

### Recommended Fingerprint Scanners:
- DigitalPersona U.are.U 4500
- ZKTeco fingerprint scanners
- Any UART-compatible fingerprint sensor module (R305, R307, etc.)

### System Requirements:
- **Minimum**: 2GB RAM, dual-core processor
- **Recommended**: 4GB RAM, quad-core processor, SSD

## Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature-name`
3. Commit changes: `git commit -am 'Add new feature'`
4. Push to branch: `git push origin feature-name`
5. Submit a pull request

## Support

For issues and questions:
- Create an issue on GitHub
- Contact the development team

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgments

- Laravel Framework
- Tailwind CSS
- Python fingerprint libraries
- All contributors to this project

## Changelog

### Version 1.0.0
- Initial release
- Basic attendance tracking
- User management
- Fingerprint integration
- Report generation

---

**Note**: Make sure to configure your fingerprint scanner properly and test the connection before deploying to production. Refer to your scanner's documentation for specific setup instructions.
