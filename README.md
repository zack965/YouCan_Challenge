# Coding Challenge Laravel / VueJs
Project setup
on vueJs part i did use vite to create and build the project , to run it execute the following commands 
```
npm install	
```
and to run it
```
npm run dev	
```
 and on laravel part you can run the following commands to execute the project
 ```
composer install
```
```
cp .env.example .env
```
```
php artisan key:generate
```
```
php artisan migrate
```
```
php artisan db:seed --class=ProductCategorySeeder
```
```
php artisan serv
```
and to run the tests you can execute this command 
```
php artisan test
```

in vuejs i did create two components , one for listing the products and one for ceating one in 2 different routes and navigation between them. and i did use axios for call the api and tailwindcss for styling , and i did use a component libarry for making the ui beautiful

in laravel i did create a simple command for creating a product from cli , hers is the command 

```
php artisan product:create
```