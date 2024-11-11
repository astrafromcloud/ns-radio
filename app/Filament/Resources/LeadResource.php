<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'CRM';
    protected static ?int $navigationSort = 1;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(self::getNameLabel())
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label(self::getPhoneLabel())
                    ->required()
                    ->tel()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label(self::getEmailLabel())
                    ->email()
                    ->maxLength(255),
                Textarea::make('message')
                    ->label(self::getMessageLabel())
                    ->maxLength(65535)
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(self::getNameLabel())
                    ->alignCenter()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label(self::getPhoneLabel())
                    ->alignCenter()
                    ->searchable(),
                TextColumn::make('email')
                    ->label(self::getEmailLabel())
                    ->alignCenter()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(self::getCreatedAtLabel())
                    ->alignCenter()
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()->label(''),
                Tables\Actions\Action::make('ViewLead')
                    ->icon('heroicon-o-eye')
                    ->color('$5e6477')
                    ->icon(false)
                    ->infolist(
                        [
                            Section::make(self::getLeadSectionInformationLabel())
                                ->schema(([
                                    TextEntry::make('name')->label(self::getNameLabel()),
                                    TextEntry::make('email')->label(self::getEmailLabel()),
                                    TextEntry::make('phone')->label(self::getPhoneLabel()),
                                ])
                                )->columns(),
                            Section::make(self::getMessageSectionLabel())
                                ->schema(([
                                    TextEntry::make('message')->label(''),
                                ])
                                )
                                ->columnSpan('full'),
                        ]
                    )
                    ->label('')
                    ->modalSubmitAction('')
                    ->modalCancelAction('')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->recordUrl(false)
            ->recordAction('ViewLead');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
            'view' => Pages\ViewLead::route('/{record}')
        ];
    }

    public static function getLeadSectionInformationLabel() : string
    {
        return __('lead.information_label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('lead.plural_label');
    }

    public static function getMessageSectionLabel() : string
    {
        return __('lead.message_section_label');
    }

    public static function getModelLabel(): string
    {
        return __('lead.model_label');
    }

    public static function getNavigationLabel(): string
    {
        return __('lead.navigation_label');
    }

    public static function getEmailLabel(): string
    {
        return __('lead.email_label');
    }

    public static function getPhoneLabel(): string
    {
        return __('lead.phone_label');
    }

    public static function getMessageLabel(): string
    {
        return __('lead.message_label');
    }

    public static function getNameLabel(): string
    {
        return __('lead.name_label');
    }

    public static function getCreatedAtLabel(): string
    {
        return __('lead.created_at_label');
    }

    public static function getUpdatedAtLabel(): string
    {
        return __('lead.updated_at_label');
    }

    public static function canCreate(): bool
    {
        return false;
    }


}
