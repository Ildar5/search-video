# Laravel application for searching videos from YouTube API v3

## Installation

### Build with docker compose
 ```shell
 docker-compose up --build
 ```
 - Make step 1
 - After success open [http://localhost:8000/search](http://localhost:8000/search)

### Pre-requisites
- `PHP >=7.0`
- `Composer`
- `npm`
- `MySQL`

### Step 1: Setup MySQL configuration

- Copy `.env.example` file to `.env`
    ```shell
    cp .env.example .env
    ```
- Change `DB_USERNAME`, `DB_PASSWORD` and `DB_DATABASE` in `.env` file
    