<p align="center"><a href="javascript:void(0);" target="_blank"><img src="https://i.ibb.co/Yy1F44R/Simple-Logo-2009.png" width="400" alt="Simple Banking"></a></p>

## About Simple Banking

All the banking features are implemented in a very basic manner such as:

-   Web Based Banking System
-   User can make their own account
-   Check user account status
-   User have the access to view the transactions
-   Withdrawal and Deposit amount is implemneted too

## Installing

1. Clone the repository to your server
2. Make the .env with proper Database Configuration
3. Set the APP_URL=http://127.0.0.1:8000, ASSET_URL=http://127.0.0.1:8000 in .env, config>app.php if you are in localhost and run project in 8000 port
4. Now update your composer (composer update/install)
5. Make a fresh migration (php artisan migrate:fresh)
6. Make sure to clear your cache and logs (php artisan optimize:clear)\
7. Finally run the project (php artisan serve)
