<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# PRY_POST_MICROSERVICIO

## Descripción General

Este proyecto corresponde al microservicio encargado de gestionar las operaciones CRUD de publicaciones (Posts) dentro del sistema distribuido. Su funcionamiento depende del microservicio de Autenticación, el cual valida los tokens enviados por los usuarios mediante solicitudes REST.

El microservicio opera de forma independiente, cuenta con su propio entorno de ejecución y su propia base de datos en PostgreSQL. Ninguna información del usuario se almacena localmente, cumpliendo así el principio de bajo acoplamiento entre microservicios.

## Tecnologías Utilizadas

* PHP 8.x
* Laravel 12
* PostgreSQL
* GuzzleHTTP (para comunicación con el microservicio de autenticación)
* Composer

## Funcionalidades Principales

* Listado de publicaciones.
* Creación de nuevas publicaciones asociadas al usuario autenticado.
* Consulta de publicaciones por ID.
* Modificación y eliminación de publicaciones.
* Middleware personalizado que valida el token remotamente.

## Endpoints

| Método | Endpoint        | Descripción                    |
| ------ | --------------- | ------------------------------ |
| GET    | /api/posts      | Listar todas las publicaciones |
| POST   | /api/posts      | Crear una nueva publicación    |
| GET    | /api/posts/{id} | Consultar una publicación      |
| PUT    | /api/posts/{id} | Modificar una publicación      |
| DELETE | /api/posts/{id} | Eliminar una publicación       |

## Arquitectura de Seguridad

Todas las solicitudes requieren el encabezado Authorization con el token emitido por el microservicio de autenticación. El middleware `CheckAuthToken` consulta el endpoint remoto para verificar la validez del token antes de ejecutar la operación solicitada.

## Instalación

1. Clonar el repositorio.
2. Instalar dependencias:

   ```
   composer install
   ```
3. Configurar el archivo `.env` con la conexión a PostgreSQL y la URL del servicio de autenticación.
4. Ejecutar migraciones:

   ```
   php artisan migrate
   ```
5. Iniciar el servidor:

   ```
   php artisan serve --port=8001
   ```

## Base de Datos

El microservicio utiliza PostgreSQL como motor de persistencia. La tabla principal `posts` almacena las publicaciones y contiene un campo `user_id` que representa al usuario autenticado, validado mediante el token.

## Autor

Wladymir Escobar
[gwescobar@espe.edu.ec](mailto:gwescobar@espe.edu.ec)
Trabajo académico – Arquitectura de Software

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
