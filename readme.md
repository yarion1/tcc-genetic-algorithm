
## Installation Steps

To get started with the application, follow these installation steps:

1. Ensure you have PHP 8.1+ installed.

2. Clone the repository using the following command:

   ```
   git clone git@github.com:olaysco/timetable-generator.git
   ```

3. Move into the project directory:

   ```
   cd timetable-generator
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
   php artisan key:generate
   ```

7. Create a local database and update the `.env` file with the database credentials.

8. Run the database migration to set up the necessary tables:

   ```
   php artisan migrate
   ```

9. Seed the application with initial data:

   ```
   php artisan db:seed
   ```

10. Access the application URL in your web browser. If prompted for a password, use the default password: `admin`.

11. Before generating timetables, configure the Queue driver in the `.env` file. Refer to the Laravel documentation on queues for more information: https://laravel.com/docs/10.x/queues#database. Using the `sync` driver will not work due to the time-consuming nature of the Genetic Algorithm.

12. Start the queue to enable timetable generation:

    ```
    php artisan queue:listen --timeout=0
    ```
