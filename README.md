1. `composer create-project laravel/laravel <nombre proyecto>`
2. `cd <carpeta>`
3. `php artisan serve` // para ver si se levanta el servidor

//carpeta 'vendor' es el 'node_modules' // `composer install` para que se cree

// app/http -> controllers y middlewares 


//softDeletes -> 'inactivo'

CREAR UNA TABLA
1. `php artisan make:migration create_<nombr en plural>_table`

RELACIONES/ MIGRACION PARA MODIFICAR 
1. `php artisan make:migration add_column_role_id_to_users_table`

CREACION DE BD/ MIGRACION
1. `php artisan migrate`

CREACION SEEDER
1. `php artisan make:seeder <NombreSeeder>`
2. `php artisan db:seed`

CREACION MODELO
1. `php artisan make:model Role`

base de datos:
models/factories/migrations/seeders

los modelos son para el ORM, afecta a mi capacidad para hacer consultas a la API.

TUMBAR DB, LEVANTAR Y SEEDEAR:
` php artisan migrate:fresh --seed`

para la relacion:
- models (hasMany/belongsTo) y en Migration (references)

1. make:migration
2. migrate
3. create seeder /create factory (para factory primero modelo)
4. añado a database seeder 
5. db:seed

TABLA INTERMEDIA 
1. php artisan make:migration create_multitasks_table 
2. le doy campos a esa migracion
3. php artisan make:migration create_multitask_user_table (ESTA ES LA INTERMEDIA)
4. le doy campos a esta migracion 
5. pho artisan migrate 
6. creo el modelo `php artisan make:model Multitask`