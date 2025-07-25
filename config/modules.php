<?php

use Nwidart\Modules\Activators\FileActivator;
use Nwidart\Modules\Providers\ConsoleServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Module Namespace
    |--------------------------------------------------------------------------
    |
    | Default module namespace.
    |
    */

    'namespace' => 'Modules',

    /*
    |--------------------------------------------------------------------------
    | Module Stubs
    |--------------------------------------------------------------------------
    |
    | Default module stubs.
    |
    */

    'stubs' => [
        'enabled' => true,
        'path' => base_path('stubs/nwidart-stubs'),
        'files' => [
            //'routes/web' => 'routes/web.php',
            'routes/api' => 'routes/api.php',
            //'views/index' => 'resources/views/index.blade.php',
            //'views/master' => 'resources/views/layouts/master.blade.php',
            'scaffold/config' => 'config/config.php',
            'composer' => 'composer.json',
            //'assets/js/app' => 'resources/assets/js/app.js',
            //'assets/sass/app' => 'resources/assets/sass/app.scss',
            //'vite' => 'vite.config.js',
            //'package' => 'package.json',
        ],
        'replacements' => [
            'routes/web' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE', 'CONTROLLER_NAMESPACE'],
            'routes/api' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE', 'STUDLY_NAME', 'CONTROLLER_NAMESPACE'],
            'vite' => ['LOWER_NAME', 'STUDLY_NAME'],
            'json' => ['LOWER_NAME', 'STUDLY_NAME', 'MODULE_NAMESPACE', 'PROVIDER_NAMESPACE'],
            'views/index' => ['LOWER_NAME'],
            'views/master' => ['LOWER_NAME', 'STUDLY_NAME'],
            'scaffold/config' => ['STUDLY_NAME'],
            'composer' => [
                'LOWER_NAME',
                'STUDLY_NAME',
                'VENDOR',
                'AUTHOR_NAME',
                'AUTHOR_EMAIL',
                'MODULE_NAMESPACE',
                'PROVIDER_NAMESPACE',
            ],
        ],
        'gitkeep' => true,
    ],
    'paths' => [
        /*
        |--------------------------------------------------------------------------
        | Modules path
        |--------------------------------------------------------------------------
        |
        | This path is used to save the generated module.
        | This path will also be added automatically to the list of scanned folders.
        |
        */

        'modules' => base_path('Modules'),
        /*
        |--------------------------------------------------------------------------
        | Modules assets path
        |--------------------------------------------------------------------------
        |
        | Here you may update the modules' assets path.
        |
        */

        'assets' => public_path('modules'),
        /*
        |--------------------------------------------------------------------------
        | The migrations' path
        |--------------------------------------------------------------------------
        |
        | Where you run the 'module:publish-migration' command, where do you publish the
        | the migration files?
        |
        */

        'migration' => base_path('database/migrations'),

        /*
        |--------------------------------------------------------------------------
        | The app path
        |--------------------------------------------------------------------------
        |
        | app folder name
        | for example can change it to 'src' or 'App'
        */
        'app_folder' => 'app/',

        /*
        |--------------------------------------------------------------------------
        | Generator path
        |--------------------------------------------------------------------------
        | Customise the paths where the folders will be generated.
        | Setting the generate key to false will not generate that folder
        */
        'generator' => [
            // app/
            'channels' => ['path' => 'app/Broadcasting', 'generate' => true],
            'command' => ['path' => 'app/Console', 'generate' => true],
            'emails' => ['path' => 'app/Emails', 'generate' => true],
            'event' => ['path' => 'app/Events', 'generate' => true],
            'jobs' => ['path' => 'app/Jobs', 'generate' => true],
            'listener' => ['path' => 'app/Listeners', 'generate' => true],
            'model' => ['path' => 'app/Models', 'generate' => true],
            'notifications' => ['path' => 'app/Notifications', 'generate' => true],
            'observer' => ['path' => 'app/Observers', 'generate' => true],
            'policies' => ['path' => 'app/Policies', 'generate' => true],
            'provider' => ['path' => 'app/Providers', 'generate' => true],
            'repository' => ['path' => 'app/Repositories', 'generate' => true],
            'resource' => ['path' => 'app/Resource', 'generate' => true],
            'rules' => ['path' => 'app/Rules', 'generate' => true],
            'component-class' => ['path' => 'app/View/Components', 'generate' => false],

            // app/Http/
            'controller' => ['path' => 'app/Http/Controllers', 'generate' => true],
            'filter' => ['path' => 'app/Http/Middleware', 'generate' => true],
            'request' => ['path' => 'app/Http/Requests', 'generate' => true],

            // config/
            'config' => ['path' => 'config', 'generate' => true],

            // database/
            'migration' => ['path' => 'database/migrations', 'generate' => true],
            'seeder' => ['path' => 'database/seeders', 'generate' => true],
            'factory' => ['path' => 'database/factories', 'generate' => true],

            // lang/
            'lang' => ['path' => 'lang', 'generate' => false],

            // resource/
            'assets' => ['path' => 'resources/assets', 'generate' => false],
            'views' => ['path' => 'resources/views', 'generate' => false],
            'component-view' => ['path' => 'resources/views/components', 'generate' => false],

            // routes/
            'routes' => ['path' => 'routes', 'generate' => true],

            // tests/
            'test-unit' => ['path' => 'tests/Unit', 'generate' => true],
            'test-feature' => ['path' => 'tests/Feature', 'generate' => true],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Package commands
    |--------------------------------------------------------------------------
    |
    | Here you can define which commands will be visible and used in your
    | application. You can add your own commands to merge section.
    |
    */
    'commands' => ConsoleServiceProvider::defaultCommands()
        ->merge([
            // New commands go here
        ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Scan Path
    |--------------------------------------------------------------------------
    |
    | Here you define which folder will be scanned. By default will scan vendor
    | directory. This is useful if you host the package in packagist website.
    |
    */

    'scan' => [
        'enabled' => false,
        'paths' => [
            base_path('vendor/*/*'),
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Composer File Template
    |--------------------------------------------------------------------------
    |
    | Here is the config for the composer.json file, generated by this package
    |
    */

    'composer' => [
        'vendor' => 'nwidart',
        'author' => [
            'name' => 'Nicolas Widart',
            'email' => 'n.widart@gmail.com',
        ],
        'composer-output' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Here is the config for setting up the caching feature.
    |
    */
    'cache' => [
        'enabled' => false,
        'driver' => 'file',
        'key' => 'laravel-modules',
        'lifetime' => 60,
    ],
    /*
    |--------------------------------------------------------------------------
    | Choose what laravel-modules will register as custom namespaces.
    | Setting one to false will require you to register that part
    | in your own Service Provider class.
    |--------------------------------------------------------------------------
    */
    'register' => [
        'translations' => true,
        /**
         * load files on boot or register method
         */
        'files' => 'register',
    ],

    /*
    |--------------------------------------------------------------------------
    | Activators
    |--------------------------------------------------------------------------
    |
    | You can define new types of activators here, file, database, etc. The only
    | required parameter is 'class'.
    | The file activator will store the activation status in storage/installed_modules
    */
    'activators' => [
        'file' => [
            'class' => FileActivator::class,
            'statuses-file' => base_path('modules_statuses.json'),
            'cache-key' => 'activator.installed',
            'cache-lifetime' => 604800,
        ],
    ],

    'activator' => 'file',
];
