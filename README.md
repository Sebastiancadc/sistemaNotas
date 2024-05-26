<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
    </a>
</p>

<p align="center">
    <a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sobre Laravel

Laravel es un framework de aplicaciones web con una sintaxis expresiva y elegante. Creemos que el desarrollo debe ser una experiencia agradable y creativa para ser realmente gratificante. Laravel elimina el dolor del desarrollo al facilitar tareas comunes utilizadas en muchos proyectos web, como:

- [Motor de enrutamiento simple y rápido](https://laravel.com/docs/routing).
- [Contenedor de inyección de dependencias potente](https://laravel.com/docs/container).
- Múltiples back-ends para [almacenamiento de sesiones](https://laravel.com/docs/session) y [caché](https://laravel.com/docs/cache).
- [ORM de base de datos expresivo e intuitivo](https://laravel.com/docs/eloquent).
- [Migraciones de esquema agnósticas de base de datos](https://laravel.com/docs/migrations).
- [Procesamiento robusto de trabajos en segundo plano](https://laravel.com/docs/queues).
- [Transmisión de eventos en tiempo real](https://laravel.com/docs/broadcasting).

Laravel es accesible, potente y proporciona herramientas requeridas para aplicaciones grandes y robustas.

## Instalación

### Prerrequisitos

- PHP >= 7.3
- Composer
- MySQL u otra base de datos compatible

### Pasos

1. Clonar el repositorio:
   ```sh
   git clone https://github.com/Sebastiancadc/sistemaTareas.git
   cd sistemaTareas
2. Instalar dependencias:
    ```sh
    composer install
3. Copiar el archivo de entorno de ejemplo y hacer los cambios de configuración necesarios en el archivo .env:
    ```sh
    cp .env.example .env
4. Generar una clave de aplicación:
    ```sh
    php artisan key:generate
5. Configurar la base de datos:
    ```sh
    php artisan migrate --seed
6. Ejecutar el servidor de desarrollo:
    ```sh
    php artisan serve

### Decisiones de Diseño
- Arquitectura Model-View-Controller (MVC): El proyecto sigue la arquitectura MVC proporcionada por Laravel para mantener una clara separación de responsabilidades.
Plantillas Blade: Se utiliza el motor de plantillas Blade para generar las vistas, ofreciendo una sintaxis limpia e intuitiva.
- ORM Eloquent: Se utiliza el ORM Eloquent para interacciones con la base de datos, simplificando las operaciones CRUD y las relaciones entre modelos.
- Control de Acceso Basado en Roles (RBAC): Implementado utilizando los mecanismos de autorización integrados de Laravel para gestionar diferentes roles (admin, worker) y sus permisos.
## Soluciones Implementadas
- Autenticación de Usuarios: Implementada usando el spatieSpatie\Permission de autenticación de Laravel, permitiendo un inicio de sesión y registro seguro.
- Gestión de Tareas: Los usuarios pueden crear, actualizar y eliminar tareas. Las tareas se asignan a los usuarios y su estado puede ser actualizado.
- Panel de Administración: Los usuarios administradores tienen acceso para gestionar roles, usuarios y ver todas las tareas.
- Panel de Usuario: Los usuarios no administradores pueden ver y gestionar solo sus tareas asignadas.
- Manejo de Errores: Se ha implementado un manejo de errores completo para asegurar una experiencia de usuario fluida incluso en caso de errores inesperados.
## Diseño
- El diseño se hizo con Bootstrap, proporcionando un sistema responsivo y estético para la gestión de tareas.