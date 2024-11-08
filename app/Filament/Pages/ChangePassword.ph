<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePassword extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $title = 'Change Password';
    protected static ?string $slug = 'change-password';

    public ?array $data = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('current_password')
                                    ->label('Current Password')
                                    ->required()
                                    ->password()
                                    ->rules(['required', 'string'])
                                    ->currentPassword(),

                                Forms\Components\TextInput::make('new_password')
                                    ->label('New Password')
                                    ->required()
                                    ->password()
                                    ->rules([
                                        'required',
                                        'string',
                                        Password::min(8)
                                            ->mixedCase()
                                            ->numbers()
                                            ->symbols(),
                                        'different:current_password'
                                    ]),

                                Forms\Components\TextInput::make('new_password_confirmation')
                                    ->label('Confirm New Password')
                                    ->required()
                                    ->password()
                                    ->rules(['required', 'string', 'same:new_password']),
                            ])
                    ])
            ]);
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        auth()->user()->update([
            'password' => Hash::make($data['new_password']),
        ]);

        Notification::make()
            ->title('Password updated successfully')
            ->success()
            ->send();

        $this->form->fill();
    }

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Update Password')
                ->submit('submit'),
        ];
    }
}
