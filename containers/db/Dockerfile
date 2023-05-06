FROM mysql:latest
ADD ./import_db/laravel_news.sql /docker-entrypoint-initdb.d/laravel_news.sql

RUN chmod -R 775 /docker-entrypoint-initdb.d

ENV MYSQL_ROOT_PASSWORD root