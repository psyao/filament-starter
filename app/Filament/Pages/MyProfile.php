<?php

namespace App\Filament\Pages;

use Filament\Forms;
use JeffGreco13\FilamentBreezy\Pages\MyProfile as BaseProfile;

class MyProfile extends BaseProfile
{

    protected function getUpdateProfileFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('first_name')
                                      ->required()
                                      ->label(__('First name')),
            Forms\Components\TextInput::make('last_name')
                                      ->required()
                                      ->label(__('Last name')),
            Forms\Components\TextInput::make($this->loginColumn)
                                      ->required()
                                      ->email(fn() => $this->loginColumn === 'email')
                                      ->unique(config('filament-breezy.user_model'), ignorable: $this->user)
                                      ->label(__('filament-breezy::default.fields.email')),
        ];
    }
}
