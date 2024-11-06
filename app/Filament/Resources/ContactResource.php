<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Log;
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
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\Repeater::make('phones')
                                    ->label('Phone Numbers')
                                    ->addActionLabel('Add Phone Number')
                                    ->defaultItems(1)
                                    ->columnSpanFull()
                                    ->reorderable(false)
                                    ->grid(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('phone')
                                            ->label(false)
                                            ->tel()
                                            ->mask('+9-(999)-999-99-99')
                                            ->placeholder('+7-777-777-77-77')
                                            ->required()
                                            ->maxLength(255)
                                    ])
                                    ->createItemButtonLabel('Add Phone Number')
                                    ->deletable(false)
                                    ->maxItems(4)
                            ]),

                        // TODO PHONE EDITOR

                        Forms\Components\TextInput::make('email')
                            ->label(self::getEmailLabel())
                            ->email()
                            ->required(),

                        Forms\Components\Textarea::make('description.ru')
                            ->label(self::getDescriptionRussianLabel())
                            ->columnSpanFull()
                            ->default(fn($record) => $record ? $record->getTranslation('name', 'ru') : ''),

                        Forms\Components\Textarea::make('description.kk')
                            ->label(self::getDescriptionKazakhLabel())
                            ->columnSpanFull()
                            ->default(fn($record) => $record ? $record->getTranslation('name', 'kk') : ''),

                        Forms\Components\Textarea::make('address.ru')
                            ->label(self::getAddressRussianLabel())
                            ->columns(['md' => 2, 'xl' => 4])
                            ->default(fn($record) => $record ? $record->getTranslation('name', 'ru') : ''),

                        Forms\Components\Textarea::make('address.kk')
                            ->label(self::getAddressKazakhLabel())
                            ->columns(['md' => 2, 'xl' => 4])
                            ->default(fn($record) => $record ? $record->getTranslation('name', 'kk') : ''),

//                        Forms\Components\KeyValue::make('address')
//                            ->label(self::getAddresLabel())
//                            ->required()
//                            ->keyLabel('ROme')
//                            ->valueLabel('Znachenie')
//                            ->editableKeys(false)
//                            ->deletable(false)
//                            ->addable(false),

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
                    ->label(self::getPhoneLabel())
                    ->alignCenter()
                    ->formatStateUsing(function ($state) {
                        Log::info(json_decode($state)[0]);
                        return json_decode($state)[0] ?? '-';
                    }),

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
            'create' => Pages\CreateContact::route('/create'),
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
            'phones.*.phone' => ['required', 'string', 'regex:/^\+[0-9]-\([0-9]{3}\)-[0-9]{3}-[0-9]{2}-[0-9]{2}$/'],
        ];
    }
}
