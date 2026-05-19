COMPOSE = docker compose
EXEC = $(COMPOSE) exec --user $(shell id -u):$(shell id -g) app

up:
	$(COMPOSE) up -d

down:
	$(COMPOSE) down

build:
	$(COMPOSE) up -d --build

logs:
	$(COMPOSE) logs -f

artisan:
	$(EXEC) php artisan $(cmd)

migrate:
	$(EXEC) php artisan migrate

composer:
	$(EXEC) composer $(cmd)