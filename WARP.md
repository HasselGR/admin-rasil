# WARP.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Project Overview

Admin-Rasil is a comprehensive hotel management system for Hotel Rasil (Puerto La Cruz) built with Laravel. The application centralizes and automates administrative processes including payroll, accounting, restaurant inventory, local rentals, and accounts receivable, replacing scattered spreadsheet management with a unified platform that operates on bi-weekly (quincenas) periods.

## Core Architecture

### Domain Structure
The application is organized around 5 main business domains:

1. **Nómina (Payroll)**: Employee management, salary calculations, assignments and deductions per bi-weekly period
2. **Contabilidad (Accounting)**: Purchase and sales books with period-based reporting
3. **Comedor (Restaurant)**: Ingredient inventory, recipe management, orders with automatic inventory deduction
4. **Renta de Locales (Local Rentals)**: Property management, client assignments, monthly payment tracking
5. **Cuentas por Cobrar (Accounts Receivable)**: Client management, invoice tracking, payment reconciliation

### Key Architectural Patterns

#### Quincena-Centric Design
The `Quincena` (bi-weekly period) model is central to most business operations. Many entities are tied to specific quincenas for:
- Payroll calculations and payments
- Accounting book entries and reports
- Historical data tracking and auditing

#### Multi-Entity Relationships
Complex many-to-many relationships exist between:
- `Plato` (dishes) ↔ `Ingrediente` (ingredients) via `MedidasPlato` (portions)
- `Orden` (orders) ↔ `Plato` via `OrdenDetalle` with automatic inventory management
- `Cargamento` (shipments) ↔ `Ingrediente` via `IngredienteCargamento` for inventory restocking

## Essential Development Commands

### Setup and Installation
```bash
# Initial setup
composer install
cp .env.example .env
# Edit .env: DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD, APP_URL
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan storage:link
```

### Development Server
```bash
# Start development server
php artisan serve --host=0.0.0.0 --port=8000

# Watch frontend assets (separate terminal)
npm run dev
```

### Database Operations
```bash
# Run migrations
php artisan migrate

# Run specific migration
php artisan migrate --path=database/migrations/2024_06_05_203326_create_quincenas_table.php

# Rollback migrations
php artisan migrate:rollback

# Seed database
php artisan db:seed

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

### Testing
```bash
# Run all tests
php artisan test
# Or using PHPUnit directly
./vendor/bin/phpunit

# Run specific test file
php artisan test tests/Feature/ExampleTest.php

# Run with coverage (if configured)
php artisan test --coverage
```

### Code Quality
```bash
# Laravel Pint (code formatting)
./vendor/bin/pint

# Fix specific file
./vendor/bin/pint app/Models/NominaEmpleado.php

# Check without fixing
./vendor/bin/pint --test
```

### Artisan Utilities
```bash
# Generate model with migration, factory, controller
php artisan make:model ModelName -mfc

# Generate controller
php artisan make:controller ControllerName --resource

# Generate migration
php artisan make:migration create_table_name

# Clear application caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Critical Business Logic

### Quincena Management
Quincenas are the fundamental time unit. When working with payroll, accounting books, or generating reports, always ensure proper quincena context. The system expects:
- `fecha_inicio` and `fecha_final` for period boundaries
- Most financial calculations are tied to specific quincenas
- Reports are typically generated per quincena

### Inventory System
The restaurant inventory uses a complex relationship system:
- Ingredients have units of measure (`UnidadMedida`)
- Dishes (`Plato`) contain multiple ingredients with specific quantities (`MedidasPlato`)
- Orders automatically deduct ingredients from inventory
- Shipments (`Cargamento`) replenish inventory through `IngredienteCargamento`

### PDF Generation
Uses `barryvdh/laravel-dompdf` for report generation. PDF routes typically follow pattern:
- `/ventas/{idQuincena}/resumen-pdf` for sales reports
- `/compras/{idQuincena}/resumen-pdf` for purchase reports
- `/cuentas_por_cobrar/imprimir/{id}` for account statements

## Important Dependencies

- **AdminLTE**: UI framework (`jeroennoten/laravel-adminlte`)
- **DataTables**: Table management (`yajra/laravel-datatables-oracle`)
- **DomPDF**: PDF generation (`barryvdh/laravel-dompdf`)
- **Vite**: Asset bundling
- **PostgreSQL**: Primary database (configurable)

## Development Considerations

### Database Relationships
When creating new features, be mindful of:
- Foreign key relationships often use non-standard primary keys (e.g., `id_empleado`, `id_quincena`)
- Many models use custom table names and primary key definitions
- Cascade delete behavior may affect related records across multiple domains

### Route Organization
Routes are organized by business domain in `routes/web.php`:
- Resource routes for CRUD operations
- Custom routes for specialized actions (PDF generation, data endpoints)
- DataTables AJAX endpoints typically end with `/data`

### Frontend Architecture
- Uses Blade templating with AdminLTE theme
- JavaScript assets bundled through Vite
- DataTables for dynamic table rendering
- Bootstrap for responsive layout

### Testing Approach
Based on the README, the system includes documented unit and integration tests covering:
- Payroll calculations
- Accounting book operations  
- Rental management
- Accounts receivable workflows

When adding new features, follow the established testing patterns for business logic validation.