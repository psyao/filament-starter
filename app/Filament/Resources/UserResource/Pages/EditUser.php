<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use XliteDev\FilamentImpersonate\Pages\Actions\ImpersonateAction;

class EditUser extends EditRecord
{

    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            ImpersonateAction::make()->record($this->getRecord()),
            Actions\DeleteAction::make(),
        ];
    }
}
