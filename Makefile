COMPOSE = docker compose
EXEC     = $(COMPOSE) exec --user $(shell id -u):$(shell id -g) app
EXEC_WWW = $(COMPOSE) exec app

up:
	$(COMPOSE) up -d

down:
	$(COMPOSE) down

build:
	$(COMPOSE) up -d --build

logs:
	$(COMPOSE) logs -f

# file-generating commands — run as host user so files are editable in IDE
artisan:
	$(EXEC) php artisan $(cmd)

composer:
	$(EXEC) composer $(cmd)

# runtime commands — run as www-data so storage/logs are writable
migrate:
	$(EXEC_WWW) php artisan migrate

run:
	$(EXEC_WWW) php artisan $(cmd)