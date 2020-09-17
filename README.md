# IA Calendar - Infracounter

Desarrollo creado bajo la empresa [Infracounter](https://infracounter.com) por **Carlos Eduardo Mera Ruiz** *Desarrollador Full Stack*.

## Detalles técnicos:
1. **Laravel Framework 7.27.0**
2. Vue
3. Buefy
4. **Dependencias Back (Composer):**
    - laravel/ui

5. **Dependencias Front (NPM):**
    - @fortawesome/fontawesome-free **^5.14.0**

## Base de datos:
1. Nombre inicial local **ia_calendar_db**
    ```
    CREATE SCHEMA `ia_calendar_db` DEFAULT CHARACTER SET utf8 ;
    ```
2. Migraciones y Seeders:
    ```
    php artisan migrate:fresh --seed
    ```
    O bien, individualmente:
    ```
    php artisan migrate:fresh
    php artisan db:seed
    ```

