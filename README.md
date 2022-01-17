## Features

- Using Repository Pattern.
- Unit tests coverage.
- Handle all Acceptance Criteria.
- Easy to install in a Docker container.

## Run with Docker

By default, the Docker will expose port 8080, so change this within the
Dockerfile if necessary. When ready, simply use the Dockerfile to
build the image.

```sh
cd jumia-task
```

```sh
cp .env.example .env && composer install && npm install
```


```sh
docker-compose up --build
```

Verify the server running by navigating to your server address in
your preferred browser.

```sh
localhost:8080
```

[![N|Solid](https://i.imgur.com/0BhHY8U.png)](https://i.imgur.com/0BhHY8U.png)

## Postman Collection

You Can look at Endpoint using Postman here
[Postman Api](https://documenter.getpostman.com/view/3113879/UVXkmucd)

## Test

```sh
php artisan test 
```

[![N|Solid](https://i.imgur.com/Qy7QOLZ.png)](https://nodesource.com/products/nsolid)


## License

MIT
