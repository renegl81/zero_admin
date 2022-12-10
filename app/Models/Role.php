<?php

namespace App\Models;

use App\Zero\Models\ZeroBaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use ZeroBaseModel;
    protected $table = 'roles';
    public $addedToMenu = false;
    protected $fillable = ['name'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}
