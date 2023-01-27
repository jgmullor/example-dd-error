UID=$(shell id -u)
GID=$(shell id -g)

build:
	docker-compose build && \
	docker-compose pull

composer-install:
	docker-compose run --rm -u ${UID}:${GID} php-fpm composer install

up:
	docker-compose up -d

down:
	docker-compose stop

bash:
	docker-compose run --rm -u ${UID}:${GID} php-fpm bash