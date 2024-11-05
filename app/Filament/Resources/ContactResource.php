<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
//                        Forms\Components\Repeater::make('phones')
//                            ->label('Phone Numbers')
//                            ->addActionLabel('Add Phone Number')
//                            ->defaultItems(1)
//                            ->schema([
//                                Forms\Components\TextInput::make('phone')
//                                    ->label('Phone Number')
//                                    ->tel()
//                                    ->required()
//                            ])
//                            ->columns(1),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required(),

                        Forms\Components\Textarea::make('description.ru')
                            ->columnSpanFull()
                            ->default(fn($record) => $record ? $record->getTranslation('name', 'ru') : ''),

                        Forms\Components\Textarea::make('description.kk')
                            ->columnSpanFull()
                            ->default(fn($record) => $record ? $record->getTranslation('name', 'kk') : ''),

                        Forms\Components\KeyValue::make('address')
                            ->required()
                            ->keyLabel('ROme')
                            ->valueLabel('Znachenie')
                            ->editableKeys(false)
                            ->deletable(false)
                            ->addable(false),

                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url()
                            ->prefix('https://instagram.com/')
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('visit')
                                    ->icon('heroicon-m-arrow-top-right-on-square')
                                    ->url(fn($record) => $record?->instagram_url, true)
                            ),

                        Forms\Components\TextInput::make('youtube_url')
                            ->label('YouTube URL')
                            ->url()
                            ->prefix('https://youtube.com/')
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('visit')
                                    ->icon('heroicon-m-arrow-top-right-on-square')
                                    ->url(fn($record) => $record?->youtube_url, true)
                            ),

                        Forms\Components\TextInput::make('whatsapp_url')
                            ->label('WhatsApp URL')
                            ->url()
                            ->prefix('https://wa.me/')
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('visit')
                                    ->icon('heroicon-m-arrow-top-right-on-square')
                                    ->url(fn($record) => $record?->whatsapp_url, true)
                            ),

                        Forms\Components\TextInput::make('telegram_url')
                            ->label('Telegram URL')
                            ->url()
                            ->prefix('https://t.me/')
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('visit')
                                    ->icon('heroicon-m-arrow-top-right-on-square')
                                    ->url(fn($record) => $record?->telegram_url, true)
                            ),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('phones')
                    ->label('First Phone')
                    ->formatStateUsing(fn($state) => $state[0]['phone'] ?? '-'),

                Tables\Columns\TextColumn::make('email'),

                Tables\Columns\IconColumn::make('instagram_url')
                    ->label('Instagram')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->getStateUsing(fn($record) => !empty($record->instagram_url)),

                Tables\Columns\IconColumn::make('youtube_url')
                    ->label('YouTube')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->getStateUsing(fn($record) => !empty($record->youtube_url)),

                Tables\Columns\IconColumn::make('whatsapp_url')
                    ->label('WhatsApp')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->getStateUsing(fn($record) => !empty($record->whatsapp_url)),

                Tables\Columns\IconColumn::make('telegram_url')
                    ->label('Telegram')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->getStateUsing(fn($record) => !empty($record->telegram_url)),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('')->color('grey'),
                Tables\Actions\DeleteAction::make()->label(''),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
