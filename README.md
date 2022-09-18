# Calendario demo

## Instalación

### Clonar el repositorio

```
git clone git@github.com:jago86/demo-calendar.git
```

### Instalar dependencias de PHP con composer

```
composer install
```

### Instalar dependencias de Javascript

```
npm install
```

### Variables de entorno
Crear el archivo **.env**

```
// Duplicar el archivo .env.example
cp .env.example .env
```

Configurar las variables del archivo .env de acuerdo a su entorno. Específicamenete las variables que tienen que ver con la conexión a base de datos.

### Ejecutar migraciones
```
php artisan migrate
```

### Ejecutar seeders
```
php artisan db:seed
```

### Arrancar servidor de desarrollo

```
php artisan serve

// O configurar con el servidor apropiado en su entorno de desarrollo.

```

## Tests
Para correr los tests del proyecto:
```
php artisan test

// O tambien

vendor/bin/phpunit
```
