#!make

ifneq (,$(wildcard ./.env))
    include .env
    export
else
$(error No se encuentra el fichero .env)
endif

help: _header
	${info }
	@echo Opciones:
	@echo ---------------------------------
	@echo build
	@echo start / stop / restart / stop-all
	@echo install
	@echo seed
	@echo workspace / workspace-root
	@echo test
	@echo redis-cli / redis-flush
	@echo stats
	@echo clean
	@echo ---------------------------------

_urls: _header
	${info }
	@echo Sitios disponibles:
	@echo -----------------------------------------
	@echo [Sitio web] https://blog.test
	@echo [phpMyAdmin] https://phpmyadmin.blog.test
	@echo [Mailpit] https://mailpit.blog.test
	@echo -----------------------------------------

_header:
	@echo ----
	@echo Blog
	@echo ----

build:
	@docker compose build --pull

_start-command:
	@docker compose up -d --remove-orphans

start: _start-command _urls

stop:
	@docker compose stop

restart: stop start

stop-all:
	@docker stop $(shell docker ps -aq)

install:
	@docker compose exec php composer install
	@docker compose exec php npm install
	@docker compose exec php npm run build

seed:
	@docker compose exec php php artisan migrate:fresh --seed

workspace:
	@docker compose exec php /bin/bash

workspace-root:
	@docker compose exec --user root php /bin/bash

test:
	@docker compose exec php php artisan test

redis-cli:
	@docker compose exec redis redis-cli

redis-flush:
	@docker compose exec redis redis-cli flushall

stats:
	@docker stats

clean:
	@docker compose down -v --remove-orphans
