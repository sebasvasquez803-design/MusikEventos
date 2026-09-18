<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Autenticación predeterminada
    |--------------------------------------------------------------------------
    |
    | Esta opción define el "guard" de autenticación predeterminado y el
    | "broker" de restablecimiento de contraseña para tu aplicación. Puedes
    | cambiar estos valores según sea necesario, pero son un excelente punto
    | de partida para la mayoría de las aplicaciones.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Guards de autenticación
    |--------------------------------------------------------------------------
    |
    | A continuación, puedes definir cada guard de autenticación para tu
    | aplicación. Por supuesto, ya se ha definido una excelente
    | configuración predeterminada que utiliza almacenamiento en sesión
    | junto con el proveedor Eloquent.
    |
    | Todos los guards de autenticación tienen un proveedor de usuarios,
    | que define cómo se obtienen realmente los usuarios de tu base de
    | datos u otro sistema de almacenamiento. Normalmente se utiliza
    | Eloquent.
    |
    | Soportados: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Proveedores de usuarios
    |--------------------------------------------------------------------------
    |
    | Todos los guards de autenticación tienen un proveedor de usuarios,
    | que define cómo se obtienen realmente los usuarios de tu base de
    | datos u otro sistema de almacenamiento. Normalmente se utiliza
    | Eloquent.
    |
    | Si tienes varias tablas o modelos de usuarios, puedes configurar
    | varios proveedores para representar el modelo o tabla. Luego,
    | estos proveedores pueden asignarse a cualquier guard adicional que
    | hayas definido.
    |
    | Soportados: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', User::class),
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Restablecimiento de contraseñas
    |--------------------------------------------------------------------------
    |
    | Estas opciones de configuración especifican el comportamiento de la
    | funcionalidad de restablecimiento de contraseña de Laravel, incluida
    | la tabla utilizada para almacenar los tokens y el proveedor de
    | usuarios que se invoca para recuperar a los usuarios.
    |
    | El tiempo de expiración es la cantidad de minutos durante los cuales
    | cada token de restablecimiento se considera válido. Esta medida de
    | seguridad mantiene los tokens de corta duración para que tengan menos
    | tiempo de ser adivinados. Puedes cambiarlo según sea necesario.
    |
    | El ajuste de throttling es la cantidad de segundos que un usuario debe
    | esperar antes de generar más tokens de restablecimiento. Esto evita
    | que genere una gran cantidad de tokens muy rápidamente.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Tiempo de espera de confirmación de contraseña
    |--------------------------------------------------------------------------
    |
    | Aquí puedes definir la cantidad de segundos antes de que expire la
    | ventana de confirmación de contraseña y se pida a los usuarios que
    | introduzcan nuevamente su contraseña a través de la pantalla de
    | confirmación. Por defecto, el tiempo de espera dura tres horas.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
