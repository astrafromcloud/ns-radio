<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $navigationGroup = 'CRM';

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(self::getNameLabel())
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label(self::getLastNameLabel())
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(self::getEmailLabel())
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(self::getPhoneLabel())
                    ->alignCenter()
                    ->searchable(),
                Tables\Columns\IconColumn::make('registered_with')
                    ->label(self::getRegisteredWithLabel())
                    ->alignCenter()
                    ->icon(fn(string $state): string => match ($state) {
                        'ns-radio' => 'icon-ns-radio',
                        'google' => 'icon-google',
                        'vk' => 'icon-vk',
                    })
                    ->default('ns-radio'),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->alignCenter()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->alignCenter()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->alignCenter()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('')->color('grey'),
                Tables\Actions\DeleteAction::make()->label('')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('user.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('user.navigation_label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('user.plural_label');
    }

    public static function getNavigationBadge(): ?string
    {
        return cache()->remember(
            "users_resource_badge",
            now()->addMinute(),
            fn() => static::getModel()::count()
        );
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNameLabel(): ?string
    {
        return __('user.name_label');
    }

    public static function getEmailLabel(): ?string
    {
        return __('user.email_label');
    }

    public static function getPhoneLabel(): ?string
    {
        return __('user.phone_label');
    }

    public static function getLastNameLabel(): ?string
    {
        return __('user.last_name_label');
    }

    public static function getRegisteredWithLabel(): ?string
    {
        return __('user.registered_with_label');
    }
}
