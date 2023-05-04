# Local set up

### After finished setting up either by xampp or docker, please run:
> composer install

### And then copy .env.example to .env and update with your according config
> cp .env.example .env

### Config in .env after run cp
```
DB_CONNECTION=mysql
DB_HOST=host.docker.internal
DB_PORT=3307
DB_DATABASE=laravel_news
DB_USERNAME=root
DB_PASSWORD=root
```

### Service name can find in docker-compose.yml

### After setup config parameter , run ```docker-compose up --build```
