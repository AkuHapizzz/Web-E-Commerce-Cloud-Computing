# Agentic Coding Guidelines - ITB Speedshop

This document provides comprehensive information for AI agents working on the ITB Speedshop codebase. It covers architecture, development workflows, coding standards, and specific implementation patterns.

## 🚀 Project Overview

ITB Speedshop is an e-commerce platform for motorcycle parts built with a modern Laravel stack.

- **Backend**: Laravel 12.0 (PHP 8.2+)
- **Frontend**: Blade Templating, Tailwind CSS (Styling), AlpineJS (Interactivity)
- **Asset Management**: Vite
- **Authentication**: Laravel Breeze (using `usertype` for Role-Based Access Control)
- **Payment Gateway**: Midtrans PHP SDK
- **Environment**: Local development typically uses SQLite or MySQL.
- **Primary Codebase**: Located in the `itb-speedshop/` directory.

## 🛠️ Build, Lint, and Test Commands

All commands should be executed from within the `itb-speedshop/` directory.

### Build & Development
- **Initialization**: `composer run setup`
  - Runs `composer install`, sets up `.env`, generates keys, runs migrations, `npm install`, and `npm run build`.
- **Development Mode**: `composer dev`
  - Starts the local server (`php artisan serve`), queue listener, log tailing (`pail`), and Vite dev server concurrently.
- **Production Build**: `npm run build`
- **Frontend Watch**: `npm run dev`

### Linting & Formatting
- **Automated Formatting**: `vendor/bin/pint`
  - Uses Laravel Pint to apply PSR-12 and Laravel-specific style rules.
- **Manual Check**: Always check for 4-space indentation and proper brace placement (Allman style for classes/methods).

### Testing
- **Run Full Suite**: `php artisan test` or `composer test`
- **Single Test File**: `php artisan test tests/Feature/ExampleTest.php`
- **Specific Test Method**: `php artisan test --filter test_the_application_returns_a_successful_response`
- **Convention**: Feature tests reside in `tests/Feature/`, Unit tests in `tests/Unit/`. Use the `test_` prefix for method names.

## 🎨 Code Style & Conventions

### PHP Style Guide
- **Indentation**: Exactly 4 spaces.
- **Braces**: 
  - **Classes/Methods**: Opening brace on a new line (Allman style).
  - **Control Structures**: Opening brace on the same line (e.g., `if (...) {`).
- **Naming Conventions**:
  - **Classes**: `PascalCase` (e.g., `ProductController`, `OrderSeeder`).
  - **Methods**: `camelCase` (e.g., `processPayment`, `updateStock`).
  - **Variables**: `camelCase` (e.g., `snapToken`, `cartItems`).
  - **Database Fields**: `snake_case` (e.g., `total_price`, `payment_status`).
- **Imports**: 
  - Group `use` statements at the top of the file.
  - Sort order: Models -> Laravel Framework -> Third-party Libraries -> Enums/Traits.
  - Avoid using FQCN (e.g., `\App\Models\Product`) inline; import it via `use` instead.
- **Type Hinting**:
  - Use type hints for all method parameters (e.g., `Order $order`, `string $slug`).
  - Provide explicit return types for all public methods (e.g., `: View`, `: RedirectResponse`, `: void`).

### Error Handling & Validation
- **Database**: Use `firstOrFail()` for single-record lookups to automatically trigger a 404 response.
- **Validation**: Use `$request->validate([...])` in controllers. Define custom messages if necessary for better UX.
- **External APIs**: Wrap integrations (like Midtrans `Snap::getSnapToken`) in `try-catch` blocks.
- **User Feedback**: Use `redirect()->with('success', '...')` or `redirect()->with('error', '...')`.

### Frontend & UI
- **Blade Components**: Reusable UI elements must be stored in `resources/views/components/`. Use `<x-component-name />` syntax.
- **Styling**: Utility-first CSS using Tailwind. Avoid creating custom CSS files unless there is a very strong reason.
- **Interactivity**: Use AlpineJS for client-side state management (e.g., cart quantity toggles, mobile menus). Keep logic concise within the `x-data` attribute.
- **Localization**: While the UI uses Indonesian for user-facing strings, code comments and structural naming should prefer English.

## 📂 Directory Structure Highlights

- `app/Http/Controllers/`: Logic for handling requests. `CartController` handles session-based cart and Midtrans logic.
- `app/Http/Middleware/`: Custom guards like `Admin` and `Customer` based on the `usertype` field.
- `app/Models/`: Eloquent models. Note use of accessors (e.g., `getCategoryLabelAttribute`).
- `database/migrations/`: Schema history. Always use `snake_case` for column names.
- `resources/views/`: 
  - `admin/`: Admin panel templates.
  - `cart/`: Shopping cart and checkout flow.
  - `layouts/`: Base templates (`app.blade.php`, `guest.blade.php`).
- `routes/web.php`: Primary route definitions with middleware groups.

## 💳 Payment Integration (Midtrans)

- **Configuration**: Managed via `Midtrans\Config`. Keys should be fetched from `env()` or `config()`.
- **Environment**: Ensure `MIDTRANS_IS_PRODUCTION` is set to `false` for Sandbox testing.
- **Snap Token**: Generated in `CartController@process`. Ensure `gross_amount` and `order_id` are correctly formatted.

## 🤖 AI Interaction Guidelines

- **Context Awareness**: Always check `itb-speedshop/AI_CONTEXT.md` before implementing large features to ensure alignment with existing flows.
- **Standardization**: When adding new models, always include a corresponding Migration, Factory, and Seeder.
- **Safety**: NEVER use `as any`, `@ts-ignore`, or empty `catch` blocks. Fix the root cause of errors.
- **Consistency**: After modifying PHP files, run `vendor/bin/pint` to ensure code style consistency.
- **Refactoring**: When refactoring, maintain existing behavior unless explicitly asked to change it. Ensure tests pass before and after.

## 📝 Common Patterns

### Creating a New Route
1. Define the route in `routes/web.php` within the appropriate middleware group.
2. Create or update the Controller in `app/Http/Controllers/`.
3. Create the corresponding Blade view in `resources/views/`.

### Handling File Uploads
- Store images using `$request->file('image')->store('path', 'public')`.
- Update the model with the resulting path.
- Use `asset('storage/' . $model->image)` to display the image in views.

### Database Migrations
- Use `$table->string('slug')->unique()` for SEO-friendly URLs.
- Always include `$table->timestamps()`.
- Use `$table->foreignId('user_id')->constrained()->onDelete('cascade')` for relationships.

---
*Last Updated: May 2026*

