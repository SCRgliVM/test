Start:
```bash
    docker compose up -d
    docker compose exec app composer install
    docker compose exec app php migration.php
```

Site is available at localhost:8080
