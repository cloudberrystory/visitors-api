# Visitors api

## Quick start

```bash
cp .env.example .env
docker-compose up -d
docker-compose exec php bash -c "composer install"
```

## Endpoints

`GET /visits/countries` - get list of all visits by countries.

`POST /visits/countries` - increment a visit from specific country.
`country_code` is required body param.