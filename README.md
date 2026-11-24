# Red Social — Symfony (PHP)

Aplicación web tipo **red social** desarrollada con el framework **Symfony**, con sistema de autenticación de usuarios y persistencia en base de datos. Proyecto académico del ciclo de Desarrollo de Aplicaciones Web (DAW).

## 🚀 Funcionalidades

- **Registro e inicio de sesión** de usuarios con autenticación.
- **Gestión de datos** persistida en base de datos (MySQL).
- Arquitectura **MVC** siguiendo las convenciones de Symfony.

## 🛠️ Stack

![Symfony](https://img.shields.io/badge/Symfony-000000?style=flat&logo=symfony&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)

- **Framework:** Symfony (PHP)
- **Base de datos:** MySQL
- **Patrón:** MVC (controladores, entidades/Doctrine, plantillas Twig)

## 🔒 Enfoque de seguridad

Como proyecto orientado a desarrollo seguro, presta atención a:

- Gestión segura de **sesiones y autenticación** mediante el componente Security de Symfony.
- Uso de **Doctrine ORM**, que parametriza las consultas y mitiga la inyección SQL por diseño.
- Escapado automático de salida en plantillas **Twig** como protección frente a XSS.

## ⚙️ Puesta en marcha

```bash
# Instalar dependencias
composer install

# Configurar la base de datos en .env (DATABASE_URL)

# Crear el esquema
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# Levantar el servidor de desarrollo
symfony serve
```

## 👤 Autor

Iván Muñoz — [GitHub](https://github.com/ivicho17) · [LinkedIn](https://linkedin.com/in/ivanmunozhernandez)

> Proyecto académico (IES, ciclo DAW). Con fines educativos.
