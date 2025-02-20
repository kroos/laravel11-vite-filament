<?php

return [
    App\Providers\AppServiceProvider::class,

    // filament
    App\Providers\Filament\AdminPanelProvider::class,

    // Custom Providers
    App\Extensions\Helper\HelperServiceProvider::class,
];
