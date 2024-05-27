
## Installation Steps

To get started with the application, follow these installation steps:

1. Ensure you have PHP 8.1+ installed.

2. Clone the repository using the following command:

   ```
   git@github.com:yarion1/tcc-genetic-algorithm.git
   ```

3. Move into the project directory:

   ```
   cd tcc-genetic-algorithm
   ```

4. Install the required dependencies by running:

   ```
   composer install
   ```

5. Create an environment file:

   ```
   cp .env.example .env
   ```

6. Generate the application key:

   ```
   ./vendor/bin/sail artisan key:generate
   ```

7. Create a local database and update the `.env` file with the database credentials.

8. Run the database migration to set up the necessary tables:

   ```
   ./vendor/bin/sail artisan migrate
   ```

9. Seed the application with initial data:

   ```
   ./vendor/bin/sail artisan db:seed
   ```
   
10. Start the queue to enable timetable generation:

    ```
    php artisan queue:work 
    ```
