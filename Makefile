UID=$(shell id -u)
GID=$(shell id -g)
DOCKER_PHP_SERVICE=php

up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build && \
	docker-compose pull

install:
	docker-compose run --rm -u ${UID}:${GID} ${DOCKER_PHP_SERVICE} composer install

bash:
	docker-compose run --rm -u ${UID}:${GID} ${DOCKER_PHP_SERVICE} sh

logs:
	docker-compose logs -f ${DOCKER_PHP_SERVICE}