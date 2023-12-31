<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nip',
        'nik',
        'phone',
        'address',
        'avatar',
        'email',
        'password',
        'organization_id',
        'is_online',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
    public function userincreated(): HasMany
    {
        return $this->hasMany(Post::class, 'created_by', 'id');
    }
    public function postShared(): HasMany
    {
        return $this->hasMany(Post::class, 'created_by', 'id');
    }
    public function userinupdated(): HasMany
    {
        return $this->hasMany(Post::class, 'updated_by', 'id');
    }
    public function userFile(): HasMany
    {
        return $this->hasMany(File::class, 'created_by', 'id');
    }
    public function userGallery(): HasMany
    {
        return $this->hasMany(Gallery::class, 'created_by', 'id');
    }
    public function userContactUs(): HasMany
    {
        return $this->hasMany(ContactUs::class, 'read_by', 'id');
    }
    public function userTag(): HasMany
    {
        return $this->hasMany(ContactUs::class, 'created_by', 'id');
    }
    public function userCategory(): HasMany
    {
        return $this->hasMany(Category::class, 'created_by', 'id');
    }
    public function userSocialMedia(): HasMany
    {
        return $this->hasMany(SocialMedia::class, 'created_by', 'id');
    }
}
