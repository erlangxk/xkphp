# XKPHP - Flight PHP API Project

A lightweight PHP API built with the Flight PHP framework.

## Features

- Simple routing with Flight PHP
- Docker and PHP-FPM deployment ready
- RESTful API endpoints

## Getting Started

### Prerequisites

- PHP 8.4+
- Composer
- Docker and Docker Compose (optional)

### Installation

1. Clone the repository
   ```
   git clone https://github.com/erlangxk/xkphp.git
   cd xkphp
   ```

### Docker Deployment

```
docker-compose up -d
```

To update the mock server with the latest version from GitHub:
```
docker-compose build --no-cache mockserver
docker-compose up -d
```

Access the API at http://localhost:8080

## API Endpoints

- GET / - Hello world
- GET /hello - JSON response example
- GET /api/users - Controller using Guzzle HTTP client
- GET /api/user/:id - Controller with parameter using Guzzle HTTP client

## License

MIT