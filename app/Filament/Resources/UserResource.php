<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use STS\FilamentImpersonate\Impersonate;
use XliteDev\FilamentImpersonate\Tables\Actions\ImpersonateAction;

class UserResource extends Resource
{

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                                          ->required()
                                          ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                                          ->required()
                                          ->maxLength(255),
                Forms\Components\TextInput::make('email')
                                          ->email()
                                          ->required()
                                          ->maxLength(255),
                Forms\Components\TextInput::make('password')
                                          ->password()
                                          ->required(fn(string $context): bool => $context === 'create')
                                          ->maxLength(255)
                                          ->dehydrateStateUsing(fn($state) => Hash::make($state))
                                          ->dehydrated(fn($state) => filled($state)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                                         ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                                         ->sortable(),
                Tables\Columns\TextColumn::make('email')
                                         ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                                         ->dateTime('d.m.Y H:m')
                                         ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                                         ->dateTime('d.m.Y H:m')
                                         ->sortable(),
            ])
            ->filters([
                Filter::make('created_at')
                      ->form([
                          Forms\Components\DatePicker::make('created_from'),
                          Forms\Components\DatePicker::make('created_until'),
                      ])
                      ->query(function (Builder $query, array $data): Builder {
                          return $query
                              ->when(
                                  $data['created_from'],
                                  fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                              )
                              ->when(
                                  $data['created_until'],
                                  fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                              );
                      }),
            ])
            ->actions([
                ImpersonateAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
