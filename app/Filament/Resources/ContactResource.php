<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

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
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Repeater::make('phones')
                                    ->label(__('contact.phone_label'))
                                    ->addActionLabel(__('contact.phone_add_button'))
                                    ->defaultItems(1)
                                    ->columnSpanFull()
                                    ->reorderable(false)
                                    ->schema([
                                        Forms\Components\TextInput::make('phone')
                                            ->label(false)
                                            ->columnSpanFull()
                                            ->mask('+9 (999)-999-99-99')
                                            ->placeholder('+7-777-777-77-77')
                                            ->required()
                                            ->hiddenLabel()
                                            ->maxLength(255)
                                    ])
                                    ->createItemButtonLabel(__('contact.phone_add_button'))
                                    ->maxItems(4)
                            ]),

                        Forms\Components\TextInput::make('email')
                            ->label(self::getEmailLabel())
                            ->columnSpanFull()
                            ->email()
                            ->required(),

                        Forms\Components\Textarea::make('description.ru')
                            ->label(self::getDescriptionRussianLabel())
                            ->rows(6)
                            ->columns(['md' => 2, 'xl' => 4])
                            ->default(fn($record) => $record ? $record->getTranslation('name', 'ru') : ''),

                        Forms\Components\Textarea::make('description.kk')
                            ->label(self::getDescriptionKazakhLabel())
                            ->rows(6)
                            ->columns(['md' => 2, 'xl' => 4])
                            ->default(fn($record) => $record ? $record->getTranslation('name', 'kk') : ''),

                        Forms\Components\Textarea::make('address.ru')
                            ->label(self::getAddressRussianLabel())
                            ->columns(['md' => 2, 'xl' => 4])
                            ->default(fn($record) => $record ? $record->getTranslation('name', 'ru') : ''),

                        Forms\Components\Textarea::make('address.kk')
                            ->label(self::getAddressKazakhLabel())
                            ->columns(['md' => 2, 'xl' => 4])
                            ->default(fn($record) => $record ? $record->getTranslation('name', 'kk') : ''),

                        Forms\Components\TextInput::make('instagram_url')
                            ->label(__('broadcaster.instagram_url_label'))
                            ->placeholder('https://www.instagram.com/')
                            ->prefixIcon('icon-instagram')
                            ->prefixIconColor('#84000e')
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('visit')
                                    ->icon('heroicon-m-arrow-top-right-on-square')
                                    ->url(fn($record) => $record?->instagram_url, true)
                            ),

                        Forms\Components\TextInput::make('youtube_url')
                            ->label(__('broadcaster.youtube_url_label'))
                            ->placeholder('https://www.youtube.com/')
                            ->prefixIcon('icon-youtube')
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('visit')
                                    ->icon('heroicon-m-arrow-top-right-on-square')
                                    ->url(fn($record) => $record?->youtube_url, true)
                            ),

                        Forms\Components\TextInput::make('whatsapp_url')
                            ->label(__('broadcaster.whatsapp_url_label'))
                            ->placeholder('https://wa.me/')
                            ->prefixIcon('icon-whatsapp')
                            ->suffixAction(
                                Forms\Components\Actions\Action::make('visit')
                                    ->icon('heroicon-m-arrow-top-right-on-square')
                                    ->url(fn($record) => $record?->whatsapp_url, true)
                            ),

                        Forms\Components\TextInput::make('telegram_url')
                            ->label(__('broadcaster.telegram_url_label'))
                            ->placeholder('https://t.me/')
                            ->prefixIcon('icon-telegram')
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
                Tables\Columns\TextColumn::make('first_phone_number')
                    ->label(self::getPhoneLabel())
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('email')
                    ->alignCenter()
                    ->label(self::getEmailLabel()),

                Tables\Columns\IconColumn::make('instagram_url')
                    ->label('Instagram')
                    ->alignCenter()
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->getStateUsing(fn($record) => !empty($record->instagram_url)),

                Tables\Columns\IconColumn::make('youtube_url')
                    ->alignCenter()
                    ->label('YouTube')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->getStateUsing(fn($record) => !empty($record->youtube_url)),

                Tables\Columns\IconColumn::make('whatsapp_url')
                    ->label('WhatsApp')
                    ->alignCenter()
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->getStateUsing(fn($record) => !empty($record->whatsapp_url)),

                Tables\Columns\IconColumn::make('telegram_url')
                    ->label('Telegram')
                    ->alignCenter()
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
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('contact.model_label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('contact.plural_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('contact.navigation_label');
    }

    public static function getPhoneLabel(): string
    {
        return __('contact.phone_label');
    }

    public static function getEmailLabel(): string
    {
        return __('contact.email_label');
    }

    public static function getDescriptionKazakhLabel(): string
    {
        return __('contact.description_kazakh_label');
    }

    public static function getDescriptionRussianLabel(): string
    {
        return __('contact.description_russian_label');
    }

    public static function getAddressKazakhLabel(): string
    {
        return __('contact.address_label_kazakh');
    }

    public static function getAddressRussianLabel(): string
    {
        return __('contact.address_label_russian');
    }

    public static function getCreatedAtLabel(): string
    {
        return __('lead.created_at_label');
    }

    public static function getUpdatedAtLabel(): string
    {
        return __('lead.updated_at_label');
    }

    public static function rules(): array
    {
        return [
            'phones.*.phone' => ['required', 'string'],
        ];
    }


}
