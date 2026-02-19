# REMIT Events

A Laravel application for displaying REMIT (Regulation on Energy Market Integrity and Transparency) events. This provides a modern, user-friendly interface for wholesale energy market data published in compliance with EU Regulation 1227/2011.

## Features

- **Filtering**: Filter events by asset, status, date range (start/end), and free-text search
- **Sorting**: Click column headers to sort by Asset, Event ID, Published date, Start date, REMIT Reason, or Status
- **Responsive design**: Dark theme optimized for data readability
- **Pagination**: 20 events per page with styled navigation
- **Professional styling**: Color-coded status badges (Active, Pending, etc.) and REMIT reason labels

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- SQLite (default) or MySQL/PostgreSQL

## Installation

1. Clone the repository and install dependencies:

```bash
composer install
npm install
```

2. Configure environment:

```bash
cp .env.example .env
php artisan key:generate
```

3. Run migrations and seed sample data:

```bash
php artisan migrate
php artisan db:seed
```

4. Build frontend assets:

```bash
npm run build
```

## Running the Application

**Production:**
```bash
php artisan serve
```
Visit http://localhost:8000

**Development (with hot reload):**
```bash
npm run dev    # in one terminal
php artisan serve   # in another
```

## Data Source

This application displays REMIT data. The official UK REMIT data is published at [Elexon BMRS](https://bmrs.elexon.co.uk/remit). The sample data included is based on publicly available REMIT event structures.

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Blade templates, Tailwind CSS 4, Vite
- **Database**: SQLite (configurable)
- **Fonts**: DM Sans, JetBrains Mono (Bunny Fonts)

## License

MIT
