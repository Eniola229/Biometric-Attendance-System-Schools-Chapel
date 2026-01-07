# Biometric Attendance System for Schools & Chapels

A comprehensive biometric attendance management system built with Laravel for tracking student and member attendance in educational institutions and religious organizations using fingerprint authentication.

## Features

- **Biometric Authentication**: Fingerprint-based attendance marking
- **Admin Dashboard**: Comprehensive administrative control panel
- **Real-time Attendance Tracking**: Instant attendance recording and monitoring
- **Report Generation**: Comprehensive attendance reports and analytics
- **Responsive Design**: Mobile-friendly interface using Tailwind CSS
- **Student/Member Management**: Complete profile and record management
- **Class/Group Management**: Organize students into classes or groups
- **Fingerprint Scanner Integration**: C-based fingerprint scanner API

## Technology Stack

- **Backend**: Laravel 10.x (PHP 8.1+)
- **Frontend**: Blade Templates, Tailwind CSS, JavaScript
- **Database**: MySQL
- **Hardware Integration**: C/C++ based fingerprint scanner API
- **CSS Framework**: Tailwind CSS, SCSS
- **Build Tool**: Vite
- **Runtime**: .NET Framework (for fingerprint scanner)

## Prerequisites

Before setting up the project, ensure you have the following installed:

- **PHP** >= 8.1
- **Composer** (latest version)
- **Node.js** >= 16.x and npm
- **MySQL** >= 5.7 or **MariaDB** >= 10.3
- **.NET Framework** (for fingerprint scanner - see installation below)
- **Git**
- **Fingerprint Scanner** (compatible with the system)
- **C/C++ Compiler** (if you need to recompile the scanner code)

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

### Step 11: Install .NET Framework (Required for Fingerprint Scanner)

The fingerprint scanner uses a C-based API that requires .NET Framework to run.

**On Windows:**

1. Download and install .NET Framework (if not already installed):
   - Visit: https://dotnet.microsoft.com/download/dotnet-framework
   - Download .NET Framework 4.7.2 or higher
   - Run the installer and follow the prompts

2. Verify installation:
```cmd
dotnet --version
```

**Note**: Most modern Windows systems (Windows 10/11) already have .NET Framework installed.

### Step 12: Set Up and Run Fingerprint Scanner

The fingerprint scanner uses a C program that communicates with the hardware.

1. Navigate to the fingerprint directory:
```bash
cd fingerprint
```

2. Locate the executable file `ftrScanApiEx.exe`

3. **IMPORTANT**: You need to run the fingerprint scanner service in a **separate terminal window** while the Laravel application is running.

**To start the fingerprint scanner service:**

Open a new terminal/command prompt window and run:

```bash
cd fingerprint
ftrScanApiEx.exe
```

Or simply double-click `ftrScanApiEx.exe` from File Explorer.

**The scanner service must remain running** for fingerprint enrollment and attendance marking to work.

4. Ensure your fingerprint scanner is connected via USB before starting the service.

5. The scanner service will start listening for fingerprint scans and communicate with the Laravel application.

### Step 13: Verify Everything is Running

You should now have **TWO separate terminal windows** running:

**Terminal 1** - Laravel Development Server:
```bash
php artisan serve
```
Should show: `Server running on [http://localhost:8000]`

**Terminal 2** - Fingerprint Scanner Service:
```bash
cd fingerprint
ftrScanApiEx.exe
```
Should show scanner initialization messages and be waiting for fingerprint input.

Now open your browser and navigate to `http://localhost:8000`

## Default Login Credentials

After running the seeders, you can use these default credentials:

- **Admin**:
  - Email: admin@example.com
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
├── fingerprint/           # C/C++ code for fingerprint scanner integration
│   ├── ftrScanApiEx.exe  # Fingerprint scanner service (must be running)
│   ├── *.c               # C source files
│   ├── *.h               # Header files
│   └── *.dll             # Required DLL libraries
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
- Ensure .NET Framework is installed
- Check that `ftrScanApiEx.exe` is running in a separate terminal
- Verify USB connection of fingerprint scanner
- Install proper drivers for your scanner
- Check if scanner is recognized in Device Manager (Windows)
- Try running `ftrScanApiEx.exe` as Administrator
- Ensure no other application is using the scanner

### Issue 7: `ftrScanApiEx.exe` won't start
**Solution**:
- Install/Reinstall .NET Framework
- Check for missing DLL files in the fingerprint folder
- Run as Administrator
- Check Windows Event Viewer for error details
- Verify fingerprint scanner is properly connected

### Issue 8: Laravel can't communicate with fingerprint service
**Solution**:
- Ensure both Laravel server and `ftrScanApiEx.exe` are running
- Check firewall settings
- Verify port configurations in both applications
- Check Laravel logs: `storage/logs/laravel.log`

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

1. **Starting the development environment**:
   
   **Terminal 1** - Start Laravel:
   ```bash
   php artisan serve
   ```
   
   **Terminal 2** - Start Fingerprint Service:
   ```bash
   cd fingerprint
   ftrScanApiEx.exe
   ```
   
   **Terminal 3** (Optional)** - Frontend hot-reload:
   ```bash
   npm run dev
   ```

2. **For backend changes**:
   - Modify PHP files in `app/` directory
   - Clear cache: `php artisan cache:clear`

3. **For frontend changes**:
   - Edit Blade files in `resources/views/`
   - Modify CSS in `resources/css/`
   - Modify JS in `resources/js/`
   - Run: `npm run dev` for hot-reload

4. **For database changes**:
   - Create migration: `php artisan make:migration migration_name`
   - Run migration: `php artisan migrate`

5. **For fingerprint scanner changes**:
   - Modify C source files in `fingerprint/` directory
   - Recompile if necessary (requires C compiler)
   - Restart `ftrScanApiEx.exe` to apply changes

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

5. **Set up fingerprint scanner service**:
   - Ensure .NET Framework is installed on production server
   - Copy `fingerprint/` folder to production server
   - Set up `ftrScanApiEx.exe` to run as a Windows Service for continuous operation
   - Configure Windows Task Scheduler to start the service on boot

6. Configure web server (Apache/Nginx) to point to `public/` directory

## Running Fingerprint Service as Windows Service (Production)

For production, you should run `ftrScanApiEx.exe` as a Windows Service so it starts automatically:

1. **Using NSSM (Non-Sucking Service Manager)**:
   
   Download NSSM from: https://nssm.cc/download
   
   ```cmd
   nssm install FingerprintScannerService "C:\path\to\your\project\fingerprint\ftrScanApiEx.exe"
   nssm start FingerprintScannerService
   ```

2. **Or use Windows Task Scheduler**:
   - Open Task Scheduler
   - Create a new task
   - Set trigger to "At startup"
   - Set action to run `ftrScanApiEx.exe`
   - Configure to run whether user is logged on or not

## Security Considerations

- Change all default passwords
- Keep `.env` file secure and never commit it
- Use HTTPS in production
- Regularly update dependencies
- Enable CSRF protection (enabled by default)
- Implement rate limiting for API endpoints
- Sanitize all user inputs

## Hardware Requirements

### Fingerprint Scanner Compatibility:
- The system uses a C-based API (`ftrScanApiEx.exe`)
- Compatible with most USB fingerprint scanners that support Windows drivers
- Common compatible models:
  - DigitalPersona U.are.U series
  - ZKTeco fingerprint scanners
  - Futronic fingerprint scanners
  - SecuGen fingerprint scanners

### System Requirements:
- **Operating System**: Windows 7/8/10/11 (required for .NET Framework and fingerprint service)
- **Minimum**: 2GB RAM, dual-core processor
- **Recommended**: 4GB RAM, quad-core processor, SSD
- **.NET Framework**: 4.7.2 or higher
- **USB Port**: For fingerprint scanner connection

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
