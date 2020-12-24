# IA Calendar's - Infracounter

Desarrollo creado bajo la empresa [Infracounter](https://infracounter.com) por **Carlos Eduardo Mera Ruiz** *Desarrollador Full Stack*.

## Detalles técnicos:
1. **Laravel Framework 8.4.0**
2. Vue
3. Buefy
4. **Dependencias Back (Composer):**
    - laravel/ui
    - laravolt/avatar
    - jeroenzwart/laravel-csv-seeder

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
    >Se incluye la importación de los archivos csv para Icons y Fonts, para hacer el proceso manual ver los puntos **4** y **5**
3. Script inicial para hosting/phpmyadmin:

    Ejecutar la importación del archivo *database/resources/init_sql.sql* el cual contiene la estructura de la base de datos y los inserts principales.
4. Importar iconos:
    - Por consola:
        ```
        LOAD DATA
        LOCAL INFILE '/var/www/html/ia-calendar/database/resources/icons.csv'
        INTO TABLE icons
        FIELDS TERMINATED BY ','
        OPTIONALLY
        ENCLOSED BY '"'
        LINES TERMINATED BY '\n'
        (`name`,`class_css`);
        ```
    - phpmyadmin:
        ```
        Importar archivos
        database/resources/icons.csv
        Formato: CSV
        Nombre de las columnas: name,class_css
        ```
5. Importar fuentes:
    - Por consola:
        ```
        LOAD DATA
        LOCAL INFILE '/var/www/html/ia-calendar/database/resources/fonts.csv'
        INTO TABLE fonts
        FIELDS TERMINATED BY ','
        OPTIONALLY
        ENCLOSED BY '"'
        LINES TERMINATED BY '\n'
        (`name`,`description`,`class_css`);
        ```
    - phpmyadmin:
        ```
        Importar archivos
        database/resources/fonts.csv
        Formato: CSV
        Nombre de las columnas: name,description,class_css
        ```
6. Datos de prueba:
    ```
    php artisan db:seed --class=TestDataSeeder
    ```
    >Este comando limpiará los datos para iniciar pruebas
    Para limpiar los datos de prueba puede optar por ejecutar:
    ```
    php artisan migrate:fresh --seed
    ```

