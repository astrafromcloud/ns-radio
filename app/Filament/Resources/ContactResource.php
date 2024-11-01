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
//    protected static ?string $navigationLabel = __('Contact Information', [], 'kz');

    public static function getNavigationLabel(): string
    {
        return __('Contact Information', [], 'navigation');
    }
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Details')
                    ->schema([
                        Forms\Components\TextInput::make('phone_1')
                            ->label('Primary Phone')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->placeholder('+1 (555) 000-0000'),

                        Forms\Components\TextInput::make('phone_2')
                            ->label('Secondary Phone')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->placeholder('+1 (555) 000-0000'),

                        Forms\Components\TextInput::make('phone_3')
                            ->label('Alternative Phone')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->placeholder('+1 (555) 000-0000'),

                        Forms\Components\Textarea::make('address')
                            ->required()
                            ->rows(3),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->placeholder('contact@example.com'),
                    ]),

                Forms\Components\Section::make('Social Media Links')
                    ->schema([
                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url()
                            ->prefix('https://')
                            ->placeholder('instagram.com/youraccount'),

                        Forms\Components\TextInput::make('youtube_url')
                            ->label('YouTube URL')
                            ->url()
                            ->prefix('https://')
                            ->placeholder('youtube.com/channel/...'),

                        Forms\Components\TextInput::make('whatsapp_url')
                            ->label('WhatsApp URL')
                            ->url()
                            ->prefix('https://')
                            ->placeholder('wa.me/1234567890'),

                        Forms\Components\TextInput::make('telegram_url')
                            ->label('Telegram URL')
                            ->url()
                            ->prefix('https://')
                            ->placeholder('t.me/youraccount'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('phone_1')
                    ->label('Primary Phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ]);
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
