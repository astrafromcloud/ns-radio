<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MakeCustomFilamentUser extends Command
{
    protected $signature = 'make:custom-filament-user';
    protected $description = 'Create a Filament user with required fields';

    public function handle()
    {
        $name = $this->ask('Name');
        $lastName = $this->ask('Last Name');
        $phone = $this->ask('Phone');
        $email = $this->ask('Email');
        $password = $this->secret('Password');

        $admin = User::create([
            'name' => $name,
            'last_name' => $lastName,
            'phone' => $phone,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }
}
