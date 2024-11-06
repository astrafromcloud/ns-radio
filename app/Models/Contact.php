<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory, HasTranslations;

    protected $guarded = false;

    protected $casts = [
        'phones' => 'array',
        'description' => 'array',
        'address' => 'array',
    ];
    public $translatable = ['description', 'address'];

    public function getPhoneNumbersAttribute(): string
    {
        return implode(', ', array_map(
            fn($number) => preg_replace('/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/', '+$1 ($2) $3-$4-$5', $number['phone']),
            $this->phones
        ));
    }
    public function phones(): Attribute
    {
        return Attribute::make(
            set: fn($value) => json_encode(array_map(
                fn($number) => [
                    'phone' => preg_replace('/[^\d]/', '', is_array($number) ? $number['phone'] : $number)
                ],
                is_string($value) ? json_decode($value, true) : $value
            ))
        );
    }

    public function getFirstPhoneNumberAttribute(): ?string
    {
        if (!is_array($this->phones) || empty($this->phones)) {
            return null;
        }

        // Get the first phone number and format it
        $firstPhone = $this->phones[0]['phone'] ?? null;

        return $firstPhone
            ? preg_replace('/(\d{1})(\d{3})(\d{3})(\d{2})(\d{2})/', '+$1 ($2) $3-$4-$5', $firstPhone)
            : null;
    }

}
