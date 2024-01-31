# Laravel Project for Backend Developer Task

## Requirements
- PHP >= 8.0
- Composer
- Laravel (latest version)

## Clone the Repository:
- git clone [repository-url]
- cd [repository-name]

## Install Dependencies:
```bash
composer install
```
## Environment Configuration:
- Copy .env.example to .env and configure your database and other settings. 
```bash
cp .env.example .env
```
## Generate Application Key:
```bash
php artisan key:generate
```
## Run Migrations:
```bash
php artisan migrate
```
## Models:
Represents the Audi car models.

## Generations:
Represents the different generations of each Audi car model, including market, name, period, generation, image path, and link to the technical specifications.

## Artisan Commands
### Parse Audi Models:
Parses the Audi model lineup and stores it in the models table.

```bash
php artisan parse:car-models
```
### Parse Model Generations:
Iterates over the parsed models and fetches generations, storing them in the generations table. Includes market, name, period, generation, image path, and technical specifications link.

```bash
php artisan parse:generations
```
## Usage
- Run the parse commands to populate your database with the required data.
- You can check the database or create routes and controllers to display the parsed data.

