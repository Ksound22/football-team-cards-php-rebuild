# Football Team Cards Rebuild with PHP and MongoDB Atlas

This is a rebuild of the [football team cards project of the updated JavaScript curriculum](https://www.freecodecamp.org/learn/javascript-algorithms-and-data-structures-v8/learn-modern-javascript-methods-by-building-football-team-cards/step-1) for the article collaboration between freeCodeCamp and MongoDB. It uses MongoDB Atlas for the database and Tailwind CSS for styling.

## Features

- Displays Footballers Based on the option selected (goalkeepers, defenders, midfielders, forwards)
- Uses MongoDB Atlas for database management

## Prerequisites

Before you begin, ensure you have the following installed on your machine:

- PHP 8+
- Composer
- MongoDB PHP extension

## Installation

1. **Clone the Starter Branch of the Repository**

   ```bash
   git clone https://github.com/Ksound22/football-team-cards-php-rebuild/tree/starter
   ```

   Or

   ```bash
   gh repo clone Ksound22/football-team-cards-php-rebuild
   ```

2. **Install Dependencies**

   ```bash
   composer install
   ```

3. **Create a `.env` File Off the Existing `.env.example` File in the ROot**

   ```bash
   cp .env.example .env
   ```

4. **Ensure MongoDB extension is Enabled**

   Make sure the MongoDB PHP extension is installed and enabled. You can install it using PECL:

   ```bash
   sudo pecl install mongodb
   ```

   Then, add the following line to your php.ini file:

   ```bash
   extension=mongodb.so
   ```

5. **Start the PHP Built-in Server**

   ```bash
   php -S localhost:port-number
   ```

## Project Structure

- `index.php`: the main page that lists all footballers (players).
- `mongo_atlas_setup.php`: MongoDB connection setup.
- `.env`: environment variables (not included in the repository).
- `vendor/`: composer dependencies (not included in the repository).
