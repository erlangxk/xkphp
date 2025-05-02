# XKPHP - Flight PHP API Project

A lightweight PHP API built with the Flight PHP framework.

## Features

- Simple routing with Flight PHP
- Docker and PHP-FPM deployment ready
- RESTful API endpoints

## Getting Started

### Prerequisites

- PHP 8.0+
- Composer
- Docker and Docker Compose (optional)

### Installation

1. Clone the repository
   ```
   git clone https://github.com/yourusername/xkphp.git
   cd xkphp
   ```

2. Install dependencies
   ```
   composer install
   ```

3. Run locally
   ```
   php -S localhost:8000
   ```

### Docker Deployment

```
docker-compose up -d
```

Access the API at http://localhost:8080

## API Endpoints

- GET / - Hello world
- GET /json - JSON response example
- GET /new - Controller example
- GET /new/:id - Controller with parameter

## License

MIT