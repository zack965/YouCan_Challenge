# Coding Challenge Laravel / VueJs
## Project Setup
### VueJs

The project was built using Vite. To run the VueJs application, follow these steps:
1. install dependencies
 
```
  npm install	
```
2. Run the development server:
```
   npm run dev	
```


In the Vue.js application, two components were created:
1. **ProductList:** Displays a list of products retrieved from an API endpoint.
2. **ProductCreate:** Provides a form for creating a new product, utilizing Axios to communicate with the API.
3. I did use Tailwind CSS  for styling purposes, with a component libarry called preline for making nice user interface .


### Laravel

To run the Laravel application, follow these steps:

1. Install dependencies:

 ```
   composer install
```
2. Copy the .env.example file to .env:
```
   cp .env.example .env
```
3. Generate a new application key:
```
   php artisan key:generate
```
4. Migrate the database:
```
   php artisan migrate
```
5. Seed the database with product categories:
```
   php artisan db:seed --class=ProductCategorySeeder
```
6. Start the development server:
```
   php artisan serv
```
7. To run the tests, execute the following command: 
```
   php artisan test
```



in laravel i did create a simple command for creating a product from cli , hers is the command 

```
   php artisan product:create
```