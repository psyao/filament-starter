<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(
            \JeffGreco13\FilamentBreezy\Pages\MyProfile::class,
            \App\Filament\Pages\MyProfile::class
        );

        $this->app->bind(
            \JeffGreco13\FilamentBreezy\Http\Livewire\Auth\Register::class,
            \App\Filament\Http\Livewire\Auth\Register::class
        );
    }

    public function boot(): void
    {
        //
    }
}
