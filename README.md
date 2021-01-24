# Money-Saving-Wallet

## Installation

composer install <br/>
cp.env.example .env <br/>
php artisan key generate <br/>

## DATABASE

Create DB & Edite (.env) file DB_DATABASE="your db name" <br/>
php artisan  db:seed --class=currencySeeder <br/>
php artisan migrate <br/>

## Modification

1) go to RegisterController then go to (use RegistersUsers) redirect by click ctrl+left click on mouse . <br/>
![carbon (1)](https://user-images.githubusercontent.com/56304666/105642417-39a0ae80-5e92-11eb-86ef-c195ec5cd13e.png) <br/>

2) Edit showRegistrationForm(). <br/>
![carbon](https://user-images.githubusercontent.com/56304666/105642313-b4b59500-5e91-11eb-97ef-38c5c551f1dc.png) <br/>

## Run 

php artisan serve

## Admin Side 

write in url : /admin/login
