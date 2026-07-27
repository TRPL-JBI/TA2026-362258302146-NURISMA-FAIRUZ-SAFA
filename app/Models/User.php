<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Authenticatable
    implements MustVerifyEmail, CanResetPasswordContract
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $primaryKey = 'id_user';

    public $incrementing = true;

protected $keyType = 'int';

public function getAuthIdentifierName()
{
    return 'id_user';
}

    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
    ];

    public function pelakuEkraf(): HasOne
{
    return $this->hasOne(PelakuEkraf::class, 'id_user', 'id_user');
}

public function verifikasi(): HasMany
{
    return $this->hasMany(Verifikasi::class, 'id_admin', 'id_user');
}

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'password' => 'hashed',
        ];
    }

public function sendPasswordResetNotification($token)
{
    $url = 'http://localhost:3000/reset-password?token='
        . $token
        . '&email='
        . urlencode($this->email);

    $this->notify(
        new \App\Notifications\ResetPasswordNotification($url)
    );
}

}
