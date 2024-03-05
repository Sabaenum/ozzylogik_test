## How to Run the Application

1. **Build Docker Services**

   Use the following command to build your Docker services.

    ```
    docker-compose build
    ```

2. **Start Docker Services**

   Use the following command to start your Docker services.

    ```
    docker-compose up -d
    ```

3. **Install NPM Dependencies and Change ENV**

   Change .env.example to .env
   
   Navigate to the `www` folder and run the following command to install the necessary NPM dependencies.

    ```
    npm install
    ```

4. **Run Composer, Migrations, and Artisan Horizon Inside Docker Container**

   Enter the `fpm-php` Docker container and execute the following commands to install Composer dependencies, run database migrations, and start Laravel Horizon (do not close terminal with Horizon).

    ```
    composer install
    php artisan migrate
    php artisan horizon
    ```
5. **Open one more `fpm-php` Docker container terminal**

    ```
    php artisan app:fetch-data
    ```
6. **Run NPM in Development Mode**

   Go back to your IDE, navigate to the `www` folder, and run the following command to start NPM in development mode.

    ```
    npm run dev
    ```
7. **Make Registration**
    ```
    http://localhost/register
    ```
8. **What you should see**

   https://prnt.sc/EyiODfdnDj-C

   https://prnt.sc/2ATZc0XW2Nan

