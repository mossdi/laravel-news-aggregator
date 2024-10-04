## Laravel News Aggregator

Проект в стадии разработки

**Запуск:**
- docker-compose up -d
- npm install
- npm run dev

**В контейнере bn.php-fpm:**
- composer install
- php artisan migrate --seed
- php artisan key:generate
- /usr/bin/supervisord

**Регистрация с двухфакторной аутентификацеий.**

Добавить в **.env**
- TELEGRAM_API_KEY=
- TELEGRAM_CHAT_ID=

Данные тянутся с ресурса https://newsapi.org

Добавить в **.env**
- NEWS_API_BASE_URL="https://newsapi.org/v2/"
- NEWS_API_KEY=