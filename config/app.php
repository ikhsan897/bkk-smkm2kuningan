<?php

use Illuminate\Support\ServiceProvider;

return [

    // ... (kode konfigurasi lainnya di atas)

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        
        // == TAMBAHKAN BARIS INI UNTUK MENDAFTARKAN ROUTE PROVIDER ANDA ==
        App\Providers\RouteServiceProvider::class,

    ])->toArray(),

    // ... (kode konfigurasi lainnya di bawah)

];
