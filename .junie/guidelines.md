# Project Development Guidelines

This document provides specific information for developers working on this Laravel project. It covers build/configuration instructions, testing information, and additional development details.

## Build/Configuration Instructions

### PHP Dependencies
- PHP 8.1+ is required
- Composer is used for PHP dependency management
- Install dependencies with: `composer install`
- Update dependencies with: `composer update`

### JavaScript/Frontend Dependencies
- Node.js is required for frontend asset building
- Install dependencies with: `npm install`
- Development build: `npm run dev`
- Production build: `npm run build`

### Environment Setup
- Copy `.env.example` to `.env`: `cp .env.example .env`
- Generate application key: `php artisan key:generate`
- Configure your database in the `.env` file
- Run migrations: `php artisan migrate`
- Seed the database (if needed): `php artisan db:seed`

### Development Server
- Start Laravel's development server: `php artisan serve`
- Access the application at: `http://localhost:8000`

## Testing Information

### Test Configuration
- Tests are configured in `phpunit.xml`
- Two test suites are defined:
  - Unit tests in `tests/Unit`
  - Feature tests in `tests/Feature`
- The testing environment uses:
  - Array drivers for cache, mail, and session
  - Sync driver for queue
  - SQLite in-memory database (commented out by default)

### Running Tests
- Run all tests: `./vendor/bin/phpunit`
- Run a specific test suite: `./vendor/bin/phpunit --testsuite Unit`
- Run a specific test file: `./vendor/bin/phpunit tests/Unit/StringHelperTest.php`
- Run a specific test method: `./vendor/bin/phpunit --filter test_string_can_be_reversed`

### Creating Tests
- Unit tests:
  - Extend `PHPUnit\Framework\TestCase`
  - Focus on testing isolated components without Laravel dependencies
  - Example:
    ```php
    <?php
    
    namespace Tests\Unit;
    
    use PHPUnit\Framework\TestCase;
    
    class StringHelperTest extends TestCase
    {
        public function test_string_can_be_reversed(): void
        {
            $original = 'Hello World';
            $reversed = strrev($original);
            
            $this->assertEquals('dlroW olleH', $reversed);
        }
    }
    ```

- Feature tests:
  - Extend `Tests\TestCase`
  - Use Laravel testing helpers like `actingAs()`, `get()`, `post()`, etc.
  - Can use traits like `RefreshDatabase` to reset the database between tests
  - Example:
    ```php
    <?php
    
    namespace Tests\Feature;
    
    use App\Models\User;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;
    
    class ExampleFeatureTest extends TestCase
    {
        use RefreshDatabase;
        
        public function test_homepage_can_be_rendered(): void
        {
            $response = $this->get('/');
            
            $response->assertStatus(200);
        }
    }
    ```

### Testing Best Practices
- Use factories to create test data
- Use `RefreshDatabase` trait for tests that modify the database
- Use `Event::fake()` to test event dispatching
- Use `Mail::fake()` to test mail sending
- Use `Storage::fake()` to test file uploads

## Additional Development Information

### Code Style
- The project follows PSR-12 coding standards
- Indentation: 4 spaces for PHP, 2 spaces for YAML (except docker-compose.yml)
- Line endings: LF
- Encoding: UTF-8
- Laravel Pint is available for code style checking and fixing:
  - Check code style: `./vendor/bin/pint --test`
  - Fix code style: `./vendor/bin/pint`

### Frontend
- Vue.js 3 with Inertia.js for frontend
- Tailwind CSS for styling
- Vite for asset building

### Authentication
- Laravel Breeze is used for authentication scaffolding
- Includes email verification functionality

### API Authentication
- Laravel Sanctum is used for API authentication

### Browser Testing
- Symfony Panther is available for browser testing
- Browser Driver Installer (BDI) is included for setting up browser drivers

### Useful Artisan Commands
- List all routes: `php artisan route:list`
- Clear cache: `php artisan cache:clear`
- Clear config cache: `php artisan config:clear`
- Clear view cache: `php artisan view:clear`
- Create a new controller: `php artisan make:controller ControllerName`
- Create a new model with migration: `php artisan make:model ModelName -m`
- Create a new test: `php artisan make:test TestName`
