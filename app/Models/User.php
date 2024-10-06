<?php

namespace App\Models;

use App\Interfaces\IMustVerifyCode;
use App\Traits\HasTelegramVerification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 * @property string $verification_code
 * @property Carbon $verified_at
 */
class User extends Authenticatable implements IMustVerifyCode
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasTelegramVerification, Notifiable;

    public readonly string $chat_id;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->chat_id = config('telegram.chat-id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verification_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
