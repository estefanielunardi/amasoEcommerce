![](public/image/amaso-peque.png)

# AMASÓ ECOMMERCE

## La app para conectar artesanos y productores locales con sus clientes.

# Requisitos técnicos

-   Laravel 8
-   PHP 7.4
-   composer 1.10.15

# Instalación

`composer install`

`npm install && npm run dev`

`php artisan migrate`

## Running app

`php artisan serve`

## Running Tests

`php artisan test`

## Metodología de trabajo

-   TDD
-   Agile
-   Scrum
-   Pair programming
-   Git Flow

### Kanban link

https://app.gitkraken.com/glo/board/X-wu328EBQARc9EZ

### Heroku link

http://amaso.herokuapp.com/

### Proyecto creado en equipo durante el Bootcamp Factoria F5.

Integrantes:

-   Carmen Pérez.
-   Laura Bassani.
-   Estefanie Garcia.
-   Alejandra Stasi.
-   Joaquim Francès.

Aplicación creada con la idea de poder ofrecer una via digital a los pequeños productores locales que quieren vender sus productos a clientes cercanos.

 [Usuarios.](#usuarios)  
 [Artesanos.](#artesanos)  
 [Administradores.](#adminstradores)

### Usuarios

-   En la aplicación los usuarios pueden ver tanto los artesanos locales como sus productos.
-   Pueden comprar productos.
-   Reciven un email de confirmación de compra.

### Artesanos

-   Los artesanos pueden subir sus productos para la venta.
-   Editar y eliminar productos.
-   Editar y eliminar su perfil de artesano.
-   Pueden ver sus productos vendidos con los datos del comprador.

### Adminstradores

-   Los administradores disponen de un panel de control donde podrán visualizar a los artesanos que se hayan inscrito en la aplicación.
-   Los administradores deberan aprovar a los artesanos inscritos antes de que estos puedan vender sus productos.
-   Se envía un email a los artesanos con la actualización del estatus de su perfil (aprobado\desaprobado)

## Aprendizajes

-   Plantear un proyecto desde scratch.
-   Implementar cambios incrementales.
-   Fundamentos del trabajo por componentes.
-   ORM

## Siguientes pasos

-   Incluir una API para la pasarela de pago.
-   Implementar patrón repositorio.
-   Vincular a cada usuario un carrito que se destruye luego de la compra.
-   Implementar transacciones para las bases de datos.
-   Utilizar sesiones que reserven los productos durante un tiempo determinado en cada carrito.
-   Utilizar Docker.
-   Manejo de errores.
-   Crear las vistas por componentes.
-   Crear perfil del usuario con su historial de compra.
