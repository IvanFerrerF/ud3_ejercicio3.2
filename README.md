EJERCICIO 4

1. ¿Qué crees que hace el método create de la clase Schema?

El método create de la clase Schema en Laravel crea una nueva tabla en la base de datos.

Ejemplo:

Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->timestamps();
});

Aquí, Schema::create('users', ...) crea una tabla llamada users.
El segundo argumento es una función que define las columnas y atributos de la tabla utilizando el objeto $table.


2. ¿Qué crees que hace $table->string('email')->primary();?

Este código agrega una columna email de tipo string (cadena de texto) y la establece como la clave primaria de la tabla.

Detalles:

    $table->string('email'): Crea una columna llamada email que almacena texto.
    ->primary(): Define esta columna como la clave primaria de la tabla, lo que garantiza que cada valor en esta columna sea único y no nulo.

    Nota: Normalmente no se usa un string como clave primaria, ya que las claves primarias suelen ser enteros o UUIDs para optimizar las consultas.


3. ¿Cuántas tablas hay definidas? Indica el nombre de cada tabla.

Para responder esta pregunta:

    Cuenta cuántos archivos hay en la carpeta database/migrations.
    Abre cada archivo y busca la llamada a Schema::create. El primer argumento de esta función será el nombre de la tabla.

Ejemplo:

    Si tienes los siguientes archivos:
        2023_01_01_000000_create_users_table.php → Tabla: users
        2023_01_01_000001_create_password_resets_table.php → Tabla: password_resets

Respuesta esperada: Supongamos que tienes las tablas predeterminadas de Laravel:

    users (gestión de usuarios).
    password_resets (para gestionar solicitudes de restablecimiento de contraseñas).
    personal_access_tokens (para autenticar usuarios con tokens, utilizada con Sanctum).

El número exacto puede variar dependiendo de si has añadido más migraciones al proyecto.



EJERCICIO 5

¿Cuantas tablas aparecen?

Cantidad de tablas: 9.
Nombres de las tablas:

    cache
    cache_locks
    failed_jobs
    job_batches
    jobs
    migrations
    password_reset_tokens
    sessions
    users

    Tablas encontradas en test1

    cache:
        Almacena los datos en caché configurados para el almacenamiento en base de datos.
        Relacionada con el uso del driver de caché database.

    cache_locks:
        Utilizada para gestionar bloqueos en la caché.
        Normalmente creada si usas caché concurrente en base de datos.

    failed_jobs:
        Registra los trabajos en cola (jobs) que fallaron durante su ejecución.
        Creada automáticamente si configuras un sistema de cola.

    job_batches:
        Almacena información sobre lotes de trabajos (batches) que se ejecutan en cola.

    jobs:
        Almacena los trabajos en cola pendientes de ser ejecutados.

    migrations:
        Lleva un registro de las migraciones ejecutadas en tu base de datos.
        Esto asegura que las migraciones no se ejecuten dos veces.

    password_reset_tokens:
        Registra las solicitudes de restablecimiento de contraseñas.
        Anteriormente llamada password_resets.

    sessions:
        Almacena las sesiones activas de los usuarios si configuras SESSION_DRIVER=database.

    users:
        Contiene información de los usuarios registrados en tu aplicación.

    
    EJERCICIO 6

    1. php artisan migrate

    Qué hace:
        Ejecuta todas las migraciones pendientes en la carpeta database/migrations para crear o modificar tablas en la base de datos.
    Cuándo usarlo:
        Al configurar la base de datos inicial o agregar nuevas migraciones al proyecto.
    Ejemplo de salida:

    Migrating: 2023_01_01_000000_create_users_table
    Migrated:  2023_01_01_000000_create_users_table (time: 0.03s)

2. php artisan migrate:status

    Qué hace:
        Muestra el estado de las migraciones, indicando cuáles ya han sido ejecutadas y cuáles están pendientes.
    Cuándo usarlo:
        Para verificar qué migraciones han sido aplicadas y cuáles no.
    Ejemplo de salida:

    +------+------------------------------------------------------------+-------+
    | Ran? | Migration                                                  | Batch |
    +------+------------------------------------------------------------+-------+
    | Yes  | 2023_01_01_000000_create_users_table                       | 1     |
    | No   | 2023_01_02_000000_create_password_resets_table             |       |
    +------+------------------------------------------------------------+-------+

3. php artisan migrate:rollback

    Qué hace:
        Revierte la última serie de migraciones aplicadas (es decir, el último batch).
    Cuándo usarlo:
        Para deshacer cambios recientes en la base de datos realizados por las migraciones.
    Ejemplo de uso:
        Después de ejecutar una migración que introdujo un error o datos incorrectos.

4. php artisan migrate:reset

    Qué hace:
        Revierte todas las migraciones, eliminando todas las tablas creadas por las migraciones.
    Cuándo usarlo:
        Cuando necesitas reiniciar completamente el esquema de la base de datos.
    Nota:
        Este comando no ejecuta nuevamente las migraciones, solo las revierte.

5. php artisan migrate:refresh

    Qué hace:
        Revierte todas las migraciones y luego las ejecuta nuevamente en el orden correcto.
    Cuándo usarlo:
        Para reiniciar el esquema de la base de datos mientras mantienes las migraciones al día.
    Ejemplo:
        Útil durante el desarrollo cuando necesitas comenzar desde cero con las tablas actualizadas.

6. php artisan make:migration

    Qué hace:
        Crea un nuevo archivo de migración en la carpeta database/migrations.
    Cuándo usarlo:
        Al querer definir cambios en la estructura de la base de datos (crear nuevas tablas, modificar existentes, etc.).
    Ejemplo de uso:

    php artisan make:migration create_products_table

        Esto crea un archivo llamado algo como: 2025_01_08_000001_create_products_table.php.

7. php artisan migrate --seed

    Qué hace:
        Ejecuta las migraciones pendientes y luego ejecuta los seeders configurados en database/seeders.
    Cuándo usarlo:
        Para aplicar migraciones y luego rellenar la base de datos con datos iniciales o de prueba.
    Nota:
        Requiere que los seeders estén configurados y definidos.

Resumen rápido de lo que hace cada comando
Comando	Acción
php artisan migrate	Aplica todas las migraciones pendientes.
php artisan migrate:status	Muestra el estado de las migraciones (ejecutadas o pendientes).
php artisan migrate:rollback	Revierte el último batch de migraciones aplicadas.
php artisan migrate:reset	Revierte todas las migraciones.
php artisan migrate:refresh	Revierte todas las migraciones y las vuelve a ejecutar.
php artisan make:migration	Crea un nuevo archivo de migración.
php artisan migrate --seed	Aplica migraciones y ejecuta los seeders configurados.


EJERCICIO 8

Para añadir un nuevo campo (apellido) a la tabla alumnos, necesitas crear una nueva migración que realice esta modificación en la estructura de la tabla.

Pasos para añadir un nuevo campo a una tabla
1. Crear una nueva migración

Ejecuta el siguiente comando para generar una migración que altere la tabla alumnos:

php artisan make:migration add_apellido_to_alumnos_table --table=alumnos

Esto creará un archivo en la carpeta database/migrations con un nombre similar a:

2025_01_08_123456_add_apellido_to_alumnos_table.php

2. Editar el archivo de migración

    Abre el archivo recién creado en tu editor de texto (por ejemplo, VSCode).
    Modifica la función up() para agregar el nuevo campo apellido:

public function up()
{
    Schema::table('alumnos', function (Blueprint $table) {
        $table->string('apellido')->after('nombre'); // Añade el campo después de 'nombre'
    });
}

Modifica la función down() para eliminar el campo apellido si es necesario revertir la migración:

    public function down()
    {
        Schema::table('alumnos', function (Blueprint $table) {
            $table->dropColumn('apellido');
        });
    }

3. Ejecutar la migración

Ejecuta el siguiente comando para aplicar la migración:

php artisan migrate

Laravel añadirá el campo apellido a la tabla alumnos.
4. Verificar la estructura de la tabla

    Accede al cliente de MariaDB:

docker exec -it mariadb-server mariadb -u root -p

Conéctate a la base de datos test2:

USE test2;

Revisa la estructura de la tabla alumnos:

    DESCRIBE alumnos;

    Deberías ver el campo apellido en la tabla.

Resumen de los pasos

    Crear una nueva migración con php artisan make:migration.
    Modificar las funciones up() y down() en el archivo generado.
    Ejecutar la migración con php artisan migrate.
    Verificar que el nuevo campo esté en la tabla alumnos.

