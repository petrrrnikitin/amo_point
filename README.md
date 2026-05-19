# Dogs API

Laravel-приложение, которое каждые 5 минут забирает породы собак из [The Dog API](https://thedogapi.com) и отдаёт их через REST.

## Запуск

```bash
cp .env.example .env
# заполнить DOG_API_KEY и APP_KEY в .env

make build
make migrate
```

## Использование

| Метод | URL | Описание |
|-------|-----|----------|
| `GET` | `/api/dogs` | Список пород с пагинацией |
| `GET` | `/api/documentation` | Swagger UI |

```
GET /api/dogs?page=1&per_page=20
```

## Команды

```bash
make run cmd="dogs:fetch"   # разовая загрузка пород
make migrate                # миграции
make logs                   # логи всех контейнеров
```