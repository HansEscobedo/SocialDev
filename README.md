Pasos para instalar el Backend:

1. Descargar o clonar el siguiente repositorio: https://github.com/HansEscobedo/SocialDev.git

2. Pasos que se necesitan para ejecutar el backend

2.1 Una vez que clonan el repositorio, crear una base de datos en mysql(se puede utilizar mysql workbench o xampp, se recomienda xampp).

2.1.1 Descargar e instalar Xampp de la siguiente pagina: https://www.apachefriends.org/es/index.html

2.2 Instalar Composer (seguir los pasos de la siguiente pagina: https://getcomposer.org/doc/00-intro.md)

2.3 en la raíz del proyecto de backend ejecutar los siguientes comandos.

2.3.1 copy .env.example .env

2.3.2 composer install

2.3.3 php artisan key:generate

2.3.4 modificar el .env con las variables de entorno de su base de datos (ingresar el nombre de la base de datos creada en DB_DATABASE).

2.3.5 php artisan migrate:fresh

2.3.6 php artisan db:seed --class=DatabaseSeeder

2.3.7 php artisan db:seed --class=SkillSeeder

2.3.8 php artisan serve --host 0.0.0.0
