<?php

namespace App\Models;

use App\Zero\Models\ZeroBaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use ZeroBaseModel;

   public bool $addedToMenu = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',

    ];

    public $menu = [
        "to" => 'users',
        "icon"  => 'account',
        "label" => 'Users'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];



    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     * @param  string  $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        foreach ($this->roles as $r) {
            if ($r->name === $role) {
                return true;
            }
        }

        return false;
    }

    public function routeNotificationForMail($notification): array
    {

        // Return email address and name...
        return [$this->email => $this->name];
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function profilePhotoDisk(): string
    {
        return 'public';
    }

    public function uploadPicture($picture)
    {
        $name = Storage::disk('public')->putFile('images/users', $picture);
        $nameParts = explode('/', $name);
        $this->profile_photo_path = $nameParts[count($nameParts) - 1];
        $this->push();
    }
}
