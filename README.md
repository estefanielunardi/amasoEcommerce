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

## Running PHP Mess Detector

`vendor/bin/phpmd ./app text cleancode,unusedcode,codesize,design,naming`

## Metodología de trabajo

-   TDD
-   Agile
-   Scrum
-   Pair programming
-   CI/CD

### Kanban link

### Heroku link

http://amaso.herokuapp.com/

### Proyecto creado en equipo durante el Bootcamp Factoria F5.

Integrantes:

-   Carmen Pérez.
-   Laura Bassani.
-   Estefanie Garcia L.
-   Joaquim Francès.

Aplicación creada con la idea de poder ofrecer una via digital a los pequeños productores locales que quieren vender sus productos a clientes cercanos.

 [Usuarios.](#usuarios)  
 [Artesanos.](#artesanos)  
 [Administradores.](#adminstradores)

### Usuarios

-   En la aplicación los usuarios pueden ver tanto los artesanos locales como sus productos.
-   Pueden comprar productos.
-   Pueden acceder a su perfil con el historial de sus compras.

### Artesanos

-   Los artesanos pueden subir sus productos para la venta.
-   Editar y eliminar productos.
-   Editar y eliminar su perfil de artesano.
-   Pueden ver sus productos vendidos con los datos del comprador.

### Adminstradores

-   Los administradores disponen de un panel de control donde podrán visualizar a los artesanos que se  hayan inscrito en la aplicación.
-   Los administradores pueden eliminar los perfiles de los artesanos.

## Aprendizajes

-   Plantear un proyecto desde scratch.
-   Implementar cambios incrementales.
-   Trabajar con CI/CD.
-   Implementar GitHub Actions.
-   Patrón Repositorio.
-   Creación de vistas por componentes.

## Siguientes pasos

- [x] Incluir una API para la pasarela de pago.
- [x] Implementar patrón repositorio.
- [ ] Vincular a cada usuario un carrito que se destruye luego de la compra.
- [x] Implementar transacciones para las bases de datos.
- [ ] Utilizar sesiones que reserven los productos durante un tiempo determinado en cada carrito.
- [ ] Utilizar Docker.
- [x] Crear las vistas por componentes.
- [x] Crear perfil del usuario con su historial de compra.
