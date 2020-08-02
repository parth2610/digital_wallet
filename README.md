## About Digital Wallet

Digital Wallet is a web application developed using Laravel framework with expressive, elegant syntax. We can add balance to wallet using credit card (For testing purpose,Stripe API is used.).Apart from that JWT Authkey based API is developed to do user registration as well asfetching user account details.

## Following are the Links/API Endpoints:

- Home Page consists adding of topup to user balance ("http://localhost:8000").
- User Registration API requires Name,Email Address and Password ,On success return JWT authkey("http://localhost:8000/api/register"). [POST]
- User Login API ("http://localhost:8000/api/login"). [POST]
- Fetchs Logged in User details when Authkey is passed  ("http://localhost:8000/api/user"). [GET]
- User LogOut API ("http://localhost:8000/api/logout"). [POST]
- Fetches specific user's total transactions when email address is passed ("http://localhost:8000/api/totaltransactions"). [POST]
- Fetches specific user's Account Balance when email address is passed ("http://localhost:8000/api/userbalance"). [POST]

## Steps to run Application
- Install XAMPP/WAMP Server
- Download / Clone this repository to your root folder of XAMPP/WAMP
- START APACHE & MYSQL IN XAMPP/WAMP SERVER
- Migrate or Import Database (In case for importing,Use SQL file from DATABASE FILE Folder of this repository)
- Check database configuration in .ENV file and set as per your Server
- Start LARAVEL APPLICATION using "PHP ARTISAN SERVE" command