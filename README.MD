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

## Mock Server Integration

This project integrates with a mock API server from [https://github.com/erlangxk/mockAPI](https://github.com/erlangxk/mockAPI).

### Features of the Mock Server
- Provides simulated API endpoints for development and testing
- Built using Mockoon for easy API mocking
- Deployed automatically as part of the Docker Compose setup

### How It Works
The mock server is pulled directly from GitHub during container build time. When you run the Docker Compose setup, the mock server runs as a separate container and is available to the main PHP application via the internal Docker network.

### Accessing Mock Endpoints
From your PHP application, you can access the mock server endpoints using the service name as the hostname:

```php
// Example using the HttpClientService
$client = HttpClientService::getClient('http://mockserver:3000');
$response = $client->get('/api/endpoint');
```

## API Endpoints

- GET / - Hello world
- GET /hello - JSON response example
- GET /api/users - Controller using Guzzle HTTP client
- GET /api/user/:id - Controller with parameter using Guzzle HTTP client

## Performance testing

install hey, https://github.com/rakyll/hey

run the following command to test the performance of the server:

```bash
hey -n 1000 -c 125 http://localhost:8080/api/users
```

## License

MIT
