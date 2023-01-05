<?php

namespace App\Filament\Http\Livewire\Auth;

use Filament\Forms;
use Illuminate\Support\Facades\Hash;
use JeffGreco13\FilamentBreezy\FilamentBreezy;
use JeffGreco13\FilamentBreezy\Http\Livewire\Auth\Register as BaseRegister;

class Register extends BaseRegister
{

    public string $firstName;
    public string $lastName;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('first_name')
                                      ->required()
                                      ->label(__('First name')),
            Forms\Components\TextInput::make('last_name')
                                      ->required()
                                      ->label(__('Last name')),
            Forms\Components\TextInput::make('email')
                                      ->label(__('filament-breezy::default.fields.email'))
                                      ->required()
                                      ->email()
                                      ->unique(table: config('filament-breezy.user_model')),
            Forms\Components\TextInput::make('password')
                                      ->label(__('filament-breezy::default.fields.password'))
                                      ->required()
                                      ->password()
                                      ->rules(app(FilamentBreezy::class)->getPasswordRules()),
            Forms\Components\TextInput::make('password_confirm')
                                      ->label(__('filament-breezy::default.fields.password_confirm'))
                                      ->required()
                                      ->password()
                                      ->same('password'),
        ];
    }

    protected function prepareModelData($data): array
    {
        return [
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
        ];
    }
}
