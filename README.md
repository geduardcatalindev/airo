# Description

## API

### Endpoints

```bash
/api/auth/login
REQUEST_TYPE: POST
PARAMS: 
    {
        "email",
        "password"
    }
RESPONSE:
    {
        "access-token"
    }
```

```bash
/api/quotation
REQUEST_TYPE: POST
HEADERS:
    Authorization: Bearer {access-token}
    Content-Type: application/json
PARAMS:
    {
        "age",
        "currency_id",
        "start_date",
        "end_date"
    }
RESPONSE:
    {
        "status",
        "id",
        "currency_id",
        "total"
    }
```

# How to run the project

Make a copy of the .env.example file and rename it to .env

## Start the App

```bash
sudo docker compose up -d
```

## Install dependencies

```bash
sudo docker exec "php container id" composer install
```

## Run the migrations

```bash
./vendor/bin/sail artisan migrate --seeder=DatabaseSeeder
```

## Generate JWT secret

```bash
./vendor/bin/sail artisan jwt:secret
```

## Visit the frontend

```bash
http://localhost/quotation
```

## If you're not logged in, you'll be redirected to the /login page. Use the following credentials

```bash
email: test@example.com
password: password
```

## The auth token will be stored inside your browser LocalStorage

## You will be redirected back to the quotation page. Fill in the form and submit it. You will see the quotation total on the page
